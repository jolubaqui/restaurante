<?php
session_start();
$url_base = 'http://localhost/restaurante/admin';
if (!isset($_SESSION['usuario'])) {
    header("Location:" . $url_base . "/login.php");
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Zona Admin</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

</head>

<body>
    <header>
        <!-- place navbar here -->
        <nav class="navbar navbar-expand navbar-light bg-light">
            <div class="nav navbar-nav">
                <a class="nav-item nav-link active" href=" <?php echo $url_base; ?>/index.php" aria-current="page">Administrador <span class="visually-hidden">(current)</span></a>

                <a class="nav-item nav-link" href="<?php echo $url_base; ?>/seccion/banner/">Banners</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>/seccion/personal/">Colaboradores</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>/seccion/testimonios/">Testimonios</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>/seccion/menu/">Menú</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>/seccion/comentarios/">Comentarios</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>/seccion/reserva/">Reservas</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>/seccion/usuarios/">Usuarios</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>/cerrar.php">Cerrar sesión</a>
            </div>
        </nav>

    </header>
    <main>
        <section class="container">
            <br>