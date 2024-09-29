<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-12">
      <span class="brand-text font-weight-light">C.P.S</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <i class="fas fa-user-circle img-circle elevation-2" style="font-size: 40px; color: #fff;"></i>
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('cps.admin.dependency') }}" class="nav-link">
              <i class="nav-icon far fa-building"></i>
              <p>
                Gestion de Dependencias
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('cps.admin.contractor') }}" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Gestion de Contratistas
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
