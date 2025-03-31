<?php
if (!$_POST) exit;

// Función para validar el correo electrónico
function isEmail($email) {
    return preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $email);
}

if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

// Recuperar los datos del formulario
$name = $_POST['name'];
$email = $_POST['email'];
$projectType = $_POST['select'];
$budget = $_POST['input_2'];
$message = $_POST['message'];

// Validar los campos
if (trim($name) == '') {
    echo '<div class="alert alert-error">Debes escribir tu nombre.</div>';
    exit();
} else if (trim($email) == '') {
    echo '<div class="alert alert-error">Debes escribir tu correo.</div>';
    exit();
} else if (!isEmail($email)) {
    echo '<div class="alert alert-error">Debes introducir un correo válido.</div>';
    exit();
} else if (trim($message) == '') {
    echo '<div class="alert alert-error">Debes escribir un mensaje.</div>';
    exit();
}

// Configuración del correo
$to = "pixelwavestudioo@gmail.com"; // Cambia esto por tu correo
$subject = "Nuevo mensaje de contacto desde el sitio web";
$body = "Nombre: $name" . PHP_EOL;
$body .= "Correo: $email" . PHP_EOL;
$body .= "Tipo de Proyecto: $projectType" . PHP_EOL;
$body .= "Presupuesto Estimado: $budget" . PHP_EOL;
$body .= "Mensaje:" . PHP_EOL . $message;

// Cabeceras del correo
$headers = "From: $email" . PHP_EOL;
$headers .= "Reply-To: $email" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-Type: text/plain; charset=utf-8" . PHP_EOL;

// Enviar el correo
if (mail($to, $subject, $body, $headers)) {
    echo '<div class="alert alert-success">Mensaje enviado correctamente.</div>';
} else {
    echo '<div class="alert alert-error">Error al enviar el mensaje.</div>';
}
?>