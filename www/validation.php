<?php

  function valid_email($email) {
    return !filter_var($email, FILTER_VALIDATE_EMAIL) === false;
  }

  function valid_password($password) {
    return strlen($password) >= 5;
  }

?>
