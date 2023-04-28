<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'isbn_code',
        'title',
        'slug',
        'main_author',
        'pages',
        'isAvailable',
        'copies',
        'genre_id'
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
