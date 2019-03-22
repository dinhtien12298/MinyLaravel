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

        $list_info['Tên tài khoản'] = $this->user->username;
        $list_info['Mật khẩu'] = '**********';
        $list_info['Tên đầy đủ'] = $this->user->fullname;
        $list_info['Tổng số bài viết'] = sizeof($all_posts);
        $list_info['Tổng lượt xem'] = $this->findTotalPostInfo($all_posts)[0];
        $list_info['Tổng lượt thích'] = $this->findTotalPostInfo($all_posts)[1];
        $list_info['Số điện thoại'] = $this->user->phone;
        $list_info['Email'] = $this->user->email;
        $list_info['Ngày sinh'] = $this->user->birth;
        $list_info['Cơ quan/Trường học'] = $this->user->working;

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

        return redirect('/nguoi-dung/cap-nhat-thong-tin');
    }

    public function postManagement()
    {
        $input['page'] = 'userHome';
        $data = $this->dataComponents($input);

        $user_id = $this->user->id;
        $data['all_posts'] = DB::table('posts')
            ->join('subjects', 'subjects.id', '=', 'posts.subject_id')
            ->select('posts.id', 'title', 'view_num', 'like_num', 'content', 'class', 'subject')
            ->where('user_id', $user_id)
            ->get()->toArray();

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
        $data['post_detail'] = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->join('subjects', 'subjects.id', '=', 'posts.subject_id')
            ->select('posts.id', 'title', 'view_num', 'like_num', 'content', 'fullname', 'class', 'subject')
            ->where('posts.id', $post_id)
            ->first();
        $data['all_classes'] = DB::table('classes')->get()->toArray();

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
            return redirect("/nguoi-dung/sua-bai-viet/$post_id/$error");
        } elseif ($content == '') {
            $error = 'Bạn chưa có nội dung!';
            return redirect("/nguoi-dung/sua-bai-viet/$post_id/$error");
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

            return redirect('/nguoi-dung/quan-ly-bai-viet');
        }
    }

    public function getPostCreate($error = null)
    {
        $input['page'] = 'userHome';
        $data = $this->dataComponents($input);

        if ($error != null) {
            $data['error'] = $error;
        }
        $data['all_classes'] = DB::table('classes')->get()->toArray();

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
            return redirect("/nguoi-dung/dang-bai/$error");
        } elseif ($content == '') {
            $error = 'Bạn chưa có nội dung!';
            return redirect("/nguoi-dung/dang-bai/$error");
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

            return redirect('/nguoi-dung/quan-ly-bai-viet');
        }
    }
}
