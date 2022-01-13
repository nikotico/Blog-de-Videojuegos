
<?php require_once 'includes/redireccion.php'; ?>

<?php require_once 'includes/cabecera.php'; ?>

<?php require_once 'includes/lateral.php'; ?>

<!--CAJA PRINCIPAL-->
<div id ="principal">
    <h1>Mis Datps</h1>

    <?php if(isset($_SESSION['completado'])): ?>
        <div class="alerta alerta-exito">
            <?=$_SESSION['completado']?>
        </div>
    <?php elseif(isset($_SESSION['errores']['general'])): ?>
        <div class="alerta alerta-error">
            <?=$_SESSION['errores']['general']?>
        </div>
    <?php endif; ?>

    <form action ="actualizar-usuario.php" method="POST">

        <label for= "name">Nombre</label>
        <input type="text" name="name" value="<?=$_SESSION['usuario']['nombre']?>"/>
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nombre') : '';?>

        <label for= "lastname">Apellidos</label>
        <input type="text" name="lastname" value="<?=$_SESSION['usuario']['apellidos']?>" />
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'apellidos') : '';?>

        <label for= "email">Email</label>
        <input type="email" name="email" value="<?=$_SESSION['usuario']['email']?>" />
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'email') : '';?>

        <input type="submit" name="submit" value="Actualizar" />
    </form>
    <?php borrarErrores();?>

     
</div><!--FIN CAJA PRINCIPAL-->


<?php require_once "includes/pie.php"; ?>