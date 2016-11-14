<?php
  $user_id = NULL;
  if (isset($_COOKIE['session_token'])) {
    // TODO decrypt token into id
    $user_id = $_COOKIE['session_token'];
  }
  
  if (is_null($user_id)) {
    if ($require_auth) {
      header('Location: /');
    }
  }
?>
