<?php
include_once("headers.php");

require("conexionLog.php");


 

if(isset($_FILES["archivo"])){
    $carpetaDestino = '../../ups';
    $Nombre = "";
    if(file_exists($carpetaDestino) || @mkdir($carpetaDestino))
        {
            $origen=$_FILES["archivo"]["tmp_name"];
            $destino=$carpetaDestino.$_FILES["archivo"]["name"];
            if(@move_uploaded_file($origen, $destino))
            {
                class Result {}
                $response = new Result();
                $response->resultado = 'OK';
                $response->mensaje = 'El archivo ha subido con éxito';
                echo json_encode($response);
            }
            else{
                class Result {}
                $response = new Result();
                $response->resultado = 'Error';
                $response->mensaje = 'El archivo no se pudo mover a la ruta';
                echo json_encode($response);
            }
        }
        else{
            class Result {}
            $response = new Result();
            $response->resultado = 'Error';
            $response->mensaje = 'Error al intentar guardar archivo';
            echo json_encode($response);
        }
}


?>

