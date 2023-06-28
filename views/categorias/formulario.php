<label for="nombre">Nombre de la categoria:</label>
<input type="text" id="nombre" name="category[categoryName]" placeholder="Nombre de la categoria" value="<?php echo $categoria->CategoryName; ?>">

<label for="image">Imagen:</label>
<input type="file" id="image" name="category[image]" accept="image/jpeg, image/png, image/jpg">