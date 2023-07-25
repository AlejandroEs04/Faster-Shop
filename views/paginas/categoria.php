
<div class="contenedor-grid2 contenedor30-70">
    <div class="barra-izquierda">
        <h3>Filtros</h3>

        <div class="filter-bar">

            <label for="price-filter">Precio:</label>
            <select id="price-filter" onchange="updateProductList()">
                <option value="">Todos los precios</option>
                <option value="under25">$25 o menos</option>
                <option value="25to50">$25 - $50</option>
                <option value="over50">Más de $50</option>
            </select>
        </div>
    </div>

    <div class="catalogo" id="productos">
        <h2>Productos de <span><?php echo $categoriaUna->categoryName ?></span></h2>
        <div class="productos">
            <?php foreach($productos as $producto): ?>
                <?php incluirTemplateArray('Producto', $producto) ?>
                
            <?php endforeach; ?>
        </div>
    </div>
</div>