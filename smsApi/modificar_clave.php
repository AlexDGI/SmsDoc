<?php
include_once("headers.php");
include_once("codificar_verificar_clave.php");
include_once('conexionLog.php');
$headers = apache_request_headers();
$passClass = new Password();

$conLog = retornarConexion();
$json = file_get_contents('php://input');
$params = json_decode($json);
$clave = $passClass->hash($params->Clave);
//echo json_encode($params);
//echo json_encode($clave);

  try {
    mysqli_query($conLog,"update usuarios set Password='$clave'
  
              where Id=$params->Id");

    $status = 'success';
    $mensaje = 'Datos modificados exitosamente.';
  
  } catch (\Throwable $th) {
      throw $th;
      $th="ERROR";
      $r = 'error';
  }
  

  class Result {}

  $response = new Result();
  $response->status = $status;
  $response->mensaje = $mensaje;


  echo json_encode($response);
