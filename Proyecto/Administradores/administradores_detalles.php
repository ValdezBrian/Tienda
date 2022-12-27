<?php
session_start();
$nombre = $_SESSION['nombre'];

if (!$_SESSION['idU']){
	header ("Location: _index.php");
}
?>
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<meta charset="UTF-8">
	<script type="text/javascript" src="js/icons.js"></script>
<?php include "includes/header.php"; ?>
<section id="contenedor">
<h1>Detalle de administrador</h1>
<?php


			

	echo "<a href=\"administradores_lista.php\" class=\"btn_back\"><i class=\"far fa-hand-point-left\"></i> Volver al listado</a><br>";
	require "./Funciones/conecta.php";
	$con = conecta();


	$id_ver = $_REQUEST['id'];
	$sql = "SELECT *
		FROM administradores
		WHERE status = 1  AND eliminado = 0";
	$res  = mysqli_query($con,$sql) or die(mysql_error());
	$contr = $res->num_rows; //Devuelve el numero de registros que contiene la variable res.
		echo "<table border=\"1px\" class=\"tablaD\">";

		echo "<tr class =\"encabezadoD\">";
			echo "<br>";
			echo "<td>Foto de administrador</td>";
			echo "<td>ID</td>";
			echo "<td>Nombre completo</td>";
			echo "<td>Correo</td>";
			echo "<td>Rol</td>";
			echo "<td>Status</td>";

		echo "</tr>";

		
		while($row = $res->fetch_array()){
	
		$id = $row['id'];

		if($id_ver == $id){

		$nombre = $row['nombre'];
		$apellidos = $row['apellidos'];
		$correo = $row['correo'];
		$rol = $row['rol'];
		$rol_txt = ($rol == 1) ? 'Gerente' : 'Ejecutivo';
		$status = $row['status'];
		$status_txt = ($status == 1) ? 'Activo' : 'Inactivo';
		$archivo_n = $row['archivo_n'];
		$archivo = $row['archivo'];
		$ext = explode(".", $archivo);

}
}	

	echo "<tr class =\"datosD\">";

			echo "<td align=\"middle\"><img src = \"./Archivos/$archivo_n\" width=\"80px\" height=\"80px\" </td>";
			echo "<td>$id_ver</td>";
			echo "<td>$nombre $apellidos</td>";
			echo "<td>$correo</td>";
			echo "<td>$rol_txt</td>";			
			echo "<td>$status_txt</td>";



		echo "</tr>";


echo "</table>";


?>
</section>