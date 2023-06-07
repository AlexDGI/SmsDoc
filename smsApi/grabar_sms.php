<?php
  include_once("headers.php");

  require("conexionLog.php");
  $headers = apache_request_headers();
  $con=retornarConexion2();
  $json = file_get_contents('php://input');
  $p=json_decode($json);

  $IdFiscal = $headers["Idfiscalcliente"];

  $x=$p->data;
  $meta=$p->meta;
  // mysqli_query($con,"insert into a values($meta)");
  //  $params = str_ireplace('"{','',$params);
  //  $params = str_ireplace('}"','',$params);

  class Resultado {};
  $response = new Resultado();
  if($x != '')   // esto es mientras se soluciona el problema que se esta llamando 2 veces desde angular y no se sabe porque. 10/06/2022.
    {
      $cantReg = count($x)-1;
      if(!$dCli=mysqli_query($con,"select * from clientes where IdFiscal='$IdFiscal'"))
      {
        $a= mysqli_errno($con);
        //mysqli_query($con,"insert into a values($y)");
        $response->status ='ERROR';
        $response->mensaje = 'No se pudo grabar el maestro, error buscando datos cliente'.$IdFiscal.'->'.$a;
      }
      else{
        $d=mysqli_fetch_array($dCli);
        $Id=$d['Id'];
        $RazonSocial=$d['RazonSocial'];$FirmaSms=$d['FirmaSms'];
        $NombreContacto=$d['NombreContacto'];$TlfContacto=$d['TlfContacto'];
        $EmailContacto=$d['EmailContacto'];$Estado=$d['Estado'];
        $SaldoSms=$d['SaldoSms'];
        //mysqli_query($con,"insert into a values($SaldoSms)");
        //mysqli_query($con,"insert into a values('$IdFiscal')");
      }
      $errores='';$error1='';
      if($cantReg > $SaldoSms){
        $response->status ='ERROR';
        $response->mensaje = 'La cantidad de registros por enviar ('.$cantReg.') sobrepasa su saldo de mensajes ('.$SaldoSms.'), deberá reducir la cantidad de registros para enviar.';
        $error1='1';
      }
      mysqli_query($con,"insert into a values('aaaa'.'$cantReg'.'-'.'$SaldoSms')");
      
      // Validación de número de teléfonos y otros datos
      $cols=3;
      $fa=1;
      $cc=1;
      $PrefTlf=' 0412,0416,0426,0414,0424';
      for($i=1;$i<=$cantReg;$i++)
        {
          $Telef=$x[$i][0];
          $pref=substr($Telef, 0, 4);
          //mysqli_query($con,"insert into a values('$cc')");
            if( stripos($PrefTlf, $pref) <= 0  or  strlen($Telef) != 11)
            {
              $errores = $errores.$fa.'-';
            }
            $fa= $fa+1;   
        }
        //$errores='';
        if($errores == '' and $error1=='')
        {
          $y="insert into envios_mae(IdCliente,Nombre,Fecha,Registros,Estado,IdFiscal) values($Id,'$RazonSocial',curdate(),$cantReg,'xEnv','$IdFiscal')";
          if(!mysqli_query($con,$y))
            {
              $a= mysqli_error($con);
              mysqli_query($con,"insert into a values($y)");
              $response->status ='ERROR';
              $response->mensaje = 'No se pudo grabar el maestro: '.$a;
            }
          else
          {
            $r1 =mysqli_query($con,"select last_insert_id() as  nr");
            $Ur=mysqli_fetch_array($r1);$IdMae=$Ur['nr'];
            for($i=1;$i<=$cantReg;$i++)
            {
              $Tlf=$x[$i][0];
              $Msg=$x[$i][1];$Dato1=$x[$i][2];//$Dato2=$x[$i][3];
              $y="insert into envios_det (IdMae,Telefono,Mensaje,Dato1,Dato2,Estado) values('$IdMae','$Tlf','$Msg','$Dato1','','xEnv')";
              if($Tlf != '')
              {
                if(!mysqli_query($con,$y) )
                {
                  $a= mysqli_errno($con);      mysqli_query($con,"insert into a values($a)");
                }
              }
            }
            if($cantReg>0)   // insertar un mensaje para avisar al administrador que ya se envio el lote de sms preparado
            {
              $Msg='iot-ve.com inf. el lote de '.$cantReg.' SMS fue enviado exitosamente.  Gracias por preferirnos.';
              $y="insert into envios_det (IdMae,Telefono,Mensaje,Dato1,Dato2,Estado) values('$IdMae','$TlfContacto','$Msg','','','xEnv')";
              if(!mysqli_query($con,$y) )
              {
                $a= mysqli_errno($con);      mysqli_query($con,"insert into a values('Error creando sms aviso fin de lote.')");
              }
            }

            $response->status ='success';
            $response->mensaje = 'Registro agregado a la lista';
            mysqli_query($con,"update clientes set SaldoSms=SaldoSms-$cantReg where IdFiscal='$IdFiscal'");
          }
        }
       else
       {
          if($error1 == ''){
          $response->status ='ERROR';
          $response->mensaje = 'hay teléfono(s) errado(s) en la(s) linea(s):'.$errores.', por favor corrija  e intente de nuevo.';
          }
       }

    }
  echo json_encode($response);
?>
