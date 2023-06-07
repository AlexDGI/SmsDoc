<?php
session_start();

function retornarConexion()
{
  if (!$conLog = mysqli_connect("p:sistematic-online.com", "sms_admin", 'M!a560up8#%$asw', "seguridad_sms")) {
    echo json_encode('Fallo la conexión a la BD' . mysqli_error($conLog));
  } else {
    return $conLog;
  }
}
function retornarConexion2()
{
  $_SESSION['IdSession'] = 0;
  if ($_SESSION['IdSession'] == 0) {
    if (!$conLog = mysqli_connect("p:sistematic-online.com", "sms_admin", 'M!a560up8#%$asw', "sms_service")) {
      echo json_encode('Fallo la conexión a la BD' . mysqli_error($conLog));
    } else { {
        $_SESSION['IdSession'] = $conLog;
        return $conLog;
      }
    }
  } else {
    $con = $_SESSION['IdSession'];
  }
}
