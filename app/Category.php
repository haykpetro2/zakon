<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'cat_name', 'cat_description' , 'image'
    ];

    public function papers(){
        return $this->hasMany(Paper::class, 'category', 'id');
    }
}
