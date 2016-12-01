<?php
  $require_auth = true;
  include 'php_header.php';
  include 'inputs.php';

  error_reporting( error_reporting() & ~E_NOTICE );

  $error_nombre = NULL;
  $error_director = NULL;
  $error_nivel = NULL;
  $error_turno = NULL;
  $error_sostenimiento = NULL;
  $error_direccion = NULL;
  $error_region = NULL;
  $error_fecha = NULL;
  $error_alumnos = NULL;
  $error_comentarios = NULL;

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

    if (empty($_POST["nombre"]))
      $error_nombre = "El nombre no puede estar vacío";
    if (empty($_POST["director"]))
      $error_director = "El nombre del director no puede estar vacío";
    if (empty($_POST["nivel"]))
      $error_nivel = "El nivel no puede estar vacío";
    if (empty($_POST["turno"]))
      $error_turno = "El turno no puede estar vacío";
    if (empty($_POST["sostenimiento"]))
      $error_sostenimiento = "El sostenimiento no puede estar vacío";
    if (empty($_POST["direccion"]))
      $error_direccion = "La dirección no puede estar vacía";
    if (empty($_POST["region"]))
      $error_region = "La región no puede estar vacía";
    if (empty($_POST["fecha"]) || date_parse($_POST["fecha"]) === false)
      $error_fecha = "Fecha inválida";
    if (intval($_POST["alumnos"]) == 0 && $_POST["alumnos"] != "0")
      $error_alumnos = "El número de alumnos debe ser un número";
    if (empty($_POST["comentarios"]))
      $iComentarios = "Debe introducir comentarios";

    if (empty($error_nombre) && empty($error_director) && empty($error_nivel) && empty($error_turno) && empty($error_sostenimiento) 
      && empty($error_direccion) && empty($error_region) && empty($error_fecha) && empty($error_alumnos)) {
      if ($editing_school) {
        $query = "update escuelas set nombre='$iNombre', director='$iDirector', nivel='$iNivel', turno='$iTurno',"
          . " sostenimiento='$iSostenimiento', direccion='$iDireccion', region='$iRegion', fecha='$iFecha', alumnos=$iAlumnos,"
          . " comentarios='$iComentarios' where id=$id";
      } else {
        $query = "insert into escuelas (nombre, director, nivel, turno, sostenimiento, direccion, region, fecha, alumnos, comentarios)"
          . " values('$iNombre', '$iDirector', '$iNivel', '$iTurno', '$iSostenimiento'," 
          . " '$iDireccion', '$iRegion', '$iFecha', $iAlumnos, '$iComentarios')";
      }
      if ($conn->query($query)) {
        header("Location: /schools.php");
        $editing_school = false;
      } else {
        $create_error = true;
      }
    }
  }

  include 'header.php';
?>

<body>
  <?php 
    include 'menu.php';
    echo '<div class="container">';
    
      if ($editing_school) {
        echo '<form action="/edit_school.php?id=' . $id .'" method="POST">';
      } else {
        echo '<form action="/create_school.php" method="POST">';
      }

      textbox_input("nombre", "Nombre de la escuela", $error_nombre, $iNombre);
      textbox_input("director", "Nombre del director", $error_director, $iDirector);
      textbox_input("nivel", "Nivel", $error_nivel, $iNivel);
      textbox_input("turno", "Turno", $error_turno, $iTurno);
      select_input("sostenimiento", "Sostenimiento", array("Pública", "Privada"), $error_sostenimiento, $iSostenimiento);
      textarea_input("direccion", "Dirección", $error_direccion, $iDireccion);
      textbox_input("region", "Región", $error_region, $iRegion);
      date_input("fecha", "Fecha de inicio", $error_fecha, $iFecha);
      number_input("alumnos", "Número de alumnos", $error_alumnos, 0, NULL, $iAlumnos);
      textarea_input("comentarios", "Comentarios", $error_comentarios, $iComentarios);

      if ($create_error) {
        echo 'Ya existe una escuela con ese nombre.';
        echo '<br>';
      }

      if ($editing_school) {
        echo '<div style="margin-bottom: 15px;">';
        echo '<a href="/event.php?id=' . $id .'">';
        echo '<input style="margin-right: 10px" type="button" class="btn btn-danger col-xs-offset-7" value="Cancelar">';
        echo '</a>';
        echo '<input type="submit" class="btn btn-success" value="Guardar">';
      } else {
        echo '<div style="margin-bottom: 15px;">';
        echo '<a href="/events.php">';
        echo '<input style="margin-right: 10px" type="button" class="btn btn-danger col-xs-offset-7" value="Cancelar">';
        echo '</a>';
        echo '<input type="submit" class="btn btn-success" value="Crear">';
      }

      echo '</div>';
    ?>
    </form>
  </div>
</body>

<?php
  include 'footer.php';
?>
