<?php

namespace App;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;

class Document extends Model implements Searchable
{
    protected $table = 'documents';

    protected $fillable = [
        'user_id', 'document_name', 'document_file', 'category', 'date'
    ];

    public function getSearchResult(): SearchResult
    {

        return new SearchResult(
            $this,
            $this->document_name
        );
    }

}
