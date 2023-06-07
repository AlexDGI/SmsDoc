<?php
  include_once("headers.php");

  require("conexionLog.php");

  $json = file_get_contents('php://input');

  $params = json_decode($json);



  $headers = apache_request_headers();
  $Idfiscalcliente = $headers["Idfiscalcliente"];

  $con=retornarConexion2();


  try {
    mysqli_query($con,"update envios_mae set    IdCliente=$params->IdCliente,
                                                Nombre='$params->Nombre',
                                                Fecha='$params->Fecha',
                                                Registros='$params->Registros',
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