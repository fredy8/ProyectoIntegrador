<?php
 function field($label, $error, $input) {
    echo $label . ':';
    echo $input;
    if ($error) {
      echo '<font color="red">' . $error . "</font>";
    }
    echo '<br>';
  }

  function textbox_input($name, $label, $error, $initial_value = "") {
    field($label, $error, '<input type="text" value="' . $initial_value . '" name="' . $name . '">');
  }

  function textarea_input($name, $label, $error, $initial_value = "") {
    field($label, $error, '<textarea rows="4" cols="50" value="' . $initial_value .'" name="' . $name . '"></textarea>');
  }

  function number_input($name, $label, $error, $min = NULL, $max = NULL, $initial_value = 0) {
    $input = '<input type="number" ';
    if ($min) {
      $input = $input . 'min="' . $min . '" ';
    }
    if ($max) {
      $input = $input . 'max="' . $max . '" ';
    }
    $input = $input . 'value="' . $initial_value . '" ';
    $input = $input . 'name="' . $name . '">';
    field($label, $error, $input);
  }

  function date_input($name, $label, $error, $initial_value = NULL) {
    if ($initial_value !== NULL) {
      field($label, $error, '<input type="date" value="' . $initial_value . '" name="' . $name . '">');
    } else {
      field($label, $error, '<input type="date" name="' . $name . '">');
    }
  }

  function select_input($name, $label, $values, $error, $initial_value = NULL) {
    $input = '<select name="' . $name .'">';
    foreach ($values as $value) {
      if ($initial_value === $value) {
        $input = $input . '<option selected="selected" value="' . $value . '">' . $value . '</option>';
      } else {
        $input = $input . '<option value="' . $value . '">' . $value . '</option>';
      }
    }
    $input = $input . '</select>';
    field($label, $error, $input);
  }

  function time_input($name, $label, $error, $initial_hour = 1, $initial_minute = 0, $initial_ampm = "AM") {
    $input = '<input type="number" min="1" max="12" value="' . $initial_hour . '" name="' . $name . '_hour">:';
    $input = $input . '<input type="number" min="0" max="59" value="' . $initial_minute .'" name="' . $name . '_minute">:';
    $input = $input . '<select name="' . $name .'">';
    foreach (array("AM", "PM") as $value) {
      if ($initial_ampm === $value) {
        $input = $input . '<option selected="selected" value= ' . $value . '>' . $value . '</option>';
      } else {
        $input = $input . '<option value= ' . $value . '>' . $value . '</option>';
      }
    }
    $input = $input . '</select>';
    field($label, $error, $input);
  }
?>

