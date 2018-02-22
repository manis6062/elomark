<?php

namespace App;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;
use App\Account;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Campaign extends Model
{
   use SoftDeletes;
    use Notifiable;

    protected $table = "campaigns";
    protected $dates = ['deleted_at'];


    protected $fillable = ['campaign_no' , 'campaign' , 'performance_dashboard' , 'insight_dashboard' , 'internal_dashboard' , 'sales_developer_1' , 'sales_developer_2' , 'sales_developer_3' , 'sales_developer_4' , 'start_date' , 'end_date' , 'status' , 'primary_contact' , 'briefing_document' , 'eoc_report' , 'data_file' , 'user_id' , 'campaign_user_id'];


    public function getAccountName($account_id)
          {
            return DB::select("select a.name  from  accounts a left join campaigns c on c.account_id = $account_id where a.deleted_at IS NULL");
          }


       public function roles()
    {
    return $this->belongsToMany('App\Role');
       }


           public function account()
        {
    return $this->belongsTo('App\Account');
       }


           public function getUsers()
        {
    return $this->belongsTo('App\User');
       }

             public function dashboardPermission()
    {
        return $this->hasMany('App\CampaignDashboardPermission');
    }




           public function salesDeveloper1()
        {
    return $this->belongsTo('App\User' , 'sales_developer_1');
       }


     public function salesDeveloper2()
        {
    return $this->belongsTo('App\User' , 'sales_developer_2');
       }

            public function salesDeveloper3()
        {
    return $this->belongsTo('App\User' , 'sales_developer_3');
       }

            public function salesDeveloper4()
        {
    return $this->belongsTo('App\User' , 'sales_developer_4');
       }

    
          public static function searchCampaign($keyword)
    {
       if ($keyword!='') {
         return DB::select("select * from campaigns c left join accounts a on c.account_id = a.id LEFT JOIN users u on u.id = c.user_id where c.deleted_at IS NULL and (c.campaign like '%{$keyword}%' or c.campaign_no like '%{$keyword}%' or a.name like '%{$keyword}%')");
    }
    else
      return NULL;

}


       public static function SearchClientCampaign($keyword , $user_id  , $status)
    {
       if ($keyword!='') {

    return DB::table('campaign_dashboard_permission')
            ->join('campaigns', 'campaigns.id', '=', 'campaign_dashboard_permission.campaign_id')
            ->join('users', 'users.id', '=', 'campaign_dashboard_permission.user_id')
            ->join('accounts', 'accounts.id', '=', 'campaign_dashboard_permission.account_id')
            ->select('users.*', 'campaign_dashboard_permission.*' , 'campaigns.*' , 'accounts.*' ,'campaign_dashboard_permission.user_id AS cdp_user_id')
            ->where('campaign_dashboard_permission.user_id', $user_id)
            ->where('campaigns.status', $status)
            ->where('campaigns.campaign','LIKE',"%{$keyword}%")
            ->get();




         // return DB::select("select * from campaigns c left join accounts a on c.account_id = a.id LEFT JOIN users u on u.id = c.user_id where c.deleted_at IS NULL and u.id = $user_id and a.name like '%{$keyword}%'");
    }
    else
      return NULL;

}



         public static function scopeSearchByKeyword($query, $keyword)
    {
       if ($keyword!='') {


               $query->where(function ($query) use ($keyword) {
                $query->where("campaign", "LIKE","%$keyword%")
                    ->orWhere("campaign_no", "LIKE", "%$keyword%")
                    ->orWhere("deleted_at", "IS", NULL);
            });
          }
       
  
        return $query;
    }


      public static function scopeSearchByCampaignManager($query, $keyword)
    {
       if ($keyword!='') {


               $query->where(function ($query) use ($keyword) {
                $query->where("campaign", "LIKE","%$keyword%")
                    ->orWhere("campaign_no", "LIKE", "%$keyword%");
            });
          }
       
  
        return $query;
    }




           public static function scopeSearchByKeywordBySales($query, $keyword)
    {
       if ($keyword!='') {

               $query->where(function ($query) use ($keyword) {
                $query->where("status" , "live")
                      ->where("campaign", "LIKE","%$keyword%")
                    ->orWhere("campaign_no", "LIKE", "%$keyword%");
                    // ->orWhere("status", "LIKE", "live");
            });
          }
       
  
        return $query;
    }




       
}
