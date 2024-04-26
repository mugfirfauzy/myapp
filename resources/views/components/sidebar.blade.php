<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{route('home')}}">MY APP</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">MyApp</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main Menu</li>

            <li class="nav-item dropdown ">
                <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                {{-- <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('') }}">General Dashboard</a>
                    </li>

                </ul> --}}
            </li>

            <li class="menu-header">Product</li>

            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Category</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('category.index') }}">All Category</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('category.create') }}">New Category</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Product</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('product.index') }}">All Product</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('product.create') }}">New Product</a>
                    </li>
                </ul>
            </li>

            <li class="menu-header">Administration</li>

            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Orders</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('order.index') }}">All Orders</a>
                    </li>
                    {{-- <li>
                        <a class="nav-link" href="{{ route('user.create') }}">New User</a>
                    </li> --}}
                </ul>
            </li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Users</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('user.index') }}">All Users</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('user.create') }}">New User</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown ">
                <a href="{{ route('setting.index') }}" class="nav-link"><i class="fas fa-fire"></i><span>Settings</span></a>
                {{-- <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('setting.index') }}">All Users</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('user.create') }}">New User</a>
                    </li>
                </ul> --}}
            </li>

        </ul>
    </aside>
</div>
