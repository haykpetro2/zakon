<?php

namespace App;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;

class Review extends Model implements Searchable
{
    protected $table = 'reviews';

    protected $fillable = [
        'user_id', 'lawyer_id', 'question_id', 'review', 'category', 'speed', 'communication', 'result', 'professional', 'moderation'
    ];

    public function user() {
        return $this->belongsTo(User::class,'lawyer_id','id');
    }

    public function getSearchResult(): SearchResult
    {

        return new SearchResult(
            $this,
            $this->review
        );
    }

}
