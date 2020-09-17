<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use SoftDeletes;
   protected $fillable = ['name','point','lesson_type','sayisal','esitagirlik','sozel','yabancidil','order'];

}
