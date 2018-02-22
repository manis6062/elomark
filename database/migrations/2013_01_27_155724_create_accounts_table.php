<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('account_no');
            $table->string('phone' , 20)->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('address_3')->nullable();
            $table->string('city')->nullable();
            $table->string('country_1')->nullable();
            $table->string('country_2')->nullable();
            $table->string('post_code')->nullable();
            $table->string('primary_contact')->nullable();
            $table->string('email_domain');
            $table->string('secondary_domain')->nullable();
            $table->enum('status',['live', 'suspended'])->default('live');            $table->string('client_logo')->nullable();
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
        Schema::dropIfExists('accounts');
    }
}
