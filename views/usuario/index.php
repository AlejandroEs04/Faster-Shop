<div class="contenedor"> 
    <div class="contenedor-blanco usuario">
        <h2>Hola <span><?php echo $usuario->name; ?></span>, Bienvenido</h2>
        <div class="opciones">
            <a href="#" class="contenedor-opciones">
                <div class="opcion">
                    <h4>Mis datos</h4>
                    <p>Modifica tus datos, correo, direccion, contrasena, telefono</p>
                </div>  
                <div class="img-opcion">
                    <img src="build/img/usuario.svg" alt="Mis datos">
                </div>
            </a>

            <a href="#" class="contenedor-opciones">
                <div class="opcion">
                    <h4>Mis pedidos</h4>
                    <p>Rastrea tus pedidos, devolver o comprar productos de nuevo</p>
                </div>  
                <div class="img-opcion">
                    <img src="build/img/carrito.svg" alt="Mis pedidos">
                </div>
            </a>

            <a href="#" class="contenedor-opciones">
                <div class="opcion">
                    <h4>Servicio al cliente</h4>
                    <p>Atencion a clientes, articulos de ayuda o contactanos</p>
                </div>  
                <div class="img-opcion">
                    <img src="build/img/servicioCliente.svg" alt="Servicio al cliente">
                </div>
            </a>
            
        </div>
        
    </div>

    <div class="contenedor-carrito" id="carrito">
        <div class="contenedor-blanco">
            <div class="flex">
                <h3>Carrito</h3>
                <p>Todos tus productos en carrito</p>
            </div>
            
            <?php if(empty($carrito)): ?>
                <h3 class="textoNoProductos">Aun no Hay productos en el <span>carrito</span></h3>
            <?php
                endif;
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
                        <form method="post" action="/carrito?id=<?php echo $productoCarrito->productoId; ?>">
                            <input type="number" name="cantidadInput" value="<?php echo $productoCarrito->cantidad; ?>">
                            <div>
                                <input type="submit"  class="btn actualizar" value="Actualizar">
                                <input type="submit" name="eliminar" class=" eliminar" value="Eliminar">
                            </div>
                            
                        </form>
                    </div>
                </div>
            <?php 
                $i++;
                endforeach; 
                
            ?>
        </div>
        
        <div class="contenedor-blanco texto textoPagar">
            <form method="POST" action="/comprar?id=<?php echo $usuario->id; ?>">
                <div class="Info-comprar">
                    <p><span>Productos Totales: </span><?php echo $cantidad; ?></p>
                    <p><span>Subtotal: </span>$<?php echo $total; ?> mxn</p>
                    <p><span>Costo de envio: </span>$99 mxn</p>
                    <p class="total"><span>Total: </span>$<?php echo $total + 99 ?> mxn</p>
                </div>
                <input type="submit" value="Pagar Ahora" class="boton btn-enviar">
            </form>

        </div>
    </div>
</div>