<div class="contenido-login contenedor">
    <h2 class="titulo">Inicie Sesion</h2>
    <div class="img">
        <div class="div" >
        <?php include __DIR__ . '/../templates/alertas.php'; ?>
        </div>
        <form action="/login" class="formulario" method="POST">
            <div class="campo">
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="Ingrese su usuario">
            </div>
            <div class="campo">
                <label for="contrasenia">contrasenia</label>
                <input type="password" name="contrasenia" placeholder="Ingrese su contrasenia">
            </div>
            <div class="opciones">
                <a href="/crear-cuenta">No tienes cuenta? Registrate</a>
                <a href="/recuperar">Recuperar contrasenia</a>
            </div>
            <input type="submit" value="Ingresar" class="boton">
        </form>
    </div>

</div>

