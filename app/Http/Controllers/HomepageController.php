<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomepageController extends Controller
{
    protected $list_classes;
    public function __construct()
    {
        $this->list_classes = [
            'Mới nhất',
            'lớp 9',
            'lớp 8'
        ];
    }

    public function homepage()
    {
        $input['page'] = 'homepage';
        $data = $this->dataComponents($input);
        $data['list_buttons'] = $this->getSubjectData();
        $data['data_content'] = $this->getPostData($data['list_buttons']);
        $data['page'] = 'homepage';
        return view('homepage', $data);
    }

    private function getSubjectData()
    {
        $list_buttons = [];
        foreach ($this->list_classes as $class) {
            $index = array_search($class, $this->list_classes);
            $list_buttons[$index] = DB::table('subjects')->select('id', 'subject', 'class')->where('class', "$class")->limit(4)->get();
        }
        return $list_buttons;
    }

    private function getPostData($list_buttons)
    {
        $data_content = [];
        foreach ($this->list_classes as $class_name) {
            $index = array_search($class_name, $this->list_classes);
            $data_content[$index] = [];
            if ($class_name == "Mới nhất") {
                $data_content[$index] = DB::table('posts')
                    ->join('users', 'users.id', '=', 'posts.user_id')
                    ->select('id', 'title', 'view_num', 'like_num', 'content', 'users.fullname')
                    ->limit(6);
            } else {
                $subject = $list_buttons[$index][0]->subject;
                $data_content[$index] = DB::table('posts')
                    ->join('users', 'users.id', '=', 'posts.user_id')
                    ->join('subject', 'subjects.id', '=', 'posts.subject_id')
                    ->select('id', 'title', 'view_num', 'like_num', 'content', 'users.fullname', 'subjects.class', 'subjects.subject')
                    ->where([
                        ['subjects.class', '=', "$class_name"],
                        ['subjects.subject', '=', "$subject"],
                    ])
                    ->limit(6);
            }
        }
        return $data_content;
    }
}
