<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0');
    	\App\Role::truncate();
    	DB::table('roles')->insert([[
    		'name'  => 'administrator',
    		'description'     => 'Elomark Administrator',
    		'status'     => '0',
    		'is_client'     => 'n',
    		'created_at' => \Carbon\Carbon::now(),
    		'updated_at' => \Carbon\Carbon::now(),
    		],
    		[
    		'name'  => 'campaign_manager',
    		'description'     => 'Elomark Campaign Manager',
    		'status'     => '0',
    		'is_client'     => 'n',
    		'created_at' => \Carbon\Carbon::now(),
    		'updated_at' => \Carbon\Carbon::now(),
    		],
    		[
    		'name'  => 'sales_developer',
    		'description'     => 'Elomark Sales Developer',
    		'status'     => '0',
    		'is_client'     => 'n',
    		'created_at' => \Carbon\Carbon::now(),
    		'updated_at' => \Carbon\Carbon::now(),
    		],
    		[
    		'name'  => 'client_administrator',
    		'description'     => 'Client Administrator',
    		'status'     => '0',
    		'is_client'     => 'y',
    		'created_at' => \Carbon\Carbon::now(),
    		'updated_at' => \Carbon\Carbon::now(),
    		],
    		[
    		'name'  => 'client',
    		'description'     => 'Client User',
    		'is_client'     => 'y',
    		'status'     => '0',
    		'created_at' => \Carbon\Carbon::now(),
    		'updated_at' => \Carbon\Carbon::now(),
    		]]
    		);
    }
}
