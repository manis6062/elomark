<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use App\Campaign;
use DB;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;

         protected $table = "users";



    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
      protected $fillable = ['firstname' , 'surname' , 'email' , 'phone' , 'password' , 'mobile' , 'job_title' , 'status' , 'client_parent'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

        protected $dates = ['deleted_at'];



            public function setFirstnameAttribute($firstname){
                 $this->attributes['firstname'] = ucfirst($firstname);
            }

            public function setLastnameAttribute($surname){
                 $this->attributes['surname'] = ucfirst($surname);
            }

            public function getFullName(){
               return $this->firstname . ' ' . $this->surname;
            }

   


            public function isAdministrator(){

            foreach($this->getRoles as $role){
            return (\Auth::check() && $role->name == 'administrator');
                                            }
                                              }

            public function isCampaignManager(){

            foreach($this->getRoles as $role){
            return (\Auth::check() && $role->name == 'campaign_manager');
                                            }
                                              }


             public function isSalesDeveloper(){

            foreach($this->getRoles as $role){
            return (\Auth::check() && $role->name == 'sales_developer');
                                            }
                                              }


  public function isClientAdministrator(){
                    foreach($this->getRoles as $role){
                    return (\Auth::check() && $role->name == 'client_administrator');
                    }
             }


            public function isClient(){
                    foreach($this->getRoles as $role){
                    return (\Auth::check() && $role->name == 'client');
                    }
             }



               public function getRoles()
          {
            return $this->belongsToMany('App\Role' , 'user_roles' , 'user_id' , 'role_id');
          }

            public function getAccounts()
          {
            return $this->belongsToMany('App\Account' , 'user_accounts' , 'user_id' , 'account_id');
          }


            public function getCampaign()
          {
            return $this->hasMany('App\Campaign' , 'user_id');
          }


          public function dashboardAcess()
    {
        return $this->hasMany('App\CampaignDashboardPermission');
    }


          public static function getUserAndRoles($role_id){
          return DB::select("select u.id , u.firstname, u.surname from users u left join user_roles ur on u.id = ur.user_id left join roles r on r.id = ur.role_id where role_id = $role_id and u.deleted_at IS NULL");
          }


          public static function getSalesDevelopers($role_id){
          return DB::select("select u.id , u.firstname, u.surname from users u left join user_roles ur on u.id = ur.user_id left join roles r on r.id = ur.role_id where ur.role_id = 3 and u.deleted_at IS NULL");
          }


           public static function getUsersWithoutAccount(){
                return DB::table("users")->select('*')->where('client' , 'y')->whereNotIn('id',function($query) {

                $query->select('user_id')->from('user_accounts');

                })->get();
          }


          public function scopeSearchByKeyword($query, $keyword , $is_client = NULL)
    {
     
       if ($keyword!='') {
         if(!empty($is_client == 'y')){


               $query->where(function ($query) use ($keyword) {
                $query->where("firstname", "LIKE","%$keyword%")
                    ->orWhere("surname", "LIKE", "%$keyword%")
                     ->orWhere("client", "LIKE", 'y');
            });
          }
          else{
               $query->where(function ($query) use ($keyword) {
               $query->where("firstname", "LIKE","%$keyword%")
                    ->orWhere("surname", "LIKE", "%$keyword%")
                    ->orWhere("client", "LIKE", "n");
           });
        }
  
        return $query;
    }

}



          public static function searchUsers($keyword)
    {
       if ($keyword!='') {
         return DB::select("select u.* from users u where u.client = 'n' and u.deleted_at IS NULL and (u.firstname LIKE '%{$keyword}%' or u.surname like '%{$keyword}%') ");
    }
    else
      return NULL;

}


          public static function searchClients($keyword)
    {
       if ($keyword!='') {
         return DB::select("select u.* from users u left join user_accounts u_a on u.id = u_a.user_id LEFT JOIN accounts a on u_a.account_id = a.id where ((u.client = 'y') and (u.firstname LIKE '%{$keyword}%' or u.surname like '%{$keyword}%') and u.deleted_at IS NULL)");
    }
    else
      return NULL;

}


       public static function SearchClientsAsClientAdmin($keyword , $account_id)
    {

       if ($keyword!='') {
         return DB::select("select * from users u left join user_accounts u_a on u.id = u_a.user_id LEFT JOIN accounts a on u_a.account_id = a.id where ((u.client = 'y') and (u.client_parent = 0) and (a.id = $account_id) and (u.firstname LIKE '%{$keyword}%' or u.surname like '%{$keyword}%') and u.deleted_at IS NULL)");
    }
    else
      return NULL;

}


  public function scopeGetUsersWithoutCamapign($user_id)

        {
         return DB::select('select * from users u left join user_accounts u_a on u.id = u_a.user_id LEFT JOIN accounts a on u_a.account_id = a.id left join campaigns c on c.user_id = u.id where u.client = "y" and u.deleted_at IS NULL and  u.id NOT IN(SELECT "$user_id" FROM campaigns WHERE "$user_id" IS NOT NULL)');

   }





}
