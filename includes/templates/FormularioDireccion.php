<p>Parece que aun no tienes una direccion registrada, Agrega una</p>
<form method="post" action="/usuario/nueva-direccion" id="form" class="formulario informacionContenedor contenedorSombra">
    <div class="input">
        <label for="nombre">Nombre: </label>
        <input type="text" id="nombre" placeholder="Nombre" name="direccion[nombreDireccion]">
    </div>

    <div class="input">
        <label for="calleNumero">Calle y Numero Ext.: </label>
        <input type="text" id="calleNumero" placeholder="Calle y Numero Ext." name="direccion[calleNumero]">    
    </div>

    <div class="input">
        <label for="colonia">Colonia: </label>
        <input type="text" id="colonia" placeholder="Colonia" name="direccion[colonia]">
    </div>

    <div class="input">
        <label for="cpp">Codigo Postal: </label>
        <input type="number" id="cpp" placeholder="CPP" name="direccion[cpp]">
    </div>

    <div class="input">
        <label for="telefono">Telefono: </label>
        <input type="number" id="telefono" placeholder="Telefono / Celular" name="direccion[numTelefono]">
    </div>

    <div class="input">
        <label for="state-filter">Estado:</label>
        <select id="jmr_contacto_estado" name="direccion[estado]">
            <option selected>Selecciona tu estado</option>
        </select>
    </div>

    <div class="input">
        <label for="state-filter">Ciudad:</label>
        <select id="jmr_contacto_municipio" name="direccion[ciudad]">
            <option selected>Selecciona tu municipio</option>
        </select>
    </div>

    <input type="submit" class="boton-enviar" value="Guardar">
</form>