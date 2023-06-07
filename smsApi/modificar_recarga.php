<?php
  include_once("headers.php");

  require("conexionLog.php");

  $json = file_get_contents('php://input');

  $params = json_decode($json);

  //print_r($params);

  $headers = apache_request_headers();
  $Idfiscalcliente = $headers["Idfiscalcliente"];

  $con=retornarConexion2();


  try {
    mysqli_query($con,"update recargas set      Forma='$params->Forma',
                                                Referencia='$params->Referencia',
                                                Fecha='$params->Fecha',
                                                FecTransaccion='$params->FecTransaccion',
                                                Monto='$params->Monto',
                                                Banco='$params->Banco',
                                                Cuenta='$params->Cuenta',
                                                FecVerificacion='$params->FecVerificacion',
                                                UsrVerifico='$params->UsrVerifico',
                                                CantidSms='$params->CantidSms',
                                                Estado='$params->Estado'

              where Id=$params->Id");

    $r = 'success';
    $th = 'Datos modificados exitosamente.';
  
  } catch (\Throwable $th) {
      throw $th;
      $th="ERROR";
      $r = 'error';
  }
  

  class Result {}

  $response = new Result();
  $response->status = $r;
  $response->mensaje = $th;


  echo json_encode($response);
?>  