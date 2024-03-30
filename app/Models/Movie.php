<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Movie extends Model
{
    use HasFactory, Searchable;

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

    protected function searchable(): Attribute
    {
        return Attribute::make(
            get: function ($value) {

                return read_json("movie.json", "config");
            },
        );
    }
}
