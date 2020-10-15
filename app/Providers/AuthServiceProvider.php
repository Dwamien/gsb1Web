<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Manga;
use App\Policies\MangaPolicy;

use App\Models\Commentaire;
use App\Policies\CommentairePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function($user){
            return $user->role == 'Administrateur';
        });

        Gate::define('compose', function($user){
            return $user->role == 'Administrateur' ||  $user->role == 'Visiteur' || $user->role == 'Praticien';
        });
    }
}
