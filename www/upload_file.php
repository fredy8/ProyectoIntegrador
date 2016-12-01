<?php
  $require_auth = true;
  include 'php_header.php';
  include 'header.php';

  $validIdTypes = array('escuela', 'evento');
  $id = $_GET['id'];
  $type = $_GET['type'];
  $error = false;
  if (!$id || !$type || !in_array($type, $validIdTypes)) {
    $error = true;
  } else {
    if ($type === 'escuela') 
      $query = "select nombre from escuelas where id='$id'";
    else
      $query = "select nombre from eventos where id='$id'";

    if ($result = $conn->query($query)) {
      if ($row = $result->fetch_assoc()) {
        $name = $row['nombre'];
      } else {
        $error = true;
      }
    } else {
      $error = true;
    }
  }

  if ($error) {
    header("Location: /home.php");
  } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_FILES['userfile']['size'] > 0) {
      $fileName = $_FILES['userfile']['name'];
      $tmpName  = $_FILES['userfile']['tmp_name'];
      $fileSize = $_FILES['userfile']['size'];
      $fileType = $_FILES['userfile']['type'];

      $fp      = fopen($tmpName, 'r');
      $content = fread($fp, filesize($tmpName));
      $content = addslashes($content);
      fclose($fp);

      if(!get_magic_quotes_gpc()) {
          $fileName = addslashes($fileName);
      }
      
      $idType = $type . '_id';
      $query = "INSERT INTO archivos (name, size, type, content, $idType) ".
        "VALUES ('$fileName', '$fileSize', '$fileType', '$content', $id)";

      if ($conn->query($query)) {
        if ($type === 'escuela')
          header("Location: /school.php?id=$id");
        else
          header("Location: /event.php?id=$id");
      } else {
        die("Error al subir el archivo.");
      }
    } else {
      die("Error al subir el archivo.");
    }
  }

?>

<body>
  <?php include 'menu.php'; ?>
  <div class="container">
    <form method="post" enctype="multipart/form-data">
      <?php
        echo 'Subir un archivo o imagen para ' . $type . ': ' . $name . '.';
        echo '<br><br>';
        echo '<input type="hidden" name="id" value=$id>';
        echo '<input type="hidden" name="type" value=$type>';
      ?>
      <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
      <input name="userfile" type="file" id="userfile"><br>
      <input name="upload" type="submit" class="btn btn-success" id="upload" value=" Cargar ">
    </form>
  </div>
</body>

<?php
  include 'footer.php';
?>
