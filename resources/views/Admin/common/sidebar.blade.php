<!-- Sidebar Start -->
<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="{{route('admin/dashboard')}}" class="text-nowrap logo-img">
       <h1 class="fw-bolder">{{$project_data->project_name}}</h1>
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
          <a class="sidebar-link" href="{{route('admin/dashboard')}}" aria-expanded="false">
            <span>
              <i class="ti ti-layout-dashboard"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">UI COMPONENTS</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('admin/purchases')}}" aria-expanded="false">
            <span>
              <i class="ti ti-shopping-cart"></i>
            </span>
            <span class="hide-menu">Purchase Orders</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./ui-alerts.html" aria-expanded="false">
            <span>
              <i class="ti ti-alert-circle"></i>
            </span>
            <span class="hide-menu">Alerts</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('admin/transactions')}}" aria-expanded="false">
            <span>
              <i class="ti ti-directions"></i>
            </span>
            <span class="hide-menu">Transactions</span>
          </a>
        </li>
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
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">AUTH</span>
        </li>
        <li class="sidebar-item">
          <form method="POST" action="{{ route('admin/logout') }}">
            @csrf
            <a class="sidebar-link" href="route('admin.logout')" aria-expanded="false" onclick="event.preventDefault();
        this.closest('form').submit();">
              <span>
                <i class="ti ti-login"></i>
              </span>
              <span class="hide-menu">Logout</span>
            </a>
          </form>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
            <span>
              <i class="ti ti-user-plus"></i>
            </span>
            <span class="hide-menu">Register</span>
          </a>
        </li>
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">EXTRA</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
            <span>
              <i class="ti ti-mood-happy"></i>
            </span>
            <span class="hide-menu">Icons</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
            <span>
              <i class="ti ti-aperture"></i>
            </span>
            <span class="hide-menu">Sample Page</span>
          </a>
        </li>
      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->