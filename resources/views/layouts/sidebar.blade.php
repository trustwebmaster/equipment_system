<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
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
                    <a href="javascript: void(0);">
                        <i class="bx bx-home-alt icon nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboard">Dashboard</span>
                        <span class="badge rounded-pill bg-primary">2</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="index" data-key="t-ecommerce">Ecommerce</a></li>
                    </ul>
                </li>



                <li class="menu-title" data-key="t-layouts">Manage Users</li>

                <li>
                    <a href="{{ route('user.index') }}">
                        <i class="bx bx-user-plus icon nav-icon"></i>
                        <span class="menu-item" data-key="t-horizontal">Users</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="bx bx-bookmark icon nav-icon"></i>
                        <span class="menu-item" data-key="t-horizontal">Roles</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="bx bx-plus-medical icon nav-icon"></i>
                        <span class="menu-item" data-key="t-horizontal">Assign Roles</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
