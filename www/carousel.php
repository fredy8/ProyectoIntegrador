<?php
  $require_auth = true;
  include 'php_header.php';
  include 'header.php';

/*
  $imageTypes = array('jpg', 'jpeg', 'png', 'gif');
  $validIdTypes = array('escuela', 'evento');
  $error = false;
  if (!$showFilesId || !$showFilesType || !in_array($showFilesType, $validIdTypes)) {
    $error = true;
  } else {
    if ($showFilesType === 'escuela') 
      $query = "select nombre from escuelas where id='$showFilesId'";
    else
      $query = "select nombre from eventos where id='$showFilesId'";

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
  }
*/

  function displayImage($id) {
    global $conn;
    if ($result = $conn->query("select type, content from archivos where id=$id")) {
      if ($row = $result->fetch_assoc()) {
        echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['content'] ).'"/>';
      } else {
        echo 'error 1: id ' . $id;
      }
    } else {
      echo 'error 2: id ' . $id;
    }
  }
?>

<div class="container">
<?php displayImage(3) ?>
</div>

<?php
  include 'footer.php';
?>
