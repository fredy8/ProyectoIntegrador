<?php
  $require_auth = true;
  $require_admin = true;

  include 'php_header.php';

  $email = $_POST["email"];
  $approve = $_POST["approve"];
  $email = $conn->real_escape_string($email);

  if ($approve === "1") {
    if ($result = $conn->query("update users set approved=1 where email='$email'")) {
      // TODO send email
    } else {
      die("Ocurrió un error.");
    }
  } else {
    if ($result = $conn->query("delete from users where email='$email'")) {
      // TODO send email
    } else {
      die("Ocurrió un error.");
    }
  }

  header("Location: /pending_registrations.php");
?>
