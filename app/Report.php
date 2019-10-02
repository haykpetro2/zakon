<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user', 'sender', 'login' , 'phone', 'email', 'problem'
    ];
}
