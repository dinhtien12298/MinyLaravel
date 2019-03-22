<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- Import Icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- Link CSS -->
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <!-- Import WebLogo -->
    <link rel="icon" href="{{ asset('images/all/logo-web.png') }}">
    <title>Miny</title>
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <div class="close-form" onclick="directTo('/')"><i class="fas fa-times"></i></div>
            <form method="post" action="{{ route('login') }}">
                {{csrf_field()}}
                <p class="form-title f-regular-25">Đăng nhập</p>
                <div class="main-form">
                    <input class="username-input-login" type="text" name="username" placeholder="Tên đăng nhập" required>
                    <input class="password-input-login" type="password" name="password" placeholder="Mật khẩu" required>
                    @if (isset($error))
                        <div class="login-messages f-regular-17">{{ $error }}</div>
                    @endif
                    <button class="f-bold-15 login-user" type="submit" name="submit">Đăng nhập</button>
                </div>
                <div class="footer-form f-regular-14">
                    <p>
                        Bạn chưa có tài khoản?
                        <a href="{{ route("signup") }}">Đăng ký</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/common.js') }}"></script>
</body>
</html>
