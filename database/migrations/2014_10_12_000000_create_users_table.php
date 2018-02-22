<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('surname');
            // $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('phone' , 30);
            $table->string('mobile' , 30);
            $table->string('job_title');
            $table->string('password');
            $table->integer('client_parent')->nullable();
            $table->integer('campaign_parent')->nullable();
            $table->enum('status',['live', 'suspended'])->default('live');
            $table->enum('client',['y', 'n'])->default('n');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
