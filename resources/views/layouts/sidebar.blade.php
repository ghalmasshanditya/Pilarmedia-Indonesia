<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
    <span class="brand-text font-weight-light">Pilarmedia Indonesia</span>
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
        <li class="nav-item">
            <a href="/education" class="nav-link @if (request()->segment(1) == 'education') active @endif">
            <i class="nav-icon fas fa-graduation-cap"></i>
            <p>
                Education
                {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/experience" class="nav-link @if (request()->segment(1) == 'experience') active @endif">
            <i class="nav-icon fas fa-briefcase"></i>
            <p>
                Work Experience
                {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/skills" class="nav-link @if (request()->segment(1) == 'skills') active @endif">
            <i class="nav-icon fas fa-basketball-ball"></i>
            <p>
                Skills
                {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/language" class="nav-link @if (request()->segment(1) == 'language') active @endif">
            <i class="nav-icon fab fa-font-awesome-flag"></i>
            <p>
                Language
                {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/activity" class="nav-link @if (request()->segment(1) == 'activity') active @endif">
            <i class="nav-icon fas fa-hiking"></i>
            <p>
                Activities
                {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/trainings" class="nav-link @if (request()->segment(1) == 'trainings') active @endif">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>
                Trainings
                {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/resume" class="nav-link @if (request()->segment(1) == 'resume') active @endif">
            <i class="nav-icon fas fa-print"></i>
            <p>
                CV / Resume
                {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/preview" class="nav-link bg-info @if (request()->segment(1) == 'resume') active @endif">
            <i class="nav-icon fas fa-file-import"></i>
            <p>
                Preview Profile
                {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
            </a>
        </li>

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
