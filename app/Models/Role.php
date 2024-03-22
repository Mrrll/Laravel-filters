<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /* `protected  = [];` is used in Laravel Eloquent models to specify which attributes are not mass assignable. */
    protected $guarded = [];

    /**
     * The function `users()` establishes a many-to-many relationship between the current model and the
     * `User` model in PHP.
     *
     * @return User model. The method is returning the result of this relationship definition.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
