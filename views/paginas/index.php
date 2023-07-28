<div class="contenedor-100 gris">
    <h1>Categorias</h1>
    <div class="contenedor-grid4 categorias">
        <?php foreach($categoriasSeccion as $categoria): ?>
            <a href="/categoria?tipo=<?php echo $categoria->id; ?>">
                <div class="categoria">
                    <div class="categoria-img">
                        <img src="imagenes/<?php echo $categoria->image; ?>" alt="Imagen Categoria">
                    </div>
                    <p><?php echo $categoria->categoryName; ?></p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<div class="contenedor-grid2 contenedor30-70">
    <?php incluirTemplateArray('Filtros', $info) ?>

    <div class="catalogo" id="productos">
        <div class="contenedorSlab">
            <h2>Mas Vendidos</h2>
            <div class="productoSlide">
                <?php foreach($productosAll as $producto): ?>
                    <?php incluirTemplateArray('Producto', $producto) ?>
                <?php endforeach; ?>
            </div>
        </div>
        

        <div class="listaProductos">
            <?php 
                foreach($categoriasSlide as $categoria): 
                    incluirTemplateArray('ProductosCategorias', $categoria);
                endforeach;
            ?>
        </div>
    </div>
</div>