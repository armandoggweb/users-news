<?php require 'cabecera.php' ?>
<style><?php include 'estilos.css' ?></style>

<h2>Log in</h2>
<form action="funciones_bd.php" method="post" id="login">
    <input type="hidden" name="consulta" value="loguin">
    <label for="nombre">Usuario</label><br>
    <input type="text" name="nombre" id="nombre"><br>
    <label for="contraseña">Contraseña</label><br>
    <input type="text" name="contraseña" id="contraseña"><br>
    <input type="submit" value="Log in">
</form>
