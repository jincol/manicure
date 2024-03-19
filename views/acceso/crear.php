<div class="contenido-login ">
    <h2 class="titulo">Ingrese tus datos</h2>
    <div class="img img-crear">
        <div class="div">
            <?php include __DIR__ . '/../templates/alertas.php'; ?>
        </div>
        <form action="/crear-cuenta" class="formulario" method="POST">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Ingrese su usuario" value="<?php echo $usuario->nombre ?>">
            </div>
            <div class="campo">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido" placeholder="Ingrese su Apellido" value="<?php echo $usuario->apellido ?>">
            </div>
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="email@gmail.com" value="<?php echo $usuario->email ?>">
            </div>
            <div class="campo">
                <label for="contrasenia">contrasenia</label>
                <input type="password" name="contrasenia" id="contrasenia" placeholder="xxxxxxx">
            </div>
            <div class="campo">
                <label for="telefono">Telefono</label>
                <input type="tel" name="telefono" id="telefono" placeholder="987-123-121" value="<?php echo $usuario->telefono ?>">
            </div>
            <div class="opciones">
                <a href="/recuperar">Recuperar contrasenia</a>
            </div>
            <input type="submit" value="Crear Cuenta" class="boton">
        </form>
    </div>
</div>