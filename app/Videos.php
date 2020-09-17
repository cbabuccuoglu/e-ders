<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Videos extends Model
{
    use SoftDeletes;
    protected $fillable = ['lesson_id','name','classNumber','files','videoslink','teacher_id'];

    public function lesson()
    {
        return $this->hasOne('App\Lesson','id','lesson_id');
    }
    public function teacher()
    {
        return $this->hasOne('App\User','id','teacher_id');
    }
}
