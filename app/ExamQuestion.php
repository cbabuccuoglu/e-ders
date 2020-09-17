<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamQuestion extends Model
{
    use SoftDeletes;
    protected $fillable = ['trialexam_id','lesson_id','gains_id','point','image','questionstype','order','trueresult','Wquestion','WoptionA','WoptionB','WoptionC','WoptionD','WoptionE'];
    public function lesson()
    {
        return $this->hasOne('App\Lesson','id','lesson_id');
    }

    public function gains()
    {
        return $this->hasOne('App\Gains','id','gains_id');
    }
    public function trialexam()
    {
        return $this->hasOne('App\TrialExam','id','trialexam_id');
    }
}
