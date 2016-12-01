<?php

  function drawTable($header, $rows, $links = NULL) {
    echo '<table class="table table-striped" style="width:100%">';
    echo '<thead>';
    foreach ($header as $cell) {
      echo '<th>' . $cell . '</th>';
    }
    echo '</thead>';
    echo '<tbody>';
    $i = 0;
    foreach ($rows as $row) {
      if ($links) {
        echo '<tr style="cursor: pointer;" onClick="window.document.location=\'' . $links[$i] . '\';">';
      } else {
        echo '<tr>';
      }
      foreach ($row as $cell) {
        echo '<td>' . $cell . '</td>';
      }
      echo '</tr>';
      $i++;
    }
    echo '</tbody>';
    echo '</table>';
  }

?>
