<?php
    require 'conexion.php';

    if (isset($_POST['consulta'])){
        $consulta = $_POST['consulta'];
        switch ($consulta){
            case 'crear-noticia':
                crear_noticia();
                break;
            case 'editar-noticia':
                editar_noticia();
                break;
            case 'borrar-noticia':
                borrar_noticia();
                break;
            case 'crear-usuario':
                crear_usuario();
                break;
            case 'editar-usuario':
                editar_usuario();
                break;
            case 'borrar-usuario':
                borrar_usuario();
                break;
            case 'like-noticia':
                like_noticia();
                break;
            case 'loguin':
                loguin();
                break;
            case 'logout':
                logout();
                break;
            break;
        }
    }

    //Muestra las útimas 5 noticias creadas
    function ultimas_noticias(){
        $con = conexion();
        $query = "SELECT * FROM Noticias ORDER BY Hora_creacion DESC LIMIT 5";
        $noticias = $con->query($query);
        if(!$noticias){
            die($con->error);
        }else{
            $con->close();
            return $noticias;
        }
    }
    //Inserta un usuario
    function crear_usuario(){
        $con = conexion();
        //Para averiguar el id, buscamos el máximo de la tabla y le sumamos 1
        $id = get_next_id($con, "Usuarios");
        $nombre = $_POST['Nombre'];
        $contraseña = $_POST['Contraseña'];
        $email = $_POST['Email'];
        $fecha_nacimiento = $_POST['Fecha_nacimiento'];
        $direccion = $_POST['Direccion'];
        $codigo_postal = $_POST['Codigo_postal'];
        $provincia = $_POST['Provincia'];
        $genero = $_POST['Genero'];
        //Obtenemos el campo edad a partir de la fecha de nacimiento
        $edad = intval(date("Y") - date("Y", strtotime($fecha_nacimiento)));

        $query = "INSERT INTO Usuarios (ID, Nombre, Contraseña, Email, Edad, Fecha_nacimiento, 
                    Direccion, Codigo_postal, Provincia, Genero) 
                    VALUES($id, '$nombre', '$contraseña', '$email', $edad, '$fecha_nacimiento',
                    '$direccion', '$codigo_postal', '$provincia', '$genero')";

        if(!$con->query($query)){
            die($con->error);
        }else{
            echo "  <p>Usuario creado correctamente</p><br>
                    <a href='cuerpo.php'>Volver</a>";
            $con->close();
        }
    }

    //Modifica un usuario
    function editar_usuario(){
        $con = conexion();
        $id = intval($_POST['id']);
        $nombre = $_POST['Nombre'];
        $contraseña = $_POST['Contraseña'];
        $email = $_POST['Email'];
        $fecha_nacimiento = $_POST['Fecha_nacimiento'];
        $direccion = $_POST['Direccion'];
        $codigo_postal = $_POST['Codigo_postal'];
        $provincia = $_POST['Provincia'];
        $genero = $_POST['Genero'];
        $edad = intval(date("Y") - date("Y", strtotime($fecha_nacimiento)));

        $query = "UPDATE Usuarios SET nombre = '$nombre', Contraseña = '$contraseña', 
                    Email = '$email', Edad = $edad , Fecha_nacimiento = '$fecha_nacimiento', 
                    Direccion = '$direccion', Codigo_postal = '$codigo_postal', Provincia = '$provincia', 
                    Genero = '$genero' WHERE ID = $id";

        if(!$con->query($query)){
            die($con->error);
        }else{
            echo "  <p>Usuario actualizado correctamente</p><br>
                    <a href='cuerpo.php'>Volver</a>";
            $con->close();
        }
    }

    //Elimina un usuario
    function borrar_usuario(){
        $con = conexion();
        $id = intval($_POST['id']);

        $query = "DELETE FROM Usuarios WHERE ID = $id";

        if(!$con->query($query)){
            die($con->error);
        }else{
            echo "  <p>Usuario borrado correctamente</p><br>
                    <a href='cuerpo.php'>Volver</a>";
            $con->close();
        }
    }

    //Inserta una noticia
    function crear_noticia(){
        $con = conexion();
        $id = get_next_id($con, "Noticias");
        $titulo = $_POST['Titulo'];
        $contenido = $_POST['Contenido'];
        $autor = $_POST['Autor'];
        $likes = 0;

        $query = "INSERT INTO Noticias (ID, Titulo, Contenido, Autor, Likes)
                    VALUES ($id, '$titulo', '$contenido', '$autor', $likes)";
        if(!$con->query($query)){
            die($con->error);
        }else{
            echo "  <p>Noticia creada correctamente</p><br>
                    <a href='cuerpo.php'>Volver</a>";
            $con->close();
        }
    }
    

    //Modifica una noticia
    function editar_noticia(){
        $con = conexion();
        $id = intval($_POST['id']);
        $titulo = $_POST['Titulo'];
        $contenido = $_POST['Contenido'];
        $autor = $_POST['Autor'];

        $query = "UPDATE Noticias 
                    SET Titulo = '$titulo', Contenido = '$contenido', Autor = '$autor'
                    WHERE ID = $id";

        if(!$con->query($query)){

            die($con->error);
        }else{
            echo "  <p>Noticia actualizada correctamente</p><br>
                    <a href='cuerpo.php'>Volver</a>";
            $con->close();
        }
    }
    
    //Elimina una noticia
    function borrar_noticia(){
        $con = conexion();
        $id = intval($_POST['id']);
        $query = "DELETE FROM Noticias WHERE ID = $id";
        if(!$con->query($query)){
            die($con->error);
        }else{
            echo "  <p>Noticia borrada correctamente</p><br>
                    <a href='cuerpo.php'>Volver</a>";
            $con->close();
        }

    }

    //Devuelve todos los usuarios de la tabla
    function obtener_usuarios(){
        $con = conexion();
        $usuarios = $con->query("SELECT * FROM Usuarios");
        if(!$usuarios){
            die($con->error);
        }else{
            $con->close();
            return $usuarios;
        }
    }

    //Devuelve todas las noticias de la tabla
    function obtener_noticias(){
        $con = conexion();
        $query = "SELECT * FROM Noticias";
        $noticias = $con->query($query);
        if(!$noticias){
            die($con->error);
        }else{
            $con->close();
            return $noticias;
        }
    }
    
    //Actualiza el campo "likes" de una noticia cuando se ejecuta
    //Además almacena una cookie con los los like de esa noticia
    function like_noticia(){
        $con = conexion();
        $id = intval($_POST['id']);
        $likes = get_likes($id) + 1;
        $resultado = $con->query("UPDATE Noticias SET likes = $likes WHERE ID = $id");
        if(!$resultado){
            die($con->error);
        }else{
            $con->close();
            setcookie("likes[noticia_" . $id . "]", $likes);
            header('location:' . $_SERVER['HTTP_REFERER']);
        }
    }

    //Comprueba que exista el usuario que intenta iniciar sesión y que coincida su contraseña
    //Además de crear una sesión con ese usuario
    function loguin(){
        $con = conexion();
        $nombre = $_POST['nombre'];
        $resultado = $con->query("SELECT * FROM Usuarios WHERE Nombre = '$nombre'");
        if(!$resultado){
            die('No existe un usuario con ese nombre');
            echo "<a href='loguin.php'>Volver</a>";
        }else{
            $usuario = $resultado->fetch_assoc();
            if($usuario['Contraseña'] == $_POST['contraseña']){
                
                session_start();
                $_SESSION['usuario'] = $usuario['Nombre'];
                $con->close();
                header('location:cuerpo.php');
            }else{
                die('Contraseña no válida');
                echo "<a href='loguin.php'>Volver</a>";
            }
        }
        

    }

    //Cierra sesión y la elimina
    function logout(){
        session_start();
        unset($_SESSION['usuario']);
        header('location: cuerpo.php');
    }


    //Obtiene el número de likes de una noticia a partir de un ID
    function get_likes($id){
        $con = conexion();
        $resultado = $con->query("SELECT likes FROM Noticias WHERE ID = $id");
        if(!$resultado){
            die($con->error);
        }else{
            $likes = intval($resultado->fetch_assoc()['likes']);
            $con->close();
            return $likes;
        }
    }

    //Obtiene un registro de una tabla a partir del campo ID
    function get_registro($id, $tabla){
        $con = conexion();
        $resultado = $con->query("SELECT * FROM $tabla WHERE ID = $id");
        if(!$resultado){
            die($con->error);
        }else{
            $registro = $resultado->fetch_assoc();
            $con->close();
            return $registro;
        }
    }

    //Obtiene el ID más alto de una tabla
    function get_next_id($con, $tabla){
        $max_id = $con->query("SELECT MAX(ID) FROM $tabla");
        if($max_id){
            while($row = $max_id->fetch_assoc()){
                return intval($row['MAX(ID)']) + 1;
            }
        }else{
            return 1;
        }
    }


?>