<label for="nombre">Nombre del producto:</label>
<input type="text" id="nombre" name="producto[productName]" placeholder="Nombre del producto" value="<?php echo $producto->productName; ?>">

<label for="descripcion">Descripcion del producto:</label>
<textarea id="descripcion" name="producto[description]"><?php echo $producto->description ?></textarea>

<label for="precio">Precio del producto:</label>
<input type="text" id="precio" name="producto[price]" placeholder="Precio del producto" value="<?php echo $producto->price; ?>">

<label for="costo">Costo del producto:</label>
<input type="text" id="costo" name="producto[precioCosto]" placeholder="Costo del producto" value="<?php echo $producto->precioCosto; ?>">

<label for="iva">Iva del producto:</label>
<input type="text" id="iva" name="producto[iva]" placeholder="iva del producto" value="<?php echo $producto->iva; ?>">

<label for="inventario">Inventario:</label>
<input type="number" id="inventario" name="producto[inventory]" placeholder="Inventario del producto" value="<?php echo $producto->inventory; ?>">

<label for="image">Imagen:</label>
<input type="file" id="image" name="producto[image]" accept="image/jpeg, image/png, image/jpg" value="<?php echo $producto->image ?>">

<?php if($producto->image): ?>
    <img src="imagenes/<?php echo $producto->image ?>">
<?php endif; ?>

<label for="categoria">Elija la categoria:</label>
<select name="producto[categoriaID]" id="categoria" value="<?php echo $categoriaID->id; ?>">
    <option value="<?php echo $categoriaID->id; ?>" select><?php if(empty($proveedorID)){ echo 'Seleccione Categoria'; } else{ echo $categoriaID->categoryName; } ?></option>
    <?php foreach($categorias as $categoria): ?>
        <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->categoryName; ?></option>
    <?php endforeach; ?>
</select>

<label for="proveedor">Elija al Proveedor:</label>
<select name="producto[proveedorID]" id="proveedor" value="<?php echo $proveedorID->id ?>">
    <option value="<?php echo $proveedorID->id ?>" select><?php if(empty($proveedorID)){ echo 'Seleccione Proveedor'; } else{ echo $proveedorID->proveedorName; } ?></option>
    <?php foreach($proveedores as $proveedor): ?>
        <option value="<?php echo $proveedor->id; ?>"><?php echo $proveedor->proveedorName; ?></option>
    <?php endforeach; ?>
</select>
<a href="/crear-categoria">Crear una categoria nueva</a>
