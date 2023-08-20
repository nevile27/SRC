<?php

namespace App\Models;

class DataType {

    public function dType($data, $precision)
    {
        $precision = ($precision == 0) ? count($data):$precision;
        $types = [];
        foreach ($data[0] as $cle => $colonne) {
            $temp_types = [];
            for ($i=0; $i < count($data) && $i < $precision; $i++) { 
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
                    if(array_key_exists('decimal',$temp_types)){
                        $real_type = "decimal";
                    }
                    if(array_key_exists('double',$temp_types)){
                        $real_type = "double";
                    }
                    if(array_key_exists('float',$temp_types)){
                        $real_type = "float";
                    }
                    if(array_key_exists('bigint',$temp_types)){
                        $real_type = "bigint";
                    }
                    break;
                case 'bigint':
                    if(array_key_exists('decimal',$temp_types)){
                        $real_type = "decimal";
                    }
                    if(array_key_exists('double',$temp_types)){
                        $real_type = "double";
                    }
                    if(array_key_exists('float',$temp_types)){
                        $real_type = "float";
                    }
                    break;
                case 'float':
                    if(array_key_exists('decimal',$temp_types)){
                        $real_type = "decimal";
                    }
                    if(array_key_exists('double',$temp_types)){
                        $real_type = "double";
                    }
                    break;
                case 'double':
                    if(array_key_exists('decimal',$temp_types)){
                        $real_type = "decimal";
                    }
                    break;
                case 'varchar':
                    if(array_key_exists('text',$temp_types)){
                        $real_type = "text";
                    }
                    break;
                case 'year':
                    if(array_key_exists('dateTime',$temp_types)){
                        $real_type = "dateTime";
                    }
                    if(array_key_exists('timestamp',$temp_types)){
                        $real_type = "timestamp";
                    }
                    if(array_key_exists('date',$temp_types)){
                        $real_type = "date";
                    }
                    break;
                case 'date':
                    if(array_key_exists('dateTime',$temp_types)){
                        $real_type = "dateTime";
                    }
                    if(array_key_exists('timestamp',$temp_types)){
                        $real_type = "timestamp";
                    }
                    break;
                case 'timestamp':
                    if(array_key_exists('dateTime',$temp_types)){
                        $real_type = "dateTime";
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
                if(strlen((string)abs($var))>9){
                    return "bigint";
                }
                return "int";
            }
            if(is_float(1+$var)){
                return "float";
            }
            if(is_double(1+$var)){
                return "double";
            }
            return "decimal";
        }
        if (strtotime($var)) {
            $details = date_parse($var);
            if($details['year'] == null && $details['month'] == null && $details['day'] == null && $details['error_count'] == 0){
                return "time";
            }
            if($details['hour'] == null && $details['minute'] == null && $details['second'] == null && $details['error_count'] == 0){
                return "date";
            }
            if(strtotime($var) < 0){
                return "dateTime";
            }
            return "timestamp";
        }
        if(is_string($var)){
            if(strlen($var)>190){
                return "text";
            }
            return "varchar";
        }
        return "null";
    }
}