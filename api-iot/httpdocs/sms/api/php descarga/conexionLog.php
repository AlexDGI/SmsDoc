<?php
session_start();
//retornarConexion();

function retornarConexion() {
    //$con=mysqli_connect("localhost","root","","inv2");
    $conLog=mysqli_connect("iot-ve.com","admin_bd_iot",'M!a560up8#%$asw',"seguridad_sms");
    //print_r($conLog);
    return $conLog;
}
function retornarConexion2() {
  // $mysqli = new mysqli("localhost","my_user","my_password","my_db");
  if(!$con=mysqli_connect("iot-ve.com","admin_bd_iot",'M!a560up8#%$asw',"sms_service"))
    {return "Error, no se pudo conectar a la base de datos ";}
  else
    {return $con;}
}
  
?>