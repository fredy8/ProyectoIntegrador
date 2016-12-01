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
    $header = ['ID', 'Nombre', 'Tamaño'];
    $rows = [];
    foreach($fileRows as $row) {
      $links = [];
      array_push($rows, [$row['id'], $row['name'], formatBytes($row['size'])]);
      array_push($links, "download.php?id=" . $row['id']);
    }
    drawTable($header, $rows, $links);
  }

  function formatBytes($bytes, $precision = 2) { 
    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 
    $bytes /= (1 << (10 * $pow)); 

    return round($bytes, $precision) . ' ' . $units[$pow]; 
} 

?>

<?php
  if (!$error)
    loadTable();
?>

<?php
  include 'footer.php';
?>
