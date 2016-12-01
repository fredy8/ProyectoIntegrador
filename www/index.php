<?php
  $require_auth = false;
  include 'php_header.php';
  if (!is_null($user_id)) {
    header("Location: /home.php");
  }
  include 'header.php';
  include 'login.php';
?>

<?php
  include 'footer.php';
?>
