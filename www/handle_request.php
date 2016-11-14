<?php
  $require_auth = true;
  $require_admin = true;

  include 'php_header.php';

  $email = $_POST["email"];
  $approve = $_POST["approve"];
  $email = $conn->real_escape_string($email);

  if ($approve === "1") {
    if ($result = $conn->query("update users set approved=1 where email='$email'")) {
      mail($email,
        "Registro aprobado",
        "Tu solicitud registro de Circulo Virtuoso ha sido aprobada.",
        "From: noreply@circulovirtuoso.com");
    } else {
      die("Ocurrió un error.");
    }
  } else {
    if ($result = $conn->query("delete from users where email='$email'")) {
      mail($email,
        "Registro denegado",
        "Tu solicitud registro de Circulo Virtuoso ha sido denegada.",
        "From: noreply@circulovirtuoso.com");
    } else {
      die("Ocurrió un error.");
    }
  }

  header("Location: /pending_registrations.php");
?>
