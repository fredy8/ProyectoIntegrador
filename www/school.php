<?php
  $require_auth = true;
  include 'php_header.php';
  include 'header.php';

  $error = false;
  $nombre = NULL;

  $id = $_GET['id'];
  $showFilesId = $id;
  $showFilesType = 'escuela';
  if (!$id) {
    header("Location: /schools.php");
  }
  if ($result = $conn->query("select * from escuelas where id='$id'")) {
    if (!$school = $result->fetch_assoc()) {
      $error = true;
    }
  } else {
    $error = true;
  }
?>

<body>
  <?php 
    include 'menu.php'; 
    ?>
  <div class="container">
    <br>
    <?php
      if ($error) {
        echo 'No se encontró la escuela.';
      } else {
        echo '<a href="/edit_school.php?id=' . $id . '">';
        echo '<button type="button" class="btn btn-info">Editar</button>';
        echo '</a>';
        echo '<a href="/upload_file.php?id=' . $id . '&type=escuela">';
        echo '<button type="button" class="btn btn-info">Agregar archivo/imagen</button>';
        echo '</a>';

        include 'carousel.php';

        $fields = [
          ['Nombre', $school["nombre"]],
          ['Director', $school["director"]],
          ['Nivel', $school["nivel"]],
          ['Turno', $school["turno"]],
          ['Sostenimiento', $school["sostenimiento"]],
          ['Direccion', $school["direccion"]],
          ['Region', $school["region"]],
          ['Alumnos', $school["alumnos"]],
          ['Comentarios', $school["comentarios"]],
          ['', '<a href="/events.php?school=' . $id .'">Eventos</a>'],
        ];

        foreach ($fields as $field) {
          echo '<div class="row form-group">';
          echo '<label class="col-xs-3 col-xs-offset-1" style="text-align: right;">' . $field[0] .'</label>';
          echo '<div class="col-xs-5">';
          echo $field[1];
          echo '</div>';
          echo '</div>';
        }
        echo '<br>';

        include 'file_list.php';
      }
    ?>
  </div>
</body>

<?php
  include 'footer.php';
?>
