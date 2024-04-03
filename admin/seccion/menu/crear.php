<?php
include("../../bd.php");

if ($_POST) {


    $nombre = (isset($_POST["nombre"])) ? $_POST["nombre"] : "";
    $ingredientes = (isset($_POST["ingredientes"])) ? $_POST["ingredientes"] : "";
    $precio = (isset($_POST["precio"])) ? $_POST["precio"] : "";
    $Imagen = (isset($_FILES["Imagen"]['name'])) ? $_FILES["Imagen"]['name'] : "";
    $fecha_foto = new DateTime();
    $nombre_foto = $fecha_foto->getTimestamp() . "_" . $Imagen;
    $tmp_foto = $_FILES['Imagen']['tmp_name'];

    if ($tmp_foto != "") {
        move_uploaded_file($tmp_foto, "../../../images/menu/" . $nombre_foto);  // Subir el archivo a la carpeta del servidor
    }


    $sentencia = $conexion->prepare("INSERT INTO tbl_menu (ID,Nombre,ingredientes,precio,Imagen)
    VALUES(null,:nombre,:ingredientes,:precio,:Imagen)");


    $sentencia->bindParam(':Imagen', $nombre_foto);
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindparam(":ingredientes", $ingredientes);
    $sentencia->bindParam(":precio", $precio);

    $sentencia->execute();





    header('location:index.php');
}



include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">MENÚS DE COMIDA</div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Ingrese el nombre del plato" />

            </div>
            <div class="mb-3">
                <label for="Imagen" class="form-label">imagen</label>
                <input type="file" class="form-control" name="Imagen" id="Imagen" placeholder="" aria-describedby="fileHelpId" />

            </div>

            <div class="mb-3">
                <label for="ingredientes" class="form-label">Ingredientes</label>
                <input type="text" class="form-control" name="ingredientes" id="ingredientes" aria-describedby="helpId" placeholder="" />

            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="text" class="form-control" name="precio" id="precio" aria-describedby="helpId" placeholder="" />

            </div>
            <button type="submit" class="btn btn-success">Crear Plato</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php
include("../../templates/footer.php");
?>