<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{asset("assets/css/login2.css")}}">
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/favicon.png')}}">
</head>

<body>
    <div id="container">
        <div class="login">
            <div class="content">
                <img src="{{asset($project_data->project_logo)}}" style="height: 110px;width: 279px;margin-bottom: 7px;"
                    alt="">
                <h1>Admin Login</h1>
                <form method="POST" action="{{route('admin/login')}}">
                    @csrf
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" />
                    @error('email')
                    <p class="error-msg">{{ $message }}</p> @enderror

                    <input type="password" name="password" placeholder="Password" />
                    @error('password')
                    <p class="error-msg">{{ $message }}</p> @enderror

                    <button>LogIn</button>
                </form>

            </div>
        </div>
        <div class="page front">
            <div class="content">
                <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none"
                    stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <h1>Hello !</h1>
                <p>If you're Staff ? Click Below</p>
                <button type="" id="staffLogin">Staff Login <svg xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 16 16 12 12 8" />
                        <line x1="8" y1="12" x2="16" y2="12" />
                    </svg></button>
            </div>
        </div>
        <div class="page back">
            <div class="content">
                <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none"
                    stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <h1>Hello !</h1>
                <p>If you're Admin ? Click Below</p>
                <button type="" id="AdminLogin"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 8 8 12 12 16" />
                        <line x1="16" y1="12" x2="8" y2="12" />
                    </svg> Log In</button>
            </div>
        </div>
        <div class="register">
            <div class="content">
                <img src="{{asset($project_data->project_logo)}}" style="height: 110px;width: 279px;margin-bottom: 7px;"
                    alt="">
                <h1>Staff Login</h1>
                <form method="POST" action="{{route('staff/login')}}">
                    @csrf
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" />
                    @error('email')
                    <p class="error-msg">{{ $message }}</p> @enderror

                    <input type="password" name="password" placeholder="Password" />
                    @error('password')
                    <p class="error-msg">{{ $message }}</p> @enderror

                    <button>Log In</button>
                </form>

            </div>
        </div>
    </div>

    <script src="{{asset("assets/js/login.js")}}"></script>
</body>

</html>