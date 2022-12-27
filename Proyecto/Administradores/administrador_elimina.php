<?php

require "Funciones/conecta.php";
$con = conecta();

$id = $_REQUEST['id'];

//$sql = "DELETE FROM administradores WHERE id = $id";
$sql = "UPDATE administradores SET eliminado = 1 WHERE id = $id ";
$res = $con->query($sql);
$ban = 1;


if(0 > 1){
	$ban = 0;	
}

echo $ban;
//header("Location: lista_administradores.php");

?>