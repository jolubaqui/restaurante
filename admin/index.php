<?php include("templates/header.php"); ?>

<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Bienvenid@ al administrador <?php echo $_SESSION['usuario']; ?></h1>
        <p class="col-md-8 fs-4">
            Este sitio es para administrar su sitio web.
        </p>
        <button class="btn btn-primary btn-lg" type="button">
            Iniciar ahora
        </button>
    </div>
</div>


<?php include("templates/footer.php"); ?>