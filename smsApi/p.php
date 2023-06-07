<?php
  session_start();
    if (!$conLog = mysqli_connect("p:sistematic-online.com", "sms_admin", 'M!a560up8#%$asw', "sms_service")) {
      echo json_encode('Fallo la conexión a la BD' . mysqli_error($conLog));
    } 
  
  $registros=mysqli_query($conLog,"select * from envios_mae");
echo "saliendo";  
print_r($registros);
/*	$vec=[];
  while ($reg=mysqli_fetch_assoc($registros))
  {
    $vec[]=$reg;
  }

  echo json_encode($vec);
  //echo json_encode($bd);
*/
?>
