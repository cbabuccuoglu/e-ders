<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gains extends Model
{
    use SoftDeletes;
   protected $fillable = ['units','name','classNumber','lesson_id'];

    public function lesson()
    {
        return $this->hasOne('App\Lesson','id','lesson_id');
    }
}
