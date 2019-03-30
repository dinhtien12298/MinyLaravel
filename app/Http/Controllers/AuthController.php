<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Foundation\Auth\User;
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

//        $this->validate($request, [
//            'username' => 'bail|required|max:20',
//            'password' => 'required',
//        ]);

        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            return redirect('nguoi-dung/thong-tin-ca-nhan');
        } else {
            $user = UserModel::where('username', $username)->count();
            if ($user == 0) {
                $error = 'Tên tài khoản không tồn tại!';
            } else {
                $error = 'Sai mật khẩu!';
            }
            return redirect()->route('login', ['error' => $error]);
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
            return redirect()->route('signup', ['error' => $error]);
        } elseif ($this->checkUsername($username)) {
            $error = 'Tên tài khoản đã tồn tại!';
            return redirect()->route('signup', ['error' => $error]);
        } elseif ($this->checkEmail($email)) {
            $error = 'Địa chỉ Email đã được sử dụng!';
            return redirect()->route('signup', ['error' => $error]);
        } elseif ($this->checkPhone($phone)) {
            $error = 'Số điện thoại đã được sử dụng!';
            return redirect()->route('signup', ['error' => $error]);
        } else {
            $new_user = new UserModel();
            $new_user->username = $username;
            $new_user->password = bcrypt($password);
            $new_user->fullname = $fullname;
            $new_user->birth = $birth;
            $new_user->phone = $phone;
            $new_user->email = $email;
            $new_user->working = $working;
            $new_user->save();
            $error = 'Đăng ký thành công! Vui lòng đăng nhập!';
            return redirect()->route('login', ['error' => $error]);
        }
    }

    public function checkUsername($username)
    {
        $check = UserModel::where('username', $username)->count();
        if ($check == 0) {
            return false;
        }
        return true;
    }

    public function checkEmail($email)
    {
        $check = UserModel::where('email', $email)->count();
        if ($check == 0) {
            return false;
        }
        return true;
    }

    public function checkPhone($phone)
    {
        $check = UserModel::where('phone', $phone)->count();
        if ($check == 0) {
            return false;
        }
        return true;
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
