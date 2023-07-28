<?php
    if(!isset($_SESSION)) {
        session_start();
    }
    $auth = $_SESSION['login'] ?? false;
    $id = $_SESSION['id'] ?? null;
    $admin = $_SESSION['admin'] ?? false;

    if(!isset($inicio)) {
        $inicio = false;
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="build/css/app.css">
    <title>Faster</title>
</head>
<body id="body">
    <header class="header" id="header">
        <a href="/" class="contenedor-logo"><img src="build/img/Fondo-LB.webp" alt="Logo Faster" class="logo_img"></a>
        <div class="flex-row busqueda-iconos">
            <div class="busqueda">
                <input type="text" id="search-input" placeholder="Buscar">
                <ul id="search-results"></ul>
            </div>
            <div class="flexWrap header-img">
                <?php if($auth): ?>
                    <a href="/logout"><img src="build/img/logout.svg" alt="Cerrar sesion"></a>
                <?php endif; ?>
                <a href="/<?php if($admin === '1'){echo 'admin';} else {echo 'usuario?id=' . $id;} ?>"><img src="build/img/usuario.svg" alt="usuario"></a>
                <a href="/usuario?id=<?php echo $id; ?>#carrito"><img src="build/img/carrito.svg" alt="carrito"></a>
            </div>
        </div>
    </header>

    <main>
        <?php echo $contenido; ?>
    </main>

    <footer>

    </footer>

    <script src="https://www.paypal.com/sdk/js?client-id=AZSvRWxB5C4xM6SKSwpJ5vBVH-XnsGhWrwH5877g0iyA-guJx5jRSqkamZcQA8466_XYahSWCe3hXsAu&currency=USD"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="build/js/bundle.min.js"></script>
</body>
</html>