<?php
  $require_auth = false;

  include 'php_header.php';
  include 'validation.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $invalid_email = !valid_email($email);
    $invalid_password = !valid_password($password);

    if (!$invalid_email && !$invalid_password) {
      setcookie("session_token", $email);
      header("Location: /home.php");
    }
  }

  include 'header.php';
?>

<body>
  <form action="/login.php" method="POST">
    Email:<br>
    <input type="text" name="email">
    <?php
      if ($invalid_email) {
        echo 'Correo electrónico inválido.';
      }
    ?>
    <br>
    Password:<br>
    <input type="password" name="password">
    <?php
      if ($invalid_password) {
        echo 'Contraseña inválida. Debe contener por lo menos 5 caracteres.';
      }
    ?>
    <br>
    <input type="submit" value="Log in">
  </form>
</body>

<?php
  include 'footer.php';
?>
