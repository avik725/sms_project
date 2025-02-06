<!-- Sidebar Start -->
<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="{{route('dashboard')}}" class="text-nowrap logo-img">
        <img src="{{asset($project_data->project_logo)}}" alt="Logo" class="w-100 h-100">
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('dashboard')}}" aria-expanded="false">
            <span>
              <i class="ti ti-layout-dashboard"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Modules</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('purchases')}}" aria-expanded="false">
            <span>
              <i class="ti ti-shopping-cart"></i>
            </span>
            <span class="hide-menu">Purchase Orders</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('sales')}}" aria-expanded="false">
            <span>
              <i class="ti ti-basket-up"></i>
            </span>
            <span class="hide-menu">Sales Orders</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('transactions')}}" aria-expanded="false">
            <span>
              <i class="ti ti-directions"></i>
            </span>
            <span class="hide-menu">Transactions</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('batch')}}" aria-expanded="false">
            <span>
              <i class="ti ti-layers-intersect"></i>
            </span>
            <span class="hide-menu">Batches</span>
          </a>
        </li>
        @if ($userGuard === 'admin')
      <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">MANAGE</span>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="{{route('admin/items')}}" aria-expanded="false">
        <span>
          <i class="ti ti-list-tree"></i>
        </span>
        <span class="hide-menu">Items</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="{{route('admin/categories')}}" aria-expanded="false">
        <span>
          <i class="ti ti-category"></i>
        </span>
        <span class="hide-menu">Categories</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="{{route('admin/suppliers')}}" aria-expanded="false">
        <span>
          <i class="ti ti-users-group"></i>
        </span>
        <span class="hide-menu">Suppliers</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="{{route('admin/settings')}}" aria-expanded="false">
        <span>
          <i class="ti ti-settings"></i>
        </span>
        <span class="hide-menu">Settings</span>
        </a>
      </li>
    @endif
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">AUTH</span>
        </li>
        @if ($userGuard === 'admin')
      <li class="sidebar-item">
        <a class="sidebar-link" href="{{route('admin/users')}}" aria-expanded="false">
        <span>
          <i class="ti ti-user"></i>
        </span>
        <span class="hide-menu">Users</span>
        </a>
      </li>
    @endif
        <li class="sidebar-item">
          <form method="POST" action="{{ route($userGuard . '/logout') }}">
            @csrf
            <a class="sidebar-link" href="route($userGuard . '/logout')" aria-expanded="false" onclick="event.preventDefault();
        this.closest('form').submit();">
              <span>
                <i class="ti ti-login"></i>
              </span>
              <span class="hide-menu">Logout</span>
            </a>
          </form>
        </li>
      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->