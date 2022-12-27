<?php
	session_start();

	if (ISSET($_SESSION['idU'])){
	header ("Location: Administradores/bienvenido.php");}
	else
	{
		echo "HOLA";
	}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
	<meta charset="utf-8">
	<link href="styleLogin.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/icons.js"></script>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum=scale=1.0, minimum-scale=1.0">
	<script src="js/jquery-3.3.1.min.js"></script>
	<title>Login</title>

	<script>
		
		function validar(){

			var user = $('#user').val();
			var pass = $('#pass').val();

			if(user != '' && pass != ''){
				$.ajax({
					url : 'Funciones/valida_user.php',
					type : 'post',
					dataType : 'text',
					data : 'user='+user+'&pass='+pass,
					success : function (res){
						alert(res);
						if(res==1){
							//window.location.href = "Administradores/administradores_lista.php";

							window.location.href = "Administradores/bienvenido.php";
						}else{
							$('#mensaje').html('Datos incorrectos');
							$('#user').val('');
							$('#pass').val('');
							setTimeout("$('#mensaje').html('');",5000);
							$("#user").focus();
							<?php session_destroy(); ?>

						}
					},error: function(){
						alert ('Error al conectar al servidor');
					}
				});
			}else{

				$('#mensaje').html('Datos incompletos');
				$('#user').val('');
				$('#pass').val('');
				setTimeout("$('#mensaje').html('');",5000);
				//setcookie()s
			}

		}
	</script>

</head>
<body>

	<section id="container">

	<form name="forma01" method="POST" action="valida_user.php" autocomplete="off">
		<h3>Inicio de sesión<br><i class="fas fa-sign-in-alt"></i></h3>
		<img src="img/login2.jpg" alt="Login">
		<input type="text" class="datos" name="user" id="user" placeholder="Escribe tu correo"/><br>
		<input type="password" class="datos" name="pass" id="pass" placeholder="Escribe tu contraseña"><br><br>
		<input class="botonSalvar" onclick="validar(); return false;" type="submit" value="Ingresar"/><br>
				<div id="mensaje"></div>
		
	</form>

	</section>

</body>
</html>