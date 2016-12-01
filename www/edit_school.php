<?php
  include 'php_header.php';

  error_reporting( error_reporting() & ~E_NOTICE );

  $editing_school = true;
  $error = false;

  $id = $_GET['id'];
  if (!$id) {
    header("Location: /schools.php");
  }

  if ($result = $conn->query("select * from escuelas where id='$id'")) {
    if (!($school = $result->fetch_assoc())) {
      $error = true;
    }
  } else {
    $error = true;
  }

  if ($error !== true && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    $iNombre = $school["nombre"];
    $iDirector = $school["director"];
    $iNivel = $school["nivel"];
    $iTurno = $school["turno"];
    $iSostenimiento = $school["sostenimiento"];
    $iDireccion = $school["direccion"];
    $iRegion = $school["region"];
    $iAlumnos = $school["alumnos"];
    $iComentarios = $school["comentarios"];

    $date = new DateTime();
    $date->setTimestamp(strtotime($event["fecha"]));
    $iFecha = $date->format("Y-m-d");
  }

  include 'create_school.php';
?>
