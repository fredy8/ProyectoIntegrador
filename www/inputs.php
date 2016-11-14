<? php
 function field($label, $error, $input) {
    echo $label . ':';
    echo $input;
    echo '<br>';
  }

  function textbox_input($name, $label, $error) {
    field($label, $error, '<input type="text" name="' . $name . '">');
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

