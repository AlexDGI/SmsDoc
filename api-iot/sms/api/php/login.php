<?php
   include_once("headers.php");

 $json = file_get_contents('php://input');
 $params = json_decode($json);

require('conexionLog.php');

 $login = $params->login;
 $clave = $params->clave;

if(!empty($login) and !empty($clave) ){
  $conLog=retornarConexion();

  $rbd=mysqli_query($conLog,"select Id from login where Nombre='$login' && Password='$clave'");
  if(mysqli_num_rows($rbd)>0)
  {
    $bdx=mysqli_fetch_array($rbd);

    $idu=$bdx['Id'];
    $rbp=mysqli_query($conLog,"select base from privilegios where id_usuario='$idu'");
      if(mysqli_num_rows($rbd)>0)
      {
        $bds=[];
        while ($reg=mysqli_fetch_assoc($rbp))
        {
          $bds[]=$reg;
   
        }
      }
      else
      {$bds='ERROR';}
  }
  else
  {
    $bds = 'ERROR';
  }
  $cad=json_encode($bds);
  echo $cad;
}
else {
  $bds = 'ERROR';
  echo json_encode($mensaje);
}