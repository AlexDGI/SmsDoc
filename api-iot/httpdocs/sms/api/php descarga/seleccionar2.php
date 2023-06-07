<?php
  include_once("headers.php");

  require("conexionLog_bon_med.php");
  $headers = apache_request_headers();

  $bd = $headers["Bds"];
  //$bd= 'bonos_cl_oncovida';
  $con=retornarConexion2($bd);
  $NumLiquidacion = $_GET['NumLiquidacion'];
  
  $registros=mysqli_query($con,"select * from liquidaciones_mae where NumLiquidacion='$NumLiquidacion'");
  $vec=[];
  if ($reg=mysqli_fetch_assoc($registros))
  {
    $vec[]=$reg;
  }

  $cad=json_encode($reg);
  echo $cad;

?>
