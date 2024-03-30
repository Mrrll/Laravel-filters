<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'year' => 'date',
    ];

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'tagable');
    }

    // Relación uno a muchos Polimórfica
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    // Relación uno a muchos (inversa)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
