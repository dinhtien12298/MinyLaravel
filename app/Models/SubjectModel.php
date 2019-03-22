<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectModel extends Model
{
    protected $table = 'subjects';
    public $timestamps = false;

    public function posts()
    {
        return $this->hasMany('App\Models\PostModel');
    }

    public function belongClass()
    {
        return $this->belongsTo('App\Models\ClassModel');
    }
}
