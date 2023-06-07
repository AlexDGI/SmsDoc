<?php
  include_once("headers.php");

  require("conexionLog.php");

  $json = file_get_contents('php://input');

  $params = json_decode($json);

  $headers = apache_request_headers();

  //$bd = $headers["Bds"];

  $con=retornarConexion2();



  $r1=mysqli_fetch_assoc(mysqli_query($con,"select count(*) as Existe from clientes where IdFiscal='$params->IdFiscal'"));
  //$r2=mysqli_fetch_assoc($r1);
  $r=$r1['Existe'];
  
  class Resultado {};
  $response = new Resultado();
  if($r==0 && $params->IdFiscal != '')   // Si Definir devuelve error, quiere decir quela sigla buscad no existe por lo tanto se debe crear
  {
    mysqli_query($con,"insert into clientes(IdFiscal, RazonSocial, FirmaSms, NombreContacto, TlfContacto, EmailContacto, Estado) values
                  ('$params->IdFiscal','$params->RazonSocial','$params->FirmaSms','$params->NombreContacto','$params->TlfContacto','$params->EmailContacto','$params->Estado')");

                  $response->status ='success';
                  $response->mensaje = 'Registro agregado a la lista';
  }
  else
    { $response->status ='error';
      $response->mensaje = 'Ya existe un registro con ese nombre';
    }
  echo json_encode($response);
?>
