<?php

namespace App;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;

class Question extends Model implements Searchable
{
    protected $table = 'questions';

    protected $fillable = [
        'user_id', 'lawyer_id', 'lawyer_name', 'date', 'price', 'status', 'paid', 'held', 'resolved', 'terms', 'name', 'question', 'category', 'theme', 'moderation'
    ];

    public function user() {
        return $this->belongsTo(User::class,'lawyer_id','id');
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('ask-question', $this->id);

        return new SearchResult(
            $this,
            $this->question,
            $url
        );
    }

}