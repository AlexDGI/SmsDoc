<?php
  include_once("headers.php");

  require("conexionLog.php");

  $json = file_get_contents('php://input');

  $params = json_decode($json);

  $headers = apache_request_headers();

  //$bd = $headers["Bds"];

  $con=retornarConexion2();



  $r1=mysqli_fetch_assoc(mysqli_query($con,"select count(*) as Existe from definiciones where Siglas='$params->Siglas'"));
  //$r2=mysqli_fetch_assoc($r1);
  $r=$r1['Existe'];

 /* $r1=mysqli_query($con, 'select Definir($params->Siglas) as t');
  $r2=mysqli_fetch_assoc($r1);
  $r=$r2['t']; */
  
  class Resultado {};
  $response = new Resultado();
  if($r==0 && $params->Nombre != '')   // Si Definir devuelve error, quiere decir quela sigla buscad no existe por lo tanto se debe crear
  {
    mysqli_query($con,"insert into definiciones(Nombre,Siglas,Valor) values
                  ('$params->Nombre','$params->Siglas','$params->Valor')");
                  $response->status ='success';
                  $response->mensaje = 'Registro agregado a la lista';
  }
  else
    { $response->status ='error';
      $response->mensaje = 'Ya existe un registro con ese nombre';
    }


 


 
  

    // $r1=mysqli_query($con,"select count(*) as Existe from definiciones where Siglas='$params->Siglas'");
    // $r2=mysqli_fetch_assoc($r1);
    // $r=$r2['Existe'];
    // if($r==0){
    //   mysqli_query($con,"insert into definiciones(Nombre,Siglas,Valor) values
    //               ('$params->Nombre','$params->Siglas','$params->Valor')");

    //   class Result {}
    //   $response = new Result();
    //     $response->resultado='OK';
    //     $response->mensaje='Registro agregado a la lista';
    // }
    // else{
    //   class Result {}

    //   $response = new Result();
    //     $response->resultado='error';
    //     $response->mensaje='Ya existe un registro con ese nombre';
    // }
  // $response->resultado = if($r==0?'OK': 'ERROR');
  // $response->mensaje = ($r==0?'datos grabados':'no se grabo nada');


  echo json_encode($response);
?>
