<div class="contenedor-comprar">
    <div class="vista-comprar">
        <div class="grid2">
            <p>Hola! <span><?php echo $usuario->name ?></span></p>
            <h2>Proceder al Pago</h2>
        </div>
    </div>

    <div class="contenido-comprar">
        <div class="contenedor-seccion-comprar">
            <div class="divForm">
               <?php incluirTemplateArray($InluirDireccion, $direcciones); ?> 
            </div>
            <div class="contenedor-blanco contenedorSombra">
                <h3>Productos</h3>
                <?php
                    if(!empty($carrito)):
                        $i = 0;
                        foreach($carrito as $productoCarrito): 
                ?>
                        <div class="contenedor-carrito-producto">
                            <div class="imagen">
                                <img src="/imagenes/<?php echo $productos[$i]->image ?>" alt="Imagen Producto">
                            </div>
                            <div class="texto">
                                <p><span>Nombre: </span><?php echo $productos[$i]->productName; ?></p>
                                <p><span>Precio: </span> $<?php echo $productos[$i]->price * $productoCarrito->cantidad; ?></p>
                                <p><span>Cantidad: </span> <?php echo $productoCarrito->cantidad ?></p>
                            </div>
                        </div>
                <?php 
                        $i++;
                        endforeach;
                    endif; 

                    if(!empty($producto)):
                ?>
                    <div class="contenedor-carrito-producto">
                            <div class="imagen">
                                <img src="/imagenes/<?php echo $producto->image ?>" alt="Imagen Producto">
                            </div>
                            <div class="texto">
                                <p><span>Nombre: </span><?php echo $producto->productName; ?></p>
                                <p><span>Precio: </span> $<?php echo $producto->price ?></p>
                                <p><span>Cantidad: </span> 1</p>
                            </div>
                        </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="contenedor-seccion-comprar"> 
            <h2>Finaliza tu compra!</h2>
            <div class="Info-comprar">
                <p><span>Productos Totales: </span><?php echo $cantidad; ?></p>
                <p><span>Subtotal: </span>$<?php echo $total; ?> mxn</p>
                <p><span>Costo de envio: </span>$99 mxn</p>
                <p class="total"><span>Total: </span>$<?php echo $total + 99 ?> mxn</p>
            </div>
            <div id="paypal-button-container"></div>
        </div>
    </div>
</div>