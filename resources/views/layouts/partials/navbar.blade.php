<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #ADBBC6;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('home') }}" class="nav-link">Inicio</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link btn btn-link" style="color: inherit; text-decoration: none;">
              <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </button>
          </form>
        </li>
      </ul>
</nav>
