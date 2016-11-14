<?php
  $require_auth = true;
  $require_admin = true;
  include 'php_header.php';
  include 'header.php';
?>

<body>
  <?php include 'menu.php'; ?>
  <br>
  <?php
    function renderRequest($email) {
      echo '<tr>';
      echo '<form action="/accept_request.php" method="POST">';
      echo '<input type="text" name="email" value="' . $email . '" readonly>';
      echo '<input type="radio" name="approve" value="1" checked>Aprobar';
      echo '<input type="radio" name="approve" value="0">Denegar';
      echo '<button type="submit">Enviar</button>';
      echo '</form>';
      echo '</tr>';
    }

    if ($result = $conn->query("select email from users where approved=0")) {
      while ($row = $result->fetch_assoc()) {
        renderRequest($row["email"]);
      }
    } else {
      die("Ocurrió un error.");
    }
  ?>
</body>

<?php
  include 'footer.php';
?>
