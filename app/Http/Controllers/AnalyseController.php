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
        // Extraction des donnees du fichiers csv 
        $path = Session::get('chemin');
        $flux = fopen(storage_path('app\\public\\' . $path), 'r');
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
            $param = ucfirst($prefix);
            if (Schema::hasTable($prefix."s")) {
                Schema::drop($prefix."s");
                $migs = scandir("..\\database\\migrations");
                foreach ($migs as $value) {
                    if (str_contains($value, $prefix)) {
                        $mig_name = $value;
                    }
                }
                $remove = system(storage_path('app\\shell\\') . 'remove.sh ' . $param .' '. $mig_name );
            }

            // Identification du type de données dans chaque colonnes 
            $dataTypes = new DataType;
            $types = $dataTypes->dType($data);

            Session::put('colonnes',$data[0]);
            Session::put('types',$types);

            // Creation du fichier de migration et du fichier de model
            $make_mig = system(storage_path('app\\shell\\') . 'maker.sh ' . $param);

            // Modification du fichier de migration 
            $migs = scandir("..\\database\\migrations");
            foreach ($migs as $value) {
                if (str_contains($value, $prefix)) {
                    $mig_name = $value;
                }
            }
            Session::put('migrations',$mig_name);/**/
            $mig = file_get_contents("..\\database\\migrations\\" . $mig_name);
            if ($mig == false) {
                return view('error',['error'=>3]);
            }
            $pos = strrpos($mig, "\$table->timestamps();");
            $mig_stream = fopen("..\\database\\migrations\\" . $mig_name, 'r+');
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
            $content .= fread($mig_stream, filesize("..\\database\\migrations\\" . $mig_name));
            fseek($mig_stream, 0);
            fwrite($mig_stream, $content);
            fclose($mig_stream);
            

            // Modification du fichier de model 
            $model = file_get_contents("..\\app\\Models\\$param.php");
            if ($model == false) {
                $remove = system(storage_path('app\\shell\\') . 'remove.sh ' . $param .' '. $mig_name );
                return view('error',['error'=>5]);
            }
            $pos = strrpos($model, "}");
            $model_stream = fopen("..\\app\\Models\\$param.php", 'r+');
            $content = fread($model_stream, $pos);
            $content .= "\n\tprotected \$fillable = [";
            foreach ($data[0] as  $value) {
                $content .= "'" . $value . "',";
            }
            $content .= "];\n\n";
            $content .= fread($model_stream, filesize("..\\app\\Models\\$param.php"));
            fseek($model_stream, 0);
            fwrite($model_stream, $content);
            fclose($model_stream);

            // Modification du fichier de control du dashboard
            $controller = file_get_contents("..\\app\\Http\\Controllers\\DashController.php");
            if ($controller == false) {
                $remove = system(storage_path('app\\shell\\') . 'remove.sh ' . $param .' '. $mig_name );
                return view('error',['error'=>0]);
            }
            $content = str_replace("DataType",$param,$controller);
            $controller_stream = fopen("..\\app\\Http\\Controllers\\DashController.php", 'r+');
            ftruncate($controller_stream,0);
            fwrite($controller_stream, $content);
            fclose($controller_stream);

            // Execution du fichier de migration, creation de la nouvelle table 
            $exec_migrate = system(storage_path('app\\shell\\') . 'migrate.sh');

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

    public function dataPresentation($options = 0)
    {
        $path = Session::get('chemin');
        $flux = fopen(storage_path('app\\public\\' . $path), 'r');
        $i = 0;
        while (!feof($flux)) {
            $data[$i] = fgetcsv($flux);
            $i++;
        }
        return view('rapport', ['data' => $data]);
    }
}
