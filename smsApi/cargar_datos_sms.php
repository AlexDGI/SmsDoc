<?php
include_once("headers.php");
include_once("conexionLog.php");
$headers = apache_request_headers();
$json = file_get_contents('php://input');
$params = json_decode($json);
$con = retornarConexion2();
$Idfiscalcliente = $headers["Idfiscalcliente"];
// print_r($params);
class Result
{
}
$response = new Result();
$xaction = $params->Action;
switch ($xaction) {
    case 'UP':
        $peticion = array(
            "ACTION" => "UP",
            "Tipo" => '',
            "IdUser" => $params->IdUser,
            "IdCliente" => $params->IdCliente,
            "DATA" => $params->Data
        );
}
$pet = json_encode($peticion, JSON_UNESCAPED_UNICODE);
//print_r($pet);


if (!$registros = mysqli_query($con, "CALL import_excel('$pet')")) {
    $response->status = 'ERROR PHP';
    $response->message = "Error ejecutando instrucción mysql" . mysqli_error($con);
} else {
    $con->next_result();
    $vec = [];
    $reg = mysqli_fetch_assoc($registros);
    if (!isset($reg['Error'])) {
        mysqli_data_seek($registros, 0);
        while ($reg = mysqli_fetch_assoc($registros)) {
            $vec[] = $reg;
        }
        $response->datos = $vec;
        $response->status = 'success';
        $response->message = 'CONSULTA CORRECTA';
    } else {
        $response->datos = '{}';
        $response->status = 'error';
        $response->message = $reg['Error'];
    }
}
echo json_encode($response);
