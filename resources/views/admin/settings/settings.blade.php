<!doctype html>
<html lang="en">

<head>
  @include('Admin/common/header-link')
</head>

<body>

  <!-- Preloader -->
  <div id="preloader">
    <div class="bar-container">
      <div class="bar"></div>
      <div class="bar"></div>
      <div class="bar"></div>
      <div class="bar"></div>
      <div class="bar"></div>
    </div>
    <h1>Hang On !</h1>
    <h1>It's Loading...</h1>
  </div>

  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    @include('Admin/common/sidebar')

    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->

      @include('Admin/common/header')

      <!--  Header End -->
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Settings</h5>
            <form action="{{route('admin/settings-update', $setting->settings_id)}}" method="POST" class="p-4"
              enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-lg-6 mb-3">
                  <label for="project_name" class="form-label">Project Name</label>
                  <input type="text" class="form-control" name="project_name" id="project_name"
                    placeholder="Enter project_name" value="{{$setting->project_name}}"></input>
                  @error('project_name')
            <div class="text-danger">{{$message}}</div>
          @enderror
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="short_name" class="form-label">Short Name</label>
                  <input type="text" class="form-control" name="short_name" id="short_name"
                    placeholder="Enter short_name" value="{{$setting->short_name}}"></input>
                  @error('short_name')
            <div class="text-danger">{{$message}}</div>
          @enderror
                </div>

                <div class="col-lg-6 mb-3">
                  <div class="row">
                    <div class="col-lg-12">
                      <label for="project_logo" class="form-label">Project Logo</label>
                      <input class="form-control" type="file" id="project_logo" name="project_logo" autofocus
                        value="" />
                      @error('project_logo')
              <div class="text-danger">{{$message}}</div>
            @enderror
                    </div>
                    <div class="col-lg-12 my-4">
                      <img class="img-fluid" style="width: 200px;" src="{{asset($setting->project_logo)}}" alt="image">
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-3">
                  <div class="row">
                    <div class="col-lg-12">
                      <label for="login_bg" class="form-label">Project Icon</label>
                      <input class="form-control" type="file" id="login_bg" name="login_bg" autofocus value="" />
                      @error('login_bg')
              <div class="text-danger">{{$message}}</div>
            @enderror
                    </div>
                    <div class="col-lg-12 my-4">
                      <img class="img-fluid" style="width: 200px;" src="{{asset($setting->login_bg)}}" alt="image">
                    </div>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('Admin/common/footer-link')
</body>

</html>