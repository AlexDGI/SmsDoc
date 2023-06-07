<?php
include_once("headers.php");
include_once("codificar_verificar_clave.php");
include_once('conexionLog.php');
$headers = apache_request_headers();
$passClass = new Password();

$conLog = retornarConexion();
$json = file_get_contents('php://input');
$params = json_decode($json);

$login = $params->login;
if (empty($login)) {
  $response->status = 'warning';
  $response->mensaje = "Usuario requerido";
  echo json_encode($response);
  exit;
}
$rbd = mysqli_query($conLog, "select Id,Nombre,Password,Email,Status from usuarios where BINARY Nombre='$login'");

if (mysqli_num_rows($rbd) <= 0) {
  $response->status = 'warning';
  $response->mensaje = "Usuario no existe";
  echo json_encode($response);
  exit;
}
//$rest=mysqli_next_result($conLog);
$obtencion = mysqli_fetch_assoc($rbd);
$email = $obtencion['Email'];
//echo json_encode($params);
//echo json_encode($obtencion);
$idu = $obtencion['Id'];
if (mysqli_num_rows($rbd) > 0) {
  $email;
  $limit = 6;
  $enteroRandom = random_int(10 ** ($limit - 1), (10 ** $limit) - 1);
  $correo = 'El código provisional generado de la app SmsV2 para el usuario '.$login.' es el siguiente: '.$key.' ingrese con esta clave la próxima vez.';

  $response->status = 'success';
  $response->mensaje = 'Se ha enviado una clave provisional al correo '.$email.', ingrese con esa clave la próxima vez.';
  echo json_encode($response);
  exit;
}
