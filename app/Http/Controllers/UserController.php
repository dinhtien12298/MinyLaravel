<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\PostModel;
use App\Models\SubjectModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class UserController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function getInformation()
    {
        $input['page'] = 'userHome';
        $data = $this->dataComponents($input);

        $user_id = $this->user->id;
        $all_posts = PostModel::join('subjects', 'subjects.id', '=', 'posts.subject_id')
            ->select('posts.id', 'title', 'view_num', 'like_num', 'content', 'class', 'subject')
            ->where('user_id', $user_id)
            ->get();

        $username_title = 'Tên tài khoản';
        $password_title = 'Mật khẩu';
        $fullname_title = 'Tên đầy đủ';
        $total_post_title = 'Tổng số bài viết';
        $total_view_title = 'Tổng lượt xem';
        $total_like_title = 'Tổng lượt thích';
        $phone_title = 'Số điện thoại';
        $email_title = 'Email';
        $birth_title = 'Ngày sinh';
        $working_title = 'Cơ quan/Trường học';

        $list_info[$username_title] = $this->user->username;
        $list_info[$password_title] = '**********';
        $list_info[$fullname_title] = $this->user->fullname;
        $list_info[$total_post_title] = sizeof($all_posts);
        $list_info[$total_view_title] = $this->findTotalPostInfo($all_posts)[0];
        $list_info[$total_like_title] = $this->findTotalPostInfo($all_posts)[1];
        $list_info[$phone_title] = $this->user->phone;
        $list_info[$email_title] = $this->user->email;
        $list_info[$birth_title] = $this->user->birth;
        $list_info[$working_title] = $this->user->working;

        $data['list_info'] = $list_info;
        $data['page'] = 'information';
        $data['userLogin'] = true;

        return view('userHome', $data);
    }

    public function findTotalPostInfo($all_posts)
    {
        $view_number = 0;
        $like_number = 0;
        foreach ($all_posts as $post) {
            $view_number += $post->view_num;
            $like_number += $post->like_num;
        }
        return [$view_number, $like_number];
    }

    public function getUpdateInfo($error = null)
    {
        $input['page'] = 'userHome';
        $data = $this->dataComponents($input);

        $data['user'] = $this->user;
        if ($error != null) {
            $data['error'] = $error;
        }

        $data['page'] = 'updateInfo';
        $data['userLogin'] = true;

        return view('userHome', $data);
    }

    public function postUpdateInfo(Request $request)
    {
        $username = $request['username'];
        $password = $request['password'];
        $phone = $request['phone'];
        $email = $request['email'];
        $working = $request['working'];

        $user = UserModel::where('username', $username)->first();
        $user->password = bcrypt($password);
        $user->phone = $phone;
        $user->email = $email;
        $user->working = $working;
        $user->save();

        $error = 'Cập nhật thông tin thành công!';
        return redirect()->route('user.update', ['error' => $error]);
    }

    public function postManagement()
    {
        $input['page'] = 'userHome';
        $data = $this->dataComponents($input);

        $user_id = $this->user->id;
        $data['all_posts'] = PostModel::join('subjects', 'subjects.id', '=', 'posts.subject_id')
            ->select('posts.id', 'title', 'view_num', 'like_num', 'content', 'class', 'subject')
            ->where('user_id', $user_id)
            ->get();

        $data['page'] = 'postManagement';
        $data['userLogin'] = true;

        return view('userHome', $data);
    }

    public function getEditPost($post_id, $error = null)
    {
        $input['page'] = 'userHome';
        $data = $this->dataComponents($input);

        if ($error != null) {
            $data['error'] = $error;
        }
        $data['post_detail'] = PostModel::join('users', 'users.id', '=', 'posts.user_id')
            ->join('subjects', 'subjects.id', '=', 'posts.subject_id')
            ->select('posts.id', 'title', 'view_num', 'like_num', 'content', 'fullname', 'class', 'subject')
            ->where('posts.id', $post_id)
            ->first();

        $data['page'] = 'postUpdate';
        $data['userLogin'] = true;

        return view('userHome', $data);
    }

    public function postEditPost($post_id, Request $request)
    {
        $data['post_detail'] = PostModel::join('users', 'users.id', '=', 'posts.user_id')
            ->join('subjects', 'subjects.id', '=', 'posts.subject_id')
            ->select('posts.id', 'title', 'view_num', 'like_num', 'content', 'fullname', 'class', 'subject')
            ->where('posts.id', $post_id)
            ->get();

        $title = $request['title'];
        $subject = $request['subject'];
        $class = $request['class'];
        $content = $request['content'];

        if ($title == '') {
            $error = 'Bạn chưa nhập tiêu đề!';
            return redirect()->route('user.edit', ['post_id' => $post_id, 'error' => $error]);
        } elseif ($content == '') {
            $error = 'Bạn chưa có nội dung!';
            return redirect()->route('user.edit', ['post_id' => $post_id, 'error' => $error]);
        } else {
            $subject = SubjectModel::where([
                    ['subject', "$subject"],
                    ['class', "$class"],
                ])
                ->first();
            $subject_id = $subject->id;
            $post = PostModel::find($post_id);
            $post->title = $title;
            $post->content = $content;
            $post->subject_id = $subject_id;
            $post->save();

            return redirect()->route('user.postManagement');
        }
    }

    public function getPostCreate($error = null)
    {
        $input['page'] = 'userHome';
        $data = $this->dataComponents($input);

        if ($error != null) {
            $data['error'] = $error;
        }

        $data['page'] = 'postCreate';
        $data['userLogin'] = true;

        return view('userHome', $data);
    }

    public function postPostCreate(Request $request)
    {
        $title = $request['title'];
        $subject = $request['subject'];
        $class = $request['class'];
        $content = $request['content'];
        $user_id = $this->user->id;

        if ($title == '') {
            $error = 'Bạn chưa nhập tiêu đề!';
            return redirect()->route('user.postCreate', ['error' => $error]);
        } elseif ($content == '') {
            $error = 'Bạn chưa có nội dung!';
            return redirect()->route('user.postCreate', ['error' => $error]);
        } else {
            $subject = SubjectModel::where([
                    ['subject', "$subject"],
                    ['class', "$class"],
                ])
                ->first();
            $subject_id = $subject->id;

            $new_post = new PostModel();
            $new_post->title = $title;
            $new_post->content = $content;
            $new_post->subject_id = $subject_id;
            $new_post->user_id = $user_id;
            $new_post->save();

            return redirect()->route('user.postManagement');
        }
    }
}
