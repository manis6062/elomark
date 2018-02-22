<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
       \App\User::truncate();
       DB::table('users')->insert([
               'firstname'  => 'Manish',
               'surname'     => 'Awale',
                'email'   => 'manis6062@gmail.com',
               'phone' => '5524875',
               'mobile'     => '9808268373',
               'job_title'     => 'Administration',
               'status'     => 'live',
                'client'     => 'n',
                'client_parent'     => '0',
               'password' => '$2y$10$yZwy9IDv1Kc5fZ2FbXzwzunS8i6KTypf4aFZR1BlpgBdp8SN47KkS',
               'remember_token' => NULL,
               'created_at' => \Carbon\Carbon::now(),
               'updated_at' => \Carbon\Carbon::now(),
           ]);
    }
}
