<?php
  $require_auth = true;

  include 'php_header.php';
  include 'validation.php';

  error_reporting( error_reporting() & ~E_NOTICE );

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $iEmpresa = $_POST["empresa"];
    $iEscuela = $_POST["escuela"];
    $iGestion = $_POST["gestion"];
    $iNombre = $_POST["nombre"];
    $iObjetivo = $_POST["objetivo"];
    $iFecha = $_POST["fecha"];
    $iHora_inicio = $_POST["hora_inicio"];
    $iHora_inicio_hour = $_POST["hora_inicio_hour"];
    $iHora_inicio_minute = $_POST["hora_inicio_minute"];
    $iHora_fin = $_POST["hora_fin"];
    $iHora_fin_hour = $_POST["hora_fin_hour"];
    $iHora_fin_minute = $_POST["hora_fin_minute"];
    $iLugar = $_POST["lugar"];
    $iTematica = $_POST["tematica"];
    $iDescripcion = $_POST["descripcion"];
    $iNum_alumnos = $_POST["num_alumnos"];
    $iNum_padres = $_POST["num_padres"];
    $iNum_personal = $_POST["num_personal"];
    $iNum_voluntarios = $_POST["num_voluntarios"];
    $iInstitucion = $_POST["institucion"];
    $iNum_alumnos_servicio = $_POST["num_alumnos_servicio"];
    $iUniversidad = $_POST["universidad"];
    $iEmpresario = $_POST["empresario"];
    $iInversion_monetaria = $_POST["inversion_monetaria"];
    $iInversion_especie = $_POST["inversion_especie"];
    $iInversion_monetaria_escuela = $_POST["inversion_monetaria_escuela"];
    $iInversion_especie_escuela = $_POST["inversion_especie_escuela"];
    $iOtra_donacion = $_POST["otra_donacion"];
    $iCorreo_electronico = $_POST["correo_electronico"];

    if (empty($_POST["escuela"]))
      $error_escuela = "El nombre de la escuela no puede estar vacio";
    if (empty($_POST["empresa"]))
      $error_empresa = "El nombre de la empresa no puede estar vacio";
    if (empty($_POST["gestion"]))
      $error_gestion = "Gestión inválida";
    if (empty($_POST["nombre"]))
      $error_nombre = "El nombre del evento no puede estar vacio";
    if (empty($_POST["objetivo"]))
      $error_objetivo = "Objetivo no puede estar vacio";
    if (empty($_POST["fecha"]) || date_parse($_POST["fecha"]) === false)
      $error_fecha = "Fecha inválida";
    if ((intval($_POST["hora_inicio_hour"]) == 0 && $_POST["hora_inicio_hour"] != "0") ||
        (intval($_POST["hora_inicio_minute"]) == 0 && $_POST["hora_inicio_minute"] != "0"))
      $error_hora_inicio = "Hora de inicio invalida.";
    if ((intval($_POST["hora_fin_hour"]) == 0 && $_POST["hora_fin_hour"] != "0") ||
        (intval($_POST["hora_fin_minute"]) == 0 && $_POST["hora_fin_minute"] != "0"))
      $error_hora_fin = "Hora de fin invalida.";
    if (empty($_POST["lugar"]))
      $error_lugar = "El lugar no puede estar vacio";
    if (empty($_POST["tematica"]))
      $error_tematica = "Tematica no puede estar vacio";
    if (empty($_POST["descripcion"]))
      $error_descripcion = "La descripción no puede estar vacia.";
    if (intval($_POST["num_alumnos"]) == 0 && $_POST["num_alumnos"] != "0")
      $error_num_alumnos = "El número de alumnos debe ser un número";
    if (intval($_POST["num_padres"]) == 0 && $_POST["num_padres"] != "0")
      $error_num_padres = "El número de padres de familia debe ser un número";
    if (intval($_POST["num_personal"]) == 0 && $_POST["num_personal"] != "0")
      $error_num_personal = "El número de personal debe ser un número";
    if (intval($_POST["num_voluntarios"]) == 0 && $_POST["num_voluntarios"] != "0")
      $error_num_voluntarios = "El número de voluntarios debe ser un número";
    if (empty($_POST["institucion"]))
      $error_institucion = "El nombre de la institución no puede estar vacio";
    if (intval($_POST["num_alumnos_servicio"]) == 0 && $_POST["num_alumnos_servicio"] != "0")
      $error_num_alumnos_servicio = "El número de alumnos de servicio social debe ser un número";
    if (empty($_POST["universidad"]))
      $error_universidad = "El nombre de la universidad no puede estar vacio";
    if (intval($_POST["inversion_monetaria"]) == 0 && $_POST["inversion_monetaria"] != "0")
      $error_inversion_monetaria = "La inversión monetaria debe de ser un número";
    if (intval($_POST["inversion_monetaria_escuela"]) == 0 && $_POST["inversion_monetaria_escuela"] != "0")
      $error_inversion_monetaria_escuela = "La inversión monetaria debe de ser un número";
    if (empty($_POST["correo_electronico"]) && !editing)
      $error_correo_electronico = "El correo electrónico no puede estar vacio";

    if (empty($error_escuela) && empty($error_empresa) && empty($error_gestion) &&
        empty($error_objetivo) && empty($error_fecha) && empty($error_hora_inicio) &&
        empty($error_hora_fin) && empty($error_lugar) && empty($error_tematica) &&
        empty($error_descripcion) && empty($error_num_alumnos) && empty($error_num_padres) &&
        empty($error_num_personal) && empty($error_num_voluntarios) && empty($error_institucion) &&
        empty($error_num_alumnos_servicio) && empty($error_universidad) && empty($error_empresario) &&
        empty($error_inversion_monetaria) && empty($error_inversion_especie) && empty($error_inversion_monetaria_escuela) &&
        empty($error_inversion_especie_escuela) && empty($error_otra_donacion) && empty($error_correo_electronico)) {
      $escuela = $conn->real_escape_string($_POST["escuela"]);
      if ($result = $conn->query("select id from escuelas where nombre = '$escuela'")) {
        if ($row = $result->fetch_assoc()) {
          $escuela_id = $row["id"];
          $empresa = $conn->real_escape_string($_POST["empresa"]);
          $gestion = $conn->real_escape_string($_POST["gestion"]);
          $nombre = $conn->real_escape_string($_POST["nombre"]);
          $objetivo = $conn->real_escape_string($_POST["objetivo"]);
          $datearray = date_parse($_POST["fecha"]);

          $year = $datearray['year'] . "";
          while (strlen($year) < 4)
            $year = "0" . $year;

          $month = $datearray['month'];
          while (strlen($month) < 2)
            $month = "0" . $month;

          $day = $datearray['day'];
          while (strlen($day) < 2)
            $day = "0" . $day;

          $inicio_hour = $_POST['hora_inicio_hour'];
          while (strlen($inicio_hour) < 2)
            $inicio_hour = "0" . $inicio_hour;

          $inicio_minute = $_POST['hora_inicio_minute'];
          while (strlen($inicio_minute) < 2)
            $inicio_minute = "0" . $inicio_minute;

          $fin_hour = $_POST['hora_fin_hour'];
          while (strlen($fin_hour) < 2)
            $fin_hour = "0" . $fin_hour;

          $fin_minute = $_POST['hora_fin_minute'];
          while (strlen($fin_minute) < 2)
            $fin_minute = "0" . $fin_minute;

          $datetime_inicio = $year . "-" . $month . "-" . $day . " " . $inicio_hour . ":" . $inicio_minute . ":00";
          $datetime_fin = $year . "-" . $month . "-" . $day . " " . $fin_hour . ":" . $fin_minute . ":00";

          $lugar = $conn->real_escape_string($_POST["lugar"]);
          $tematica = $conn->real_escape_string($_POST["tematica"]);
          $descripcion = $conn->real_escape_string($_POST["descripcion"]);
          $num_alumnos = intval($_POST["num_alumnos"]);
          $num_padres = intval($_POST["num_padres"]);
          $num_personal = intval($_POST["num_personal"]);
          $num_voluntarios = intval($_POST["num_voluntarios"]);
          $institucion = $conn->real_escape_string($_POST["institucion"]);
          $num_alumnos_servicio = intval($_POST["num_alumnos_servicio"]);
          $universidad = $conn->real_escape_string($_POST["universidad"]);
          $empresario = false;
          if ($_POST["empresario"] == "Sí")
            $empresario = 1;
          else
            $empresario = 0;
          $inversion_monetaria = intval($_POST["inversion_monetaria"]);
          $inversion_especie = $conn->real_escape_string($_POST["inversion_especie"]);
          $inversion_monetaria_escuela = intval($_POST["inversion_monetaria_escuela"]);
          $inversion_especie_escuela = $conn->real_escape_string($_POST["inversion_especie_escuela"]);
          $otro_tipo_donacion = $conn->real_escape_string($_POST["otra_donacion"]);

          if ($editing) {
            $query = "update eventos set escuela_id=$escuela_id, empresa='$empresa', gestion='$gestion', nombre='$nombre',
              objetivo='$objetivo', inicio=('$datetime_inicio'), fin=('$datetime_fin'), lugar='$lugar', tematica='$tematica',
              descripcion='$descripcion', num_alumnos=$num_alumnos, num_padres=$num_padres, num_personal=$num_personal,
              num_voluntarios=$num_voluntarios, institucion='$institucion', num_alumnos_servicio=$num_alumnos_servicio,
              universidad='$universidad', empresario=$empresario, inversion_monetaria_empresa=$inversion_monetaria, 
              inversion_especie_empresa='$inversion_especie', inversion_monetaria_escuela='$inversion_monetaria_escuela',
              inversion_especie_escuela='$inversion_especie_escuela', otro_tipo_donacion='$otro_tipo_donacion' where id=$id";
          } else {
            $correo_electronico = $conn->real_escape_string($_POST["correo_electronico"]);

            $query = "insert into eventos (escuela_id, empresa, gestion, nombre, objetivo, inicio,
              fin, lugar, tematica, descripcion, num_alumnos, num_padres, num_personal, num_voluntarios,
              institucion, num_alumnos_servicio, universidad, empresario, inversion_monetaria_empresa, 
              inversion_especie_empresa, inversion_monetaria_escuela, inversion_especie_escuela, otro_tipo_donacion,
              correo_electronico) values ($escuela_id, '$empresa', '$gestion', '$nombre', '$objetivo', ('$datetime_inicio'), ('$datetime_fin'),
              '$lugar', '$tematica', '$descripcion', $num_alumnos, $num_padres, $num_personal, $num_voluntarios,
              '$institucion', $num_alumnos_servicio, '$universidad', $empresario, $inversion_monetaria,
              '$inversion_especie', $inversion_monetaria_escuela, '$inversion_especie_escuela', '$otro_tipo_donacion',
              '$correo_electronico')";
          }

          if ($conn->query($query)) {
            header("Location: /events.php");
          } else {
            die($conn->error);
          }
        } else {
          $error_escuela = "Escuela no encontrada.";
        }
      } else {
        die("Ocurrió un error.");
      }
    }
  }

  include 'header.php';
  include 'inputs.php';
 ?>

