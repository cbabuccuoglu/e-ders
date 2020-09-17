<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideosWatch extends Model
{
    use SoftDeletes;
    protected $fillable = ['videos_id','student_id','minute'];

    public function videos()
    {
        return $this->hasOne('App\Videos','id','videos_id');
    }
    public function student()
    {
        return $this->hasOne('App\User','id','student_id');
    }
}
