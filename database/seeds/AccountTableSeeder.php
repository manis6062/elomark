<?php

use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::statement('SET FOREIGN_KEY_CHECKS=0');
       \App\Account::truncate();
       DB::table('accounts')->insert([[
				'name'  => 'Test Company 1',
				'account_no'     => '001',
				'phone'     => '55214566',
				'address_1'   => 'A Company address1',
				'address_2' => 'A Company address2',
				'address_3'     => 'A Company address3',
				'city'     => 'A Company city',
				'country_1'     => 'A Company Country1',
				'country_2' => 'A Company Country2',
				'post_code' => 'A Company Postcode',
				'email_domain' => 'A Company Email Domain',
				'secondary_domain' => 'A Company Secondary Domain',
				'status' => 'active',
				'client_logo' => 'A-Company.png',
               'created_at' => \Carbon\Carbon::now(),
               'updated_at' => \Carbon\Carbon::now(),
           ],

           [
				'name'  => 'Test Company 2',
				'account_no'     => '002',
				'phone'     => '5856366',
				'address_1'   => 'B Company address1',
				'address_2' => 'B Company address2',
				'address_3'     => 'A Company address3',
				'city'     => 'B Company city',
				'country_1'     => 'B Company Country1',
				'country_2' => 'B Company Country2',
				'post_code' => 'B Company Postcode',
				'email_domain' => 'B Company Email Domain',
				'secondary_domain' => 'B Company Secondary Domain',
				'status' => 'active',
				'client_logo' => 'B-Company.png',
               'created_at' => \Carbon\Carbon::now(),
               'updated_at' => \Carbon\Carbon::now(),
           ],
              [
				'name'  => 'Test Company 3',
				'account_no'     => '002',
				'phone'     => '5856366',
				'address_1'   => 'B Company address1',
				'address_2' => 'B Company address2',
				'address_3'     => 'A Company address3',
				'city'     => 'B Company city',
				'country_1'     => 'B Company Country1',
				'country_2' => 'B Company Country2',
				'post_code' => 'B Company Postcode',
				'email_domain' => 'B Company Email Domain',
				'secondary_domain' => 'B Company Secondary Domain',
				'status' => 'active',
				'client_logo' => 'B-Company.png',
               'created_at' => \Carbon\Carbon::now(),
               'updated_at' => \Carbon\Carbon::now(),
           ],   [
				'name'  => 'Test Company 4',
				'account_no'     => '002',
				'phone'     => '5856366',
				'address_1'   => 'B Company address1',
				'address_2' => 'B Company address2',
				'address_3'     => 'A Company address3',
				'city'     => 'B Company city',
				'country_1'     => 'B Company Country1',
				'country_2' => 'B Company Country2',
				'post_code' => 'B Company Postcode',
				'email_domain' => 'B Company Email Domain',
				'secondary_domain' => 'B Company Secondary Domain',
				'status' => 'active',
				'client_logo' => 'B-Company.png',
               'created_at' => \Carbon\Carbon::now(),
               'updated_at' => \Carbon\Carbon::now(),
           ],
              [
				'name'  => 'Test Company 5',
				'account_no'     => '002',
				'phone'     => '5856366',
				'address_1'   => 'B Company address1',
				'address_2' => 'B Company address2',
				'address_3'     => 'A Company address3',
				'city'     => 'B Company city',
				'country_1'     => 'B Company Country1',
				'country_2' => 'B Company Country2',
				'post_code' => 'B Company Postcode',
				'email_domain' => 'B Company Email Domain',
				'secondary_domain' => 'B Company Secondary Domain',
				'status' => 'active',
				'client_logo' => 'B-Company.png',
               'created_at' => \Carbon\Carbon::now(),
               'updated_at' => \Carbon\Carbon::now(),
           ]
          ]);
    }
}
