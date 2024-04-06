<?php
include("../../bd.php");

if (isset($_GET["txtID"])) {

    $txtID = (isset($_GET["txtID"])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE ID = :id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    // borra los datos  de la base de datos
    $sentencia = $conexion->prepare("DELETE FROM tbl_usuarios WHERE ID = :id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    header("Location:index.php");
}

$sentencia = $conexion->prepare('SELECT * FROM tbl_usuarios');
$sentencia->execute();
$listado_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);





include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header"><a href="crear.php" role="button" class="btn btn-primary">Agregar usuario</a>
        <h1>Listado de Usuarios</h1>
    </div>

    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Password</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listado_usuarios as $usuario) { ?>
                        <tr class="">
                            <td scope="row"><?php echo $usuario['ID'] ?></td>
                            <td><?php echo $usuario['usuario'] ?></td>
                            <td><?php echo $usuario['password'] ?></td>
                            <td><?php echo $usuario['correo'] ?></td>
                            <td>
                                <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $usuario["ID"]; ?>" role="button">Borrar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php
include("../../templates/footer.php");
?>