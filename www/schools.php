<?php
  $require_auth = true;
  include 'php_header.php';
  include 'header.php';
  include 'table_util.php';

  function loadTable() {
    global $conn;

    if ($rows = $conn->query("select id, nombre, director, nivel, turno, sostenimiento, alumnos from escuelas")) {
      $header = ['ID', 'Nombre', 'Director', 'Nivel', 'Turno', 'Sostenimiento', 'Alumnos'];
      $links = [];
      foreach ($rows as $row) {
        $id = $row['id'];
        array_push($links, "school.php?id=$id");
      }
      drawTable($header, $rows, $links);
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
