<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Noice extends Model
{
    use SoftDeletes;
    protected $fillable = ['type','user_id','name','description','finish_date'];

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }
}
