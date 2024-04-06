<?php
include("../../bd.php");

$sentencia = $conexion->prepare('SELECT * FROM tbl_comentarios');
$sentencia->execute();
$lista_comentarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["txtID"])) {
    //Vincula el valor del id pasado mediante el método GET a la declaración preparada.
    //Elimina la fila con el id correspondiente de la tabla tbl_comentarios.
    //Redirige al usuario a la página de índice.
    $txtID = (isset($_GET["txtID"])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("DELETE FROM tbl_comentarios WHERE ID = :id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    header("Location:index.php");
}



include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">Comentarios</div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table ">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Mensaje</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_comentarios as $registro) { ?>
                        <tr class="">
                            <td scope="row"><?php echo  $registro['ID'] ?></td>
                            <td><?php echo  $registro['nombre'] ?></td>
                            <td><?php echo  $registro['correo'] ?></td>
                            <td><?php echo  $registro['mensaje'] ?></td>
                            <td>
                                <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registro["ID"]; ?>" role="button">Borrar</a>
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