<?php
  error_reporting( error_reporting() & ~E_NOTICE );

  $user_id = NULL;
  if (isset($_COOKIE['session_token'])) {
    // TODO decrypt token into id
    $user_id = intval($_COOKIE['session_token']);
  }
  
  if (is_null($user_id)) {
    if ($require_auth) {
      header('Location: /');
    }
  } else if ($user_id !== 1 && $require_admin) {
    header('Location: /home.php');
  }
?>
