<?php

  function drawTable($header, $rows, $links = NULL) {
    echo '<table style="width:50%">';
    echo '<tr>';
    foreach ($header as $cell) {
      echo '<th>' . $cell . '</th>';
    }
    echo '</tr>';
    $i = 0;
    foreach ($rows as $row) {
      if ($links) {
        echo '<tr onClick="window.document.location=\'' . $links[$i] . '\';">';
      } else {
        echo '<tr>';
      }
      foreach ($row as $cell) {
        echo '<td>' . $cell . '</td>';
      }
      echo '</tr>';
      $i++;
    }
    echo '</table>';
  }

?>
