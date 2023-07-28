<div class="informacionContenedor contenedorSombra">
    <h3>Direccion</h3>
    <?php foreach($info as $direccion):?>
        <div class="direccion">
            <p><span>Nombre: </span><?php echo $direccion->nombreDireccion; ?></p>
            <div class="contenedor-grid2">
                <p><span>Calle y Numero Ext.: </span><?php echo $direccion->calleNumero; ?></p>
                <p><span>Colonia: </span><?php echo $direccion->colonia; ?></p>
                <p><span>CPP: </span><?php echo $direccion->cpp; ?></p>
            </div>
            <div class="contenedor-grid2">
                <p><span>Estado: </span><?php echo $direccion->estado; ?></p>
                <p><span>Ciudad: </span><?php echo $direccion->ciudad; ?></p>
            </div>
            
            <p><span>Numero de Telefono: </span><?php echo $direccion->numTelefono; ?></p>
        </div>
    <?php endforeach; ?>
    <a href="/usuario/editar-direccion">Editar Direccion</a>
</div>