<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campaign;
use App\User;
use App\Http\Requests\CampaignRequest;
use Response;
use Session;
use Auth;
use App\Account;
use File; 
use App\CampaignDashboardPermission;
use DB;


class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
     
        if (Auth::user()->isClient() || Auth::user()->isClientAdministrator())
{
         $campaign = DB::table('campaign_dashboard_permission')
            ->join('campaigns', 'campaigns.id', '=', 'campaign_dashboard_permission.campaign_id')
            ->join('users', 'users.id', '=', 'campaign_dashboard_permission.user_id')
            ->select('users.*', 'campaign_dashboard_permission.*' , 'campaign_dashboard_permission.user_id AS cdp_user_id' , 'campaigns.*')
            ->where('campaigns.id' , $id)
             ->where('users.id' , Auth::user()->id)
            ->get()->first();
     }
     else{
         $campaign = Campaign::find($id);
     }

        $p_contact = User::find($campaign->primary_contact);
        $primary_contact = $p_contact->firstname . ' ' . $p_contact->surname;
       return view('backend.campaign.view')->with('campaign' , $campaign)->with('primary_contact' , $primary_contact);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $sales_developers = User::getSalesDevelopers(3);
        $clients = User::getUserAndRoles(5);
        $getAccounts = Account::all();
       return view('backend.campaign.create')->with('get_accounts' ,$getAccounts)->with('sales_developers' , $sales_developers)->with('clients' , $clients);
    }


   public function getPrimaryContacts(Request $request){
     $id = $request->account_id;
     $user_accounts = Account::find($id)->getUsers->where('client' , 'y');
     return $user_accounts;
     exit();

   }


      public function getEditPrimaryContacts(Request $request){
     $id = $request->account_id;
     $user_accounts = Account::find($id)->getUsers->where('client' , 'y');
     return $user_accounts;
     exit();

   }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CampaignRequest $Campaignrequest)
    {



       //Insert to users table
            $Campaign = new Campaign();
            $Campaign->account_id = $Campaignrequest->account_id;


            $users = Account::find($Campaignrequest->account_id)->getUsers;

            $Campaign->campaign_no = $Campaignrequest->campaign_no;
            $Campaign->campaign = $Campaignrequest->campaign;
            $Campaign->performance_dashboard = $Campaignrequest->performance_dashboard;
            $Campaign->insight_dashboard = $Campaignrequest->insight_dashboard;
            $Campaign->internal_dashboard = $Campaignrequest->internal_dashboard;



                if($Campaignrequest->sales_developer){
                    $count = 1;
                    foreach ($Campaignrequest->sales_developer as $key => $value) {
                    // $Campaign->sales_developer_ . $count = $value;
                      $field = "sales_developer_" . $count++;
                    $Campaign->$field = $value;
                    }

                }

            if($Campaignrequest->campaign_user_id){
                $Campaign->campaign_user_id = $Campaignrequest->campaign_user_id;
            }else{
              $Campaign->campaign_user_id = '0';
            }


             

            // $Campaign->sales_developer_1 = $Campaignrequest->sales_developer_1;
            // $Campaign->sales_developer_2 = $Campaignrequest->sales_developer_2;
            // $Campaign->sales_developer_3 = $Campaignrequest->sales_developer_3;
            // $Campaign->sales_developer_4 = $Campaignrequest->sales_developer_4;
            $Campaign->start_date = $Campaignrequest->start_date;
            $Campaign->end_date = $Campaignrequest->end_date;


            // $Campaign->performance_dashboard_access = "y";
            // $Campaign->insight_dashboard_access = "y";
            // $Campaign->internal_dashboard_access = "y";

            $Campaign->status =$Campaignrequest->status;

             if($Campaignrequest->primary_contact){
             $Campaign->primary_contact = $Campaignrequest->primary_contact;
             $Campaign->user_id = $Campaignrequest->primary_contact;
             }






             if ($Campaignrequest->hasFile('briefing_document')) {

        

                $briefing_document = $Campaignrequest->file('briefing_document');
                $briefing_document_filename = $Campaignrequest->campaign_no . '-' . time() . '.' . $briefing_document->getClientOriginalExtension();
                $location = public_path('uploads/briefing_document/');
                $Campaignrequest->file('briefing_document')->move($location , $briefing_document_filename);
                                $Campaign->briefing_document = $briefing_document_filename;



            }

            if ($Campaignrequest->hasFile('eoc_report')) {
                $eoc_report = $Campaignrequest->file('eoc_report');
                $eoc_report_filename = $Campaignrequest->campaign_no . '-' . time() . '.' . $eoc_report->getClientOriginalExtension();
                $location = public_path('uploads/eoc_report/');
                $Campaignrequest->file('eoc_report')->move($location , $eoc_report_filename);
                $Campaign->eoc_report = $eoc_report_filename;
            }

            if ($Campaignrequest->hasFile('data_file')) {
                $data_file = $Campaignrequest->file('data_file');
                $data_file_filename = $Campaignrequest->campaign_no . '-' . time() . '.' . $data_file->getClientOriginalExtension();
                $location = public_path('uploads/data_file/');
                $Campaignrequest->file('data_file')->move($location , $data_file_filename);
            $Campaign->data_file = $data_file_filename;

            }
            $Campaign->save();

            


            foreach ($users as $key => $value) {
                            $CampaignAccess = new CampaignDashboardPermission();

                $insertedId = $Campaign->id;
             $CampaignAccess->campaign_id = $insertedId;
             $CampaignAccess->account_id = $Campaignrequest->account_id;
            $CampaignAccess->user_id = $value->id;
            $CampaignAccess->performance_dashboard_access = "n";
            $CampaignAccess->insight_dashboard_access = "n";
            $CampaignAccess->internal_dashboard_access = "n";
          $CampaignAccess->save();

            }


       



            Session::flash('success', 'Campaign successfully created.');
            return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Campaign  $Campaign
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
   if(Auth::user()->isCampaignManager()){
    $getAllCampaigns = Campaign::where('campaign_user_id' , Auth::user()->id)->orderBy('created_at', 'DESC')->get();
      } else{
             $getAllCampaigns = Campaign::orderBy('created_at', 'DESC')->get();
                            }

       return view('backend.campaign.show')->with('getall_Campaigns' , $getAllCampaigns);
    }



      public function mylivestat(Request $request)
    {

        if (Auth::user()->isClient()){
             $user = Auth::user()->id;
             $client_logo = User::find($user)->getAccounts->first()->client_logo;
         }
         else{
            $client_logo = NULL;
         }

        $status = $request->stat;

        $getCampaign = DB::table('campaign_dashboard_permission')
            ->join('campaigns', 'campaigns.id', '=', 'campaign_dashboard_permission.campaign_id')
            ->join('users', 'users.id', '=', 'campaign_dashboard_permission.user_id')
            ->select('users.*', 'campaign_dashboard_permission.*' , 'campaign_dashboard_permission.user_id AS cdp_user_id' , 'campaigns.*')
            ->where('performance_dashboard_access' , 'y')
            ->orWhere('insight_dashboard_access' , 'y')
            ->orWhere('internal_dashboard_access' , 'y')
            ->get();


       if(Auth::user()->isClientAdministrator()){


        $my_id = Auth::user()->id;
 
       if(!empty(User::find($my_id)->getAccounts->first())){
         $my_account = User::find($my_id)->getAccounts->first()->name;

        $getCampaigns = $getCampaign->where('cdp_user_id' , $my_id)->where('status' , $status);
       }
       else{
        $getCampaigns = NULL;
       }

       
        


        // if($my_clients->isEmpty()){
        //      $getCampaigns = User::find($my_id)->getCampaign->where('status' , $status);
        // }else{
        //     foreach ($my_clients as $key => $value) {
        //      $getCampaigns = User::find($value->client_parent)->getCampaign->where('status' , $status);
        // } 
        // }

        

        

}


       if(Auth::user()->isClient()){


        $my_id = Auth::user()->id;
        $my_account = User::find($user)->getAccounts->first()->name;

        $getCampaigns = $getCampaign->where('cdp_user_id' , $my_id)->where('status' , $status);
           


}

return view('backend.campaign.mylive')->with('getall_Campaigns' , $getCampaigns)->with('status' , $status)->with('my_account' , $my_account);

}





      public function mylive()
    {

        $status = "live";


        

if(Auth::user()->isClientAdministrator()){



     $getCampaigns = DB::table('campaign_dashboard_permission')
            ->join('campaigns', 'campaigns.id', '=', 'campaign_dashboard_permission.campaign_id')
            ->join('users', 'users.id', '=', 'campaign_dashboard_permission.user_id')
            ->select('users.*', 'campaign_dashboard_permission.*' , 'campaigns.*')
            ->where('users.id', Auth::user()->id)
            ->where('performance_dashboard_access' , 'y')
            ->orWhere('insight_dashboard_access' , 'y')
            ->orWhere('internal_dashboard_access' , 'y')
            ->get();


        // $my_id = Auth::user()->id;
        // $my_clients = User::all()->where('client_parent' , $my_id);

        // foreach ($my_clients as $key => $value) {
        //      $getCampaigns = User::find($value->client_parent)->getCampaign;
        // } 

        return view('backend.campaign.mylive')->with('getall_Campaigns' , $getCampaigns)->with('status' , $status);

}



                if (Auth::user()->isSalesDeveloper()){

                 

        $id = Auth::user()->id;

$columns = ['sales_developer_1' , 'sales_developer_2', 'sales_developer_3' , 'sales_developer_4'];

$query = Campaign::select('*');

foreach($columns as $column)
{
  $query->orWhere($column, '=', $id);
}

$getAllCampaigns = $query->get()->where('status' , 'live');

       return view('backend.campaign.mylive')->with('getall_Campaigns' , $getAllCampaigns)->with('status' , $status);
    }

}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Campaign  $Campaign
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sales_developers = User::getUserAndRoles(3);
        $clients = User::getUserAndRoles(5);
        $getAccounts = Account::all();
        $campaign = Campaign::find($id);
       return view('backend.campaign.edit')->with('get_accounts' ,$getAccounts)->with('sales_developers' , $sales_developers)->with('clients' , $clients)->with('campaign' , $campaign);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campaign  $Campaign
     * @return \Illuminate\Http\Response
     */
    public function update(CampaignRequest $Campaignrequest , $id)
    {

          $Campaign = Campaign::find($id);

          if($Campaign->account_id != $Campaignrequest->account_id){

            CampaignDashboardPermission::where('campaign_id' , $id)->where('account_id' , $Campaign->account_id)->delete();

            $users = Account::find($Campaignrequest->account_id)->getUsers;


               foreach ($users as $key => $value) {
                            $CampaignAccess = new CampaignDashboardPermission();

             $CampaignAccess->campaign_id = $id;
             $CampaignAccess->account_id = $Campaignrequest->account_id;
            $CampaignAccess->user_id = $value->id;
            $CampaignAccess->performance_dashboard_access = "n";
            $CampaignAccess->insight_dashboard_access = "n";
            $CampaignAccess->internal_dashboard_access = "n";
          $CampaignAccess->save();

            }

          }

            $Campaign->account_id = $Campaignrequest->account_id;
            $Campaign->campaign_no = $Campaignrequest->campaign_no;
            $Campaign->campaign = $Campaignrequest->campaign;
            $Campaign->performance_dashboard = $Campaignrequest->performance_dashboard;
            $Campaign->insight_dashboard = $Campaignrequest->insight_dashboard;
            $Campaign->internal_dashboard = $Campaignrequest->internal_dashboard;
      


                     $Campaign->sales_developer_1 = NULL;
                     $Campaign->sales_developer_2 = NULL;
                     $Campaign->sales_developer_3 = NULL;
                     $Campaign->sales_developer_4 = NULL;

                 if($Campaignrequest->sales_developer){
                    $count = 1;

                 


                    foreach ($Campaignrequest->sales_developer as $key => $value) {
                    // $Campaign->sales_developer_ . $count = $value;
                      $field = "sales_developer_" . $count++;
                      $Campaign->$field = $value;
                    }

                }


            $Campaign->start_date = $Campaignrequest->start_date;
            $Campaign->end_date = $Campaignrequest->end_date;
            $Campaign->status = $Campaignrequest->status;
             if($Campaignrequest->primary_contact){
            $Campaign->primary_contact = $Campaignrequest->primary_contact;
             $Campaign->user_id = $Campaignrequest->primary_contact;

             }


             if ($Campaignrequest->hasFile('briefing_document')) {


$old_briefing_document = public_path('uploads/briefing_document/'.$Campaign->briefing_document);
                File::delete($old_briefing_document);

                $briefing_document = $Campaignrequest->file('briefing_document');
                $briefing_document_filename = $Campaignrequest->campaign_no . '-' . time() . '.' . $briefing_document->getClientOriginalExtension();
                $location = public_path('uploads/briefing_document/');
                $Campaignrequest->file('briefing_document')->move($location , $briefing_document_filename);
                $Campaign->briefing_document = $briefing_document_filename;


            }

            if ($Campaignrequest->hasFile('eoc_report')) {


$old_eoc_report = public_path('uploads/eoc_report/'.$Campaign->eoc_report);
                File::delete($old_eoc_report);
                $eoc_report = $Campaignrequest->file('eoc_report');
                $eoc_report_filename = $Campaignrequest->campaign_no . '-' . time() . '.' . $eoc_report->getClientOriginalExtension();
                $location = public_path('uploads/eoc_report/');
                $Campaignrequest->file('eoc_report')->move($location , $eoc_report_filename);
                $Campaign->eoc_report = $eoc_report_filename;
            }

            if ($Campaignrequest->hasFile('data_file')) {

                $old_data_file = public_path('uploads/data_file/'.$Campaign->data_file);
                File::delete($old_data_file);
                $data_file = $Campaignrequest->file('data_file');
                $data_file_filename = $Campaignrequest->campaign_no . '-' . time() . '.' . $data_file->getClientOriginalExtension();
                $location = public_path('uploads/data_file/');
                $Campaignrequest->file('data_file')->move($location , $data_file_filename);
            $Campaign->data_file = $data_file_filename;

            }
           
            $Campaign->save();
            Session::flash('success', 'Campaign Successfully Updated.');
            return redirect('campaign/show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Campaign  $Campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $Campaign)
    {
        //
    }


    public function search(Request $request){
     if(Auth::user()->isCampaignManager()){
      $getCampaigns = Campaign::SearchByKeyword($request->keyword)->where('campaign_user_id' , Auth::user()->id)->get();

               }
         else{
      $getCampaigns = Campaign::SearchByKeyword($request->keyword)->get();
                            }

      return view('backend.campaign.show')->with('getall_Campaigns' , $getCampaigns);
      
    }


     public function searchBySales(Request $request){

           if(!empty($request->status)){
            $status = $request->status;
           }
           else{
            $status = 'live';
           }

         if(Auth::user()->isClient()){

        $my_id = Auth::user()->id;
       $getAllCampaigns = Campaign::SearchClientCampaign($request->keyword, $my_id , $status);
               $my_account = User::find($my_id)->getAccounts->first()->name;

   }


if(Auth::user()->isClientAdministrator()){

    $my_id = Auth::user()->id;

    if($request->keyword){
         $getAllCampaigns = Campaign::SearchClientCampaign($request->keyword, $my_id , $status);

    }
            $my_account = User::find($my_id)->getAccounts->first()->name;



}
     if (Auth::user()->isSalesDeveloper()){
                $my_id = Auth::user()->id;

           $user_id = $request->user_id;

$columns = ['sales_developer_1' , 'sales_developer_2', 'sales_developer_3' , 'sales_developer_4'];

$query = Campaign::select('*');

foreach($columns as $column)
{
  $query->orWhere($column, '=', $user_id);
}
$getAllCampaigns = $query->SearchByKeywordBySales($request->keyword)->get()->where('status' , 'live');

      }




      return view('backend.campaign.mylive')->with('getall_Campaigns' , $getAllCampaigns)->with('status' , $status);

    }
}
