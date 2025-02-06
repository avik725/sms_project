<!--  Header Start -->
<header class="app-header">
  <nav class="navbar navbar-expand-lg navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item d-block d-xl-none">
        <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
          <i class="ti ti-menu-2"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link nav-icon-hover" href="javascript:void(0)">
          <i class="ti ti-bell-ringing"></i>
          <div class="notification bg-primary rounded-circle"></div>
        </a>
      </li>
    </ul>
    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
      <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
            aria-expanded="false">
            <img src="{{asset('admin-assets/assets/images/profile/user-1.jpg')}}" alt="" width="35" height="35"
              class="rounded-circle">
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
            <div class="message-body text-center">
              @if ($userGuard === 'admin')
          <i class="ti ti-user fs-user d-inline-block m-2 "></i>
          <a href="javascript:void(0)" class="d-inline-block text-center gap-2 dropdown-item">
          <p class="mb-0 fs-3">{{ucfirst($user->name)}}</p>
          </a>
        @elseif($userGuard === 'staff')
        <div>
        <i class="ti ti-user fs-user d-inline-block m-2"></i>
        <p class="fs-3 text-center mb-2">{{ucfirst($user->name)}}</p>
        <p class="mb-2 fs-3 text-center">{{$user->email}}</p>
        <p class="fs-3 text-center mb-0">Role: {{ucfirst($user->role)}}</p>
        </div>
      @endif
              <form action="{{route($userGuard . '/logout')}}" method="POST">
                @csrf
                <a href="route('$userGuard . '/logout')" aria-expanded="false"
                  class="btn btn-outline-primary mx-3 mt-2 d-block" onclick="event.preventDefault();
        this.closest('form').submit();">Logout</a>
              </form>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</header>
<!--  Header End -->