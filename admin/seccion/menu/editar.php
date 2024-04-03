<?php
include("../../bd.php");

if ($_POST) {

    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $nombre = (isset($_POST["nombre"])) ? $_POST["nombre"] : "";
    $ingredientes = (isset($_POST["ingredientes"])) ? $_POST["ingredientes"] : "";
    $precio = (isset($_POST["precio"])) ? $_POST["precio"] : "";
    //$imagen = (isset($_POST["Imagen"])) ? $_POST["imagen"] : "";

    $sentencia = $conexion->prepare('UPDATE tbl_menu SET
     nombre=:nombre,
     ingredientes=:ingredientes,
     precio=:precio
     WHERE ID=:id');

    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":ingredientes", $ingredientes);
    $sentencia->bindParam(":precio", $precio);
    $sentencia->bindParam(":id", $txtID);

    $sentencia->execute();
    echo "<script>alert('Se ha actualizado el plato correctamente')</script>";

    //proceso actualizar foto
    $Imagen = (isset($_FILES['Imagen']["name"])) ? $_FILES['Imagen']["name"] : "";
    $tmp_foto = $_FILES['Imagen']['tmp_name'];

    if ($Imagen != "") {
        $fecha_foto = new DateTime();
        $nombre_foto = $fecha_foto->getTimestamp() . "_" . $Imagen;

        // Subir el archivo a la carpeta del servidor
        move_uploaded_file($tmp_foto, "../../../images/menu/" . $nombre_foto);

        $sentencia = $conexion->prepare("SELECT * FROM tbl_menu WHERE ID = :id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();

        $registro_foto = $sentencia->fetch(PDO::FETCH_LAZY);

        //borra la foto del colaborador en el servidor
        if (isset($registro_foto['Imagen'])) {
            if (file_exists("../../../images/menu/" . $registro_foto['Imagen'])) {
                unlink("../../../images/menu/" . $registro_foto['Imagen']);
            }
        }

        $sentenciaUpdate = $conexion->prepare(
            'UPDATE tbl_menu SET
            Imagen=:Imagen
            WHERE ID=:id'
        );

        $sentenciaUpdate->bindParam(":Imagen", $nombre_foto);
        $sentenciaUpdate->bindParam(":id", $txtID);
        $sentenciaUpdate->execute();
    }
    header("location:index.php");
}


if (isset($_GET['txtID'])) {

    $txtID = ($_GET['txtID']) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM tbl_menu WHERE ID= :id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    //Recuperación de datos (asignar al formulario)
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $nombre = $registro["nombre"];
    $ingredientes = $registro["ingredientes"];
    $precio = $registro["precio"];
    $Imagen =  $registro["Imagen"];
}



include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">CORRECCION DE MENÚS</div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" value="<?php echo $txtID; ?>" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" />

            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" value="<?php echo $nombre; ?>" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Ingrese el nombre del plato" />

            </div>
            <div class="mb-3">
                <label for="Imagen" class="form-label">imagen</label>
                <img src="../../../images/menu/<?php echo $Imagen; ?>" alt="" width="50">
                <input type="file" value="<?php echo $Imagen; ?>" class="form-control" name="Imagen" id="Imagen" placeholder="" aria-describedby="fileHelpId" />

            </div>


            <div class="mb-3">
                <label for="ingredientes" class="form-label">Ingredientes</label>
                <input type="text" value="<?php echo $ingredientes; ?>" class="form-control" name="ingredientes" id="ingredientes" aria-describedby="helpId" placeholder="" />

            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="text" value="<?php echo $precio; ?>" class="form-control" name="precio" id="precio" aria-describedby="helpId" placeholder="" />

            </div>
            <button type="submit" class="btn btn-success">Modificar Plato</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php
include("../../templates/footer.php");
?>