<?php
  $require_auth = true;
  $require_admin = true;
  include 'php_header.php';
  include 'header.php';
?>

<body>
  <?php include 'menu.php'; ?>
  <div class="container">
    <br>
    <?php
      function renderRequest($name, $email) {
        echo '<tr>';
        echo '<form action="/handle_request.php" method="POST">';
        echo '<input style="margin: 10px;" type="text" name="name" value="' . $name . '" readonly>';
        echo '<input style="margin: 10px;" type="text" name="email" value="' . $email . '" readonly>';
        echo '<input style="margin: 10px;" type="radio" name="approve" value="1" checked>Aprobar';
        echo '<input style="margin: 10px;" type="radio" name="approve" value="0">Denegar';
        echo '<button style="margin: 10px;" type="submit" class="btn btn-success">Enviar</button>';
        echo '</form>';
        echo '</tr>';
      }

      if ($result = $conn->query("select name, email from users where approved=0")) {
        while ($row = $result->fetch_assoc()) {
          renderRequest($row["name"], $row["email"]);
        }
      } else {
        die("Ocurrió un error.");
      }
    ?>
  </div>
</body>

<?php
  include 'footer.php';
?>
