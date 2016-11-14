<?php
  $require_auth = false;

  include 'php_header.php';
  include 'validation.php';

  $invalid_email = false;
  $invalid_password = false;
  $register_error = false;
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST["email"]; 
    $password = $_POST["password"];

    $invalid_email = !valid_email($email);
    $invalid_password = !valid_password($password);

    if (!$invalid_email && !$invalid_password) {
      $email = $conn->real_escape_string($email);
      $password = password_hash($password, PASSWORD_DEFAULT);

      if ($conn->query("insert into users(email, password) values ('$email', '$password')")) {
        header("Location: /registration_requested.php");
      } else {
        $register_error = true;
      }
    }
  }
  include 'header.php';
?>

<body>
  <form action="/register.php" method="POST">
    Correo electrónico:<br>
    <input type="text" name="email">
    <?php
      if ($invalid_email) {
        echo 'Correo electrónico inválido.';
      }
    ?>
    <br>
    Constraseña:<br>
    <input type="password" name="password">
    <?php
      if ($invalid_password) {
        echo 'Contraseña inválida. Debe contener por lo menos 5 caracteres.';
      }
    ?>
    <br>
    <?php
      if ($register_error) {
        echo 'Ya existe un usuario con el correo electrónico.';
        echo '<br>';
      }
    ?>
    <input type="submit" value="Registrar">
  </form>
</body>

<?php
  include 'footer.php';
?>
