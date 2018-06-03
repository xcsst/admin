<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>{{ config('params.project_name') }}</b>管理系统</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <span class="hidden-xs">{{ Auth::user()->name }} {{ link_to_route('login.logout', '[退出]') }}</span>
                </li>
            </ul>
        </div>

    </nav>
</header>