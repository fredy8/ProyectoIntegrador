<?php
  $require_auth = true;
  include 'php_header.php';
  include 'inputs.php';

  $nombre = null;
  $director = null;
  $nivel = null;
  $turno = null;
  $sostenimiento = null;
  $direccion = null;
  $region = null;
  $fecha = null;
  $alumnos = null;
  $comentarios = null;
  $error_nombre = null;
  $error_director = null;
  $error_nivel = null;
  $error_turno = null;
  $error_sostenimiento = null;
  $error_direccion = null;
  $error_region = null;
  $error_fecha = null;
  $error_alumnos = null;
  $error_comentarios = null;

  $create_error = false;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST["nombre"];
    $director = $_POST["director"];
    $nivel = $_POST["nivel"];
    $turno = $_POST["turno"];
    $sostenimiento = $_POST["sostenimiento"];
    $direccion = $_POST["direccion"];
    $region = $_POST["region"];
    $fecha = $_POST["fecha"];
    $alumnos = $_POST["alumnos"];
    $comentarios = $_POST["comentarios"];

    $valid = true;

    if (!$nombre) {
      $error_nombre = "Inválido";
      $valid = false;
    }
    if (!$director) {
      $error_director = "Inválido";
      $valid = false;
    }
    if (!$nivel) {
      $error_nivel = "Inválido";
      $valid = false;
    }
    if (!$turno) {
      $error_turno = "Inválido";
      $valid = false;
    }
    if (!$sostenimiento) {
      $error_sostenimiento = "Inválido";
      $valid = false;
    }
    if (!$direccion) {
      $error_direccion = "Inválido";
      $valid = false;
    }
    if (!$region) {
      $error_region = "Inválido";
      $valid = false;
    }
    if (!$fecha) {
      $error_fecha = "Inválido";
      $valid = false;
    }
    if (!$alumnos) {
      $error_alumnos = "Inválido";
      $valid = false;
    }
    if (!$comentarios) {
      $error_comentarios = "Inválido";
      $valid = false;
    }

    $query = "insert into escuelas (nombre, director, nivel, turno, sostenimiento, direccion, region, fecha, alumnos, comentarios)"
      . " values('$nombre', '$director', '$nivel', '$turno', '$sostenimiento'," 
      . " '$direccion', '$region', '$fecha', $alumnos, '$comentarios')";

    echo $query;

    if ($valid) {
      if ($conn->query($query)) {
        header("Location: /school_created.php");
      } else {
        $create_error = true;
      }
    }
  }

  include 'header.php';
?>

<body>
  <?php include 'menu.php'; ?>
  <br>
  <form action="/create_school.php" method="POST">
    <?php
      textbox_input("nombre", "Nombre de la escuela", $error_nombre);
      textbox_input("director", "Nombre del director", $error_director);
      textbox_input("nivel", "Nivel", $error_nivel);
      textbox_input("turno", "Turno", $error_turno);
      textbox_input("sostenimiento", "Sostenimiento", $error_sostenimiento);
      textarea_input("direccion", "Dirección", $error_direccion);
      textbox_input("region", "Región", $error_region);
      date_input("fecha", "Fecha de inicio", $error_fecha);
      number_input("alumnos", "Número de alumnos", $error_alumnos);
      textarea_input("comentarios", "Comentarios", $error_comentarios);
    ?>

    <?php
      if ($create_error) {
        echo 'Ya existe una escuela con ese nombre.';
        echo '<br>';
      }
    ?>
    <a href="schools.php">Cancelar</a>
    <input type="submit" value="Crear">
  </form>
</body>

<?php
  include 'footer.php';
?>
