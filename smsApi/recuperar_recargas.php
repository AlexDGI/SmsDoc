<?php
  include_once("headers.php");

  require("conexionLog.php");
  $headers = apache_request_headers();
  //print_r($headers);
  $IdFiscal = $headers["Idfiscalcliente"];
  //echo json_encode($bd);
  $Idfiscalcliente = $headers["Idfiscalcliente"];
  $con=retornarConexion2();

  $registros=mysqli_query($con,"select * from recargas where IdFiscal='$IdFiscal'");
  $vec=[];
  while ($reg=mysqli_fetch_assoc($registros))
  {
    $vec[]=$reg;
  }

  echo json_encode($vec);
  //echo json_encode($bd);

?>
