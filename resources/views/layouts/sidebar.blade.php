<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div class="navbar-brand-box">
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="" alt="" height="28">
            </span>
        </a>

        <a href="index" class="logo logo-light">
            <span class="logo-lg">
                <img src="" alt="" height="30">
            </span>
            <span class="logo-sm">
                <img src="" alt="" height="26">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
        <i class="bx bx-menu align-middle"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Dashboard</li>

                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="bx bx-building icon nav-icon"></i>
                        <span class="menu-item" data-key="t-horizontal">Dashboard</span>
                    </a>
                </li>

               @can('view users')
                <li class="menu-title" data-key="t-layouts">User Management</li>

                <li>
                    <a href="{{ route('users.index') }}">
                        <i class="bx bx-user-plus icon nav-icon"></i>
                        <span class="menu-item" data-key="t-horizontal">Users</span>
                    </a>
                </li>

                @endcan

                @can('view equipment')
                    <li class="menu-title" data-key="t-layouts">Equipment Management</li>
                    <li>
                        <a href="{{ route('equipments.index') }}">
                            <i class="bx bx-paste icon nav-icon"></i>
                            <span class="menu-item" data-key="t-horizontal">Equipment</span>
                        </a>
                    </li>
                @endcan

                @can('view equipment assignment')
                    <li class="menu-title" data-key="t-layouts">Assignment Management</li>
                    <li>
                        <a href="{{ route('allocations.index') }}">
                            <i class="bx bx bx-clinic icon nav-icon"></i>
                            <span class="menu-item" data-key="t-horizontal">Manage Allocation</span>
                        </a>
                    </li>
                @endcan

                @can('view equipment returns')
                    <li>
                        <a href="{{ route('returns.index') }}">
                            <i class="bx bx bx-clinic icon nav-icon"></i>
                            <span class="menu-item" data-key="t-horizontal">Manage Returns</span>
                        </a>
                    </li>
                @endcan

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
