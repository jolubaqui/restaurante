<?php

include("../../bd.php");

if (isset($_GET['txtID'])) {

    $txtID = ($_GET['txtID']) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM tbl_banners WHERE ID= :id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $titulo = $registro["titulo"];
    $descripcion = $registro["descripcion"];
    $link = $registro["link"];
}

if ($_POST) {
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
    $link = (isset($_POST['link'])) ? $_POST['link'] : "";
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";

    if (empty($titulo) || empty($descripcion) || empty($link)) {
        echo "Por favor, completa todos los campos del formulario.";
    } else {
        $sentencia = $conexion->prepare(
            'UPDATE tbl_banners SET
            titulo=:titulo, descripcion=:descripcion, link=:link  
            WHERE ID=:id'
        );

        // Se asignan los valores a las variables en la sentencia preparada

        $sentencia->bindParam(':titulo', $titulo);
        $sentencia->bindParam(':descripcion', $descripcion);
        $sentencia->bindParam(':link', $link);
        $sentencia->bindParam(':id', $txtID);

        if ($sentencia->execute()) {
            header("location:index.php");
            exit(); // Asegura que el script se detenga después de la redirección
        } else {
            echo "Error al insertar el banner.";
        }
    }
} else {
    echo "No se recibió ninguna información por parte del usuario.";
}

include("../../templates/header.php")
?>
<br>
<div class="card">
    <div class="card-header">Banners</div>
    <div class="card-body">

        <form action="" method="post">

            <div class="mb-3">
                <label for="" class="form-label">ID:</label>
                <input type="text" class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID del banner" />

            </div>
            <div class="mb-3">
                <label for="" class="form-label">Título:</label>
                <input type="text" class="form-control" value="<?php echo $titulo; ?>" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Coloque el título del banner" />

            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" value="<?php echo $descripcion; ?>" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Ingrese la descripción" />

            </div>

            <div class="mb-3">
                <label for="link" class="form-label">Link:</label>
                <input type="text" class="form-control" value="<?php echo $link; ?>" name="link" id="link" aria-describedby="helpId" placeholder="Ingrese el enlace" />

            </div>

            <button type="submit" class="btn btn-success">Editar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php
include("../../templates/footer.php")
?>