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
$clave = $params->clave;
if (empty($login) && empty($clave)) {
  $response->status = 'warning';
  $response->mensaje = "Usuario y Contraseña son requeridos";
  echo json_encode($response);
  exit;
}
$rbd = mysqli_query($conLog, "select Id,Password,Status from usuarios where BINARY Nombre='$login'");
//$rest=mysqli_next_result($conLog);
$obtencion = mysqli_fetch_assoc($rbd);
if (!password_verify($clave, $obtencion['Password'])) {
  $response->status = 'warning';
  $response->mensaje = "Usuario o Contraseña inválido";
  echo json_encode($response);
  exit;
}
if ($obtencion['Status'] !== 'VERIFICADO') {
  $response->IdFiscalCliente;
  $response->status = 'warning';
  $response->mensaje = "El usuario que ha ingresado aún no está verificado, comuníquese con el administrador al número 04125150474.";
  echo json_encode($response);
  exit;
}
// echo json_encode($params);
// echo json_encode($obtencion);
// echo json_encode($verificacion);
$idu = $obtencion['Id'];
$rbp = mysqli_query($conLog, "select base, nombre, IdFiscalCliente, id_usuario from privilegios where id_usuario='$idu'");

if (mysqli_num_rows($rbd) > 0) {
  $bds = [];
  while ($reg = mysqli_fetch_assoc($rbp)) {
    $bds[] = $reg;
  }
  echo json_encode($bds);
  exit;
}
