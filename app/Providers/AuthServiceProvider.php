<?php

namespace App\Providers;

use App\Models\JobOfferPost;
use App\Models\JobSeekerPost;
use App\Models\User;
use App\Policies\JobOfferPostPolicy;
use App\Policies\JobSeekerPostPolicy;
use Illuminate\Support\Facades\Gate;

// use Illuminate\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        JobSeekerPost::class => JobSeekerPostPolicy::class,
        JobOfferPost::class => JobOfferPostPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('modify-job-seeker-information',function($user){
            if($user->role == "job_seeker"){
                return true;
            }
            return false;
        });

    }
}
