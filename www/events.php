<?php
  $require_auth = true;
  include 'php_header.php';
  include 'header.php';
  include 'table_util.php';

  function loadTable() {
    global $conn;

    if ($rows = $conn->query("select ev.id, ev.nombre, es.nombre as nombre_escuela, ev.empresa, ev.lugar, ev.inicio from eventos as ev join escuelas as es on ev.escuela_id = es.id")) {
      $header = ['ID', 'Nombre', 'Empresa', 'Lugar', 'Fecha'];
      $links = [];
      foreach ($rows as $row) {
        $id = $row['id'];
        array_push($links, "event.php?id=$id");
      }
      drawTable($header, $rows, $links);
    } else {
      echo 'Error loading table';
    }    
  }

?>

<body>
  <?php include 'menu.php'; ?>
  <div class="container">
    <br>
    <a href="/create_event.php">Crear Evento</a>
    <?php
      loadTable();
    ?>
  </div>
</body>

<?php
  include 'footer.php';
?>
