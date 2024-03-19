<div class="contenedor contenedor-servicios">
    <div class="img"></div>
    <div class="servicios">
        <h2>Panel de Administracion</h2>
        <div class="contenidoServicios">

            <div class="header">
                <a class="red" href="/servicios">➡️ Administrar Servicios</a>
                <h2>Buscar Citas</h2>
                <form class="formulario">
                    <div class="campo">
                        <label for="fecha">Ingrese Fecha de busqueda</label>
                        <input type="date" id="fecha" name="fecha">
                    </div>
                </form>
            </div>
            <div class="contenedorCitas">
                <ul class="citas">
                    <?php
                    $idExistente = 0;
                    foreach ($citas as $key  => $cita) {
                        if ($idExistente != $cita->id) {
                            $total = 0;
                    ?>
                            <li>
                                <h2>Cliente</h2>
                                <p>Nombres: <span><?php echo $cita->cliente; ?></span></p>
                                <p>Celular :<span><?php echo $cita->telefono; ?></span> </p>
                                <p>Email :<span><?php echo $cita->email; ?></span></p>

                                <h3>Servicios </h3>
                                <div class="ser">
                                <?php
                                $idExistente = $cita->id;
                            } ?>
                                <p><?php echo $cita->servicio . " --- " ?> <span> S\. <?php echo  $cita->precio; ?></span></p>
                                <?php
                                $total +=  $cita->precio;

                                $actual = $cita->id;
                                $ultimo = $citas[$key + 1]->id ?? 0;

                                if ($actual != $ultimo) { ?>
                                    <p class="total">Total S\. <span class="precio"> <?php echo $total ?></span> </p>
                                    
                                </div>
                                <form action="/api/eliminar" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                                    <input type="submit" class="boton btn_e" value="Eliminar">
                                </form>
                        <?php }
                            } ?>
                            </li>
                </ul>
            </div>
        </div>
    </div>

    <?php
    $script = "
<script src='build/js/buscador.js'></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
"
    ?>