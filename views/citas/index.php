<div class="contenedor contenedor-servicios">
    <div class="img"></div>
    <div class="servicios">
        <h2>Registrar Citas</h2>
        <div class="contenidoServicios">

            <nav class="tabs">
                <button class="actual" type="button" data-paso="1">Servicios</button>
                <button type="button" data-paso="2">Informacion</button>
                <button type="button" data-paso="3">Resumen</button>
            </nav>

            <div id="paso-1" class="seccion">
                <h2>Servicios</h2>
                <p>Eliges los servicios a reservar</p>
                <div class="listado-servicios" id="servicios"></div>
            </div>
            <div id="paso-2" class="seccion">
                <h2>Tus datos y Cita</h2>
                <p>Coloca tus datos y fecha de reserva</p>
                <form class="formulario" >
                    <input type="hidden" id="id" value="<?php echo $id ?>">
                    <div class="campo">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre ?>" disabled>
                    </div>
                    <div class="campo">
                        <label for="fecha">Fecha</label>
                        <input type="date" id="fecha" min="<?php echo date('Y-m-d') ?>">
                    </div>
                    <div class="campo">
                        <label for="hora">Hora</label>
                        <input type="time" id="hora">
                    </div>
                </form>
            </div>
            <div id="paso-3" class="seccion contenido-resumen">
                <h2>Resumen</h2>
                <p>Verifica tu cita </p>
            </div>
            <div class="paginacion">
                <button class="boton" id="anterior"> &laquo; Anterior</button>
                <button class="boton" id="siguiente"> Siguiente &raquo;</button>
            </div>
        </div>
    </div>
</div>

<?php
$script = "
<script src='https://kit.fontawesome.com/715e801ef4.js' crossorigin='anonymous'></script>
<script src='build/js/app.js'></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
"
?>