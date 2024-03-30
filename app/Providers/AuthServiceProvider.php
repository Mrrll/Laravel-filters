<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Movie;
use App\Models\User;
use App\Policies\CommentPolicy;
use App\Policies\MoviePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Movie::class => MoviePolicy::class,
        Comment::class => CommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Definimos puerta si el usuario es admin
        Gate::define('isAdmin', function (User $user) {
            return $user->roles->first()->slug == 'admin';
        });
    }
}
