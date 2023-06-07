<?php
  include_once("headers.php");

  require("conexionLog.php");

  $headers = apache_request_headers();
  $Idfiscalcliente = $headers["Idfiscalcliente"];
  $con=retornarConexion2();
  mysqli_query($con,"delete from recargas where Id=$_GET[Id]");

  class Result {}

  $response = new Result();
  $response->resultado = 'OK';
  $response->mensaje = 'Recarga borrada con éxito';

  header('Content-Type: application/json');
  echo json_encode($response);
?>