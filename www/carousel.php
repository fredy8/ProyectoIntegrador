<?php
  $require_auth = true;
  include 'php_header.php';
  include 'header.php';

  $imageTypes = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
  $validIdTypes = array('escuela', 'evento');
  $error = false;
  $numImages = 0;
  $imageIds = [];

  if (!$showFilesId || !$showFilesType || !in_array($showFilesType, $validIdTypes)) {
    $error = true;
  } else {
    $query = "select id from archivos where " . $showFilesType . "_id='$showFilesId' and type in('". implode("','", $imageTypes) . "')";
    if ($result = $conn->query($query)) {
      while ($row = $result->fetch_assoc()) {
        $numImages++;
        array_push($imageIds, $row['id']);
      }
    } else {
      $error = true;
    }
  }

  if ($error) {
    echo 'No se pudieron cargar las imagenes';
  }

  function displayImage($id) {
    global $conn;
    if ($result = $conn->query("select type, content from archivos where id=$id")) {
      if ($row = $result->fetch_assoc()) {
        echo '<img style="display:block; height:200px; margin: auto;" src="data:image/jpeg;base64,' 
          .base64_encode( $row['content'] ) . '"/>';
      } else {
        echo 'error';
      }
    } else {
      echo 'error';
    }
  }
?>

<?php
  if ($numImages > 0) {
?>
<div style='max-height:550px; padding:20px'>
<div id="myCarousel" class="carousel slide" style="height:300px; padding-top:50px;" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <?php
      for($i = 1; $i < $numImages; $i++) {
        echo '<li data-target="#myCarousel" data-slide-to="$i"></li>';
      }
    ?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <?php
      $first = true;
      for($i = 0; $i < $numImages; $i++) {
        echo '<div style="max-height:200px;" class="item' . ($i === 0 ? ' active' : '') . '">';
        displayImage($imageIds[$i]);
        echo '</div>';
      }
    ?>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
<?php
}
?>

<?php
  include 'footer.php';
?>
