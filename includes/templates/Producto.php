<a href="/producto?id=<?php echo $info->id; ?>" class="producto">
    <div class="productoContenedor">
        <img src="imagenes/<?php echo $info->image; ?>" alt="imagen1">
        <p class="nomProducto"><?php echo $info->productName; ?></p>
        <p class="descProducto"><?php echo $info->description; ?></p>
        <p class="precio">$<?php echo $info->price; ?> mxn</p>
        <p class="invProducto">Inventario: <?php echo $info->inventory; ?></p>
    </div>
</a>