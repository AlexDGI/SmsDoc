<?php
include_once("headers.php");

require("conexionLog.php");

$json = file_get_contents('php://input');

$params = json_decode($json);

$headers = apache_request_headers();

$IdFiscal = $headers["Idfiscalcliente"];

$con = retornarConexion2();

//print_r($params);



// $r1=mysqli_fetch_assoc(mysqli_query($con,"select count(*) as Existe from recargas where Referencia='$params->Referencia'"));
// //$r2=mysqli_fetch_assoc($r1);
// $r=$r1['Existe'];
// //$r==0 && 
class Resultado
{
};
$response = new Resultado();

if ($params->Referencia != '') {

  /*mysqli_query($con,"insert into a (valor1,valor2) values
                  ($params->Monto,'$params->Forma')");
    */
  mysqli_query($con, "insert into recargas(IdFiscal, Fecha, FecTransaccion, FecVerificacion, Forma, Referencia, Monto, Banco, Cuenta, CantidSms, UsrVerifico, Estado) values
                  ('$IdFiscal','$params->Fecha','$params->FecTransaccion',NULL,'$params->Forma','$params->Referencia',$params->Monto,'$params->Banco','$params->Cuenta', $params->CantidSms,NULL,'$params->Estado')");
  //echo ("Error description: " . $con->error);
  $response->status = 'success';
  $response->mensaje = 'Registro agregado a la lista';
} else {
  $response->status = 'error';
  $response->mensaje = 'Ya existe un registro con ese nombre';
}
echo json_encode($response);
