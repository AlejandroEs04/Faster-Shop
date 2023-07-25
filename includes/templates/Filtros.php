<?php 
    $categorias = $info['categorias'];
    $proveedores = $info['proveedores'];
?>

<div class="barra-izquierda">
        <h3>Filtros</h3>

        <div class="filter-bar">
            <label for="catogory-filter">Categorias:</label>
            <select id="category-filter" onchange="updateProductList()">
            <option value="" select>Categorias</option>
            <option value="">Todas</option>
            <?php foreach($categorias as $categoria): ?>
                <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->categoryName; ?></option>
            <?php endforeach; ?>
            </select>

            <label for="price-filter">Precio:</label>
            <select id="price-filter" onchange="updateProductList()">
                <option value="" selected>Precios</option>
                <option value="">Todos los precios</option>
                <option value="BETWEEN 0 AND 200">Hasta 200</option>
                <option value="BETWEEN 200 AND 500">$200 a $500</option>
                <option value="BETWEEN 500 AND 700">$500 a $700</option>
                <option value=">=700 ">$700 o mas</option>
            </select>

            <label for="proveedores-filter">Proveedores:</label>
            <select id="proveedores-filter" onchange="updateProductList()">
                <option value="" selected>Proveedores</option>
                <?php foreach($proveedores as $proveedor): ?>
                    <option value="<?php echo $proveedor->id ?>"><?php echo $proveedor->proveedorName; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>