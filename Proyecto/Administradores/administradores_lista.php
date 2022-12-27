<?php
session_start();
$nombres = $_SESSION['nombre'];

if (!$_SESSION['idU']){
	header ("Location: ../_index.php");
}
?>
<html>

<head>
	<link href="css/style.css?t=<?php echo time(); ?>" rel="stylesheet" type="text/css">
	<meta charset="UTF-8">
	<title>Lista de administradores</title>	
	<script src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/icons.js"></script> 

	

	
	<style>
		.error{
			display: inline;
			color: #FF0000;
		}
		.datos{
			background-color: #A9BEEC;
			margin: 3px;
		}
	</style>
	<script>
	 	function borrarfila(fila){    	    

	 		if(confirm("La fila se borrara...")){
	 		$.ajax({
	 			url			: 'administrador_elimina.php',
	 			type		: 'post',
				datatype	: 'text',
				data 		: 'id='+fila,
				success		: function(res){
					if(res){

						$('#datos'+fila).remove();
						$('#mensaje').html('Fila eliminada.');
						setTimeout("$('#mensaje').html('')",3000);

					}else {
						$('#mensaje').html('Error en la eliminacion.');
						setTimeout("$('#mensaje').html('')",3000);
					}
					},error: function(){
						alert('Error archivo no encontrado...');
						
					}
	 		});
	 		}
	 	}
		
	 </script>

</head>
<body>
	<?php include "includes/header.php"; ?>

	<section id="contenedor">

	<h1><i class="fas fa-users"></i> Lista de Administradores</h1>
	<?php
	//echo "<a href=\"administradores_alta.php\">Agregar administradores</a> <br>";
	echo "<a href=\"administradores_alta.php\" class=\"btn_new\"><i class=\"fas fa-user-plus\"></i> Crear Administrador</a><br>";

	//echo "<a href=\"probarcodigo.php\"style=\"color:blue;\">Probar archivo</a><br> ";

	require "Funciones/conecta.php";
	$con = conecta();

	$sql = "SELECT *
	FROM administradores
	WHERE status = 1  AND eliminado = 0 order by id";

	$res  = mysqli_query($con,$sql) or die(mysql_error());
	$contr = $res->num_rows; //Devuelve el numero de registros que contiene la variable res.


echo "<table border=\"1px\">";

echo "<tr class =\"encabezado\">";

echo "<br>";
echo "<td>ID</td>";
echo "<td>Nombre completo</td>";
echo "<td>Correo</td>";
echo "<td>Rol</td>";
echo "<td colspan = \"3\">Acciones</td>";


echo "</tr>";


while($row = $res->fetch_array()){
	$id = $row['id'];
	$nombre = $row['nombre'];
	$apellidos = $row['apellidos'];
	$correo = $row['correo'];
	$rol = $row['rol'];
	$rol_txt = ($rol == 1) ? 'Gerente' : 'Ejecutivo';

	echo "<tr id=\"datos$id\" class =\"datos\">";

	echo "<td>$id</td>";
	echo "<td>$nombre $apellidos</td>";
	echo "<td>$correo</td>";
	echo "<td>$rol_txt</td>";
	echo "<td class=\"link_delete\"> <input class=\"link_delete\" onClick = \"borrarfila($id);\" type=\"button\" class=\"borrar\" value=\"Eliminar\"><i class=\"far fa-trash-alt\"></i></td>";
	echo "<td class=\"link_detalle\"> <input class=\"link_detalle\" type=\"button\" class=\"borrar\" value=\"Ver detalle\" onclick=\"window.location.href='administradores_detalles.php?id=$id'\"><i class=\"fas fa-eye\"></i></td>";
	echo "<td class=\"link_edita\"> <input class=\"link_edita\" type=\"button\" class=\"borrar\" value=\"Editar\" onclick=\"window.location.href='administradores_edita.php?id=$id'\"><i class=\"far fa-edit\"></i></td>";

	echo "</tr>";
}

echo "</table>";
?>
<div id="mensaje" style="color:#F00;font-size:16px;"></div>
</section>

</body>

</html>