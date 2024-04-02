<?php
include("../../bd.php");

if (isset($_GET['txtID'])) {

    $txtID = ($_GET['txtID']) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM tbl_testimonios WHERE ID= :id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $opinion = $registro["opinion"];
    $nombre = $registro["nombre"];
}

if ($_POST) {
    $opinion = (isset($_POST['opinion'])) ? $_POST['opinion'] : "";
    $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : "";
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";

    if (empty($nombre) || empty($opinion)) {
        echo "Por favor, completa todos los campos del formulario.";
    } else {
        $sentencia = $conexion->prepare(
            'UPDATE tbl_testimonios SET
            opinion=:opinion, nombre=:nombre  
            WHERE ID=:id'
        );

        // Se asignan los valores a las variables en la sentencia preparada

        $sentencia->bindParam(':opinion', $opinion);
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':id', $txtID);

        if ($sentencia->execute()) {
            header("location:index.php");
            exit(); // Asegura que el script se detenga después de la redirección
        } else {
            echo "Error al insertar el testimonio.";
        }
    }
} else {
    echo "No se recibió ninguna información por parte del usuario.";
}

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">TESTIMONIOS</div>
    <div class="card-body">

        <form action="" method="post">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" value="<?php echo $txtID; ?>" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="Coloque el nombre del empleado" />

            </div>
            <div class="mb-3">
                <label for="opinion" class="form-label">Opinión</label>
                <input type="text" value="<?php echo $opinion; ?>" class="form-control" name="opinion" id="opinion" aria-describedby="helpId" placeholder="" />
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" value="<?php echo $nombre; ?>" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="" />
            </div>
            <button type="submit" class="btn btn-success">Editar opinión</button>
            <a href="index.php" role="button" class="btn btn-primary">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php
include("../../templates/footer.php");
?>