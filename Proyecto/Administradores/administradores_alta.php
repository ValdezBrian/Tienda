<?php
	session_start();
if (!$_SESSION['idU']){
	header ("Location: ../_index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<meta charset="UTF-8">
	<title>Alta Administradores</title>
	<script src="jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/icons.js"></script>


	<script>

		function verificaCorreo(){
			var id = $('#id_sel').val();
			var correo = $('#correo').val();
			if(correo != ''){

				$.ajax({
					url : 'Funciones/verificacorreo.php',
					type : 'post',
					dataType : 'text',
					data : 'id='+id+'&correo='+correo,
					success : function(res){
						if (res > 0 ){
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

			if(nombre && apellidos && correo && pass && rol > 0){
				document.forma01.method = 'post';
				document.forma01.enctype = 'multipart/form-data';
				document.forma01.action = 'administradores_salva.php';
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
		<h1>Agregar Administrador</h1>

		<?php
			echo "<a href=\"administradores_lista.php\" class=\"btn_back\"><i class=\"far fa-hand-point-left\"></i> Volver al listado</a><br>";
		?>

		<form name="forma01" autocomplete="off">
			<br>
			<input type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre" class="datos"> <br>
			<input type="text" name="apellidos" id="apellidos" placeholder="Escribe tus apellidos"  class="datos"><br>
			<input type="text" name="correo" id="correo" placeholder="Escribe tu correo" class="datos" onblur="verificaCorreo()">
			<div id="mensaje1" class="error"></div><br>
			<input type="text" name="pass" id="pass" placeholder="Escribe tu contraseña" class="datos"><br>
			<select name="rol" id="rol" class="datos">
				<option value="0">Selecciona</option>
				<option value="1">Gerente</option>
				<option value="2">Ejecutivo</option>
			
			</select><br>
			<br>
			<input type="file" id="archivo" name="archivo" class="datos"><br><br>

			<input type="submit" value="Salvar" onclick="validaDatos(); return false;" class="botonSalvar">
			<input type="hidden" name="id_sel" name="id_sel" value="0"/><br>
			<div id="mensaje1" class="error"></div><br>
			<div id="mensaje2" class="error"></div>
			
		</form>
</section>
</body>
</html>