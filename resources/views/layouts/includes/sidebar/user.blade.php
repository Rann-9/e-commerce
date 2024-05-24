<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="index.html">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user.my-transaction.*') ? '' : 'collapsed' }}"
                data-bs-target="#components-transaction" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Transaction</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-transaction"
                class="nav-content {{ request()->routeIs('user.my-transaction.index') ? 'show' : '' }} collapse"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('user.my-transaction.index') }}"
                        class="{{ request()->routeIs('user.my-transaction.index', 'user.my-transaction.show') ? 'active  ' : '' }}">
                        <i class="bi bi-circle"></i><span>Data My Transaction</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>

</aside>
