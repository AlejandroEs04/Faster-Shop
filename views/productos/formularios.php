<label for="nombre">Nombre del producto:</label>
<input type="text" id="nombre" name="product[productName]" placeholder="Nombre del producto" value="<?php echo $producto->productName; ?>">

<label for="descripcion">Descripcion del producto:</label>
<textarea id="descripcion" name="product[description]"></textarea>

<label for="precio">Precio del producto:</label>
<input type="text" id="precio" name="product[price]" placeholder="Precio del producto" value="<?php echo $producto->price; ?>">

<label for="inventario">Inventario:</label>
<input type="number" id="inventario" name="product[inventory]" placeholder="Inventario del producto" value="<?php echo $producto->inventory; ?>">

<label for="image">Imagen:</label>
<input type="file" id="image" name="product[image]" accept="image/jpeg, image/png, image/jpg">

<label for="categoria">Elija la categoria:</label>
<select name="product[categoriaID]" id="categoria">
    <option value="" select>-- Seleccione categoria --</option>
    <?php foreach($categorias as $categoria): ?>
        <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->categoryName; ?></option>
    <?php endforeach; ?>
</select>
<a href="/crear-categoria">Crear una categoria nueva</a>
