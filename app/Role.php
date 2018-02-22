<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
     protected $table = "roles";

    protected $fillable = ['name' , 'description' , 'status'];


    public function getAllUsers()
		  {
		    return $this->hasMany('App\User' , 'user_roles' , 'role_id' , 'user_id');
		  }

		   public function users()
		  {
		    return $this->belongsToMany('App\User' , 'user_roles' , 'role_id' , 'user_id');
		  }

		  
}
