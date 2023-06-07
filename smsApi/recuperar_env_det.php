<?php
  include_once("headers.php");

  require("conexionLog.php");

  $json = file_get_contents('php://input');

  $params = json_decode($json);



  $headers = apache_request_headers();
  $Idfiscalcliente = $headers["Idfiscalcliente"];
  $con=retornarConexion2();

  $Id = $_GET['Id'];


  $registros=mysqli_query($con,"select * from envios_det where IdMae='$Id'");
  $vec=[];
  while ($reg=mysqli_fetch_assoc($registros))
  {
    $vec[]=$reg;
  }

  echo json_encode($vec);
  //echo json_encode($bd);

?>