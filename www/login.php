<?php
  $require_auth = false;

  include 'php_header.php';
  include 'validation.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $login_error = false;
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
  <form action="/login.php" method="POST">
    Email:<br>
    <input type="text" name="email">
    <br>
    Password:<br>
    <input type="password" name="password">
    <br>
    <?php
      if ($login_error) {
        echo 'Usuario o contraseña incorrecta.';
        echo '<br>';
      } else if ($not_approved) {
        echo 'La cuenta aún no ha sido aprovada por el administrador.';
        echo '<br>';
      }
    ?>
    <input type="submit" value="Log in">
  </form>
</body>

<?php
  include 'footer.php';
?>
