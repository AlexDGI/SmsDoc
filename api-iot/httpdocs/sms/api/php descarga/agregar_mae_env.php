<?php
  include_once("headers.php");

  require("conexionLog.php");

  $json = file_get_contents('php://input');

  $params = json_decode($json);

  $headers = apache_request_headers();

  //$bd = $headers["Bds"];

  $con=retornarConexion2();



  $r1=mysqli_fetch_assoc(mysqli_query($con,"select count(*) as Existe from envios_mae where IdCliente=$params->IdCliente"));
  //$r2=mysqli_fetch_assoc($r1);
  $r=$r1['Existe'];
  
  class Resultado {};
  $response = new Resultado();
  if($r==0 && $params->IdCliente != 0)   // Si Definir devuelve error, quiere decir quela sigla buscada no existe por lo tanto se debe crear
  {
    mysqli_query($con,"insert into envios_mae(IdCliente, Nombre, Fecha, Registros, Estado) values
                  ($params->IdCliente,'$params->Nombre','$params->Fecha','$params->Registros','$params->Estado')");

                  $response->status ='success';
                  $response->mensaje = 'Registro agregado a la lista';
  }
  else
    { $response->status ='error';
      $response->mensaje = 'Ya existe un registro con ese Id Cliente';
    }
  echo json_encode($response);
?>
