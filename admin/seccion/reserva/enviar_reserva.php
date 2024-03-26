<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    // Correo electrónico de destino
    $destinatario = "correo@destino.com";

    // Asunto del correo
    $asunto = "Nueva reserva de casa de campo";

    // Cuerpo del correo
    $mensaje = "Nombre: $nombre\n";
    $mensaje .= "Email: $email\n";
    $mensaje .= "Teléfono: $telefono\n";
    $mensaje .= "Fecha de inicio: $fecha_inicio\n";
    $mensaje .= "Fecha de fin: $fecha_fin\n";

    // Enviar correo electrónico
    mail($destinatario, $asunto, $mensaje);

    // Redirigir a una página de confirmación o mostrar un mensaje de éxito
    header("Location: confirmacion_reserva.html");
} else {
    // Si no se envió por método POST, redirigir a una página de error o mostrar un mensaje de error
    header("Location: error.html");
}
