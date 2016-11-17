<?php
  $require_auth = true;
  include 'php_header.php';
  include 'header.php';

  $error = false;
  $nombre = NULL;

  $id = $_GET['id'];
  if (!$id) {
    header("Location: /schools.php");
  }
  if ($result = $conn->query("select * from escuelas where id='$id'")) {
    if ($row = $result->fetch_assoc()) {
      $nombre = $row['nombre'];
    } else {
      $error = true;
    }
  } else {
    $error = true;
  }
?>

<body>
  <?php include 'menu.php'; ?>
  <br>
  <?php
    if ($error) {
      echo 'No se encontró la escuela.';
    } else {
      echo $nombre;
    }
  ?>
</body>

<?php
  include 'footer.php';
?>
