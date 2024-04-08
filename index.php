<?php

include("admin/bd.php");

$sentencia = $conexion->prepare('SELECT * FROM tbl_banners ORDER BY id DESC LIMIT 1');
$sentencia->execute();
$lista_banners = $sentencia->fetchALL(PDO::FETCH_ASSOC);

$sentencia = $conexion->prepare('SELECT * FROM tbl_personal ORDER BY id DESC ');
$sentencia->execute();
$lista_personal = $sentencia->fetchALL(PDO::FETCH_ASSOC);

$sentencia = $conexion->prepare('SELECT * FROM tbl_testimonios ORDER BY id DESC LIMIT 4');
$sentencia->execute();
$lista_testimonios = $sentencia->fetchALL(PDO::FETCH_ASSOC);

$sentencia = $conexion->prepare('SELECT * FROM tbl_menu ORDER BY id DESC LIMIT 4');
$sentencia->execute();
$lista_menus = $sentencia->fetchALL(PDO::FETCH_ASSOC);

if ($_POST) {


    $nombre = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
    $correo = filter_var($_POST["correo"], FILTER_VALIDATE_EMAIL);
    $mensaje = filter_var($_POST["mensaje"], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    if ($nombre && $correo && $mensaje) {
        $sentencia = 'INSERT INTO tbl_comentarios (Nombre,Correo,Mensaje) VALUES(:nombre,:correo, :mensaje)';
        $resultado = $conexion->prepare($sentencia);
        $resultado->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $resultado->bindParam(':correo', $correo, PDO::PARAM_STR);
        $resultado->bindParam(':mensaje', $mensaje, PDO::PARAM_STR);
        $resultado->execute();
        header("Location: index.php");
        echo "<script>alert(\'Mensaje enviado correctamente\')</script>";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Restaurante</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />



</head>

<body>

    <nav id="inicio" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">

            <a class="navbar-brand" href="#"> <i class="fas fa-utensils"></i> Bonka's</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!--barra de Navegación-->
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="nav navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="#inicio">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#chefs">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#menu">Menú día</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonios">Testimonios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#menu">Reservas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#horario">Horarios</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>




    <!-- Banner de presentación -->
    <section id="banner" class="container-fluid p-0">
        <div class="banner-img" style="position:relative; background:url('images/casaCampo.png') center/cover no-repeat; height:500px;">
            <div class="banner-text" style="position:absolute; top:50%; left: 50%; transform: translate(-50%, -50%); text-align:center; color:#fff">

                <?php
                foreach ($lista_banners as $banner) {
                ?>

                    <h1><?php echo $banner['titulo']; ?></h1>
                    <p style="color:white;"><?php echo $banner['descripcion']; ?></p>
                    <a href="<?php echo $banner['link']; ?>" class="btn btn-primary">Nuestros Servicios</a>

                <?php  } ?>
            </div>
        </div>
    </section>
    <!-- Información de presentación -->
    <section id="id" class="container mt-4 text-center">

        <div class="jumbotron bg-dark text-white">
            <br>
            <h2>Bienvenido a la Casa de Campo</h2>
            <p>Lugar ideal para relajarse y disfrutar del aire libre, entorno perfecto para reuniones familiares y sociales, así como para escapar del bullicio de la ciudad y disfrutar de la tranquilidad y la privacidad que ofrecen las zonas rurales.</p>
            <br>
        </div>

    </section>
    <!--Sección dirección-->
    <br>
    <section>
        <div class="container text-center bg-light p-4">
            <div class="mb-3">


                <p><i class='fa-solid fa-location-dot'></i> Carrera 8 Nº 12 - 39 0810 Valledupar (Cesar)</p>
                <p><i class="fa-solid fa-square-phone"></i> Cel: 312 458 4567</p>
                <a href="<?php echo $persona['linkfacebook'] ?>" class="text-dark me-2"><i class="fab fa-facebook"></i></a>
                <a href="<?php echo $persona['linkinstagram'] ?>" class="text-dark me-2"><i class="fab fa-instagram"></i></a>
                <a href="<?php echo $persona['linklinkedin'] ?>" class="text-dark me-2"><i class="fab fa-linkedin"></i></a>
            </div>

        </div>
    </section>

    <!-- Sección de Chefs -->
    <section id=" chefs" class="container mt-4 text-center">
        <h2>Disfrutaras de...!</h2>
        <div class="row">
            <?php
            foreach ($lista_personal as $persona) {
            ?>
                <div class="col-md-3 d-flex">
                    <div class="card">
                        <img height="300" src="images/colaboradores/<?php echo $persona['foto'] ?>" alt="Carlo" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $persona['nombre'] ?></h5>
                            <p class="card-text"><?php echo $persona['descripcion'] ?></p>
                            <div class="social-icons mt-3">
                                <a href="<?php echo $persona['linkfacebook'] ?>" class="text-dark me-2"><i class="fab fa-facebook"></i></a>
                                <a href="<?php echo $persona['linkinstagram'] ?>" class="text-dark me-2"><i class="fab fa-instagram"></i></a>
                                <a href="<?php echo $persona['linklinkedin'] ?>" class="text-dark me-2"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>

    </section>

    <!-- Sección Menú del día -->
    <section id="menu" class="container mt-4">
        <h2 class="text-center">Menú (Nuestra recomendación)</h2>
        <br>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php
            foreach ($lista_menus as $menu) {
            ?>
                <div class="col d-flex">
                    <div class="card h-100">
                        <img height="200" src="images/menu/<?php echo $menu['Imagen'] ?>" alt="Plato" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $menu['nombre'] ?></h5>
                            <p class="card-text small"><strong>Ingredientes: </strong><?php echo $menu['ingredientes'] ?></p>
                            <p class="card-text"> <strong>Precio: </strong><?php echo $menu['precio'] ?> </p>
                        </div>
                    </div>

                </div>

            <?php   } ?>
        </div>
    </section>
    <!-- Sección de Testimonios -->
    <section id="testimonios" class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">Testimonios</h2>
            <div class="row">
                <?php
                foreach ($lista_testimonios as $testimonio) {
                ?>
                    <div class="col-md-6 d-flex">
                        <div class="card mb-4 w-100">

                            <div class="card-body">
                                <p class="card-text"><?php echo $testimonio['opinion'] ?></p>
                            </div>
                            <div class="card-footer text-muted">
                                <?php echo $testimonio['nombre'] ?>
                            </div>

                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!--Sección de Reservas-->
    <section>
        <br>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h2>RESERVAS</h2>
                </div>
                <div class="card-body">


                    <form action="enviar_reserva.php" method="post">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Coloque su nombre" />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha de inicio:</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_fin" class="form-label">Fecha de fin:</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                        </div>
                        <button type="submit" class="btn btn-success">Ingresar reserva</button>
                    </form>
                </div>
                <div class="card-footer text-muted"></div>
            </div>
        </div>
    </section>


    <!-- Sección Contacto -->
    <section id="contacto" class="container mt-4">
        <h2>Contacto opiniones y testimonios!</h2>
        <p>Estamos aquí para servirle.</p>
        <form action="?" method="post">
            <label for="name" id="name">Nombre:</label><br>
            <input type="text" class="form-control" name="nombre" placeholder="Escribe tu nombre..." required><br>
            <label for="email" id="email">Correo electrónico:</label><br>
            <input type="email" name="correo" class="form-control" placeholder="Escribe tu correo electrónico..." required><br>
            <label for="message" id="message">Mensaje:</label><br>
            <textarea class="form-control" name="mensaje" rows="6" cols="50"></textarea><br>
            <input type="submit" class="btn btn-primary" value="Enviar mensaje">
        </form>

    </section>
    <br />
    <!--Sección Horarios-->
    <div class="text-center bg-light p-4" id="horario">
        <h3 class="mb-4">Horario de atención</h3>
        <div>
            <p><strong>Lunes a viernes</strong></p>
            <p><strong>11:00 a.m. - 10:00 p.m.</strong></p>
        </div>
        <div>
            <p><strong>Sábados</strong></p>
            <p><strong> 8:00 a.m. - 5:00 p.m.</strong></p>
        </div>
        <div>
            <p><strong>Domingos</strong></p>
            <p><strong> 7:00 a.m. - 2:00 p.m.</strong></p>
        </div>
    </div>

    <header>
        <!-- place navbar here -->
    </header>
    <main></main>
    <footer class="bg-dark text-light text-center py-3">
        <!-- place footer here -->
        <p>&copy; 2024 Casa de Campo, todos los derechos reservados.</p>
    </footer>
    <!-- Bootstrap JavaScript Libraries -->

    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>