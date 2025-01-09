<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="{{asset("assets/css/login_page.css")}}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</head>

<body>
  <!-- Section: Design Block -->
  <section class="background-radial-gradient overflow-hidden align-content-center">
    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
      <div class="row gx-lg-5 align-items-center mb-5">
        <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
          <h1 class="mt-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">{{$project_data->project_name}}</h1>
          <h2 class="my-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
            The Best Thing You Will Need <br />
            <span style="color: #4351cd;">For Your Business</span>
          </h2>
          <p class="mb-4 opacity-70" style="color: hsl(218deg 45.38% 88.09%)">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
            Temporibus, expedita iusto veniam atque, magni tempora mollitia
            dolorum consequatur nulla, neque debitis eos reprehenderit quasi
            ab ipsum nisi dolorem modi. Quos?
          </p>
        </div>

        <div class="col-lg-4 offset-lg-1 mb-5 mb-lg-0 position-relative">
          <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
          <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

          <div class="card bg-glass">
            <div class="card-body px-4 py-5 px-md-5">
              <form method="POST" action="{{route('login')}}">
                @csrf
                <h3 class="mb-4 fw-bold text-center" style="color: hsl(218deg 1.57% 31.79%);">Admin Login</h3>
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                  <label class="form-label" for="email">Email address</label>
                  <input type="email" id="email" name="email" class="form-control" />
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                  <label class="form-label" for="password">Password</label>
                  <input type="password" id="password" name="password" class="form-control" />
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">
                  Log In
                  <i class="ti ti-login-2"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>