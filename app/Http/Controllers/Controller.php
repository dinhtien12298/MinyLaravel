<?php

namespace App\Http\Controllers;

use App\Models\AdvertimentModel;
use App\Models\ClassModel;
use App\Models\PostModel;
use App\Models\SubjectModel;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dataComponents($input)
    {
        $class = isset($input['class']) ? $input['class'] : '';
        $subject = isset($input['subject']) ? $input['subject'] : '';
        $post_id = isset($input['post_id']) ? $input['post_id'] : '';
        $data['all_classes'] = $this->getMenu()['all_classes'];
        $data['data_menu'] = $this->getMenu()['data_menu'];
        $data['class_images'] = $this->getMenu()['class_images'];
        $data['data_footer'] = $this->getFooter();
        if ($input['page'] != 'homepage' && $input['page'] != 'userHome') {
            $data['all_ads'] = $this->getSideBar($post_id)['all_ads'];
            $data['banner_title'] = $this->getBanner($class, $subject, $post_id)['banner_title'];
            $data['breadcrumb'] = $this->getBanner($class, $subject, $post_id)['breadcrumb'];
        }
        if($input['page'] == 'detail') {
            $data['data_related'] = $this->getSideBar($post_id)['data_related'];
        }
        return $data;
    }

    public function getMenu()
    {
        $data = [];
        $data_menu = [];
        $all_classes = ClassModel::all()->reverse();
        foreach ($all_classes as $class) {
            $index = $all_classes->search($class);
            $data_menu[$index][0] = [];
            $data_menu[$index][1] = [];
            $class_name = $class->class;
            $all_menu[$index] = SubjectModel::where('class', $class_name)->get();
            $class_images[$index] = explode(" ", $class_name);
            for ($i = 0; $i < sizeof($all_menu[$index]) - intval(sizeof($all_menu[$index]) / 2); $i++) {
                array_push($data_menu[$index][0], $all_menu[$index][$i]);
            }
            for ($i = intval(sizeof($all_menu[$index]) / 2) + 1; $i < sizeof($all_menu[$index]); $i++) {
                array_push($data_menu[$index][1], $all_menu[$index][$i]);
            }
        }
        $data['all_classes'] = $all_classes;
        $data['data_menu'] = $data_menu;
        $data['class_images'] = $class_images;
        return $data;
    }

    public function getBanner($class, $subject, $post_id)
    {
        $data = [];
        if ($class != '') {
            $input['class'] = $class;
            if ($subject != '') {
                $input['subject'] = $subject;
            }
            $data['breadcrumb'] = $this->breadcrumb($input);
            $data['banner_title'] = "$class - GIẢI BÀI TẬP $class";
        } elseif ($post_id != '') {
            $post = PostModel::select('title', 'subject', 'class')
                ->join('subjects', 'posts.subject_id', '=', 'subjects.id')
                ->find($post_id);
            $input['post'] = $post;
            $subject = $post->subject;
            $title = $post->title;
            $data['breadcrumb'] = $this->breadcrumb($input);
            $data['banner_title'] = "$subject - $title";
        }
        return $data;
    }

    public function getSideBar($post_id)
    {
        $data = [];
        $all_ads = AdvertimentModel::all();
        if ($post_id != '') {
            $subject_id = PostModel::find($post_id)->subject_id;
            $data_related = PostModel::select('id', 'title')->where([
                ['subject_id', '=', $subject_id],
                ['id', '!=', $post_id],
            ])->limit(8)->get();
            $data['all_ads'] = $all_ads;
            $data['data_related'] = $data_related;
            return $data;
        }
        $data['all_ads'] = $all_ads;
        return $data;
    }

    public function getFooter()
    {
        $all_subjects = SubjectModel::all();
        $data_footer = [];
        $data_check_name = [];
        foreach ($all_subjects as $subject) {
            if (!in_array($subject->subject, $data_check_name)) {
                array_push($data_footer, $subject);
                array_push($data_check_name, $subject->subject);
            }
            if (sizeof($data_footer) >= 8) {
                break;
            }
        }
        return $data_footer;
    }

    public function breadcrumb($data)
    {
        $breadcrumb = ['trang chủ'];
        if (isset($data['class'])) {
            array_push($breadcrumb, $data['class']);
        }
        if (isset($data['subject']) && $data['class'] != 'Mới nhất') {
            array_push($breadcrumb, $data['subject']);
        }
        if (isset($data['post'])) {
            if (!in_array($data['post']->class, $breadcrumb)) {
                array_push($breadcrumb, $data['post']->class);
            }
            if (!in_array($data['post']->subject, $breadcrumb)) {
                array_push($breadcrumb, $data['post']->subject);
            }
            array_push($breadcrumb, $data['post']->title);
        }
        return $breadcrumb;
    }
}
