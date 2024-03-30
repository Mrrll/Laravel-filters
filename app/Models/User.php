<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    /**
     * The `roles()` function defines a many-to-many relationship between the current model and the
     * `Role` model in PHP.
     *
     * @return roles associated with it. When this method is called on an instance of the class, it will return
     * a collection of
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * The `profile` function returns a polymorphic relationship with the `Profile` model.
     *
     * @return Profile model. This means that the current model can be associated with multiple Profile models
     * through a polymorphic many-to-many relationship.
     */
    public function profile()
    {
        return $this->morphToMany(Profile::class, 'profileable');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }

    public function rating()
    {
        return $this->morphToMany(Rating::class, 'ratingable');
    }
}
