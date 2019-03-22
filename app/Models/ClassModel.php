<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';
    public $timestamps = false;

    public function subjects()
    {
        return $this->hasMany('App\Models\SubjectModel');
    }
}
