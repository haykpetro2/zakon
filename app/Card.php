<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'number', 'code', 'month', 'year'
    ];
}
