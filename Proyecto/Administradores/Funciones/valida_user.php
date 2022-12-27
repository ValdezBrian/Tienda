<?php
session_start();
require "conecta.php";
$con= conecta();

$user = $_REQUEST['user'];
$pass = $_REQUEST['pass'];
$pass = md5($pass);

$sql = "SELECT * FROM administradores WHERE correo = '$user' AND pass = '$pass' AND status = 1 AND eliminado = 0";
$res  = mysqli_query($con,$sql) or die(mysql_error());
$contr = $res->num_rows;

if($contr){

	$row = $res->fetch_array();

	$idU = $row['id'];
	$nombre = $row['nombre'];
	$correo = $row['correo'];



    $_SESSION['idU']    =$idU;
    $_SESSION['nombre'] =$nombre;
    $_SESSION['correo'] =$correo;

}
echo $contr;
?>