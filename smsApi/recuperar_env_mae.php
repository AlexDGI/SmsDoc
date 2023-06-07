<?php
  session_start();
  include_once("headers.php");

  require("conexionLog.php");
  $headers = apache_request_headers();

  $Idfiscalcliente = $headers["Idfiscalcliente"];
  //print_r($headers);
  //$bd = $headers["Bds"];
  //echo json_encode($bd);
  
  $con=retornarConexion2();
session_start();
  $registros=mysqli_query($con,"select * from envios_mae");
  $vec=[];
  while ($reg=mysqli_fetch_assoc($registros))
  {
    $vec[]=$reg;
  }

  echo json_encode($vec);
  //echo json_encode($bd);

?>
