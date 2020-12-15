<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pac Desarrollo</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php 
        session_start();
        if(isset($_SESSION['usuario'])){
            echo '<h3>Usuario conectado: ',
                $_SESSION['usuario'],
                '</h3>';
        }
    ?>
    <ul id="cabecera">
        <li><a href="cuerpo.php">Inicio</a></li>
        <li><a href="list_usuarios.php">Usuarios</a></li>
        <li><a href="list_noticias.php">Noticias</a></li>
        <?php
        
            if(isset($_SESSION['usuario'])){
                echo '<li><a href="form_usuario.php?action=crear">Crear Usuario</a></li>',
                    '<li><a href="form_noticias.php?action=crear">Crear Noticia</a></li>';
                echo '<li>',
                        '<form action="funciones_bd.php" method="post">',
                            '<input type="hidden" name="consulta" value="logout">',
                            '<input type="submit" name="logout" value="Log out">',
                        '</form>',
                    '</li>';
            }else{
                echo '<li><a href="loguin.php">Log in</a></li>';
            }
        ?>
    </ul>
</body>
</html>
