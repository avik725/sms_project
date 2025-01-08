<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('assets/css/login_page.css')}}">
  <link rel="icon" href="">
  <!-- icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <title>login page</title>
</head>
<body>
  <div class="login-box">
    <form action="{{route('login')}}" method="POST">
      @csrf
      <h2>Login</h2>
      <div class="input-box">
        <span class="icon">
          <i class="fa-solid fa-envelope"></i>
        </span>
        <input type="email" name="email" id="email" required>
        <label for="">Email</label>
      </div>
      <div class="input-box">
        <span class="icon">
          <i class="fa-solid fa-lock"></i>
        </span>
        <input type="password" name="password" id="password" required>
        <label for="">password</label>
      </div>
      <div class="remember-forgot">
        <label>
          <input type="checkbox"> Remember me
        </label>
        <a href="#">forgot password?</a>
      </div>
      <button type="submit">Login</button>
      <div class="link">
        <p>
          Don't have an account?
          <a href="#">Register</a>
        </p>
      </div>
    </form>
  </div>
</body>
</html>