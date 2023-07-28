<label for="nombre">Nombre de la categoria:</label>
<input type="text" id="nombre" name="category[categoryName]" placeholder="Nombre de la categoria" value="<?php echo $categoria->categoryName; ?>">

<label for="image">Imagen:</label>
<input type="file" id="image" name="category[image]" accept="image/jpeg, image/png, image/jpg">

<?php if ($categoria->image): ?>
    <img src="/imagenes/<?php echo $categoria->image ?>" class="imagen-small">
<?php endif; ?>