
<?php 
    require 'cabecera.php';
    require 'funciones_bd.php';
?>
<style><?php include 'estilos.css'; ?></style>
    

<?php
    
    echo "<h1>Lista de usuarios</h1>";
    if(isset($_SESSION['usuario'])){
        nuevo();
    }
    echo "<div id='usuarios'>";
    $usuarios = obtener_usuarios();
    while($row = $usuarios->fetch_assoc()){
        echo    "<div class='usuario'>",
                "<h6>" . $row['Nombre'] . "</h6>",
                "<p>" . $row['Email'] . "</p>",
                "<div class='botones'>";
        if(isset($_SESSION['usuario'])){
            editar($row['ID']);
            borrar($row['ID']);
        }
        echo "</div></div>";
    }
    echo "</div>";

    
    function nuevo(){
        ?>
        <form action="form_usuario.php" method="get" class="btn-nuevo">
            <input type="hidden" name="action" value="crear">
            <input type="submit" value="Nuevo">
        </form>
        <?php
    }

    function editar($id){
        ?>
        <form action="form_usuario.php" method="get">
            <input type="hidden" name="action" value="editar">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="submit" value="Editar">
        </form>
        <?php
    }
    function borrar($id){
        ?>
        <form action="form_usuario.php" method="get">
            <input type="hidden" name="action" value="borrar">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="submit" value="Borrar">
        </form>
        <?php
    }
 
?>

