<?php
    require 'funciones_bd.php';
    require 'cabecera.php';

    //Dependiendo de la acción elegida se insertará un formulario acorde
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
        <h2>Nuevo usuario</h2>
        <form action="funciones_bd.php" method="post">
            <input type="hidden" name="consulta" value="crear-usuario">
            <label for="nombre">Nombre de usuario: </label><br>
            <input type="text" name="Nombre" id="nombre" maxlength="20" required><br>
            <label for="contraseña">Contraseña: </label><br>
            <input type="password" name="Contraseña" id="contraseña" maxlength="15" required><br>
            <label for="email">Email: </label><br>
            <input type="email" name="Email" id="email" maxlength="20" required><br>
            <label for="fecha_nacimiento">Fecha de nacimiento: </label><br>
            <input type="date" name="Fecha_nacimiento" id="fecha_nacimiento"><br>
            <label for="direccion">Dirección: </label><br>
            <input type="address" name="Direccion" id="direccion" maxlength="30"><br>
            <label for="codigo_postal">Código postal: </label><br>
            <input type="text" name="Codigo_postal" id="codigo_postal" maxlength="6"><br>
            <label for="provincia">Provincia: </label><br>
            <input type="text" name="Provincia" id ="provincia" maxlength="15"><br>
            Genero:<br>
            <input type="radio" name="Genero" id="hombre" value="hombre">
            <label for="hombre">Hombre</label>
            <input type="radio" name="Genero" id="mujer" value="mujer">
            <label for="mujer">Mujer</label><br>
            <input type="submit" name="submit" value="Enviar">
        </form>
        <?php
    }

    function edit_form(){
        //Buscamos el registro en su table para poder editar sus campos
        $id = $_GET['id'];
        $usuario = get_registro(intval($id), "Usuarios");
        ?>
        <h2>Editar usuario</h2>
         <form action="funciones_bd.php" method="post">
            <input type="hidden" name="consulta" value="editar-usuario">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <label for="nombre">Nombre de usuario: </label><br>
            <input type="text" name="Nombre" id="nombre" value="<?php echo $usuario['Nombre'] ?>" maxlength="20" required><br>
            <label for="contraseña">Contraseña: </label><br>
            <input type="password" name="Contraseña" id="contraseña" value="<?php echo $usuario['Contraseña'] ?>" maxlength="15" required><br>
            <label for="email">Email: </label><br>
            <input type="email" name="Email" id="email" value="<?php echo $usuario['Email'] ?>"maxlength="20" required><br>
            <label for="fecha_nacimiento">Fecha de nacimiento: </label><br>
            <input type="date" name="Fecha_nacimiento" value="<?php echo $usuario['Fecha_nacimiento'] ?>" id="fecha_nacimiento"><br>
            <label for="direccion">Dirección: </label><br>
            <input type="address" name="Direccion" id="direccion" value="<?php echo $usuario['Direccion'] ?>" maxlength="30"><br>
            <label for="codigo_postal">Código postal: </label><br>
            <input type="text" name="Codigo_postal" id="codigo_postal" value="<?php echo $usuario['Codigo_postal'] ?>" maxlength="6"><br>
            <label for="provincia">Provincia: </label><br>
            <input type="text" name="Provincia" id ="provincia" value="<?php echo $usuario['Provincia'] ?>" maxlength="15"><br>
            Genero:<br>
            <input type="radio" name="Genero" id="hombre" value="hombre" <?php if($usuario['Genero'] == "Hombre") echo "checked"?>>
            <label for="hombre">Hombre</label>
            <input type="radio" name="Genero" id="mujer" value="mujer" <?php if($usuario['Genero'] == "Mujer") echo "checked"?>>
            <label for="mujer">Mujer</label><br>
            <input type="submit" name="submit" value="Enviar">
        </form>
        <?php
    }

    function borrar_form(){
        ?>
        <h2>Borrar usuario</h2>
        <form action="funciones_bd.php" method="post">
            <input type="hidden" name="consulta" value="borrar-usuario">
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <label for="borrar">¿Estás seguro de que quieres eliminar el usuario</label><br>
            <input type="submit" value="Si" id="borrar">
            <a href="cuerpo.php">Volver</a>
        </form>
        <?php
    }
?>
