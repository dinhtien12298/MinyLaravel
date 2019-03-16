<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DetailController extends Controller
{
    public function detail($post_id)
    {
        $input['page'] = 'detail';
        $input['post_id'] = $post_id;
        $data = $this->dataComponents($input);
        $data['post'] = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->join('subjects', 'subjects.id', '=', 'posts.subject_id')
            ->select('posts.id', 'title', 'view_num', 'like_num', 'content', 'fullname', 'subject', 'class')
            ->where('posts.id', '=', "$post_id")
            ->first();
        $class = $data['post']->class;
        $data['data_more_post'] = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->join('subjects', 'subjects.id', '=', 'posts.subject_id')
            ->select('posts.id', 'title', 'view_num', 'like_num', 'content', 'fullname', 'subject', 'class')
            ->where([
                ['class', '=', "$class"],
                ['posts.id', '!=', "$post_id"],
            ])
            ->limit(6)->get();

        return view('detail', $data);
    }
}
