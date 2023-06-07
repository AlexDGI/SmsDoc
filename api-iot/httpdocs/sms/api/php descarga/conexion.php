<?php
function retornarConexion() {
  $con=mysqli_connect("localhost","root","","inv1");
  return $con;
}
?>
