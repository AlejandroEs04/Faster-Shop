<div class="contenedorSlab">
    <h2><?php echo $info->categoryName; ?></h2>

    <div class="productoSlide">
        <?php foreach($info->productos as $productos): ?>
            <?php foreach($productos as $producto): ?>
                <?php incluirTemplateArray('Producto', $producto); ?>
            <?php endforeach; ?>
        <?php endforeach; ?>        
    </div>      
</div>


    
