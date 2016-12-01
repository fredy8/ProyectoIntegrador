<nav class="navbar navbar-default" style="margin-bottom: 30px;">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar">
        </span>
        <span class="icon-bar">
        </span>
        <span class="icon-bar">
        </span>
      </button>
      <a class="navbar-brand" href="#" style="padding: 7px 20px;">
        <img src="logo.png" height="36px">
      </a>
      </div>
      <div id="navbar" class="navbar-collapse collapse" aria-expanded="false">
        <ul class="nav navbar-nav">
          <?php
            if ($user_id === 1) {
              echo '<li class=""><a href="/pending_registrations.php">Registros Pendientes</a></li>';
            }
          ?>
          <li class=""><a href="/schools.php">Escuelas</a></li>
          <li class=""><a href="/events.php">Eventos</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="/logout.php">Salir</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
