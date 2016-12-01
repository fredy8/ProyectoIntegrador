<?php
  include 'php_header.php';

  $editing = true;
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

  if ($error !== true && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    $iEmpresa = $event["empresa"];
    $iEscuela = $school["nombre"];
    $iGestion = $event["gestion"];
    $iNombre = $event["nombre"];
    $iObjetivo = $event["objetivo"];

    $start = new DateTime();
    $start->setTimestamp(strtotime($event["inicio"]));
    
    //$iFecha = $event["fecha"];
    //$iHora_inicio = $event["empresa"];
    //$iHora_inicio_hour = $event["empresa"];
    //$iHora_inicio_minute = $event["empresa"];
    //$iHora_fin = $event["empresa"];
    //$iHora_fin_hour = $event["empresa"];
    //$iHora_fin_minute = $event["empresa"];
    
    $iLugar = $event["lugar"];
    $iTematica = $event["tematica"];
    $iDescripcion = $event["descripcion"];
    $iNum_alumnos = $event["num_alumnos"];
    $iNum_padres = $event["num_padres"];
    $iNum_personal = $event["num_personal"];
    $iNum_voluntarios = $event["num_voluntarios"];
    $iInstitucion = $event["institucion"];
    $iNum_alumnos_servicio = $event["num_alumnos_servicio"];
    $iUniversidad = $event["universidad"];
    $iEmpresario = $event["empresario"] ? "Sí" : "No";
    $iInversion_monetaria = $event["inversion_monetaria_empresa"];
    $iInversion_especie = $event["inversion_especie_empresa"];
    $iInversion_monetaria_escuela = $event["inversion_monetaria_escuela"];
    $iInversion_especie_escuela = $event["inversion_especie_escuela"];
    $iOtra_donacion = $event["otro_tipo_donacion"];
  }

  include 'create_event.php';
?>
