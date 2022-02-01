<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{
    use HasFactory;

    protected $table = "racks";
    public $timestamps = false;
    protected $fillable = [
        "id",
        "name",
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
