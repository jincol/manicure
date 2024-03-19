<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/img/manicura-modified-fotor-2024030119112.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Over+the+Rainbow&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="   /build/css/app.css">
    <title>UñasVIP</title>
</head>

<body>
    <?php
    $auth; 
    $ruta = $_SERVER["PATH_INFO"] ?? '';
    $enlaces = ['/login', '/crear-cuenta', '/mensaje', '/confirmar-cuenta', '/recuperar', '/view-recuperar'];
    if (!in_array($ruta, $enlaces)) {;
        
        include 'templates/nav.php';
    }; ?>


    <main>
        <?php echo $contenido; ?>
    </main>
    <?php if (!$ruta  == '/login') {;
        include 'templates/copy.php';
    }; ?>

</body>
<?php
    echo $script ?? '';
    ?>
<script src="https://kit.fontawesome.com/715e801ef4.js" crossorigin="anonymous"></script>

</html>