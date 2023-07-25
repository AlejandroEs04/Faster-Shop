<div class="contenedor-grid2 contenedor-admin">
    <div class="contenedor2">
        <h2>Acciones</h2>

        <div class="acciones admin">
            <div class="botones">
                <a href="/crear-producto">Crear Producto</a>
                <a href="/crear-categoria">Crear Categoria</a>       
            </div>

            <div class="accion">
                <h3>Productos</h3>
                <div class="contenedor-tabla">
                    <table class="lista">
                        <thead>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Imagen</th>
                            <th>Inventario</th>
                            <th>Acciones</th>
                        </thead>

                        <div class="contenedor-barra">
                            <input id="searchbar" onkeyup="search_barra()" type="text" name="search" placeholder="Busqueda" class="barra-busqueda">
                        </div>

                        <tbody class="tabla" id="list">
                            <?php foreach($productos as $producto): ?>
                            <tr class="no">
                                <td class="id"><?php echo $producto->id; ?></td>
                                <td><?php echo $producto->productName; ?></td>
                                <td><?php echo $producto->price; ?></td>
                                <td><img src="imagenes/<?php echo $producto->image ?>" alt="imagen produto"></td>
                                <td><?php echo $producto->inventory; ?></td>
                                <td class="flex"><a href="/actualizar-producto?id=<?php echo $producto->id; ?>">Actualizar</a><a href="/eliminar-producto?id=<?php echo $producto->id; ?>" class="no-fondo"><img src="build/img/basura.svg" alt="Eliminar producto"></a></td>   
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="accion">
                <h3>Categorias</h3>
                <div class="contenedor-tabla">
                    <table class="lista">
                        <thead>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </thead>

                        <tbody class="tabla" id="list">
                            <?php foreach($categorias as $categoria): ?>
                                <tr class="no">
                                <td><?php echo $categoria->id ?></td>
                                <td><?php echo $categoria->categoryName ?></td>
                                <td><img src="imagenes/<?php echo $categoria->image ?>" alt="imagen produto"></td>
                                <td class="flex"><a href="/actualizar-categoria?id=<?php echo $categoria->id; ?>">Actualizar</a><a href="/eliminar-categoria?id=<?php echo $categoria->id; ?>" class="no-fondo"><img src="build/img/basura.svg" alt="Eliminar producto"></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="contenedor2 negro">
        <h2>Compras</h2>
    </div>
</div>