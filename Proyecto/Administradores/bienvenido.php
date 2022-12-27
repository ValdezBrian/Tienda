<?php
session_start();
$nombre = $_SESSION['nombre'];

if (!$_SESSION['idU']){
    header ("Location: index.php");
}
?>
<html>
    <head>
        <title>Sistema de administracion</title>
        <link href="css/style.css?t=<?php echo time(); ?>" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/icons.js"></script>

    </head>

    <body>

        <?php include "includes/header.php"; ?>
        <section id="contenedor1">
        <h1>Bienvenido al Sistema de Administracion</h1>
        <br>
        <p class="letra"><span class="user"><?php echo $_SESSION['nombre']; ?></span></p>
    </section>
    </body>
</html>