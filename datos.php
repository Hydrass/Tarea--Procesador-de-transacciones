<?php

    Class Datos{


        function creacionSerializacion($file){
            $datos = serialize($file);
            file_put_contents("DarosSerealizado.dat",$datos);
        }


        function subirJson($file){
            
            $fileName = $_FILES['file']['tmp_name'];

            if($_FILES['file']['size'] > 0){
                $file = fopen($fileName, 'r');

                while(($column = fgetcsv($file, 1000, ',')) !== FALSE){
                    // $valore = $column[0], $column[1];
                    var_dump($valore);
                }
            }
        

         }
        function subirCSV($file){
            $fileName = $_FILES['file']['tmp_name'];

            // if($_FILES['file']['size'] > 0){
                $file = fopen($fileName, 'r');

                while(($column = fgetcsv($file, 1000, ",")) !== FALSE){
                    // $valore = $column[0], $column[1];
                    var_dump($file );
                    // echo "Hola";
                
            }
        

         }


         function descargarJSON($file){
            header('Content-Type:application/json; charset=UFT-8');
            header('Content-Disposition:attachment;filename=datos.json');
            header('Cache-Conntrol: no-cache, no-store, must-revalidate');
            header('Pragma: no-cache');
            header('Expires:0');

            $output = fopen("php://output","w");

            $salida_array = [];

            foreach($file as $datos_nuevo){
                $salida_array[] = $datos_nuevo;
            }

            fwrite($output, json_encode($salida_array));
            fclose($output);
            exit;

         }

         function descargarCSV($file){
             header('Content-Type:text/plain');
             header('Content-Disposition:attachment;filename=datos.csv');
             header('Cache-Conntrol: no-cache, no-store, must-revalidate');
             header('Pragma: no-cache');
             header('Expires:0');
             $output = fopen("php://output","w");
             $inicio = true;


             foreach($file as $data){
                if($inicio){
                    $encabezado = array_keys($data);
                    fputcsv($output, $encabezado);
                    $inicio = false;
                }
                fputcsv($output, $data);
             }
             fclose($output);
             exit;

             foreach ($file as $datos_nuevo){
                print($datos_nuevo['Hora']);
                print($datos_nuevo['Fecha']);
                print($datos_nuevo['Monto']);
                print($datos_nuevo['Descripcion']);

            }
         }
         

    }

?>