<body>
  <?php
    include 'menu.php';
    echo '<div class="container">';

      if ($editing) {
        echo '<form action="/edit_event.php?id=' . $id .'" method="POST">';
      } else {
        echo '<form action="/create_event.php" method="POST">';
      }

      $escuelas = array();
      if ($result = $conn->query("select nombre from escuelas")) {
        while ($row = $result->fetch_assoc()) {
          array_push($escuelas, $row["nombre"]);
        }
      } else {
        die("Ocurrió un error.");
      }
      textbox_input("empresa", "Empresa a la que pertenece el asesor", $error_empresa, $iEmpresa);
      select_input("escuela", "Escuela", $escuelas, $error_escuela, $iEscuela);
      select_input("gestion", "El evento o actividad fue gestionado por",
        array("La escuela", "El asesor", "En conjunto", "Una organización civil", "Municipio", "SENL", "Otro"), $error_gestion, $iGestion);
      textbox_input("nombre", "Nombre del evento o actividad", $error_nombre, $iNombre);
      textbox_input("objetivo", "Objetivo", $error_objetivo, $iObjetivo);
      date_input("fecha", "Fecha en que se realizó", $error_fecha, $iFecha);
      time_input("hora_inicio", "Hora de inicio", $error_hora_inicio, $iHora_inicio_hour, $iHora_inicio_minute, $iHora_inicio);
      time_input("hora_fin", "Hora en que termino", $error_hora_fin, $iHora_fin_hour, $iHora_fin_minute, $iHora_fin);
      textbox_input("lugar", "¿Dónde se realizó?", $error_lugar, $iLugar);
      select_input("tematica", "¿Cuál fue la temática del evento o actividad?",
        array("5'S", "Académico", "Arranque de obras", "Capacitaciones", "CEPS", "Concursos",
            "Cultural", "Deportivo", "Ecológico", "Entrega de Infraestructura", "Feria de los Ceps",
            "Gran Día de la Limpieza", "Mantenimiento de la Escuela", "Programas", "Salud", "Seguridad",
            "Otro"), $error_tematica, $iTematica);
      textbox_input("descripcion", "Descripción del Evento", $error_descripcion, $iDescripcion);
      number_input("num_alumnos", "¿Cuántos alumnos asistieron?", $error_num_alumnos, 0, 10000, $iNum_alumnos);
      number_input("num_padres", "¿Cuántos padres de familia asistieron?", $error_num_padres, 0, 10000, $iNum_padres);
      number_input("num_personal", "¿Cuánto personal de la escuela asistió?", $error_num_personal, 0, 10000, $iNum_personal);
      number_input("num_voluntarios", "¿Cuántos voluntarios asistieron?", $error_num_voluntarios, 0, 10000, $iNum_voluntarios);
      textbox_input("institucion", "Nombre de la institución que apoyó con voluntariado", $error_institucion, $iInstitucion);
      number_input("num_alumnos_servicio", "Número de alumnos de servicio social que asistieron", $error_num_alumnos_servicio, 0, 10000, $iNum_alumnos_servicio);
      select_input("universidad", "Universidad que participó",
        array("UANL", "UDEM", "ITESM", "UR", "Tec Milenio", "Universidad Metropolitana",
            "UMM", "NA", "Otro"), $error_universidad, $iUniversidad);
      select_input("empresario", "¿Asistió el empresario al evento?",
        array("Sí", "No"), $error_empresario, $iEmpresario);
      number_input("inversion_monetaria", "Inversión monetaria de la empresa", $error_inversion_monetaria, 0, 1000000000, $iInversion_monetaria);
      textbox_input("inversion_especie", "Inversión en especie de la empresa", $error_inversion_especie, $iInversion_especie);
      number_input("inversion_monetaria_escuela", "Inversión monetaria de la escuela", $error_inversion_monetaria_escuela, 0, 1000000000, $iInversion_monetaria_escuela);
      textbox_input("inversion_especie_escuela", "Inversión en especie de la escuela", $error_inversion_especie_escuela, $iInversion_especie_escuela);
      textbox_input("otra_donacion", "Otro tipo de donación", $error_otra_donacion, $iOtra_donacion);

      if ($editing) {
        echo '<input type="submit" value="Guardar">';
      } else {
        textbox_input("correo_electronico", "Agrega tu correo electrónico", $error_correo_electronico, $iCorreo_electronico);
        echo '<div style="margin-bottom: 15px;">';
        echo '<a href="/events.php">';
        echo '<input style="margin-right: 10px" type="button" class="btn btn-danger col-xs-offset-7" value="Cancelar">';
        echo '</a>';
        echo '<input type="submit" class="btn btn-success" value="Crear">';
        echo '</div>';
      }
    ?>
    </form>
  </div>
</body>

<?php
  include 'footer.php';
?>
