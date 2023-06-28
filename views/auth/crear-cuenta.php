<div class="contenedor-grid2 mitad" id="formulario">
    <div class="contenedor-texto negro">
        <div class="contenedor-texto">
            <h2>Crear una nueva cuenta</h2>
            <p>Ingresa tus datos para poder crear una cuenta nueva</p>
        </div>

        <div class="contenedor-texto">
            <p>Ya tienes una cuenta? <a href="/inicio-sesion" class="texto-color-gris">Inicia sesion</a></p>
        </div>
    </div>

    <div class="contenedor-formulario">
        <h3>Ingresa tus datos</h3>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <form action="/crear-cuenta" class="formulario-login" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" placeholder="Nombre" name="usuario[name]">

            <label for="numero">Numero:</label>
            <input type="number" placeholder="Numero" name="usuario[number]">

            <label for="correo">Correo:</label>
            <input type="email" placeholder="Correo" name="usuario[email]">

            <label for="contrasena">Contrasena:</label>
            <input type="password" placeholder="Contrasena" name="usuario[password]">

            <input type="submit" class="boton-enviar" value="Crear Cuenta">
        </form>
    </div>
</div>