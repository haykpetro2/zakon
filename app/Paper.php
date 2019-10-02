<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $fillable = [
        'name' , 'category'
    ];

    public function category() {
        return $this->belongsTo(Category::class,'category','id');
    }

}
