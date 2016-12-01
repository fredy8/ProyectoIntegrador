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
  <div class="container-fluid">
    <form style="max-width: 500px; padding: 15px; margin: 0px auto;" action="/register.php" method="POST">
      <h1>Registro</h1>
      <div class="form-group">
        <label class="control-label" for="email">Email</label>
        <?php
          if ($invalid_email) {
            echo 'Correo electrónico inválido.';
          }
        ?>
        <input type="text" class="form-control" id="email" name="email">
      </div>
      <div class="form-group">
        <label class="control-label" for="password">Password</label>
        <?php
          if ($invalid_password) {
            echo 'Contraseña inválida. Debe contener por lo menos 5 caracteres.';
          }
        ?>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <input type="submit" class="btn btn-success col-xs-offset-9" value="Solicitar Cuenta">
    </form>
  </div>
</body>

<?php
  include 'footer.php';
?>
