<?php
  include_once("headers.php");

  require("conexionLog.php");

  $headers = apache_request_headers();
  //print_r($headers);
  //$bd = $headers["Bds"];
  //echo json_encode($bd);
  
  $con=retornarConexion2();
    //$Siglas=$_GET['Siglas'];
    //$PeriodoActual='PeríodoActual';

    //where Siglas='$Siglas'
  $registros=mysqli_query($con,"select Id, Siglas, Nombre, Valor from definiciones");

  $vec=[];
  while ($reg=mysqli_fetch_assoc($registros))
  {
    $vec[]=$reg;
  }

  echo json_encode($vec);
  //echo json_encode($bd);

?>