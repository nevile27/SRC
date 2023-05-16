<?php

namespace App\Models;

class DataType {

    public function dType($data)
    {
        $types = [];
        foreach ($data[0] as $cle => $colonne) {
            $temp_types = [];
            for ($i=0; $i < count($data) && $i < 20; $i++) { 
                $temp_type = $this->detect($data[$i][$cle]);
                if(array_key_exists($temp_type,$temp_types)){
                    $temp_types[$temp_type]++;
                }else{
                    $temp_types += [$temp_type => 0];
                }
            }
            $previous = 0;
            foreach ($temp_types as $temp_type => $nbr) {
                if ($nbr > $previous) {
                    $real_type = $temp_type;
                }
                $previous = $nbr;
            }
            switch ($real_type) {
                case 'int':
                    if(array_key_exists('float',$temp_types)){
                        $real_type = "float";
                    }
                    if(array_key_exists('double',$temp_types)){
                        $real_type = "double";
                    }
                    if(array_key_exists('real',$temp_types)){
                        $real_type = "real";
                    }
                    break;
                case 'float':
                    if(array_key_exists('double',$temp_types)){
                        $real_type = "double";
                    }
                    if(array_key_exists('real',$temp_types)){
                        $real_type = "real";
                    }
                    break;
                case 'double':
                    if(array_key_exists('real',$temp_types)){
                        $real_type = "real";
                    }
                    break;
                default:
                    # code...
                    break;
            }
            $types[$cle] = $real_type;
        }

        return $types;
    }

    private function detect($var)
    {
        if (is_numeric($var)) {
            if(is_int(1+$var)){
                return "int";
            }
            if(is_float(1+$var)){
                return "float";
            }
            if(is_double(1+$var)){
                return "double";
            }
            return "real";
        }
        if(is_string($var)){
            if(strlen($var)>240){
                return "text";
            }
            return "varchar";
        }
        if (strtotime($var)) {
            return "timestamp";
        }
        return "null";
    }
}