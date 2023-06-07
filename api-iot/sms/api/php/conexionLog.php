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
  
    if(!$con=mysqli_connect("iot-ve.com","admin_bd_iot",'M!a560up8#%$asw',"sms_service"))
      {return "Error, no se abrio:";}
    else
      {return $con;}
  }
  
?>