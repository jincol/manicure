<div class="contenido-login ">
    <h2 class="titulo">Formulario de Recuperacion contrasenia</h2>
    <div class="img img-crear">
        <div class="div">
            <?php include __DIR__ . '/../templates/alertas.php'; ?>
        </div>
        <form method="POST" class="formulario ">

            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" disabled value="<?php echo $usuario->email ?? ''; ?>">
            </div>
            <div class="campo">
                <label for="contrasenia">Tu nueva contrasenia</label>
                <?php if (!$usuario || empty($usuario)) { ?>
                    <input type="password" name="contrasenia" id="contrasenia" disabled>
                    <?php } else { ?>
                        <input type="password" name="contrasenia" id="contrasenia">
                <?php } ?>
            </div>

            <div class="opciones">
                <a href="/login">Iniciar Sesion</a>
            </div>
            <input type="submit" value="Actualizar contrasenia " class="boton">
        </form>
    </div>
</div>