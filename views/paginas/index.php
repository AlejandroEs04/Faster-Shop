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
        <h2>Productos</h2>
        <div class="productos">
            <?php foreach($productos as $producto): ?>
                <?php incluirTemplateArray('Producto', $producto) ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>