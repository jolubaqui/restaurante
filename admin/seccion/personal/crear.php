<?php
include("../../bd.php");

if ($_POST) {
    $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
    $linkfacebook = (isset($_POST['linkfacebook'])) ? $_POST['linkfacebook'] : "";
    $linkinstagram = (isset($_POST['linkinstagram'])) ? $_POST['linkinstagram'] : "";
    $linklinkedin = (isset($_POST['linklinkedin'])) ? $_POST['linklinkedin'] : "";
    $foto = (isset($_FILES['foto']["name"])) ? $_FILES['foto']["name"] : "";
    $fecha_foto = new DateTime();
    $nombre_foto = $fecha_foto->getTimestamp() . "_" . $foto;
    $tmp_foto = $_FILES['foto']['tmp_name'];

    if ($tmp_foto != "") {
        move_uploaded_file($tmp_foto, "../../../images/colaboradores/" . $nombre_foto);  // Subir el archivo a la carpeta del servidor
    }

    if (empty($nombre) || empty($foto) || empty($descripcion) || empty($linkfacebook) || empty($linkinstagram) || empty($linklinkedin)) {
        echo "Por favor, completa todos los campos del formulario.";
    } else {
        $sentencia = $conexion->prepare('INSERT INTO tbl_personal 
        (ID, nombre, descripcion, linkfacebook, linkinstagram, linklinkedin, foto) 
        VALUES(NULL, :nombre ,:descripcion, :linkfacebook, :linkinstagram, :linklinkedin, :foto)');


        // Se asignan los valores a las variables en la sentencia preparada
        $sentencia->bindParam(':foto', $nombre_foto);
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':descripcion', $descripcion);
        $sentencia->bindParam(':linkfacebook', $linkfacebook);
        $sentencia->bindParam(':linkinstagram', $linkinstagram);
        $sentencia->bindParam(':linklinkedin', $linklinkedin);

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

include("../../templates/header.php");
?>


<div class="card">
    <div class="card-header">Colaboradores</div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">


            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Coloque el nombre del empleado" />

            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto:</label>
                <input type="file" class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Coloque una foto del empleado" />

            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Ingrese la descripción" />

            </div>

            <div class="mb-3">
                <label for="linkfacebook" class="form-label">Facebook:</label>
                <input type="text" class="form-control" name="linkfacebook" id="linkfacebook" aria-describedby="helpId" placeholder="Ingrese el enlace" />

            </div>

            <div class="mb-3">
                <label for="linkinstagram" class="form-label">Instagram:</label>
                <input type="text" class="form-control" name="linkinstagram" id="linkinstagram" aria-describedby="helpId" placeholder="Ingrese el enlace" />

            </div>
            <div class="mb-3">
                <label for="linklinkedin" class="form-label">Linkedin:</label>
                <input type="text" class="form-control" name="linklinkedin" id="linklinkedin" aria-describedby="helpId" placeholder="Ingrese el enlace" />

            </div>

            <button type="submit" class="btn btn-success">Ingresar persona</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php
include("../../templates/footer.php")
?>