<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;
    protected $fillable = ['trialexam_id','user_id','start_date','finish_date','type','net','point','tytpuan','aytsayisal','aytesit','aytsozel','ydspuan'];

    public function trialexam()
    {
        return $this->hasOne('App\TrialExam','id','trialexam_id');
    }
    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }
}
