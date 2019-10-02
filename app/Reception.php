<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    protected $fillable = [
        'user_id', 'lawyer_id' , 'name' , 'date', 'time' , 'address', 'question'
    ];
}
