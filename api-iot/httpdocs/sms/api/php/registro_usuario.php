<?php

  include_once("codificar_verificar_clave.php");

  include_once("headers.php");

  require("conexionLog.php");


  $json = file_get_contents('php://input');

  $params = json_decode($json);

  $headers = apache_request_headers();

  $con=retornarConexion();
  
  //print_r($params);
  $IdFiscal=$params->idFiscal;
  $nombre=$params->nombre;



  $r1=mysqli_fetch_assoc(mysqli_query($con,"select count(*) as Existe from privilegios where IdFiscalCliente='$IdFiscal'"));
  $existe=$r1['Existe'];
  class Resultado {};
  $response = new Resultado();

  $passClass = new Password();
  
  $clave=$passClass->hash($params->clave);

  if( !$existe and  $nombre != '' )
  {

    /*mysqli_query($con,"insert into a (valor1,valor2) values
                  ($params->Monto,'$params->Forma')");
    */
    mysqli_query($con,"insert into login(Nombre, Email, Password, Telefono, createdAt) values
                  ('$nombre','$params->email','$clave','$params->tlf',curdate())");

    $idLogin = $con->insert_id;


    mysqli_query($con,"insert into privilegios(nombre, IdFiscalCliente,createdAt, id_usuario, base) values
                ('$params->empresa','$IdFiscal',curdate(),'$idLogin', 'sms_service')");

                $response->mensaje = 'El usuario y los privilegios han sido creados con éxito';
                $response->status ='success';

    $con->close();
                
  }
  else
    { $response->status ='error';
      $response->mensaje = "Ya existe una empresa con el Id Fiscal '$IdFiscal'";
    }
  echo json_encode($response);
?>
