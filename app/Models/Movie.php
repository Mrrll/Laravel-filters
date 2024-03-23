<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function comments()
    {
        return $this->morphToMany(Comment::class, 'commentable');
    }

    public function rating()
    {
        return $this->morphToMany(Rating::class, 'ratingable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'tagable');
    }


}
