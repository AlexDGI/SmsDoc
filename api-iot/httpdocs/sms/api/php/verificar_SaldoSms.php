<?php
  include_once("headers.php");

  require("conexionLog.php");
  $headers = apache_request_headers();
  //print_r($headers);
  $IdFiscal = $headers["Idfiscalcliente"];
  
  $con=retornarConexion2();

  class Resultado {};
  $response = new Resultado();
  $dCli=mysqli_query($con,"select * from clientes where IdFiscal='$IdFiscal'");
  $d=mysqli_fetch_array($dCli);
  $SaldoSms=$d['SaldoSms'];


  $response->mensaje = 'Tu saldo actual de Mensajes es '.$SaldoSms.'';

  echo json_encode($response);
  //echo json_encode($bd);

?>