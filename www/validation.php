<?php

  function valid_email($email) {
    return !filter_var($email, FILTER_VALIDATE_EMAIL) === false;
  }

  function valid_password($password) {
    return strlen($password) >= 5;
  }

  function valid_time($hour, $minute, $ampm) {
    return is_numeric($hour) && is_numeric($minute)
      && 0 < $hour && $hour <= 12
      && 0 <= $minute && $minute < 60
      && (ampm === 'am' || ampm === 'pm');
  }

?>
