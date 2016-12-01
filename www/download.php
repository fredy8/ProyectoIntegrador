<?php
  include 'php_header.php';

  $errorMsg = "No se pudo descargar el archivo.";

  if(isset($_GET['id'])) {
    $id    = $_GET['id'];
    $query = "SELECT name, type, size, content " .
             "FROM archivos WHERE id = '$id'";

    if ($result = $conn->query($query)) {
      if (!$file = $result->fetch_assoc()) {
        die($errorMsg);
      }
    } else {
      die($errorMsg);
    }

    $name = $file['name'];
    $type = $file['type'];
    $size = $file['size'];
    $content = $file['content'];

    header("Content-length: $size");
    header("Content-type: $type");
    header("Content-Disposition: attachment; filename=$name");
    echo $content;
  } else {
    die($errorMsg);
  }

?>