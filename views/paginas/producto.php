<?php 
    $resultado = $_GET['resultado'];
    if($resultado):
        $mensaje = mostrarNotificacion( intval( $resultado) );
        if($mensaje): ?>
            <a href="/carrito?id=<?php echo $usuarioId; ?>" class="mensaje exito">
                <p><?php echo $mensaje; ?></p>
                <img src="build/img/carrito.svg"alt="mensaje de exito">
            </a>
        <?php endif;
    endif;
?>
<div class="contenedor">
<div class="contenedor-producto">
    <div class="imagen-producto">
        <img src="imagenes/<?php echo $producto->image ?>" alt="Imagen Producto">
    </div>

    <div class="informacion-producto">
        <h2><?php echo $producto->productName; ?></h2>
        <p>Descripcion: <span><?php echo $producto->description; ?></span></p>

        <p>Precio: <span>$<?php echo $producto->price; ?></span></p>
        <p class="text-low">Inventario: <span><?php echo $producto->inventory ?></span></p>

        <div class="formulario-producto">
            <?php foreach($errores as $error): ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>
            <form method="post" action="/carrito?id=<?php echo $producto->id ?>" class="formulario-compra">
                <label for="cantidad">Seleccione la cantidad</label>
                <input type="number" name="cantidad" placeholder="Cantidad ej. 5" id="cantidad" class="input-number">

                <div class="botones-acciones">
                    <input type="submit" class="boton boton-carrito" value="Agregar al carrito" name="carrito">
                    <input type="submit" class="boton boton-comprar" value="Comprar" name="comprar">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="contenedor">
    <h2>Hola</h2>
</div>
</div>