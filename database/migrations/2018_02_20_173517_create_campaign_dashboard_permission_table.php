<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignDashboardPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_dashboard_permission', function (Blueprint $table) {
    $table->increments('id');      
    $table->integer('user_id')->unsigned();
    $table->foreign('user_id')->references('id')->on('users');
    $table->integer('account_id')->unsigned();
    $table->foreign('account_id')->references('id')->on('accounts');
    $table->integer('campaign_id')->unsigned();
    $table->foreign('campaign_id')->references('id')->on('campaigns');
    $table->enum('performance_dashboard_access',['y', 'n'])->default('n');
    $table->enum('insight_dashboard_access',['y', 'n'])->default('n');
    $table->enum('internal_dashboard_access',['y', 'n'])->default('n');
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_dashboard_permission');
    }
}
