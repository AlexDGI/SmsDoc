<?php
include_once("headers.php");
include_once("codificar_verificar_clave.php");
include_once('conexionLog.php');
$headers = apache_request_headers();
$passClass = new Password();

$json = file_get_contents('php://input');
$params = json_decode($json);



$login = $params->login;
$clave = $params->clave;
//print_r($params);

if (!empty($login) && !empty($clave)) {
  $conLog = retornarConexion();


  $rbd = mysqli_query($conLog, "select Id,Password,Status from login where Nombre='$login'");

  $obtencion = mysqli_fetch_assoc($rbd);
  $rest=mysqli_next_result($conLog);
  if (mysqli_num_rows($rbd) > 0) {
    //$bdx = mysqli_fetch_assoc($rbd);
//echo $bdx['Password'];
    $verificacion = $passClass->verify($clave, $obtencion['Password']);


    if ($verificacion) {
      $idu = $obtencion['Id'];

      $rbp = mysqli_query($conLog, "select base, nombre, IdFiscalCliente from privilegios where id_usuario='$idu'");

      if (mysqli_num_rows($rbd) > 0) {
        $bds = [];
        while ($reg = mysqli_fetch_assoc($rbp)) {
          $bds[] = $reg;
        }
      }
      if ($obtencion['Status'] == 'VERIFICADO') {
        echo $cad = json_encode($bds);
      } else {
        $response->IdFiscalCliente;
        $response->status = 'warning';
        $response->mensaje = "El usuario que ha ingresado aún no está verificado, comuníquese con el administrador al número 04125150474.";
        echo json_encode($response);
      }
    } else {
      $response->status = 'warning';
      $response->mensaje = "Usuario o Contraseña inválido 1";
      echo json_encode($response);
    }
  } else {
    $response->status = 'warning';
    $response->mensaje = "Usuario o Contraseña inválido 2";
    echo json_encode($response);
  }
} else {

  $response->status = 'warning';
  $response->mensaje = "Usuario o Contraseña inválido 3";
  echo json_encode($response);
}
