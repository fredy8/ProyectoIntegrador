<?php
 function field($label, $error, $input) {
    echo $label . ':';
    echo $input;
    if ($error) {
      echo '<font color="red">' . $error . "</font>";
    }
    echo '<br>';
  }

  function textbox_input($name, $label, $error) {
    field($label, $error, '<input type="text" name="' . $name . '">');
  }

  function textarea_input($name, $label, $error) {
    field($label, $error, '<textarea rows="4" cols="50" name="' . $name . '"></textarea>');
  }

  function number_input($name, $label, $error, $min = NULL, $max = NULL) {
    $input = '<input type="number" ';
    if ($min) {
      $input = $input . 'min="' . $min . '" ';
    }
    if ($max) {
      $input = $input . 'max="' . $max . '" ';
    }
    $input = $input . 'name="' . $name . '">';
    field($label, $error, $input);
  }

  function date_input($name, $label, $error) {
    field($label, $error, '<input type="date" name="' . $name . '">');
  }

  function select_input($name, $label, $values, $error) {
    $input = '<select>';
    foreach ($values as $value) {
      $input = $input . '<option value= ' . $value . '>' . $value . '</option>';
    }
    $input = $input . '</select>';
    field($label, $error, $input);
  }

  function time_input($name, $label, $error) {
    $input = '<input type="number" min="1" max="12" name="' . $name . '_hour">:';
    $input = $input . '<input type="number" min="0" max="59" name="' . $name . '_minute">:';
    $input = $input . '<select>';
    foreach (array("AM", "PM") as $value) {
      $input = $input . '<option value= ' . $value . '>' . $value . '</option>';
    }
    $input = $input . '</select>';
    field($label, $error, $input);
  }
?>

