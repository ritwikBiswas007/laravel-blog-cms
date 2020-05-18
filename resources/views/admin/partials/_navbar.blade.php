<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>

    </a>


    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    @role('Administrator')
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @yield('users')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
            aria-controls="collapseTwo">
            <i class="fas fa-user    "></i>
            <span>Users</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Select an action:</h6>
                <a class="collapse-item @yield('view-users')" href="{{ route('user.index') }}">
                    <i class="fas fa-eye    "></i> View Users</a>
                <a class="collapse-item @yield('create-users')" href="{{ route('user.create') }}"><i
                        class="fas fa-user-edit    "></i>
                    Create New User</a>
            </div>
        </div>
    </li>

    @endrole

    @role('Administrator|Author')
    <li class="nav-item @yield('posts')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fa fa-file" aria-hidden="true"></i>
            <span>Posts</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Select an action:</h6>
                <a class="collapse-item @yield('view-posts')" href="{{ route('posts.index') }}"><i
                        class="fas fa-eye    "></i> View
                    Posts</a>
                <a class="collapse-item @yield('create-posts')" href="{{ route('posts.create') }}"><i
                        class="fas fa-edit    "></i>
                    Create New Posts</a>
            </div>
        </div>
    </li>
    @endrole

    @role('Administrator')
    <!-- Nav Item - Categories -->
    <li class="nav-item @yield('categories')">
        <a class="nav-link" href="{{ route('categories.index') }}">
            <i class="fas fa-database    "></i>
            <span>Categories</span></a>
    </li>
    @endrole

    @role('Administrator|Author')
    <!-- Nav Item - Media Manager -->
    <li class="nav-item @yield('media-manager')">
        <a class="nav-link" href="/admin/media">
            <i class="fas fa-folder"></i>
            <span>Media Manager</span></a>
    </li>
    @endrole


</ul>