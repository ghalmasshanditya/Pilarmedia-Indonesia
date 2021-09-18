<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link text-center">
        <img src="{{asset('assets')}}/dist/img/favicon.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light text-center">Pilarmedia Indonesia</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel @if (request()->segment(1) != 'profile') mt-3 pb-3 mb-3  @else mt-1 @endif d-flex">
        @if (request()->segment(1) != 'profile')
        <div class="image">
            @if (Auth::user()->foto == '')
            <img src="{{asset('assets')}}/dist/img/profile.png" class="img-circle elevation-2" alt="User Image">
            @else
            <img src="{{asset('assets')}}/dist/img/{{ Auth::user()->foto }}" class="img-circle elevation-2" alt="User Image">
            @endif
        </div>
        <div class="info">
        <a href="/profile" class="d-block">
            @php
                $nama = Auth::user()->name;
            @endphp
            @if (strlen($nama) > 23)
            @php
                echo substr($nama, 0,23).'...';
            @endphp
            @else
            {{ $nama }}
            @endif
        </a>
        </div>
        @endif
    </div>
    <!-- SidebarSearch Form -->
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
            </button>
        </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/profile" class="nav-link @if (request()->segment(1) == 'profile') active @endif">
            <i class="nav-icon fas fa-user"></i>
            <p>
                Profile
                {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
            </a>
        </li>



        @if (Auth::user()->level == 2)
        <li class="nav-item">
            <a href="/absence-list" class="nav-link @if (request()->segment(1) == 'absence-list') active @endif">
                <i class="nav-icon fas fa-clipboard-check"></i>
            <p>
                Absence
            </p>
            </a>
        </li>
        @elseif (Auth::user()->level == 1)
        <li class="nav-item">
            <a href="/absence-list" class="nav-link @if (request()->segment(1) == 'absence-list' ) active @endif">
                <i class="nav-icon fas fa-clipboard-check"></i>
            <p>
                Absence
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/permissions/request" class="nav-link @if (request()->segment(1) == 'permissions' && request()->segment(2) == 'request') active @endif">
                <i class="nav-icon fas fa-clock"></i>
            <p>
                Request Permissions
            </p>
            </a>
        </li>
        @elseif (Auth::user()->level == 3 && Auth::user()->address !='' && Auth::user()->phone !='' && Auth::user()->gender !='' && Auth::user()->birth !='' )
        <li class="nav-item">
            <a href="/absents" class="nav-link @if (request()->segment(1) == 'absents') active @endif">
                <i class="nav-icon fas fa-clipboard-check"></i>
            <p>
                Absents
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/permissions" class="nav-link @if (request()->segment(1) == 'permissions') active @endif">
            <i class="nav-icon fas fa-briefcase"></i>
            <p>
                Permissions
            </p>
            </a>
        </li>
        @else

        @endif

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
