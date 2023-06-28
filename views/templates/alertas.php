<?php
    foreach($errores as $key => $mensajes):
        foreach($mensajes as $mensaje):
?>
<div class="contenedor-alerta">
    <div class="alerta <?php echo $key; ?>">
            <?php echo $mensaje; ?>
    </div>
</div>
<?php
        endforeach;
    endforeach;
?>