<?php

namespace App\Providers;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
      public function boot(GateContract $gate)
    {
        $this->registerPolicies();
        $gate->define('administrator-access',function($user){
           foreach($user->getRoles as $role){
               if($role->name == 'administrator'){
                   return true;
               }
           }
           return false;
       });



    $gate->define('campaign_manager',function($user){
           foreach($user->getRoles as $role){
               if($role->name == 'campaign_manager'){
                   return true;
               }
           }
           return false;
       });

     $gate->define('sales_developer',function($user){
           foreach($user->getRoles as $role){
               if($role->name == 'sales_developer'){
                   return true;
               }
           }
           return false;
       });

   $gate->define('client_administrator',function($user){
           foreach($user->getRoles as $role){
               if($role->name == 'client_administrator'){
                   return true;
               }
           }
           return false;
       });

  $gate->define('client',function($user){
           foreach($user->getRoles as $role){
               if($role->name == 'client'){
                   return true;
               }
           }
           return false;
       });

    $gate->define('admin-campaign-access',function($user){
           foreach($user->getRoles as $role){
               if($role->name == 'administrator' || $role->name == 'campaign_manager'){
                   return true;
               }
           }
           return false;
       });

    $gate->define('admin-campaign-clientadmin-access',function($user){
           foreach($user->getRoles as $role){
               if($role->name == 'administrator' || $role->name == 'campaign_manager' || $role->name == 'client_administrator'){
                   return true;
               }
           }
           return false;
       });

        //
    }
}
