<?php
  include_once("headers.php");

  require("conexionLog.php");

  $headers = apache_request_headers();
  $con=retornarConexion2();
  mysqli_query($con,"delete from clientes where Id=$_GET[Id]");

  class Result {}

  $response = new Result();
  $response->resultado = 'OK';
  $response->mensaje = 'Registro borrado';

  header('Content-Type: application/json');
  echo json_encode($response);
?>