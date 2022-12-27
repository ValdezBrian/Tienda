<?php

	/*if(empty($_SESSION['active']))
	{
		header('location: ../');
	}
*/
?>
<header>
	<div class="header">
		<h1> Sistema de Administracion</h1>
			<div class="optionsBar">
				<span class="user"><?php echo $_SESSION['nombre']; ?></span>  <!-- Nombre del Usuario que Ingresa -->
				<img class="photouser" src="imagenes/user.png" alt="Usuario">
				<a href="cerrarsesion.php"><img class="close" src="imagenes/salir.png" alt="Salir del sistema" title="Salir"></a>
			</div>
		</div>
		<?php include "nav.php"; ?>
</header>
<div class="modal">
	<div class="bodyModal">
		
	</div>
</div>