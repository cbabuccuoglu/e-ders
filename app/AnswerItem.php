<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnswerItem extends Model
{
    use SoftDeletes;
    protected $fillable = ['answer_id','user_id','lesson_id','gain_id','selectedoption','trueoption','examquestion_id','truetype'];
    public function lesson()
    {
        return $this->hasOne('App\Lesson','id','lesson_id');
    }
    public function examquestion()
    {
        return $this->hasOne('App\ExamQuestion','id','examquestion_id');
    }
    public function gains()
    {
        return $this->hasOne('App\Gains','id','gain_id');
    }
}
