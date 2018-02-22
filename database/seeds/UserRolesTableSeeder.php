<?php

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::statement('SET FOREIGN_KEY_CHECKS=0');
       \App\UserRole::truncate();
       DB::table('user_roles')->insert(
       	[
               'user_id'  => '1',
               'role_id'     => '1',
                'deleted_at'     => NULL,
               'created_at' => \Carbon\Carbon::now(),
               'updated_at' => \Carbon\Carbon::now(),
           ]
           );
    }
}
