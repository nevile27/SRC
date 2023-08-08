<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\DataType;

class AnalyseController extends Controller
{
    public function dataExtract($delimiteur = ",")
    {
        // Definition du separateur
        if(strtoupper(substr(PHP_OS, 0, 3)) == "WIN"){
            $s = "\\";
        }else{
            $s = "/";
        }

        // Extraction des donnees du fichiers csv 
        $path = Session::get('chemin');
        $flux = fopen(storage_path('app'.$s.'public'. $s . $path), 'r');
        $i = 0;
        while (!feof($flux)) {
            $line = fgetcsv($flux);
            if($line){
                $data[$i] = $line;
                $i++;
            }
        }
        
        if ($data) {
            $prefix = Session::get('prefixe');
            if (Schema::hasTable($prefix."s")) {
                Schema::drop($prefix."s");
                $migs = scandir("..".$s."database".$s."migrations");
                foreach ($migs as $value) {
                    if (str_contains($value, $prefix)) {
                        $mig_name = $value;
                    }
                }
                $remove = system(storage_path('app'.$s.'shell'. $s) . 'remove.sh '. $mig_name );
            }

            // Identification du type de données dans chaque colonnes 
            $dataTypes = new DataType;
            $types = $dataTypes->dType($data);

            Session::put('colonnes',$data[0]);
            Session::put('types',$types);

            // Creation du fichier de migration
            $make_mig = system(storage_path('app'.$s.'shell'. $s) . 'maker.sh ' . $prefix);

            // Modification du fichier de migration 
            $migs = scandir("..".$s."database".$s."migrations");
            foreach ($migs as $value) {
                if (str_contains($value, $prefix)) {
                    $mig_name = $value;
                }
            }
            Session::put('migrations',$mig_name);/**/
            $mig = file_get_contents("..".$s."database".$s."migrations" . $s . $mig_name);
            if ($mig == false) {
                return view('error',['error'=>3]);
            }
            $pos = strrpos($mig, "\$table->timestamps();");
            $mig_stream = fopen("..".$s."database".$s."migrations" . $s. $mig_name, 'r+');
            if($mig_stream == false){
                return view('error',['error'=>4]);
            }
            $content = fread($mig_stream, $pos);
            foreach ($data[0] as $key => $value) {
                switch ($types[$key]) {
                    case 'int':
                        $content .= "\$table->integer('" . $value . "');\n\t\t\t";
                        break;
                    case 'bigint':
                        $content .= "\$table->bigInteger('" . $value . "');\n\t\t\t";
                        break;
                    case 'decimal':
                        $content .= "\$table->decimal('" . $value . "');\n\t\t\t";
                        break;
                    case 'float':
                        $content .= "\$table->float('" . $value . "');\n\t\t\t";
                        break;
                    case 'double':
                        $content .= "\$table->double('" . $value . "');\n\t\t\t";
                        break;
                    case 'varchar':
                        $content .= "\$table->string('" . $value . "');\n\t\t\t";
                        break;
                    case 'text':
                        $content .= "\$table->text('" . $value . "');\n\t\t\t";
                        break;
                    case 'timestamp':
                        $content .= "\$table->timestamp('" . $value . "');\n\t\t\t";
                        break;
                    case 'null':
                        $content .= "\$table->string('" . $value . "');\n\t\t\t";
                        break;
                    default:
                        $content .= "\$table->string('" . $value . "');\n\t\t\t";
                        break;
                }
            }
            $content .= fread($mig_stream, filesize("..".$s."database".$s."migrations" . $s . $mig_name));
            fseek($mig_stream, 0);
            fwrite($mig_stream, $content);
            fclose($mig_stream);

            // Execution du fichier de migration, creation de la nouvelle table 
            $exec_migrate = system(storage_path('app'.$s.'shell'. $s) . 'migrate.sh');

            // Insertion des donnees du fichier csv dans la nouvelle table
            $inserts = [];
            foreach ($data as $key => $value) {
                if ($key != 0) {
                    $insert = [];
                    foreach ($data[0] as $cle => $valeur) {
                        $insert += [$valeur => $value[$cle]];
                    }
                    $inserts += [--$key => $insert];
                }
            }
            if(DB::table($prefix . 's')->insert($inserts) == false){
                return view('error',['error'=>7]);
            }
            return redirect(route('third'));
        }
        return view('error',['error'=>8]);
    }

}
