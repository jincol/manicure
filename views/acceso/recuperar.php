<div class="contenido-login ">
    <h2 class="titulo">Recuperar contrasenia</h2>
    <div class="img img-crear">
        <div class="div">
        <?php include __DIR__ . '/../templates/alertas.php'; ?>
        </div>
        <form action="/recuperar" method="POST" class="formulario ">

            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="email@gmail.com">
            </div>

            <div class="opciones">
                <a href="/login">Iniciar Sesion</a>
            </div>
            <input type="submit" value="Recuperar " class="boton">
        </form>
    </div>
</div>