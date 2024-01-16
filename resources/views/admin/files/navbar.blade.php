<nav class="main-header navbar navbar-expand navbar-white navbar-light bg-info">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                    class="fas fa-bars text-light"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- user navbar links -->
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <span class="d-none d-md-inline text-light text-uppercase"><i class="fa-solid fa-id-card-clip"></i>
                    &nbsp;<b>{{ Auth()->user()->name }}</b></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header d-flex justify-content-center bg-info">
                    <strong class="d-flex align-items-center h1 "
                        style="color:#ffffff !important;font-family: Algerian"> {{ Auth()->user()->name }}</strong>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat"><i
                                    class="fa-solid fa-gear"></i> Settings</a>
                        </div>
                        <div class="col-6 ">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right"
                                    onclick="event.preventDefault();
                        this.closest('form').submit();">
                                    <i class="fa-solid fa-right-from-bracket"></i> Sign out
                                </a>
                            </form>
                        </div>
                    </div>

                </li>
            </ul>
        </li>
        {{-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}
    </ul>
</nav>
