<?php
  include_once("headers.php");

  require("conexionLog.php");

  $json = file_get_contents('php://input');

  $params = json_decode($json);

  $headers = apache_request_headers();

  //$bd = $headers["Bds"];

  $con=retornarConexion2();



  //$r1=mysqli_fetch_assoc(mysqli_query($con,"select count(*) as Existe from envios_det where IdCliente=$params->IdMae"));
  //$r2=mysqli_fetch_assoc($r1);
  //$r=$r1['Existe'];
  
  class Resultado {};
  $response = new Resultado();
  if($params->Telefono != 0)   // Si Definir devuelve error, quiere decir quela sigla buscada no existe por lo tanto se debe crear
  {
    mysqli_query($con,"insert into envios_det(IdMae, Telefono, Mensaje, Dato1, Dato2, Estado) values
                  ($params->IdMae,'$params->Telefono','$params->Mensaje','$params->Dato1','$params->Dato2','$params->Estado')");

                  $response->status ='success';
                  $response->mensaje = 'Registro agregado a la lista';
  }
  else
    { $response->status ='error';
      $response->mensaje = 'Ya existe un registro con ese Id Maestro';
    }
  echo json_encode($response);
?>
