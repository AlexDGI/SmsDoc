<?php
  include_once("headers.php");

  require("conexionLog.php");
  $headers = apache_request_headers();
  //print_r($headers);
  $Idfiscalcliente = $headers["Idfiscalcliente"];
  //echo json_encode($rs);

  $con=retornarConexion2();
  class Resultado {};
  $response = new Resultado();
  $rsaldo=mysqli_query($con,"select SaldoSms from clientes where Idfiscalcliente='$Idfiscalcliente'");
  $data=mysqli_fetch_array($rsaldo);$FecUltEnvio='';
  $saldo=$data['SaldoSms'];
  $FecUltEnvio=0;$CantUltEnv=0;$msg='indefinido';
  if($saldo<=0) $msg=' No tienes saldo disponible para el envío de SMS, por favor ve a la sección de recargas.';
  if($aldo >0 and $saldo < 500) $msg=' Tu saldo disponible para el envío de SMS es de: '.$saldo.' es bajo, por favor ve a la sección de recargas.';
  if($aldo >500) $msg=' Bienvenido, tu saldo actual de SMS es de:'.$saldo.', tú último envío fue el :'.$FecUltEnvio.' cuando enviaste:'.$CantUltEnv.' SMS';

  $response->mensaje = $msg;

  echo json_encode($response);
  //echo json_encode($bd);

?>
