<?php
  $user_id = NULL;
  if (isset($_COOKIE['session_token'])) {
    // TODO check db and set user id
  }
  
  $page = $_SERVER['REQUEST_URI'];
  if (!is_null($user_id)) {
    // Logged in
    if ($page == '/' || $page == '/index.php' || $page == '/login.php' || $page == '/register.php') {
      header('Location: /home.php');
    }
  } else {
    // Not logged in
    if (!($page == '/' || $page == '/index.php' || $page == '/login.php' || $page == '/register.php')) {
      header('Location: /');
    }
  }
?>
