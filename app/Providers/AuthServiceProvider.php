<?php

namespace App\Providers;

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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
        //Mengatur Hak Akses untuk Admin
    Gate::define('admin-only', function ($user) {
        if ($user->level == 'admin'){
        return true;
        }
        return false;
        });
        // //Mengatur Hak Akses untuk Bendahara
        Gate::define('bendahara-only', function ($user) {
        if ($user->level == 'bendahara'){
        return true;
        }
        return false;
        });
        //Mengatur Hak Akses untuk Pelanggan
        Gate::define('pelanggan-only', function ($user) {
        if ($user->level == 'pelanggan'){
        return true;
        }
        return false;
        });   
        //  //Mengatur Hak Akses untuk Pemilik
         Gate::define('pemilik-only', function ($user) {
            if ($user->level == 'pemilik'){
            return true;
            }
            return false;
            });   
    } 
}