<?php
include("../../bd.php");

if (isset($_GET["txtID"])) {
    //Vincula el valor del id pasado mediante el método GET a la declaración preparada.
    //Elimina la fila con el id correspondiente de la tabla tbl_banners.
    //Redirige al usuario a la página de índice.
    $txtID = (isset($_GET["txtID"])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("DELETE FROM tbl_banners WHERE ID = :id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    header("Location:index.php");
}
//Prepara y ejecuta una declaración SELECT para recuperar todas las filas de la tabla tbl_banners.
//Asigna el resultado a la variable $lista_banner.

$sentencia = $conexion->prepare("SELECT * FROM tbl_banners");
$sentencia->execute();
$lista_banner = $sentencia->fetchAll(PDO::FETCH_ASSOC);


include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Crear registro</a>
        <h1>Banners</h1>
    </div>
    <div class="card-body">

        <div class="table-responsive-sm">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tïtulo</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Link</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Recorre el array $lista_banner y muestra cada fila como una fila de tabla.
                    foreach ($lista_banner as $key => $value) { ?>
                        <tr class="">
                            <td scope="row"><?php echo ($value['ID']); ?></td>
                            <td><?php echo ($value['titulo']); ?></td>
                            <td><?php echo ($value['descripcion']); ?></td>
                            <td><?php echo ($value['link']); ?></td>
                            <td><a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $value["ID"]; ?>" role="button">Editar</a>
                                <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $value["ID"]; ?>" role="button">Borrar</a>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>


    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php include("../../templates/footer.php") ?>