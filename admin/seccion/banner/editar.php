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