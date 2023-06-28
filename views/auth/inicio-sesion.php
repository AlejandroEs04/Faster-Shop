<div class="contenedor-grid2 mitad" id="formulario">
    <div class="contenedor-texto negro">
        <div class="contenedor-texto">
            <h2>Inicia sesion</h2>
            <p>Ingresa tus datos para iniciar sesion</p>
        </div>

        <div class="contenedor-texto">
            <p>Aun no tienes cuenta? <a href="/crear-cuenta" class="texto-color-gris">Crear Nueva Cuenta</a></p>
        </div>
    </div>

    <div class="contenedor-formulario">
        <h3>Ingresa tus datos</h3>
        <?php 
            include_once __DIR__ . "/../templates/alertas.php";
        ?>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <form action="/inicio-sesion" class="formulario-login" method="post">
            <label for="correo">Correo:</label>
            <input type="email" placeholder="Correo" name="usuario[email]">

            <label for="contrasena">Contrasena:</label>
            <input type="password" placeholder="Contrasena" name="usuario[password]">

            <input type="submit" class="boton-enviar" value="Inciar sesion">
        </form>
    </div>
</div>