<div class="campo">
    <label for="nombre">Nombre del Servicio</label>
    <input type="text" name="nombre" placeholder="Ingrese el servicio" value="<?php echo $servicios->nombre; ?>">
</div>
<div class="campo">
    <label for="precio">Precio</label>
    <input type="precio" name="precio" placeholder="Ingrese su precio" value="<?php echo $servicios->precio; ?>">
</div>
<div class="opciones">
    <a href="/admin/crear">Crear Servicio</a>
    <a href="/admin">Volver</a>
</div>