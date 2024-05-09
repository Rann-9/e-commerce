<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('admin.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="{{ route('admin.list-user') }}">
                <i class="bi bi-file-person"></i>
                <span>List User</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.category.*', 'admin.product.*') ? '' : 'collapsed' }}"
                data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav"
                class="nav-content {{ request()->routeIs('admin.category.*', 'admin.product.*') ? 'show' : '' }} collapse"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.category.index') }}"
                        class="{{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Data Category</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.product.index') }}"
                        class="{{ request()->routeIs('admin.product.*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Data Product</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.transaction.*', 'admin.My-transaction.*') ? '' : 'collapsed' }}"
                data-bs-target="#components-transaction" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Transaction</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-transaction"
                class="nav-content {{ request()->routeIs('admin.transaction.*', 'admin.my-transaction.*') ? 'show' : '' }} collapse"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.transaction.index') }}"
                        class="{{ request()->routeIs('pages.admin.transaction.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Data Transaction</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.my-transaction.index') }}"
                        class="{{ request()->routeIs('admin.my-transaction.index', 'admin.my-transaction.show') ? 'active  ' : '' }}">
                        <i class="bi bi-circle"></i><span>Data My Transaction</span>
                    </a>
                </li>
            </ul>
        </li>

    </ul>

</aside>
