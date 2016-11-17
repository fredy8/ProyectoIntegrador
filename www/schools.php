<?php
  $require_auth = true;
  include 'php_header.php';
  include 'header.php';
  include 'table_util.php';

  function loadTable() {
    global $conn;
    
    if ($rows = $conn->query("select nombre, director, nivel, turno, sostenimiento, alumnos from escuelas")) {
      $header = ['Nombre', 'Director', 'Nivel', 'Turno', 'Sostenimiento', 'Alumnos'];
      drawTable($header, $rows);
    } else {
      echo 'Error loading table';
    }    
  }

?>

<body>
  <?php include 'menu.php'; ?>
  <br>
  <a href="/create_school.php">Crear Escuela</a>
  <?php
    loadTable();
  ?>
</body>

<?php
  include 'footer.php';
?>
