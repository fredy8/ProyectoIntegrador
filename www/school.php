<?php
  $require_auth = true;
  include 'php_header.php';
  include 'header.php';

  $id = $_GET['id'];
  if (!$id) {
    header("Location: /schools.php");
  }
?>

<body>
  <?php include 'menu.php'; ?>
  <br>
</body>

<?php
  include 'footer.php';
?>
