<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignDashboardPermission extends Model
{

    protected $table = "campaign_dashboard_permission";
    protected $dates = ['deleted_at'];


    protected $fillable = ['user_id' , 'campaign_id' , 'performance_dashboard_access' , 'insight_dashboard_access' , 'internal_dashboard_access'];


      public function users()
    {
        return $this->belongsTo('App\User');
    }

       public function campaigns()
    {
        return $this->belongsTo('App\Campaign');
    }
}
