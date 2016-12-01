<a href="/home.php">Inicio</a>
<?php
  if ($user_id === 1) {
    echo '<a href="/pending_registrations.php">Registros Pendientes</a>';
  }
?>
<a href="/schools.php">Escuelas</a>
<a href="/events.php">Eventos</a>
<a href="/logout.php">Salir</a>
