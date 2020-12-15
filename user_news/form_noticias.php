<?php
    require 'cabecera.php';
    require 'funciones_bd.php';

    switch ($_GET['action']) {
        case 'crear':
            crear_form();
            break;
        case 'editar':
            edit_form();
            break;
        case 'borrar':
            borrar_form();
        break;
        
        default:
            echo "Acción no valida";
            echo "<br><a href='cuerpo.php'>Volver</a>";
        break;
    }

?>
    <style><?php include 'estilos.css' ?></style>
<?php

    function crear_form(){
        ?>
        <h2>Nueva noticia</h2>
        <form action="funciones_bd.php" method="post">
            <input type="hidden" name="consulta" value="crear-noticia">
            <label for="titulo">Título: </label><br>
            <input type="text" name="Titulo" id="titulo" maxlength="30" required><br>
            <label for="contenido">Contenido: </label><br>
            <textarea name="Contenido" id="contenido" maxlength="200"></textarea><br>
            <label for="autor">Autor: </label><br>
            <input type="text" name="Autor" id="autor" maxlength="20" required><br>
            <input type="submit" value="Enviar">
        </form>
        <?php
    }

    function edit_form(){
        $id = $_GET['id'];
        $noticia = get_registro(intval($id), "Noticias");
        ?>
        <h2>Editar noticia</h2>
        <form action="funciones_bd.php" method="post">
            <input type="hidden" name="consulta" value="editar-noticia">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <label for="titulo">Título: </label><br>
            <input type="text" name="Titulo" id="titulo" value="<?php echo $noticia['Titulo'] ?>" maxlength="30" required><br>
            <label for="contenido">Contenido: </label><br>
            <textarea name="Contenido" id="contenido" maxlength="200"><?php echo $noticia['Contenido'] ?></textarea><br>
            <label for="autor">Autor: </label><br>
            <input type="text" name="Autor" id="autor" value="<?php echo $noticia['Autor'] ?>"maxlength="20" required><br>
            <input type="submit" value="Enviar">
        </form>
        <?php
    }

    function borrar_form(){
        ?>
        <h2>Borrar noticia</h2>
        <form action="funciones_bd.php" method="post">
            <input type="hidden" name="consulta" value="borrar-noticia">
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <label for="borrar">¿Estás seguro de que quieres borrar la noticia</label><br>
            <input type="submit" value="Si" id="borrar">
            <a href="cuerpo.php">Volver</a>
        </form>
        <?php
    }
?>
