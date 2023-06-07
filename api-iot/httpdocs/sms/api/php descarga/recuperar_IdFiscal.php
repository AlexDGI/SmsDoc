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

  $saldo=mysqli_query($con,"select SaldoSms from clientes where Idfiscalcliente='$Idfiscalcliente'");


  $response->mensaje = 'Tu saldo actual de Mensajes es ('.$saldo.')';

  echo json_encode($response);
  //echo json_encode($bd);

?>