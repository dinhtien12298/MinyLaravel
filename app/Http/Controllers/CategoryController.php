<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $class;
    protected $subject;
    protected $page;
    public function category($class, $subject = null, $page = null)
    {
        $this->class = $class;
        $this->subject = $subject;
        $this->page = $page;

        if ($page != null) {
            return $this->detail();
        } else {
            return $this->basic();
        }
    }

    public function basic()
    {
        if ($this->class == 'Mới nhất') {
            $this->detail();
        } else {
            $input['page'] = 'category';
            $input['class'] = $this->class;
            $data = $this->dataComponents($input);
            $all_subjects = $this->getSubjectBasicData();
            $data['data_content'] = $this->getPostBasicData($all_subjects);
            $data['page'] = 'category';
            return view('basic_category', $data);
        }
    }

    public function detail()
    {
        $input['page'] = 'category';
        $input['class'] = $this->class;
        $input['subject'] = $this->subject;
        $data = $this->dataComponents($input);
        $page = $this->page;
        $tab_title = ($this->class == 'Mới nhất') ? $this->class : $this->subject;
        $data['tab_title'] = $tab_title;
        $data['data_content'] = $this->getPostDetailData($page)['data_content'];
        $data['page_button'] = $this->getPostDetailData($page)['page_button'];
        $data['continue'] = $this->getPostDetailData($page)['continue'];
        $data['page'] = 'category';
        $data['action'] = 'detailCategory';
        return view('detail_category', $data);
    }

    private function getSubjectBasicData()
    {
        $class = $this->class;
        $all_subjects = DB::table('subjects')->where('class', "$class")->get()->toArray();
        return $all_subjects;
    }

    private function getPostBasicData($all_subjects)
    {
        $data_content = [];
        foreach ($all_subjects as $subject) {
            $index = array_search($subject, $all_subjects);
            $data_content[$index] = DB::table('posts')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->join('subjects', 'subjects.id', '=', 'posts.subject_id')
                ->select('posts.id', 'title', 'view_num', 'like_num', 'content', 'users.fullname', 'subjects.class', 'subjects.subject')
                ->where('subjects.id', '=', $subject->id)
                ->limit(3)
                ->get();
        }
        return $data_content;
    }

    private function getPostDetailData($page)
    {
        $start_number = 9 * ($page - 1);
        if ($this->class == 'Mới nhất') {
            $data_content = DB::table('posts')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->select('posts.id', 'title', 'view_num', 'like_num', 'content', 'users.fullname')
                ->skip($start_number)
                ->take(9)
                ->get();
            $number_of_records = 27;
        } else {
            $subject_id = DB::table('subjects')->where([
                ['subject', "$this->subject"],
                ['class', "$this->class"],
            ])->first()->id;
            $data_content = DB::table('posts')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->select('posts.id', 'title', 'view_num', 'like_num', 'content', 'users.fullname')
                ->where('subject_id', $subject_id)
                ->skip($start_number)
                ->take(9)
                ->get();
            $number_of_records = DB::table('posts')->where('subject_id', $subject_id)->skip($start_number)->take(28);
        }
        $data['page_button'] = $this->calculatePageNumber($page, $number_of_records)['page_number'];
        $data['data_content'] = $data_content;
        $data['continue'] = $this->calculatePageNumber($page, $number_of_records)['continue'];
        return $data;
    }

    public function calculatePageNumber($page, $number_of_records)
    {
        $continue = false;
        if ($number_of_records <= 9) {
            $page_number = $page;
        } elseif ($number_of_records <= 18) {
            $page_number = $page + 1;
        } else {
            $page_number = $page + 2;
        }
        if ($number_of_records > 27) {
            $continue = true;
        }
        $data['continue'] = $continue;
        $data['page_number'] = $page_number;
        return $data;
    }
}
