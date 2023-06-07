<?php
  include_once("headers.php");
  require("conexionLog_bon_med.php");

  $headers = apache_request_headers();

  $bd = $headers["Bds"];

  $con=retornarConexion2($bd);
  
  $sigla = $_GET["sigla"];

  $registros=mysqli_query($con,"select definir($sigla)");

  if ($reg=mysqli_fetch_array($registros))
  {
    $vec[]=$reg;
  }

  $cad=json_encode($vec);
  echo $cad;

?>
