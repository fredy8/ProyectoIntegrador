<?php
  $require_auth = true;
  include 'php_header.php';
  include 'header.php';

  $error = false;
  $event = NULL;
  $school = NULL;

  $id = $_GET['id'];
  if (!$id) {
    header("Location: /events.php");
  }

  if ($result = $conn->query("select * from eventos where id='$id'")) {
    if (!($event = $result->fetch_assoc())) {
      $error = true;
    } else {
      $id_escuela = $event["escuela_id"];
      if ($result = $conn->query("select * from escuelas where id='$id_escuela'")) {
        if (!($school = $result->fetch_assoc())) {
          $error = true;
        }
      } else {
        $error = true;
      }
    }
  } else {
    $error = true;
  }
?>

<body>
  <?php include 'menu.php'; ?>
  <div class="container">
    <br>
    <?php
      if ($error) {
        echo 'No se encontró el evento.';
      } else {
        echo '<a href="/edit_event.php?id=' . $id . '">Editar Evento</a><br>';
        $fields = [
          ['Nombre', $event['nombre']],
          ['Escuela', '<a href="/school.php?id=' . $school["id"] . '">' . $school['nombre'] . "</a>"],
          ['Empresa', $event['empresa']],
          ['Gestión', $event['gestion']],
          ['Objetivo', $event['objetivo']],
          ['Inicio', $event['inicio']],
          ['Fin', $event['fin']],
          ['Lugar', $event['lugar']],
          ['Temática', $event['tematica']],
          ['Descripción', $event['descripcion']],
          ['Número de Alumnos', $event['num_alumnos']],
          ['Número de Padres de Familia', $event['num_padres']],
          ['Número de Personal', $event['num_personal']],
          ['Número de Voluntarios', $event['num_voluntarios']],
          ['Institución de Apoyo', $event['institucion']],
          ['Número de Alumnos de Servicio Social', $event['num_alumnos_servicio']],
          ['Universidad Participante', $event['universidad']],
          ['Asistencia Empresario', $event['empresario'] === "1" ? "Sí" : "No"],
          ['Inversión Monetaria Empresa', $event['inversion_monetaria_empresa']],
          ['Inversión Especie Empresa', $event['inversion_especie_empresa']],
          ['Inversión Monetaria Escuela', $event['inversion_monetaria_escuela']],
          ['Inversión Especie Escuela', $event['inversion_especie_escuela']],
          ['Otras donaciones', $event['otro_tipo_donacion']],
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
        echo 'Evento creador por ' . $event["correo_electronico"] . '<br>';
      }
    ?>
  </div>
</body>

<?php
  include 'footer.php';
?>
