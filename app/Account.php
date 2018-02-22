<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Account extends Model
{

	    use SoftDeletes;


	        protected $dates = ['deleted_at'];

    use Notifiable;

    protected $table = "accounts";

    protected $fillable = ['name' , 'account_no' , 'phone' , 'address_1' , 'address_2' , 'address_3' , 'city' , 'country_1' , 'country_2' , 'post_code' , 'email_domain' , 'secondary_domain' , 'status' , 'client_logo'];


    public function getUsers()
          {
            return $this->belongsToMany('App\User' , 'user_accounts' , 'account_id' , 'user_id');
          }

          public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("name", "LIKE","%$keyword%")
                    ->orWhere("account_no", "LIKE", "%$keyword%")
                    ->orWhere("country_1", "LIKE", "%$keyword%")
                    ->orWhere("status", "LIKE", "%$keyword%")
                    ->orWhere("deleted_at", "IS", NULL);

            });
        }
        return $query;
    }

 




}
