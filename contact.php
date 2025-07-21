<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Recolectar los datos del formulario
  $name    = strip_tags(trim($_POST["name"]));
  $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $subject = strip_tags(trim($_POST["subject"]));
  $message = trim($_POST["message"]);

  // Validar que no vengan vacíos
  if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    http_response_code(400);
    echo "Por favor completa todos los campos.";
    exit;
  }

  // Dirección a la que se enviará el mensaje
  $to = "abadlisbeth91@gmail.com";

  // Asunto del correo
  $email_subject = "Mensaje desde tu sitio web: $subject";

  // Cuerpo del correo
  $email_body = "Has recibido un nuevo mensaje desde el formulario de tu sitio web.\n\n";
  $email_body .= "Nombre: $name\n";
  $email_body .= "Correo: $email\n";
  $email_body .= "Motivo: $subject\n";
  $email_body .= "Mensaje:\n$message\n";

  // Encabezados
  $headers = "From: $name <$email>";

  // Enviar el correo
  if (mail($to, $email_subject, $email_body, $headers)) {
    http_response_code(200);
    echo "Mensaje enviado con éxito.";
  } else {
    http_response_code(500);
    echo "Hubo un problema al enviar el mensaje.";
  }
} else {
  http_response_code(403);
  echo "No permitido.";
}
?>
