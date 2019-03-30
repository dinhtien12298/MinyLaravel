<?php

namespace App\Http\Controllers;
use App\Models\PostModel;
use App\Models\SubjectModel;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if ($this->class == 'latest') {
            return $this->detail();
        } else {
            $input['page'] = 'category';
            $input['class'] = $this->class;
            $data = $this->dataComponents($input);
            $all_subjects = $this->getSubjectBasicData();
            $data['data_content'] = $this->getPostBasicData($all_subjects);
            if (Auth::check()) {
                $data['userLogin'] = true;
            }
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
        $tab_title = ($this->class == 'latest') ? 'Mới nhất' : $this->subject;
        $data['class'] = $input['class'];
        $data['subject'] = $input['subject'];
        $data['tab_title'] = $tab_title;
        $data['data_content'] = $this->getPostDetailData($page)['data_content'];
        $data['page_button'] = $this->getPostDetailData($page)['page_button'];
        $data['continue'] = $this->getPostDetailData($page)['continue'];
        if (Auth::check()) {
            $data['userLogin'] = true;
        }
        return view('detail_category', $data);
    }

    public function getSubjectBasicData()
    {
        $class = $this->class;
        $all_subjects = SubjectModel::where('class', $class)->get();
        return $all_subjects;
    }

    public function getPostBasicData($all_subjects)
    {
        $data_content = [];
        foreach ($all_subjects as $subject) {
            $index = $all_subjects->search($subject);
            $data_content[$index] = PostModel::with('user')
                ->join('subjects', 'subjects.id', '=', 'subject_id')
                ->orderBy('posts.id', 'desc')
                ->where('subjects.id', $subject->id)
                ->limit(3)
                ->get();
        }
        return $data_content;
    }

    public function getPostDetailData($page)
    {
        $start_number = 9 * ($page - 1);
        if ($this->class == 'latest') {
            $data_content = PostModel::with('user')
                ->orderBy('id', 'desc')
                ->skip($start_number)
                ->take(9)
                ->get();
            $number_of_records = 27;
        } else {
            $subject_id = SubjectModel::where([
                ['subject', $this->subject],
                ['class', $this->class],
            ])->first()->id;
            $data_content = PostModel::with('user')
                ->orderBy('id', 'desc')
                ->where('subject_id', $subject_id)
                ->skip($start_number)
                ->take(9)
                ->get();
            $number_of_records = PostModel::where('subject_id', $subject_id)->skip($start_number)->take(28)->count();
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
