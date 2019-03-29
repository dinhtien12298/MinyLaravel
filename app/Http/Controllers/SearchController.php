<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use DB;

class SearchController extends Controller
{
    public function searchPost($keyword)
    {
        $data = PostModel::select('id', 'title')->where('title', 'like', "%$keyword%")->get();
        echo json_encode($data);
    }

    public function searchTabPost($subject_id)
    {
        $data = PostModel::join('users', 'users.id', '=', 'posts.user_id')
            ->join('subjects', 'subjects.id', '=', 'posts.subject_id')
            ->where('subjects.id',"$subject_id")
            ->limit(6)
            ->get();
        echo json_encode($data);
    }

    public function deletePost($post_id)
    {
        $delete = PostModel::where('id',"$post_id")->delete();
        if (!$delete) {
            echo "Xóa bài viết không thành công!";
        } else {
            echo "Xóa bài viết thành công!";
        }
    }

    public function searchSubjects($class)
    {
        $data = SubjectModel::where('class', "$class")->get();
        echo json_encode($data);
    }
}
