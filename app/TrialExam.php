<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrialExam extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','classNumber','startpoint','start_date','finish_date','resulttype','type','resulttype','dyType','opticsType','trial_type','time'];

}
