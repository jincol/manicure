<div class="contenedor contenedor-servicios">
    <div class="img"></div>
    <div class="servicios">
        <h2>Servicios</h2>

        <?php
        foreach ($servicios as $servicio) { ?>
            <div class="servicio">
                <div class="datos">
                    <p class="nombre">Servicio : <?php echo $servicio->nombre;  ?></p>

                    <p>Precio : $<?php echo $servicio->precio ;  ?></p>
                </div>
                <?php if ($admin) : ?>
                    <div class="opciones">
                        <a href="/servicios/actualizar?id=<?php echo $servicio->id; ?>" class="btn_a">Actualizar</a>
                        <form action="/servicios/eliminar" method="post" id="formulario">
                            <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">
                            <!-- <input type="submit" value="Eliminar" class="btn_e" onclick="confirmarEliminar(e)"> -->
                            <input type="submit" value="Eliminar" class="btn_e">
                        </form>
                    </div>
                <?php endif ?>
            </div>
        <?php } ?>
    </div>
</div>

<?php
$script = "
<script src='https://kit.fontawesome.com/715e801ef4.js' crossorigin='anonymous'></script>
<script src='build/js/app.js'></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
"
?>