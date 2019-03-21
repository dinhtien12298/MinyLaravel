<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class AuthController extends Controller
{
    public function getLogin($error = null)
    {
        $input['error'] = ($error != null) ? $error : '';
        return view('login', $input);
    }

    public function postLogin(Request $request)
    {
        $username = $request['username'];
        $password = $request['password'];
        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            return redirect('nguoi-dung/thong-tin-ca-nhan');
        } else {
            $user = DB::table('users')->where('username', '=', "$username")->count();
            if ($user == 0) {
                $error = 'Tên tài khoản không tồn tại!';
            } else {
                $error = 'Sai mật khẩu!';
            }
            return redirect("dang-nhap/$error");
        }
    }

    public function getSignup($error = null)
    {
        $input['error'] = ($error != null) ? $error : '';;
        return view('signup', $input);
    }

    public function postSignup(Request $request)
    {
        $username = $request['username'];
        $fullname = $request['fullname'];
        $password = $request['password'];
        $confirm_password = $request['confirm_password'];
        $birth = $request['birth'];
        $phone = $request['phone'];
        $email = $request['email'];
        $working = $request['working'];

        if ($password != $confirm_password) {
            $error = 'Mật khẩu không trùng nhau!';
            return redirect("dang-ky/$error");
        } elseif ($this->checkUsername($username)) {
            $error = 'Tên tài khoản đã tồn tại!';
            return redirect("dang-ky/$error");
        } elseif ($this->checkEmail($email)) {
            $error = 'Địa chỉ Email đã được sử dụng!';
            return redirect("dang-ky/$error");
        } elseif ($this->checkPhone($phone)) {
            $error = 'Số điện thoại đã được sử dụng!';
            return redirect("dang-ky/$error");
        } else {
            $sign_up = DB::table('users')->insert([
                'username' => "$username",
                'fullname' => "$fullname",
                'password' => bcrypt($password),
                'birth' => "$birth",
                'phone' => "$phone",
                'email' => "$email",
                'working' => "$working",
            ]);
            if (!$sign_up) {
                $error = 'Đăng ký không thành công!';
                return redirect("dang-ky/$error");
            } else {
                $error = 'Đăng ký thành công! Vui lòng đăng nhập!';
                return redirect("dang-nhap/$error");
            }
        }
    }

    public function checkUsername($username)
    {
        $check = DB::table('users')->where('username', '=', "$username")->count();
        if ($check == 0) {
            return false;
        }
        return true;
    }

    public function checkEmail($email)
    {
        $check = DB::table('users')->where('email', '=', "$email")->count();
        if ($check == 0) {
            return false;
        }
        return true;
    }

    public function checkPhone($phone)
    {
        $check = DB::table('users')->where('phone', '=', "$phone")->count();
        if ($check == 0) {
            return false;
        }
        return true;
    }

    public function logout()
    {
        Auth::logout();
        return redirect('dang-nhap');
    }
}
