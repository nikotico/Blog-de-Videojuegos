<?php require_once 'includes/helpers.php'; ?>

<!--BARRA LATEREAL-->
<aside id = "sidebar">

    <div id = "buscador" class = "bloque"> 
        <h3>Buscar</h3>

        <form action ="buscar.php" method="POST">
            <input type="text" name="busqueda" />

            <input type="submit" value="Buscar" />
        </form>
    </div>

    <?php if(isset($_SESSION['usuario'])): ?>
		<div id="usuario-logueado" class="bloque">
			<h3>Hola, <?=$_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'];?></h3>
            <!--Botones-->
            <a href="crear-entradas.php" class = "boton boton-verde">Crear Entradas</a>
            <a href="crear-categoria.php" class = "boton">Crear Categoria</a>
            <a href="mis-datos.php" class = "boton boton-naranja">Mis datos</a>
            <a href="cerrar.php" class = "boton boton-rojo">Cerrar Sesion</a>
		</div>
	<?php endif; ?>

    <?php if(!isset($_SESSION['usuario'])): ?> <!--Desaparece cuando se inicia sesion-->
    <div id = "login" class = "bloque"> 
        <h3>Identificate</h3>

        <!--Error cuando el usuario se logea mal-->
        <?php if(isset($_SESSION['error_login'])): ?>
		<div class ="alerta alerta-error">
			<?=$_SESSION['error_login']?>
		</div>
	    <?php endif; ?>

        <form action ="login.php" method="POST">
            <label for= "email">Email</label>
            <input type="email" name="email" />

            <label for= "password">Contraseña</label>
            <input type="password" name="password" />

            <input type="submit" value="Entrar" />
        </form>
    </div>

    <div id = "register" class = "bloque">

        <!-- Mostar errores-->

        <?php if(isset($_SESSION['completado'])) : ?>
            <div class="alerta alerta-exito"><?=$_SESSION['completado']?></div>
        <?php elseif(isset($_SESSION['errores']['general'])) : ?>
            <div class="alerta alerta-error"><?=$_SESSION['errores']['general']?></div>
        <?php endif; ?>
    

        <h3>Registrate</h3>
        <form action ="registro.php" method="POST">

            <label for= "name">Nombre</label>
            <input type="text" name="name" />
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nombre') : '';?>

            <label for= "lastname">Apellidos</label>
            <input type="text" name="lastname" />
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'apellidos') : '';?>

            <label for= "email">Email</label>
            <input type="email" name="email" />
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'email') : '';?>

            <label for= "password">Contraseña</label>
            <input type="password" name="password" />
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'password') : '';?>

            <input type="submit" name="submit" value="Registrar" />
        </form>
        <?php borrarErrores();?>
    </div>
    <?php endif; ?>
</aside>