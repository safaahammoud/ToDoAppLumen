<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todo';

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'category',
        'status_id',
        'date_time'
    ];

    public function status()
    {
        return $this->hasOne('App\Task_Status');
    }
}
