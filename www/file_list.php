<?php
  $require_auth = true;
  include 'php_header.php';
  include 'header.php';
  include 'table_util.php';

  $imageTypes = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
  $validIdTypes = array('escuela', 'evento');
  $error = false;
  $fileRows = NULL;

  if (!$showFilesId || !$showFilesType || !in_array($showFilesType, $validIdTypes)) {
    $error = true;
  } else {
    $query = "select id, name, size from archivos where " . $showFilesType . 
      "_id='$showFilesId' and type not in('". implode("','", $imageTypes) . "')";
    if (!$fileRows = $conn->query($query)) {
      $error = true;
    }
  }

  function loadTable() {
    global $fileRows;
    $header = ['ID', 'Nombre', 'Tamaño', 'Descargar', 'Eliminar'];
    $rows = [];
    foreach($fileRows as $row) {
      array_push($rows, 
        [$row['id'], $row['name'], formatBytes($row['size']), getDownloadButton($row['id']), getDeleteButton($row['id'])]);
    }
    if (count($rows) > 0)
      drawTable($header, $rows);
  }

  function formatBytes($bytes, $precision = 2) { 
    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 
    $bytes /= (1 << (10 * $pow)); 

    return round($bytes, $precision) . ' ' . $units[$pow]; 
  }

  function getDownloadButton($id) {
    return '<a href="/download.php?id=' . $id . '">'
      . '<button type="button" class="btn btn-info">Descargar</button></a>';
  }

  function getDeleteButton($id) {
    return '<a href="/delete_file.php?id=' . $id . '">'
      . '<button type="button" class="btn btn-danger">Eliminar</button></a>';
  }

?>

<?php
  if (!$error)
    loadTable();
?>

<?php
  include 'footer.php';
?>
