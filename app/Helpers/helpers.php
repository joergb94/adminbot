<?php

    if ( ! function_exists('constants'))
    {
        function constants($key){
            return config('constants.' . $key);
        }
    }

    if (!function_exists('cleanString')){
        function cleanString($input){
            if(!is_null($input) ){
                $string_search  = array('"', '\\', ',', '\'','  ', '�');
                $string_replace = array('', '', '', '', ' ', '');
                $input          = str_replace($string_search, $string_replace, $input);
                $input          = trim(utf8_encode($input));
    
            }
            return $input;
        }
    }

    if (!function_exists('getFileContentBase64')){
        function getFileContentBase64($file){
            return preg_replace('/\r|\n/', '', base64_encode(file_get_contents($file)));
        }
    }

    if (!function_exists('stringPregReplace')){
        function stringPregReplace($file){
            return trim(preg_replace('/\t\r\n/', '', $file));
        }
    }

    if (!function_exists('addressStringSubtitution')){
        function addressStringSubtitution($file){
            $from = [' AVENIDA ',' CALLE ',' BOULEVARD ',' EDIFICIO ', ' PISO '];
            $to   = [' AV. ',' C. ',' BLVD. ',' EDF. ', ' PS. '];
            return  strtoupper(trim(str_replace($from, $to, $file)));
        }
    }

    if (!function_exists('convertDataToCsv')){
        function convertDataToCsv(array $data){
            $csv        = '';
            $coma       = '';
            foreach($data[0] as $key => $v){
                $csv .= $coma . $key;
                $coma = ',';
            }
            $csv .= "\n";
            foreach ($data as $item) {
                $coma = '';
                foreach($item as $value){
                    $csv .= $coma.cleanString($value);
                    $coma = ',';
                }
                $csv .= "\n";
            }
            
            return $csv;
        }
    }

    if (!function_exists('base64Validation')){
        function base64Validation($base64, array $mimeTypeAllow=['image/jpeg', 'image/png', 'image/webp']){
            $message = '';
            if(isset($base64) && base64_encode(base64_decode($base64, true)) === $base64 ) {
                $fileInfo         = finfo_open();
                $fileImageDecode  = base64_decode($base64);
                $mime_type        = finfo_buffer($fileInfo, $fileImageDecode, FILEINFO_MIME_TYPE);
                $bytes            = strlen($fileImageDecode);
                $sizeFileDecode   = (((int)$bytes) / 1024.0);

                if( (float)$sizeFileDecode <= 0 ) {
                    $message .= 'El archivo importado no debe estar vacio';
                }

                if ($sizeFileDecode > 1024) {
                    $message .= 'El archivo importado tiene un tamaño incorrecto';
                }

                if (!in_array($mime_type, $mimeTypeAllow)) {
                    $message .= 'Error en el formato de archivo importado, debe ser de tipo '.implode(', ', $mimeTypeAllow);
                } 
            }
            else {
                $message .= 'El archivo importado contiene errores';
            }
            return $message;
        }
    }