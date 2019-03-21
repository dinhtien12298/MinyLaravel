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
    <div class="login-container signup-container">
        <div class="login-form">
            <div class="close-form" onclick="directTo('/')"><i class="fas fa-times"></i></div>
            <form method="post" action="{{ url('dang-ky') }}">
                {{ csrf_field() }}
                <p class="form-title f-regular-25">Đăng ký tài khoản</p>
                <div class="main-form">
                    <div class="input-container">
                        <input class="username-input" type="text" name="username" placeholder="Tên đăng nhập" required>
                        <input class="fullname-input" type="text" name="fullname" placeholder="Tên đầy đủ" required>
                        <input class="password-input" type="password" name="password" placeholder="Mật khẩu" required>
                        <input class="confirm-password-input" type="password" name="confirm_password" placeholder="Nhập lại mật khảu" required>
                        <input class="birth-input" type="date" name="birth" required>
                        <input class="phone-input" type="number" name="phone" placeholder="Số điện thoại" required>
                        <input class="email-input" type="email" name="email" placeholder="Email" required>
                        <input class="working-input" type="text" name="working" placeholder="Cơ quan/Trường học" required>
                    </div>
                    @if (isset($error))
                        <div class="signup-messages f-regular-17">{{ $error }}</div>
                    @endif
                    <button class="f-bold-15 signup-user" type="submit" name="submit">Đăng ký</button>
                </div>
                <div class="footer-form f-regular-14">
                    <p>
                        Bạn đã có tài khoản?
                        <a href="{{ url("dang-nhap") }}">Đăng nhập</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/common.js') }}"></script>
</body>
</html>
