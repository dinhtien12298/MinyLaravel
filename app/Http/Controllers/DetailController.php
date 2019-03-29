<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class DetailController extends Controller
{
    public function detail($post_id)
    {
        $input['page'] = 'detail';
        $input['post_id'] = $post_id;
        $data = $this->dataComponents($input);
        $data['post'] = PostModel::with('user')
            ->join('subjects', 'subjects.id', '=', 'subject_id')
            ->where('posts.id', "$post_id")
            ->first();
        $class = $data['post']->class;
        $data['data_more_post'] = PostModel::with('user')
            ->join('subjects', 'subjects.id', '=', 'subject_id')
            ->orderBy('posts.id', 'desc')
            ->where([
                ['class', $class],
                ['posts.id', '!=', $post_id],
            ])
            ->limit(6)
            ->get();
        if (Auth::check()) {
            $data['userLogin'] = true;
        }
        return view('detail', $data);
    }
}
