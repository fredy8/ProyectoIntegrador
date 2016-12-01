<?php
  $require_auth = true;
  include 'php_header.php';
  include 'header.php';

  $errorMsg = "No se pudo eliminar el archivo.";

  if(isset($_GET['id'])) {
    $id    = $_GET['id'];
    $query = "DELETE FROM archivos WHERE id = '$id'";

    if (!$result = $conn->query($query)) {
      die($errorMsg);
    }
  } else {
    die($errorMsg);
  }

?>

<body>
  <?php 
    include 'menu.php';
    echo "Se borró el archivo exitosamente. <a href=\"javascript:history.go(-1)\">Regresar</a>";
  ?>
</body>

<?php
  include 'footer.php';
?>
