<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function genres()
    {
        return $this->belongsToMany('App\Genre', 'books_genres', 'id_book', 'id_genre');
    }
}
