<?php
  include_once("headers.php");

  require("conexionLog.php");
  $headers = apache_request_headers();

  //$bd = $headers["Bds"];
  //$bd= 'bonos_cl_oncovida';
  $con=retornarConexion2();
  $Id = $_GET['Id'];
  
  $registros=mysqli_query($con,"select * from definiciones where Id='$Id'");
  $vec=[];
  if ($reg=mysqli_fetch_assoc($registros))
  {
    $vec[]=$reg;
  }

  $cad=json_encode($reg);
  echo $cad;

?>
