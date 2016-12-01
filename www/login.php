<?php
  $require_auth = false;

  include 'php_header.php';
  include 'validation.php';

  $login_error = false;
  $not_approved = false;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $email = $conn->real_escape_string($email);

    if ($result = $conn->query("select id, approved, password from users where email='$email'")) {
      if ($result->num_rows === 0) {
        $login_error = true;
      } else {
        $row = $result->fetch_assoc();
        if (!password_verify($password, $row["password"])) {
          $login_error = true;
        } else if (!$row["approved"]) {
          $not_approved = true;
        } else {
          // TODO encrypt user id
          setcookie("session_token", $row["id"]);
          header("Location: /home.php");
        }
      }
    } else {
      die("Ocurrió un error.");
    }
  }

  include 'header.php';
?>

<body>
  <div class="container-fluid">
    <img width="370px" class="center-block" src="logo.png" style="padding: 30px;">
    <form style="max-width: 500px; padding: 15px; margin: 0px auto;" action="/login.php" method="POST">
      <div class="form-group">
        <label class="control-label" for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email">
      </div>
      <div class="form-group">
        <label class="control-label" for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <?php
        if ($login_error) {
          echo 'Usuario o contraseña incorrecta.';
          echo '<br>';
        } else if ($not_approved) {
          echo 'La cuenta aún no ha sido aprovada por el administrador.';
          echo '<br>';
        }
      ?>
      <input type="submit" class="btn btn-lg btn-primary btn-block" value="Entrar">
      <a href="register.php">
        <input style="margin-top: 20px;" type="button" class="btn btn-lg btn-success btn-block" value="Solicitar cuenta">
      </a>
    </form>
  </div>
</body>

<?php
  include 'footer.php';
?>
