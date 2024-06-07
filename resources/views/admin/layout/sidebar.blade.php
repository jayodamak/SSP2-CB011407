<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <span class="brand-text font-weight-light nav-link">A Q L Y - Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <br>

                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}" class="nav-link {{ Session::get('page') == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>


                <li class="nav-item menu-open">
                    <a href="#" class="nav-link {{ Session::get('page') == 'cms-pages' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Pages Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/cms-pages') }}" class="nav-link {{ Session::get('page') == 'cms-pages' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>CMS Pages</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item menu-open">
                    <a href="#" class="nav-link {{ in_array(Session::get('page'), ['categories', 'products']) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Catalogue Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/categories') }}" class="nav-link {{ Session::get('page') == 'categories' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/products') }}" class="nav-link {{ Session::get('page') == 'products' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Products</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item menu-open">
                    <a href="#" class="nav-link {{ Session::get('page') == 'users' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/users') }}" class="nav-link {{ Session::get('page') == 'users' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item menu-open">
                    <a href="#" class="nav-link {{ Session::get('page') == 'orders' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-shopping-bag"></i>
                        <p>
                            Orders Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/orders') }}" class="nav-link {{ Session::get('page') == 'orders' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Orders</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item menu-open">
                    <a href="#" class="nav-link {{ Session::get('page') == 'banners' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            Banners Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/banners') }}" class="nav-link {{ Session::get('page') == 'banners' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Banners</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
