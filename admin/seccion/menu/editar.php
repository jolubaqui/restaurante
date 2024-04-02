<?php
include("../../bd.php");

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
                <label for="imagen" class="form-label">imagen</label>
                <img src="../../../images/menu/<?php echo $Imagen; ?>" alt="" width="50">
                <input type="file" value="<?php echo $Imagen; ?>" class="form-control" name="imagen" id="imagen" placeholder="" aria-describedby="fileHelpId" />

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