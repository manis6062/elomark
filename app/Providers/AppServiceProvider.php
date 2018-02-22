<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Auth;
use Request;
use App\Account;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//         if (\Request::is('account/*/view') ||  \Request::is('account/*/edit')){
//             $account_id = Request::segment(2);
//             $account_image = Account::find($account_id)->client_logo;
//             View::share( 'account_image', $account_image );
//         }


//         if(\Request::is('user/*/view') || \Request::is('user/*/edit') || \Request::is('user/*/mydetail')){

//                 $user_id = Request::segment(2);
//                 $is_client = User::find($user_id)->client;
//                 if($is_client == 'n'){
//                     $user_account_image = NULL;
//                 }else{
//                     $user_account_image = User::find($user_id)->getAccounts->first()->client_logo;
//                 }
//                 View::share( 'user_account_image', $user_account_image );
            

         
// }





    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
