<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relación uno a muchos (inversa)
    public function movies()
    {
        return $this->belongsTo(Movie::class);
    }
    public function user()
    {
        return $this->morphByMany(User::class, 'ratingable');
    }

}
