<?php
  include_once("headers.php");

  require("conexionLog.php");

  $json = file_get_contents('php://input');

  $params = json_decode($json);

  //print_r($params);

  $headers = apache_request_headers();

  $con=retornarConexion2();


  try {
    mysqli_query($con,"update recargas set      
                                                Estado='APROBADO'

              where Id=$params->Id");

    $r = 'success';
    $result = 'OK';
    $th = 'Recarga aprobada exitosamente.';
  
  } catch (\Throwable $th) {
      throw $th;
      $th="ERROR";
      $r = 'error';
  }
  

  class Result {}

  $response = new Result();
  $response->resultado = $result;
  $response->status = $r;
  $response->mensaje = $th;


  echo json_encode($response);
?>  