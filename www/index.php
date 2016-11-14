<?php
  $require_auth = false;
  include 'php_header.php';
  if (!is_null($user_id)) {
    header("Location: /home.php");
  }
  include 'header.php';
?>

<body>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
</body>

<?php
  include 'footer.php';
?>
