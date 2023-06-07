<?php
  include_once("headers.php");
//  require("conexionLog.php");
  $json = file_get_contents('php://input');
  $params = json_decode($json);
  $headers = apache_request_headers();
if(!$con=mysqli_connect("iot-ve.com","admin_bd_iot",'M!a560up8#%$asw',"sms_service"))
  {return "Error, no se pudo conectar a la base de datos ";}
//else echo json_encode("Conecto");
  if($params->nombreDoc=='')
  {  $i=$i+1;}

  $k=$params->token.'-'.$params->nombre.'-'.$params->cantDoc.'-'.$params->idUsuEcert;
  if(mysqli_query($con,"insert into debug values(null,'$k','$params->id_documento')"))
  {
      $r=mysqli_query($con,"SELECT LAST_INSERT_ID() as d");
      $r1=mysqli_fetch_array($r);

      ECHO json_encode($r1['d']);
  }
          else {
       ECHO json_encode("Error guardando.");
     //  echo "0";
  }

?>
