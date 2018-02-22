<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserAccount;
use App\Account;
use App\User;
use App\Http\Requests\AccountRequest;
use Response;
use Session;
use Image; 
use File; 
use DB;
use Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $account = Account::find($id);

        if($account->primary_contact){
            $pc = User::find($account->primary_contact)->getFullName();
        }else{
         $pc = NULL;
        }
       return view('backend.account.view')->with('account' , $account)->with('primary_contact' , $pc);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $is_client = 'y';
        $getAllUsers = User::getUsersWithoutAccount();
       return view('backend.account.create')->with('getAllUsers' , $getAllUsers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $Accountrequest)
    {
       //Insert to users table

           


            $account = new Account();
            $account->name = $Accountrequest->name;
            $account->status = $Accountrequest->status;
            $account->phone = $Accountrequest->phone;
            $account->address_1 = $Accountrequest->address_1;
            $account->address_2 = $Accountrequest->address_2;
            $account->address_3 = $Accountrequest->address_3;
            $account->city = $Accountrequest->city;
            $account->country_1 = $Accountrequest->country_1;
            $account->country_2 = $Accountrequest->country_2;
            $account->post_code = $Accountrequest->post_code;
            $account->email_domain = $Accountrequest->email_domain;
            $account->secondary_domain = $Accountrequest->secondary_domain;
            $account->account_no = $Accountrequest->account_no;
            $account->primary_contact = $Accountrequest->primary_contact;

 if ($Accountrequest->hasFile('file')) {
                $image = $Accountrequest->file('file');
                $filename = $Accountrequest->account_no . '-' . time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('uploads/client_logo/logo-'.$filename);
                Image::make($image)->fit(160, 160)->save($location);
                if($filename){
             $account->client_logo = 'logo-' . $filename;

            }
            }


            
            $account->save();
            Session::flash('success', 'Account successfully created.');
            return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show()
    {


if (Auth::user()->isClientAdministrator()){
    $user_id = Auth::user()->id;
    $getClients = User::all()->where('client_parent' , $user_id);


     if($getClients->isEmpty()){
        $getAllAccounts = User::find($user_id)->getAccounts;
     }
     else{
        

foreach ($getClients as $key => $value) {
    $getAllAccounts = User::find($value->id)->getAccounts;
                                        }
}
     }

else{
      $getAllAccounts = Account::all();
}

return view('backend.account.show')->with('getall_accounts' , $getAllAccounts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $account = Account::find($id);
         $selected_user = User::find($account->primary_contact); 
      $users = $account->getUsers->where('status' , 'live');

       // dd($account->getUsers->where('status' , 'live'));

       return view('backend.account.edit')->with('account' , $account)->with('selected_user' , $selected_user)->with('users' , $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(AccountRequest $Accountrequest , $id)
    {
   
           $account = Account::find($id);

       if (!Auth::user()->isClientAdministrator()){

            $account->name = $Accountrequest->name;
            $account->account_no = $Accountrequest->account_no;
            $account->status = $Accountrequest->status;
          

           if ($Accountrequest->hasFile('file')) {

            $old_pic = public_path('uploads/client_logo/'.$account->client_logo);
                File::delete($old_pic);
                $image = $Accountrequest->file('file');
                $filename = $Accountrequest->account_no . '-' . time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('uploads/client_logo/logo-'.$filename);
                Image::make($image)->fit(150, 150)->save($location);
                             $account->client_logo = 'logo-' . $filename;

            }
}

            $account->phone = $Accountrequest->phone;
            $account->address_1 = $Accountrequest->address_1;
            $account->address_2 = $Accountrequest->address_2;
            $account->address_3 = $Accountrequest->address_3;
            $account->city = $Accountrequest->city;
            $account->country_1 = $Accountrequest->country_1;
            $account->country_2 = $Accountrequest->country_2;
            $account->post_code = $Accountrequest->post_code;
            $account->primary_contact = $Accountrequest->primary_contact;
            $account->email_domain = $Accountrequest->email_domain;
            $account->secondary_domain = $Accountrequest->secondary_domain;
          


           if($account->save()){
            Session::flash('success', 'Account Successfully Updated.');
       }
                  return redirect('account/show'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $account = Account::find($id);
        $account->delete(); 

        Session::flash('success', 'Account successfully deleted.');
            return redirect()->back();
    }


      public function getEmailDomain(Request $request)
    {
        $id = $request->account_id;
        $primary_email_domain = Account::find($id)->email_domain;
        $secondary_email_domain = Account::find($id)->secondary_domain;
         $removeChar= array("http://","https://","/" ,"www.");    


        $email_domain1 = array();
           
           if(empty($secondary_email_domain)){
            $email_domain1[] = str_replace($removeChar, "", $primary_email_domain);
           }
           else{
             $email_domain1[] = str_replace($removeChar, "", $primary_email_domain);
        $email_domain1[] = str_replace($removeChar, "", $secondary_email_domain);
           }

        return $email_domain1;


    }



        public function changeStatus(Request $request)
    {
        $id = $request->account_id;
        $email_domain = Account::find($id)->email_domain;

        $removeChar= array("http://","https://","/" ,"www.");    
        $email_domain1 = str_replace($removeChar, "", $email_domain);

        return '@' . $email_domain1;


    }



    public function search(Request $request){

$getAccounts = Account::SearchByKeyword($request->keyword)->get();

return view('backend.account.show')->with('getall_accounts' , $getAccounts);
      
    }
}
