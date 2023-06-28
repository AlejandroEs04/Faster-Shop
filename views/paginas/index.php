<div class="contenedor-100 gris">
    <h1>Categorias</h1>
    <div class="contenedor-grid4 categorias">
        <a href="/categoria?tipo=1">
            <div class="categoria">
                <div class="categoria-img">
                    
                </div>
                <p>Resinas</p>
            </div>
        </a>
        
        <a href="/categoria?tipo=2">
            <div class="categoria">
                <div class="categoria-img">

                </div>
                <p>Guantes</p>
            </div>
        </a>
        
        <a href="/categoria?tipo=3">
            <div class="categoria">
                <div class="categoria-img">

                </div>
                <p>Brackets</p>
            </div>
        </a>
        
        <a href="/categoria?tipo=4">
            <div class="categoria">
                <div class="categoria-img">

                </div>
                <p>Anestesia</p>
            </div>
        </a>
        
        <a href="/categoria?tipo=5">
            <div class="categoria">
                <div class="categoria-img">

                </div>
                <p>Resinas</p>
            </div>
        </a>
        
        <a href="/categoria?tipo=6">
            <div class="categoria">
                <div class="categoria-img">

                </div>
                <p>Guantes</p>
            </div>
        </a>
        
        <a href="/categoria?tipo=7">
            <div class="categoria">
                <div class="categoria-img">

                </div>
                <p>Brackets</p>
            </div>
        </a>
        
        <a href="/categoria?tipo=8">
            <div class="categoria">
                <div class="categoria-img">

                </div>
                <p>Anestesia</p>
            </div>
        </a>
    </div>
</div>

<div class="contenedor-grid2 contenedor30-70">
    <div class="barra-izquierda">
        <h3>Filtros</h3>

        <div class="filter-bar">
            <label for="catogory-filter">Categorias:</label>
            <select id="category-filter" onchange="updateProductList()">
            <option value="" select>-- SELECCIONE --</option>
            <option value="">Todas</option>
            <?php foreach($categorias as $categoria): ?>
                <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->categoryName; ?></option>
            <?php endforeach; ?>
            </select>

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
        <h2>Productos mas vendidos</h2>
        <div class="productos">
            <?php foreach($productos as $producto): ?>
                <a href="/producto?id=<?php echo $producto->id; ?>" class="producto">
                    <div class="productoContenedor">
                        <img src="imagenes/<?php echo $producto->image; ?>" alt="imagen1">
                        <p><?php echo $producto->productName; ?></p>
                        <p class="precio">$<?php echo $producto->price; ?> mxn</p>
                    </div>
                </a>
                
            <?php endforeach; ?>
        </div>
    </div>
</div>