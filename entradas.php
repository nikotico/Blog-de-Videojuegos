
<?php require_once 'includes/cabecera.php'; ?>

<?php require_once 'includes/lateral.php'; ?>
            
<!--CAJA PRINCIPAL-->
<div id ="principal">
    <h1>Todas las entradas</h1>
    <?php 
        $entradas = conseguirEntradas($db);
        if(!empty($entradas)):
            while($entrada = mysqli_fetch_assoc($entradas))://Este recorre todas las filas de la consulta
    ?>
                <article class = "entradas">
                    <a href="entrada.php?id=<?=$entrada['id']?>">
                        <h2><?=$entrada['titulo']?></h2>
                        <span class ="fecha"><?= $entrada['categoria'] . " | ".$entrada['fecha']?></span>
                        <p>
                        <?=substr($entrada['descripcion'],0,150)?>
                        </p>
                    </a>
                </article>
    <?php 
            endwhile;
        endif;
        ?>
</div><!--FIN CAJA PRINCIPAL-->


<?php require_once "includes/pie.php"; ?>