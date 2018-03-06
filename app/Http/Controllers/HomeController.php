<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

   public function backend()
    {

if (Auth::user()->isClient() || Auth::user()->isClientAdministrator()){
             $user = Auth::user()->id;

          if(!empty(User::find($user)->getAccounts->first())){
                         $client_logo = User::find($user)->getAccounts->first()->client_logo;

                     }else{
                         $client_logo = NULL;
                     }

         }
         else{
            $client_logo = NULL;
         }




        return view('backend.dashboard')->with('client_logo' , $client_logo);
    }
}
