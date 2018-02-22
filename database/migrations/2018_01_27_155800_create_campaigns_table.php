<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->nullable();
            $table->integer('campaign_user_id')->nullable();
            $table->string('campaign_no');
            $table->string('campaign');
            $table->text('performance_dashboard')->nullable();
            $table->text('insight_dashboard')->nullable();
            $table->text('internal_dashboard')->nullable();
    
            $table->integer('sales_developer_1')->unsigned()->nullable();
            $table->foreign('sales_developer_1')->references('id')->on('users');

            $table->integer('sales_developer_2')->unsigned()->nullable();
            $table->foreign('sales_developer_2')->references('id')->on('users');

            $table->integer('sales_developer_3')->unsigned()->nullable();
            $table->foreign('sales_developer_3')->references('id')->on('users');

            $table->integer('sales_developer_4')->unsigned()->nullable();
            $table->foreign('sales_developer_4')->references('id')->on('users');

            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('status',['live', 'completed' , 'not_started' , 'paused'])->default('live');
            $table->integer('primary_contact')->nullable();   
             $table->string('briefing_document')->nullable();   
              $table->string('eoc_report')->nullable();   
               $table->string('data_file')->nullable();  
                               $table->softDeletes();
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
        Schema::dropIfExists('campaigns');
    }
}
