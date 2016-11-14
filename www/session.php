<?php
  $user_id = NULL;
  if (isset($_COOKIE['session_token'])) {
    // TODO decrypt cookie, verify user id in database and set user id
    $user_id = "1";
  }
  
  if (is_null($user_id)) {
    if ($require_auth) {
      header('Location: /');
    }
  }
?>
