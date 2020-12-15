<?php 
    require 'cabecera.php';
    require 'funciones_bd.php';
?>
<style><?php include 'estilos.css'; ?></style>
    

<?php
    echo "<h1>Lista de noticias</h1>";
    if(isset($_SESSION['usuario'])){
        nuevo();
    }
    echo "<div id='noticias'>";

    $usuarios = obtener_noticias();

    while($row = $usuarios->fetch_assoc()){
        echo    "<div class='noticia'>",
                "<h6>" . $row['Titulo'] . "</h6>",
                "<p> Autor: " . $row['Autor'] . "</p>",
                "<p> Likes: " . $row['Likes'] . "</p>",
                "<div class='botones'>";
        if(isset($_SESSION['usuario'])){
            editar($row['ID']);
            borrar($row['ID']);
            like($row['ID']);
        }
        echo "</div></div>";
    }
    echo "</div>";

    function nuevo(){
        ?>
        <form action="form_noticias.php" method="get" class="btn-nuevo">
            <input type="hidden" name="action" value="crear">
            <input type="submit" value="Nuevo">
        </form>
        <?php
    }

    function editar($id){
        ?>
        <form action="form_noticias.php" method="get">
            <input type="hidden" name="action" value="editar">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="submit" value="Editar">
        </form>
        <?php
    }
    function borrar($id){
        ?>
        <form action="form_noticias.php" method="get">
            <input type="hidden" name="action" value="borrar">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="submit" value="Borrar">
        </form>
        <?php
    }
    function like($id){
        ?>
        <form action="funciones_bd.php" method="post">
            <input type="hidden" name="consulta" value="like-noticia">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="submit" value="Like">
        </form>
        <?php
    }
 
?>
