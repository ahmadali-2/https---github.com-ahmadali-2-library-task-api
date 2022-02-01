<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = "book_new";
    public $timestamps = false;
    protected $fillable = [
        "id",
        "rack_id",
        "name",
        "author",
        "published_year",
    ];


}
