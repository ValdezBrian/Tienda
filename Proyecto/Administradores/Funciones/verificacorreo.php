<?php
	require "conecta.php";
	$con = conecta();

	$idC = $_REQUEST['id'];
	$correoC = $_REQUEST['correo'];
	$bandera = 0;
	$contr = 0;

	$sql = "SELECT *
	FROM administradores
	WHERE status = 1  AND eliminado = 0 AND correo = '$correoC' ";

	$res  = mysqli_query($con,$sql) or die(mysql_error());
	$contr = $res->num_rows; //Devuelve el numero de registros que contiene la variable res.

	if($contr > 0){
		$bandera = 1;
	}
	$row = $res->fetch_array();
	$correo = $row['correo'];
	$id = $row['id'];

	if($idC == $id){
		$bandera = 0;
	}
	
echo $bandera;

?>


