<?php
include("../../bd.php");

if (isset($_GET["txtID"])) {

    $txtID = (isset($_GET["txtID"])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("DELETE FROM tbl_menu WHERE ID = :id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    header("Location:index.php");
}

$sentencia = $conexion->prepare("SELECT * FROM tbl_menu");
$sentencia->execute();
$lista_menus = $sentencia->fetchAll(PDO::FETCH_ASSOC);


include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Crear plato</a>
        <h1>Menús</h1>
    </div>
    <div class="card-body">

        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Ingredientes</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_menus as $menu) { ?>
                        <tr class="">
                            <td scope="row"><?php echo  $menu['ID'] ?></td>
                            <td>
                                <img src="../../../images/menu/<?php echo ($menu['Imagen']); ?>" width="80">
                            </td>
                            <td><?php echo  $menu['nombre'] ?></td>
                            <td><?php echo  $menu['ingredientes'] ?></td>
                            <td><?php echo  $menu['precio'] ?></td>
                            <td><a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $menu["ID"]; ?>" role="button">Editar</a>
                                <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $menu["ID"]; ?>" role="button">Borrar</a>
                            </td>
                        </tr>
                    <?php   } ?>

                </tbody>
            </table>
        </div>


    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php
include("../../templates/footer.php");
?>