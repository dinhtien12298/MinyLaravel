<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SearchController extends Controller
{
    public function searchPost($keyword)
    {
        $data = DB::table('posts')->select('id', 'title')->where('title', 'like', "%$keyword%")->get();
        echo json_encode($data);
    }

    public function searchTabPost($subject_id)
    {
        $data = DB::table('posts')
            ->select('posts.id', 'title', 'view_num', 'like_num', 'content', 'fullname', 'subject', 'class')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->join('subjects', 'subjects.id', '=', 'posts.subject_id')
            ->where('subjects.id', '=', "$subject_id")
            ->limit(6)
            ->get();
        echo json_encode($data);
    }

    public function deletePost($post_id)
    {
        $delete = DB::table('posts')->where('id', '=', "$post_id")->delete();
        if (!$delete) {
            echo "Xóa bài viết không thành công!";
        } else {
            echo "Xóa bài viết thành công!";
        }
    }

    public function searchSubjects($class)
    {
        $data = DB::table('subjects')->where('class', '=', "$class")->get();
        echo json_encode($data);
    }
}
