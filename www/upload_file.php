<?php
  $require_auth = true;
  include 'php_header.php';
  include 'header.php';

  $upload_error = false;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

      $query = "INSERT INTO archivos (name, size, type, content ) ".
        "VALUES ('$fileName', '$fileSize', '$fileType', '$content')";

      if ($conn->query($query)) {
        header("Location: /upload_file.php");
      } else {
        $upload_error = true;
      }
    } else {
      $upload_error = true;
    }
  }

?>

<body>
  <?php include 'menu.php'; ?>
  <div class="container">
    <form method="post" enctype="multipart/form-data">
      <table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
        <tr> 
          <td width="246">
          <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
          <input name="userfile" type="file" id="userfile"> 
          </td>
          <td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
        </tr>
      </table>
    </form>
  </div>
</body>

<?php
  include 'footer.php';
?>
