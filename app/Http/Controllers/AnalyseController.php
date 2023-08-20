<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\DataType;
use Hamcrest\Type\IsNumeric;

class AnalyseController extends Controller
{
    public function dataExtract(Request $request)
    {
        // Definition du separateur
        if(strtoupper(substr(PHP_OS, 0, 3)) == "WIN"){
            $s = "\\";
        }else{
            $s = "/";
        }

        // Extraction des donnees du fichiers csv 

        $chars = [NULL," ",",",";","'","\"","/","\\"];
        $delimiteur = $chars[$request->spec1];
        $encadrement = $chars[$request->spec2];
        $echappement = $chars[$request->spec3];
        $path = Session::get('chemin');
        $flux = fopen(storage_path('app'.$s.'public'. $s . $path), 'r');
        $i = 0;
        while (!feof($flux)) {
            $line = fgetcsv($flux,null,$delimiteur,$encadrement,$echappement);
            if($line){
                $data[$i] = $line;
                $i++;
            }
        }
        
        if ($data) {
            //Vérification du formatage des collonnes
            foreach ($data[0] as $key => $colonne) {
                if(preg_match("/^[a-z][a-z0-9_]{0,63}$/i", $colonne) == 0){
                    return view('error',['error'=>4]);
                }
            }
            Session::put('colonnes',$data[0]);

            // Identification du type de données dans chaque colonnes 
            $dataTypes = new DataType;
            $types = $dataTypes->dType($data,$request->spec4);
            if($types == false){
                return view('error',['error'=>5]);
            }
            Session::put('types',$types);

            // Suppression de la configuration existante
            $prefix = Session::get('prefixe');
            if (Schema::hasTable($prefix."s")) {
                Schema::drop($prefix."s");
            }
            $migs = scandir("..".$s."database".$s."migrations");
            foreach ($migs as $value) {
                if (str_contains($value, $prefix)) {
                    system(storage_path('app'.$s.'shell'. $s) . 'remove.sh '. $value , $exit_code);
                    if($exit_code != 0){
                        return view('error',['error'=>1]);
                    }
                    break;
                }
            }

            // Creation du fichier de migration
            system(storage_path('app'.$s.'shell'. $s) . 'maker.sh ' . $prefix, $exit_code);
            if($exit_code != 0){
                return view('error',['error'=>2]);
            }

            // Modification du fichier de migration 
            $migs = scandir("..".$s."database".$s."migrations");
            foreach ($migs as $value) {
                if (str_contains($value, $prefix)) {
                    $mig_name = $value;
                }
            }
            if(!isset($mig_name)){
                return view('error',['error'=>3]);
            }
            $mig = file_get_contents("..".$s."database".$s."migrations" . $s . $mig_name);
            $pos = strrpos($mig, "\$table->timestamps();");
            $mig_stream = fopen("..".$s."database".$s."migrations" . $s. $mig_name, 'r+');
            $content = fread($mig_stream, $pos);
            foreach ($data[0] as $key => $value) {
                if($value == 'id'){
                    continue;
                }
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
                    case 'time':
                        $content .= "\$table->time('" . $value . "');\n\t\t\t";
                        break;
                    case 'date':
                        $content .= "\$table->date('" . $value . "');\n\t\t\t";
                        break;
                    case 'dateTime':
                        $content .= "\$table->dateTime('" . $value . "');\n\t\t\t";
                        break;
                    case 'timestamp':
                        $content .= "\$table->timestamp('" . $value . "');\n\t\t\t";
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
            system(storage_path('app'.$s.'shell'. $s) . 'migrate.sh', $exit_code);
            if($exit_code != 0){
                return view('error',['error'=>6]);
            }

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
            try {
                DB::table($prefix . 's')->insert($inserts);
            } catch (\Throwable $th) {
                return view('error',['error'=>7]);
            }
            return redirect(route('third'));
        }
        return view('error',['error'=>8]);
    }

}
