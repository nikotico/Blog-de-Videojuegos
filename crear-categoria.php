
<?php require_once 'includes/redireccion.php'; ?>

<?php require_once 'includes/cabecera.php'; ?>

<?php require_once 'includes/lateral.php'; ?>

<!--CAJA PRINCIPAL-->
<div id ="principal">
    <h1>Crear Categorias</h1>
    <p>
        Añade nuevas categorias al blog para que los usuarios puedan
        usarlar al crear sus entradas.
    </p>
    <br/>

    <form action="guardar-categoria.php" method="POST">
        <label for="nombre">Nombre de la categoria:</label>
        <input type="text" name="nombre"/>

        <input type="submit" value="Guardar"/>



    </form>
</div><!--FIN CAJA PRINCIPAL-->


<?php require_once "includes/pie.php"; ?>