<?php
include("../../bd.php");

if ($_POST) {
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
    $linkfacebook = (isset($_POST['linkfacebook'])) ? $_POST['linkfacebook'] : "";
    $linkinstagram = (isset($_POST['linkinstagram'])) ? $_POST['linkinstagram'] : "";
    $linklinkedin = (isset($_POST['linklinkedin'])) ? $_POST['linklinkedin'] : "";

    //Actualizacion de foto
    $foto = (isset($_FILES['foto']["name"])) ? $_FILES['foto']["name"] : "";
    $tmp_foto = $_FILES['foto']['tmp_name'];
    if ($foto = "") {
        $fecha_foto = new DateTime();
        $nombre_foto = $fecha_foto->getTimestamp() . "_" . $foto;

        move_uploaded_file($tmp_foto, "../../../images/colaboradores/.$nombre_foto");

        $sentencia = $conexion->prepare("SELECT * FROM tbl_personal WHERE ID = :id ");
        $sentencia->bindParam(':id', $txtID);
        $sentencia->execute();

        $registro = $sentencia->fetch(PDO::FETCH_LAZY);

        if (isset($registro_foto['foto'])) {
            if (file_exists("../../../images/colaboradores/.$registro_foto")) {
                unlink("../../../images/colaboradores/.$nombre_foto");
            }
        }
        $sentencia = $conexion->prepare(
            'UPDATE tbl_personal SET
            foto=:foto
            WHERE ID=:id'
        );
        $sentencia->bindParam(':foto', $nombre_foto);
        $sentencia->bindParam(':id', $txtID);
        $sentencia->execute();
    }

    $sentencia = $conexion->prepare(
        'UPDATE tbl_personal SET
        nombre=:nombre, 
        descripcion=:descripcion, 
        linkfacebook=:linkfacebook,  
        linkinstagram=:linkinstagram, 
        linklinkedin=:linklinkedin
        WHERE ID=:id'
    );


    // Se asignan los valores a las variables en la sentencia preparada

    $sentencia->bindParam(':id', $txtID);
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':descripcion', $descripcion);
    $sentencia->bindParam(':linkfacebook', $linkfacebook);
    $sentencia->bindParam(':linkinstagram', $linkinstagram);
    $sentencia->bindParam(':linklinkedin', $linklinkedin);
    $sentencia->execute();

    if ($sentencia->execute()) {
        header("location:index.php");
        exit(); // Asegura que el script se detenga después de la redirección
    } else {
        echo "Error al insertar el banner.";
    }
} else {
    echo "No se recibió ninguna información por parte del usuario.";
}


if (isset($_GET['txtID'])) {

    $txtID = ($_GET['txtID']) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM tbl_personal WHERE ID= :id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    //recuperación de datos
    $nombre = $registro['nombre'];
    $descripcion = $registro['descripcion'];
    $linkfacebook = $registro['linkfacebook'];
    $linkinstagram = $registro['linkinstagram'];
    $linklinkedin = $registro['linklinkedin'];
    $foto = $registro['foto'];
    // $foto = (isset($_FILES['foto']["name"])) ? $_FILES['foto']["name"] : "";
    // $fecha_foto = new DateTime();
    // $nombre_foto = $fecha_foto->getTimestamp() . "_" . $foto;
    // $tmp_foto = $_FILES['foto']['tmp_name'];
}

include("../../templates/header.php");
?>
<br>
<div class="card">
    <div class="card-header">Editar Colaboradores</div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" value="<?php echo $txtID; ?>" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="Coloque el nombre del empleado" />

            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" value="<?php echo $nombre; ?>" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Coloque el nombre del empleado" />

            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto:</label><br>
                <img src="../../../images/colaboradores/<?php echo $foto; ?>" width="50">
                <input type="file" class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Coloque una foto del empleado" />

            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" value="<?php echo $descripcion; ?>" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Ingrese la descripción" />

            </div>

            <div class="mb-3">
                <label for="linkfacebook" class="form-label">Facebook:</label>
                <input type="text" value="<?php echo $linkfacebook; ?>" class="form-control" name="linkfacebook" id="linkfacebook" aria-describedby="helpId" placeholder="Ingrese el enlace" />

            </div>

            <div class="mb-3">
                <label for="linkinstagram" class="form-label">Instagram:</label>
                <input type="text" value="<?php echo $linkinstagram; ?>" class="form-control" name="linkinstagram" id="linkinstagram" aria-describedby="helpId" placeholder="Ingrese el enlace" />

            </div>
            <div class="mb-3">
                <label for="linklinkedin" class="form-label">Linkedin:</label>
                <input type="text" value="<?php echo $linklinkedin; ?>" class="form-control" name="linklinkedin" id="linklinkedin" aria-describedby="helpId" placeholder="Ingrese el enlace" />

            </div>

            <button type="submit" class="btn btn-success">Editar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include_once('../../templates/footer.php');
?>