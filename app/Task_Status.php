<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task_Status extends Model
{
    protected $fillable = ['id','value'];

    /*
    * Get Todo of User
    *
    */
    public function todo()
    {
        return $this->belongsTo('App\Todo');
    }
}
