<?php require 'cabecera.php' ?>
<style><?php include 'estilos.css' ?></style>

<h1>Últimas noticias</h1>
<div id="noticias">
    <?php
        require 'funciones_bd.php';

        if($noticias = ultimas_noticias()){
            while($row = $noticias->fetch_assoc()){ 
                echo '<div class="noticia">',
                    '<h3>' . $row['Titulo'] . '</h3>',
                    '<h4>Escrito por: ' . $row['Autor'] . '</h4>',
                    '<p>' . $row['Contenido'] . '</p>',
                    '<time>' . $row['Hora_creacion'] . '</time>',
                    '<div>Likes: ' . $row['Likes'] . '</div>';
                if(isset($_SESSION['usuario'])){
                    like($row['ID']);
                }
                echo '</div>';
            }
        }
    ?>
</div>

<?php
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
