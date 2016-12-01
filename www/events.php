<?php
  $require_auth = true;
  include 'php_header.php';
  include 'header.php';
  include 'table_util.php';

  $school = $_GET['school'];

  function loadTable() {
    global $conn;
    global $school;

    if (intval($school)) {
      $school = intval($school);
      $query = "select ev.id, ev.nombre, es.nombre as nombre_escuela, ev.empresa, ev.lugar, ev.inicio from eventos as ev join escuelas as es on ev.escuela_id = es.id where es.id=$school";
    } else {
      $query = "select ev.id, ev.nombre, es.nombre as nombre_escuela, ev.empresa, ev.lugar, ev.inicio from eventos as ev join escuelas as es on ev.escuela_id = es.id";
    }

    if ($rows = $conn->query($query)) {
      $header = ['ID', 'Nombre', 'Escuela', 'Empresa', 'Lugar', 'Fecha'];
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
    <a href="/create_event.php">
      <button type="button" class="btn btn-success">Crear Evento</button>
    </a>
    <?php
      loadTable();
    ?>
  </div>
</body>

<?php
  include 'footer.php';
?>
