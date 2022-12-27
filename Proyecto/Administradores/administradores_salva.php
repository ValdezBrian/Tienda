<?php
	
	require "Funciones/conecta.php";
	$con = conecta();

	$nombre = $_REQUEST['nombre'];
	$apellidos = $_REQUEST['apellidos'];
	$correo = $_REQUEST['correo'];
	$pass = $_REQUEST['pass'];
	$passEnc = md5($pass);
	$rol = $_REQUEST['rol'];
	$file_name = $_FILES['archivo']['name'];
	$file_tmp = $_FILES['archivo']['tmp_name'];
	$cadena = explode(".", $file_name);
	$ext = $cadena[1];
	$dir = "Archivos/";
	$file_enc = md5_file($file_tmp);
	$archivo_n = $file_enc;
	$archivo = $file_name;

	if($file_name != ''){
		$fileName1 = "$file_enc.$ext";
		copy($file_tmp, $dir.$fileName1);
}

	//Insertar en BD
	$sql = "INSERT INTO administradores VALUES
			(0,'$nombre', '$apellidos', '$correo','$passEnc',$rol,'$archivo_n','$archivo',1,0)";
	$res  = mysqli_query($con,$sql) or die(mysql_error());
	//$res = $con->query($sql);

header("Location: administradores_lista.php");
?>