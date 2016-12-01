<?php
  $require_auth = true;
  include 'php_header.php';
  include 'inputs.php';

  error_reporting( error_reporting() & ~E_NOTICE );

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $iNombre = $_POST["nombre"];
    $iDirector = $_POST["director"];
    $iNivel = $_POST["nivel"];
    $iTurno = $_POST["turno"];
    $iSostenimiento = $_POST["sostenimiento"];
    $iDireccion = $_POST["direccion"];
    $iRegion = $_POST["region"];
    $iFecha = $_POST["fecha"];
    $iAlumnos = $_POST["alumnos"];
    $iComentarios = $_POST["comentarios"];

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
  <div class="container">
    <br>
    <form action="/create_school.php" method="POST">
      <?php
        textbox_input("nombre", "Nombre de la escuela", $error_nombre, $iNombre);
        textbox_input("director", "Nombre del director", $error_director, $iDirector);
        textbox_input("nivel", "Nivel", $error_nivel, $iNivel);
        textbox_input("turno", "Turno", $error_turno, $iTurno);
        select_input("sostenimiento", array("Público", "Privado"), "Sostenimiento", $error_sostenimiento, $iSostenimiento);
        textarea_input("direccion", "Dirección", $error_direccion, $iDireccion);
        textbox_input("region", "Región", $error_region, $iRegion);
        date_input("fecha", "Fecha de inicio", $error_fecha, $iFecha);
        number_input("alumnos", "Número de alumnos", $error_alumnos, $iAlumnos);
        textarea_input("comentarios", "Comentarios", $error_comentarios, $iComentarios);
      ?>

      <?php
        if ($create_error) {
          echo 'Ya existe una escuela con ese nombre.';
          echo '<br>';
        }
      ?>

      <div style="margin-bottom: 15px;">
      <a href="/schools.php">
        <input style="margin-right: 10px" type="button" class="btn btn-danger col-xs-offset-7" value="Cancelar">
      </a>
      <input type="submit" class="btn btn-success" value="Agregar">
      </div>
    </form>
  </div>
</body>

<?php
  include 'footer.php';
?>
