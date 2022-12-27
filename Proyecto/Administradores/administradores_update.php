<?php
	
	require "Funciones/conecta.php";
	$con = conecta();


	$id = $_REQUEST['id_sel'];
	$nombre = $_REQUEST['nombre'];
	$apellidos = $_REQUEST['apellidos'];
	$correo = $_REQUEST['correo'];
	$pass = $_REQUEST['pass'];
	$rol = $_REQUEST['rol'];
	$file_name = $_FILES['archivo']['name'];
	$file_tmp = $_FILES['archivo']['tmp_name'];
	$cadena = explode(".", $file_name);
	$ext = $cadena[1];
	$dir = "Archivos/";
	$file_enc = md5_file($file_tmp);
	$archivo_n = $file_enc;
	$archivo = $file_name;
	$tx = '';
	$tx1 = '';

	if($file_name != ''){
		$fileName1 = "$file_enc.$ext";
		copy($file_tmp, $dir.$fileName1);
		$tx1 = ", archivo_n = '$archivo_n', archivo = '$archivo'";
}
	if($pass != ''){
		$pass = md5($pass);
		$tx = ", pass = '$pass'";
	}

	//Actualizar en BD
	$sql = "UPDATE administradores
	SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', rol = $rol $tx $tx1 WHERE id = $id";
	$res = $con->query($sql);


header("Location: administradores_lista.php");
?>