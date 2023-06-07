<?php
include_once("headers.php");
include_once("conexionLog.php");

$headers = apache_request_headers();
$con=retornarConexion2();

$json = file_get_contents('php://input');
$params = json_decode($json);
  
  //print_r($headers);
  //print_r($params);
  
  //mysqli_query($con,"insert into a values($params)");

  try {
    mysqli_query($con,"update envios_det set    IdMae='$params->IdMae',
                                                Telefono='$params->Telefono',
                                                Mensaje='$params->Mensaje',
                                                Dato1='$params->Dato1',
                                                Dato2='$params->Dato2',
                                                Estado='$params->Estado'
              where Id=$params->Id");

    $r = 'success';
    $th = 'Datos modificados exitosamente.';
  
  } catch (\Throwable $th) {
      throw $th;
      $th="ERROR";
      $r = 'error';
  }
  

  class Result {}

  $response = new Result();
  $response->status = $r;
  $response->mensaje = $th;


  echo json_encode($response);

?>