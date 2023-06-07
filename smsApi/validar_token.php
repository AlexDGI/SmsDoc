<?php
include_once("headers.php");
include_once("codificar_verificar_clave.php");
include_once("conexionLog.php");
$headers = apache_request_headers();

$json = file_get_contents('php://input');
$params = json_decode($json);
$conLog = retornarConexion();



$tlf = $params;
//print_r($tlf);

$rbp = mysqli_query($conLog, "select Id from login where Telefono='$tlf'");

$bds = false;
if (mysqli_num_rows($rbp) > 0) {
  $bds = true;
  //print_r($bds);
  echo json_encode($bds);
}else{
  $bds = false;
  echo json_encode($bds);
}
