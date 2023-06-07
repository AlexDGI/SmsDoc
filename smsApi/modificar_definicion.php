<?php
  include_once("headers.php");

  require("conexionLog.php");

  $json = file_get_contents('php://input');

  $params = json_decode($json);



  $headers = apache_request_headers();
  $Idfiscalcliente = $headers["Idfiscalcliente"];

  $con=retornarConexion2();



  try {
    mysqli_query($con,"update definiciones set  Nombre='$params->Nombre',
                                                Siglas='$params->Siglas',
                                                Valor='$params->Valor'
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