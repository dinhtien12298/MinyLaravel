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
        return response()->json($data);
    }

    public function searchTabPost($subject_id)
    {
        $data = PostModel::with('user')
            ->join('subjects', 'subjects.id', '=', 'subject_id')
            ->orderBy('posts.id', 'desc')
            ->where('subjects.id', $subject_id)
            ->limit(6)
            ->get();
        return response()->json($data);
    }

    public function deletePost($post_id)
    {
        $delete = PostModel::destroy($post_id);
        if (!$delete) {
            return "Xóa bài viết không thành công!";
        } else {
            return "Xóa bài viết thành công!";
        }
    }

    public function searchSubjects($class)
    {
        $data = SubjectModel::where('class', $class)->get();
        return response()->json($data);
    }
}
