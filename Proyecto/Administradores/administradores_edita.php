<?php
session_start();
$nombres = $_SESSION['nombre'];

if (!$_SESSION['idU']){
	header ("Location: _index.php");
}
?>
<?php

	require "./Funciones/conecta.php";
$con = conecta ();
$id = $_REQUEST['id'];

$sql = "SELECT * FROM administradores WHERE id = $id";

//$res = mysql_query($sql, $con);
$res = $con->query($sql);

//$nombre = mysqli_result($res, 0,"nombre");
$row = mysqli_fetch_assoc($res);

$nombre = $row['nombre'];
$apellidos = $row['apellidos'];
$correo = $row['correo'];
$rol = $row['rol'];
$archivo_n = $row['archivo_n'];
$archivo = $row['archivo'];
$ext = explode(".", $archivo);

?>


<!DOCTYPE html>
<html>
<head>

	<meta charset="UTF-8">
	<title>Edicion Administradores</title>
	<script src="jquery-3.3.1.min.js"></script>
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/icons.js"></script>


	<script>

		function verificaCorreo(){

			var id = $('#id_sel').val();
			var correo = $('#correo').val();
			if(correo != ''){

				$.ajax({
					url : 'funciones/verificaCorreo.php',
					type : 'post',
					dataType : 'text',
					data : 'id='+id+'&correo='+correo,
					success : function(res){
						if (res > 0){
							$('#mensaje1').html('El correo '+correo+' ya esta registrado ');
							$('#correo').val('');
							setTimeout("$('#mensaje1').html('')",5000);
						}
					},error:function(){
						alert('Error al conectar al servidor...');
					}
			});
		}
}
		function validaDatos() {

			var nombre = document.forma01.nombre.value;
			var apellidos = document.forma01.apellidos.value;
			var correo = document.forma01.correo.value;
			var pass = document.forma01.pass.value;
			var rol = document.forma01.rol.value;

			if(nombre && apellidos && correo && rol > 0){
				document.forma01.method = 'post';
				document.forma01.enctype = 'multipart/form-data';
				document.forma01.action = 'administradores_update.php';
				document.forma01.submit ();

			} else {
					$('#mensaje2').html('Faltan campos por llenar');
					setTimeout("$('#mensaje2').html('')",5000);
			}
		}
	</script>

</head>
<body>

		<?php include "includes/header.php"; ?>

<section id="contenedor">
		<h1>Edicion de administradores</h1>
		<?php
			echo "<a href=\"administradores_lista.php\" class=\"btn_back\"><i class=\"far fa-hand-point-left\"></i> Volver al listado</a><br>";
		?>
		<form name="forma01">
			<br>
			<input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>"  class="datos"> <br>
			<input type="text" name="apellidos" id="apellidos" value="<?php echo $apellidos; ?>" class="datos"><br>
			<input type="text" name="correo" id="correo" value="<?php echo $correo; ?>" onblur="verificaCorreo();"/ class="datos">
			<div id="mensaje1" class="error"></div><br>
			<input type="text" name="pass" id="pass" placeholder="Escribe tu contraseña" class="datos"><br>
			<select name="rol" id="rol" class="datos">
				<option value="0" >Selecciona</option>
				<option value="1" <?php if($rol==1) echo 'selected'; ?>>Gerente</option>
				<option value="2" <?php if($rol==2) echo 'selected'; ?>>Ejecutivo</option>
				
			</select><br>
			<input type="file" id="archivo" name="archivo" class="datos"><br><br>

			<br><br>
			<input type="submit" value="Actualizar" onclick="validaDatos(); return false;" class="botonActualizar">
			<input type="hidden" name="id_sel" id="id_sel" value="<?php echo $id; ?>"/><br>
			<div id="mensaje2" class="error"></div>
			
		</form>
</section>
</body>
</html>