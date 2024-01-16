<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-info elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link bg-info">
        @if (!empty($setting->logo))
            <img src="{{ asset('public/storage/logo/' . $setting->logo) }}" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
        @endif
        @if (!empty($setting->title))
            <strong class="brand-text">{{ $setting->title }}</strong>
        @endif
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-gauge"></i>
                        <p>
                            Dashboard
                            <span class="right badge badge-light text-dark">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('slider') }}"
                        class="nav-link {{ request()->routeIs('slider') || request()->routeIs('slider.create') || request()->routeIs('slider.edit') || request()->routeIs('slider.show') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-film"></i>
                        <p>
                            Slider
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
