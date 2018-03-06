<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\UserRole;
use App\Account;
use App\UserAccount;
use App\Campaign;
use App\CampaignDashboardPermission;
use App\Http\Requests\UserRequest;
use Session;
use Response;
use Auth;
use Illuminate\Support\Facades\Password;
use Hash;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index($id)
    {
       $user = User::find($id);
       $selected_roleid = $user->getRoles()->pluck('role_id')->toArray(); 
       $my_role = Role::find($selected_roleid[0]);


          $getall_accounts = Account::all();
           $selected_account = $user->getAccounts()->pluck('account_id')->toArray(); 

       if(empty($selected_account)){

           return view('backend.user.view')->with('user' , $user)->with('my_role' , $my_role);
      
       }else
       {
        $my_account = Account::find($selected_account[0]);
         return view('backend.user.view')->with('user' , $user)
                                         ->with('my_role' , $my_role)
                                          ->with('my_account' , $my_account)
                                         ;

       }
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Elomark User
    public function create()
    {
        $is_client = 'n';
        $getAllRoles = Role::all()->where('is_client' ,  $is_client);
   return view('backend.user.create')->with('getall_roles', $getAllRoles)->with('is_client' , '$is_client');

    }

    //Client User
     public function create_client(Request $request , $is_client)
    {

        if(Auth::user()->isClientAdministrator()){
         $getAccounts = User::find(Auth::user()->id)->getAccounts;
        $getAllRoles = Role::all()->where('is_client' , $is_client)->where('id' , 5);

         }else{
             $getAccounts = Account::all();
             $getAllRoles = Role::all()->where('is_client' , $is_client);
         }

        return view('backend.user.create')->with('getall_roles' , $getAllRoles)->with('getall_accounts' , $getAccounts)->with('is_client' , $is_client);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(UserRequest $user_request)
    {




           //Insert to users table
            $user = new User();
            $user->firstname = $user_request->firstname;
            // $user->username = $user_request->username;
            $user->surname = $user_request->surname;
            $user->phone = $user_request->phone;
            $user->mobile = $user_request->mobile;
            $user->job_title = $user_request->job_title;

            $user->email = $user_request->email;
            $user->password = bcrypt($user_request->password);
           
           if($user_request->status){
               $user->status = $user_request->status;
            }
            
            
            
            if($user_request->client){
                $user->client = 'y';

            }
            else{
                $user->client = 'n';
            }

            if($user_request->role_id == 4){
                $user->client_parent = 1;
            }else{
              $user->client_parent = 0;
            }

            // if($user_request->client_parent){
            //     $user->client_parent = $user_request->client_parent;
            // }else{
            //   $user->client_parent = '0';
            // }

            // // if($user_request->role_id == 4){
            // //     $user->client_parent = 1;
            // // }else{
            // //   $user->client_parent = 0;
            // // }


            // // dd($user_request->client_parent);

            // if($user_request->client_parent){
            //     $user->client_parent = $user_request->client_parent;
            // }else{
            //   $user->client_parent = '0';
            // }

             if($user_request->campaign_parent){
                $user->campaign_parent = $user_request->campaign_parent;
            }else{
              $user->campaign_parent = '0';
            }

            $user->save();


                       if($user_request->client == 'y'){
 $getCampaignsAccount = Campaign::all()->where('account_id' , $user_request->account_id);

            if(!empty($getCampaignsAccount)){
 //Insert to campign dashbard access
            foreach ($getCampaignsAccount as $key => $value) {
            $CampaignAccess = new CampaignDashboardPermission();
            $CampaignAccess->campaign_id = $value->id;
             $CampaignAccess->account_id = $user_request->account_id;
            $CampaignAccess->user_id = $user->id;
            $CampaignAccess->performance_dashboard_access = "n";
            $CampaignAccess->insight_dashboard_access = "n";
            $CampaignAccess->internal_dashboard_access = "n";
          $CampaignAccess->save();

            }


            }
}

           //Insert to user roles table

            $lastId = $user->id;
            $userRole = new userRole();
            $userRole->user_id = $lastId;
            $userRole->role_id = $user_request->role_id;
            $userRole->save();

            if($user_request->account_id){
                $userAccount = new UserAccount();
                $userAccount->user_id = $lastId;
                $userAccount->account_id = $user_request->account_id;
                $userAccount->save();
            }

           if( $user->save() && $userRole->save()){
                        Session::flash('success', 'User successfully created.');

           }



            return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $is_client = 'n';
        $getAllUsers = User::where('client' , $is_client)->orderBy('created_at', 'DESC')->get();
        return view('backend.user.show')->with('getall_users' , $getAllUsers)
                                         ->with('is_client' , $is_client);
    }

     public function showClient()
    {

      $is_client = 'y';

if (Auth::user()->isClientAdministrator()){

  if(!empty(User::find(Auth::user()->id)->getAccounts->first())){
  $my_account_id = User::find(Auth::user()->id)->getAccounts->first()->id;

  $getAllUsers = Account::find($my_account_id)->getUsers->where('client' , $is_client)->where('client_parent' , 0);

  }
  else{
    $getAllUsers = NULL;
  }


}elseif (Auth::user()->isCampaignManager()){
  // $getAllUsers = User::all()->where('client' , $is_client)->where('campaign_parent' , Auth::user()->id);
     $getAllUsers = User::where('client' , $is_client)->orderBy('created_at', 'DESC')->get();

}else{
   $getAllUsers = User::where('client' , $is_client)->orderBy('created_at', 'DESC')->get();
}

        return view('backend.user.show_client')->with('getall_users' , $getAllUsers)->with('is_client' , $is_client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if (Auth::user()->isClientAdministrator()){
           $getAllRoles = Role::all()->where('id' , 5);

}else{
         $getAllRoles = Role::all();

}
       $user = User::find($id);
       $selected_roleid = $user->getRoles()->pluck('role_id')->toArray(); 
       $my_role = Role::find($selected_roleid[0]);

          $getall_accounts = Account::all();
           $selected_account = $user->getAccounts()->pluck('account_id')->toArray(); 

       if(empty($selected_account)){

           return view('backend.user.edit')->with('user' , $user)->with('my_role' , $my_role)->with('getall_roles' , $getAllRoles->where('is_client' , 'n'));
      
       }else
       {
        $my_account = Account::find($selected_account[0]);
         return view('backend.user.edit')->with('user' , $user)
                                         ->with('my_role' , $my_role)
                                          ->with('getall_roles' , $getAllRoles->where('is_client' , 'y'))
                                          ->with('my_account' , $my_account)
                                          ->with('getall_accounts' , $getall_accounts);

       }


    }

    public function mydetail($id)
    {
       $getAllRoles = Role::all();
       $user = User::find($id);
       $selected_roleid = $user->getRoles()->pluck('role_id')->toArray(); 
       $my_role = Role::find($selected_roleid[0]);

          $getall_accounts = Account::all();
           $selected_account = $user->getAccounts()->pluck('account_id')->toArray(); 

       if(empty($selected_account)){

           return view('backend.user.mydetail')->with('user' , $user)->with('my_role' , $my_role)->with('getall_roles' , $getAllRoles->where('is_client' , 'n'));
      
       }else
       {
        $my_account = Account::find($selected_account[0]);
         return view('backend.user.mydetail')->with('user' , $user)
                                         ->with('my_role' , $my_role)
                                          ->with('getall_roles' , $getAllRoles->where('is_client' , 'y'))
                                          ->with('my_account' , $my_account)
                                          ->with('getall_accounts' , $getall_accounts);

       }


    }




     public function campaign($id)
    {
        // $user = User::find($id);
        // $getCampaigns = $user->getCampaign;

        $user = User::find($id);

         $associateCampaigns = DB::table('campaign_dashboard_permission')
            ->join('campaigns', 'campaigns.id', '=', 'campaign_dashboard_permission.campaign_id')
            ->join('users', 'users.id', '=', 'campaign_dashboard_permission.user_id')
            ->select('users.*', 'campaign_dashboard_permission.*' , 'campaigns.*')
            ->where('users.id', $id)
            ->get();

        if(Auth::user()->isClientAdministrator()){
       $getCampaigns = $associateCampaigns->where('status' , 'live');
     
      }elseif(Auth::user()->isCampaignManager()){

          $getCampaigns = $associateCampaigns->where('campaign_user_id' , Auth::user()->id);
      }
      else
        {

        $getCampaigns = $associateCampaigns;

        
        }
         $accounts = Account::all();
        $status = 'live';
        return view('backend.user.user_campaign')->with('user' , $user)
                                                 ->with('getCampaigns' , $getCampaigns)->with('status' , $status)->
                                                 with('accounts' , $accounts);
    }

      





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $user_request, $id)
    {


      $message = NULL;
  
             $user = User::find($id);
            $user->firstname = $user_request->firstname;
            $user->job_title = $user_request->job_title;
            $user->surname = $user_request->surname;
            $user->phone = $user_request->phone;
            if($user_request->mobile){
              $user->mobile = $user_request->mobile;
            }


             $user->email = $user_request->email;

            if($user_request->new_password == 'y'){

            $response = Password::broker()->sendResetLink(['email'=>$user->email]);
            if($response == Password::RESET_LINK_SENT){

            $message = "Password reset link has been sent to users email.";

            } else {
              $message = "Something wrong with the email address.";

            }
                }else{
                   if($user_request->new_password){
                      $user->password = Hash::make($user_request->new_password);
                }
                }


           if($user_request->status){
               $user->status = $user_request->status;
            }


        if($user_request->role_id){

              if($user_request->role_id == 4){
                $user->client_parent = 1;
            }else{
              $user->client_parent = '0';
            }
          }

            $user->save();

            if($user_request->role_id){
                          $user->getRoles()->sync($user_request->role_id);

            }

            if($user_request->mydetail){

               if($user_request->mydetail == 'y'){

                  if($message){
                     Session::flash('success', $message);
                  // Session::flash('info', 'Details Successfully Updated.');
                  return redirect('dashboard');
                  }

                 Session::flash('success', 'Details Successfully Updated.');
                return redirect('dashboard');
               }
                if($user->client == 'n'){
                  Session::flash('success', 'User Successfully Updated.');
                  return redirect('user/show');



            }
            else{
              Session::flash('success', 'Client User Successfully Updated.');
             return redirect('user/showClient');
            }

            }
            else{
                  if($user->client == 'n'){
                  Session::flash('success', "User Successfully Updated". "<br>" . $message);
                  return redirect('user/show');
            }
            else{
  Session::flash('success', "Client User Successfully Updated". "<br>" . $message);             return redirect('user/showClient');
            }
            }

           


           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::find($id);

        $user->delete(); 

        if($user->client == 'y'){
           $userAccount = UserAccount::where('user_id' , $id)->first();
           $userAccount->delete(); 
           Session::flash('success', 'User successfully deleted.');
            return redirect('user/showClient');
        }
        else{

        Session::flash('success', 'User successfully deleted.');
            return redirect()->back();
        }


    }


     public function update_delete(Request $request)
    {
 

      $user = User::findOrFail($request->id);
        // update if edit
        if($request->action == 'edit') {
       $update = $user->update($request->all());
       if($update)
       return Response::json("The record had been successfully updated.");
       else
       return Response::json("Something gets wrong . Please contact to the adminstrator.");
        }
        else{
            //or delete
             $user->delete();  
             return Response::json("The record had been successfully deleted.");
        }


    }


    public function search(Request $request){

      $is_client = 'n';
      $users = User::searchUsers($request->keyword);
       return view('backend.user.show')->with('getall_users' , $users)
                                         ->with('is_client' , $is_client);
    }


  public function searchClient(Request $request){



      $is_client = 'y';

     if(Auth::user()->isCampaignManager()){
               $users = User::searchClients($request->keyword);
                             }
        elseif(Auth::user()->isClientAdministrator()){


          if(!empty(User::find(Auth::user()->id)->getAccounts->first())){
 $my_account_id = User::find(Auth::user()->id)->getAccounts->first()->id;
 $users = User::SearchClientsAsClientAdmin($request->keyword , $my_account_id);
          }
          else{
            $users = NULL;
          }



  }else{
         $users = User::searchClients($request->keyword);

         // dd($users);

                             }


       return view('backend.user.show_client')->with('getall_users' , $users)
                                         ->with('is_client' , $is_client);
    }



 public function campaignSearchByStatus(Request $request){
           
      $status = $request->status;
       $user_id = $request->user_id;
       $user = User::find($user_id);



         $associateCampaigns = DB::table('campaign_dashboard_permission')
            ->join('campaigns', 'campaigns.id', '=', 'campaign_dashboard_permission.campaign_id')
            ->join('users', 'users.id', '=', 'campaign_dashboard_permission.user_id')
            ->select('users.*', 'campaign_dashboard_permission.*' , 'campaigns.*')
            ->where('users.id', $user_id)
            ->get();



             $account= Account::all();
               if($status == 'all'){
            if(Auth::user()->isClientAdministrator()){
        $getCampaigns = $associateCampaigns;

 }elseif(Auth::user()->isCampaignManager()){
            $getCampaigns = $associateCampaigns->where('campaign_user_id' , Auth::user()->id);

                             }
                
        else
        {

        $getCampaigns = $associateCampaigns;
        }
       }else{


 if(Auth::user()->isClientAdministrator()){
 //        $my_id = Auth::user()->id;
 //        $my_clients = User::all()->where('client_parent' , $my_id);
        
 // $user_ids = [];

 //        foreach ($my_clients as $key => $value) {
 //             $user_ids[] = User::find($value->id)->id;
 //        } 
 //                $getCampaigns = Campaign::where('user_id', $user_id)->where('status',$status)->get();

  $getCampaigns = $associateCampaigns->where('status' , $status);


 }elseif(Auth::user()->isCampaignManager()){

    $getCampaigns = $getCampaigns = $associateCampaigns->where('campaign_user_id' , Auth::user()->id)->where('status' , $status);
                          }
              
        else
        {

           $getCampaigns = $associateCampaigns->where('status' , $status);

        // $getCampaigns = Campaign::all()->where('status' , $status)->where('account_id' , $usersAccountID);
        }

    }

        return view('backend.user.user_campaign')->with('user' , $user)
                                                 ->with('getCampaigns' , $getCampaigns)->with('status' , $status)->with('accounts' , $account);
      
    }


      public function campaignAccess(Request $request){

         
         $user_id = $request->user_id;


        $campaign_id = $request->campaign_id;
     

        $camp_aceess = CampaignDashboardPermission::where('campaign_id' , $request->campaign_id)->where('user_id' , $request->user_id)->first();

        if($request->performance_dashboard_access == NULL){
              $camp_aceess->performance_dashboard_access = 'n';
        }else{
           $camp_aceess->performance_dashboard_access = 'y';
        }


         if($request->insight_dashboard_access == NULL){
              $camp_aceess->insight_dashboard_access = 'n';
        }else{
           $camp_aceess->insight_dashboard_access = 'y';
        }



         if($request->internal_dashboard_access == NULL){
              $camp_aceess->internal_dashboard_access = 'n';
        }else{
           $camp_aceess->internal_dashboard_access = 'y';
        }

        $camp_aceess->save();


        Session::flash('success', 'Campaign Permission Updated Successfully.');
        return \Redirect::route('user/campaign' , $user_id);

       // return redirect()->back();
    }



     public function managerCampaign($id)
    {
        // $user = User::find($id);
        // $getCampaigns = $user->getCampaign;

        $user = User::find($id);
        $getCampaigns = Campaign::all();
         $accounts = Account::all();
        $status = 'live';
        return view('backend.user.manager_campaign')->with('user' , $user)
                                                 ->with('getCampaigns' , $getCampaigns)->with('status' , $status)->
                                                 with('accounts' , $accounts);
    }



         public function managerCampaignAccess(Request $request){

         
         $user_id = $request->user_id;
        $campaign_id = $request->campaign_id;
        $campaign = Campaign::find($campaign_id);

        if($request->campaign_user_id != 0){
              $campaign->campaign_user_id = $request->campaign_user_id;
        }else{
           $campaign->campaign_user_id = 0;
        }

        $campaign->save();

        Session::flash('success', 'Campaign Permission Updated Successfully.');
        return redirect()->back();

       // return redirect()->back();
    }


     



}
