<?php
include("../../bd.php");

if ($_POST) {
    print_r($_POST);

    $opinion = (isset($_POST['opinion'])) ? $_POST['opinion'] : '';
    $nombre = (isset($_SESSION['nombre'])) ? $_POST['nombre'] : '';

    $sentencia = $conexion->prepare('INSERT INTO 
    tbl_testimonios (NULL,opinion, nombre) VALUES    
( :opinion ,:nombre)');

    $nombre = $_POST['nombre'];
    $opinion = $_POST['opinion'];

    //Se pasan los valores a la sentencia preparada para evitar inyecciones SQL
    $sentencia->bindParam(":opinion", $opinion);
    $sentencia->bindParam(":nombre", $nombre);

    $resultado = $sentencia->execute(); //Ejecución de la consulta

    /*Si todo ha ido bien (ninguna fila afectada), se devuelve un mensaje y redirecciona a la página principal*/
    if ($resultado == true) {
        echo 'Testimonio enviado correctamente';
        header('Location: ../index.php');
    } else { /*En caso de error, muestra un mensaje de error*/
        die('Error al enviar el testimonio');
    }
} else {
    die("No hay datos en este formulario");
}

include("../../templates/header.php");
?>

<br>
<div class="card">
    <div class="card-header">TESTIMONIOS</div>
    <div class="card-body">

        <form action="" method="post">

            <div class="mb-3">
                <label for="opinion" class="form-label">Opinión</label>
                <input type="text" class="form-control" name="opinion" id="opinion" aria-describedby="helpId" placeholder="" />
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="" />
            </div>
            <button type="submit" class="btn btn-success">Agregar opinión</button>
            <a href="index.php" role="button" class="btn btn-primary">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php
include("../../templates/footer.php");
?>