<header>
    <div class="barra contenedor">
        <div class="logo">
            <p class="logo">Nail Bar</p>
        </div>
        <i class="fa-solid fa-bars menu"></i>
        <ul class="navegacion">
            <li>
                <a href="#">Catalogo</a>
            </li>
            <li>
                <a href="#">Blog</a>
            </li>
            <li>
                <a href="#">Contacto</a>
            </li>
        </ul>
        <?php 
        if ($auth) { ?>
            <a class="login" href="/logout">Cerrar Sesion <i class="fa-solid fa-arrow-right-to-bracket"></i></a>

        <?php } else { ?>
            <a class="login" href="/login">Login <i class="fa-solid fa-arrow-right-to-bracket"></i></a>
        <?php } ?>

    </div>

    <?php if ($_SERVER["REQUEST_URI"] == '/') {; ?>
        <div class="bienvenida">
            <h1 class="titulo"> Nair Bar </h1>
        </div>
    <?php }; ?>

</header>