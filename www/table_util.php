<?php

  function drawTable($header, $rows) {
    echo '<table style="width:50%">';
    echo '<tr>';
    foreach ($header as $cell) {
      echo '<th>' . $cell . '</th>';
    }
    echo '</tr>';
    foreach ($rows as $row) {
      echo '<tr>';
      foreach ($row as $cell) {
        echo '<td>' . $cell . '</td>';
      }
      echo '</tr>';
    }
    echo '</table>';
  }

?>
