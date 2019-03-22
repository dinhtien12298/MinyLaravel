<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    protected $table = 'posts';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Models\UserModel');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\SubjectModel');
    }
}
