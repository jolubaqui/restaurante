<?php
include('../../templates/header.php');
?>
<br>

<div class="card">
    <div class="card-header">RESERVAS</div>
    <div class="card-body">


        <form action="enviar_reserva.php" method="post">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Coloque su nombre" />
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de inicio:</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
            </div>
            <div class="mb-3">
                <label for="fecha_fin" class="form-label">Fecha de fin:</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
            </div>
            <button type="submit" class="btn btn-success">Ingresar reserva</button>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php
include('../../templates/footer.php');
?>