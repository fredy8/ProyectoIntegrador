<?php
  unset($_COOKIE['session_token']);
  setcookie('session_token', null, -1, '/');
  header("Location: /");
?>

