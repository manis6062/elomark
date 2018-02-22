<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::fallback(function(){
    abort(404);
});


Auth::routes();

Route::group(['middleware' => 'auth'] ,function(){

	 Route::get('/', 'HomeController@backend')->name('home');
	Route::get('dashboard', 'HomeController@backend')->name('home');

	//users routes
Route::group(['prefix' => 'user'] , function(){
	Route::get('/{id}/view' , 'UserController@index');


       // Administrator Access
	Route::get('/create' , 'UserController@create')->middleware('administrator-access');
	Route::post('/search' , 'UserController@search')->middleware('administrator-access');;
	Route::get('/show' , 'UserController@show')->middleware('administrator-access');
	Route::get('/{id}/managerCampaign' , 'UserController@managerCampaign')->name('user/managerCampaign')->middleware('administrator-access');
	
		Route::post('/managerCampaignAccess' , 'UserController@managerCampaignAccess')->name('user/managerCampaignAccess')->middleware('administrator-access');




Route::group(['middleware' => 'admin-campaign-clientadmin-access'] ,function(){
	Route::get('/create_client/{is_client}' , 'UserController@create_client');
	Route::post('/searchClient' , 'UserController@searchClient');
	Route::post('/store' , 'UserController@store');
	Route::get('/showClient' , 'UserController@showClient');
	Route::get('/{id}/edit' , 'UserController@edit');
	Route::get('/{id}/campaign' , 'UserController@campaign')->name('user/campaign');
    Route::get('delete/{id}' , 'UserController@destroy')->name('user.destroy');
	Route::post('/campaignAccess' , 'UserController@campaignAccess');
    Route::post('/campaignSearchByStatus' , 'UserController@campaignSearchByStatus');
    Route::get('/campaignSearchByStatus' , 'UserController@campaignSearchByStatus');
 });		

		Route::get('/{id}/mydetail' , 'UserController@mydetail');
			Route::patch('/update/{id}' , 'UserController@update')->name('user.update');



 });

	//account routes
Route::group(['prefix' => 'account'] , function(){


    Route::get('/create' , 'AccountController@create')->middleware('admin-campaign-access');
	Route::post('/store' , 'AccountController@store')->middleware('admin-campaign-access');

Route::group(['middleware' => 'admin-campaign-clientadmin-access'] ,function(){

	Route::get('/{id}/view' , 'AccountController@index');
	Route::post('/search' , 'AccountController@search');
	Route::get('/show' , 'AccountController@show');
	Route::get('/{id}/edit' , 'AccountController@edit');
	Route::patch('/update/{id}' , 'AccountController@update')->name('account.update');
	Route::get('delete/{id}' , 'AccountController@destroy')->name('account.destroy');
	// get primary contact ajax
	Route::post('/getEmailDomain' , 'AccountController@getEmailDomain');
	 });
 });


	//account routes
Route::group(['prefix' => 'campaign'] , function(){


       // Administrator and Campaign Manager Permission 
	Route::get('/create' , 'CampaignController@create')->middleware('admin-campaign-access');
	Route::post('/store' , 'CampaignController@store')->middleware('admin-campaign-access');
	Route::get('/{id}/edit' , 'CampaignController@edit')->middleware('admin-campaign-access');
	Route::patch('/update/{id}' , 'CampaignController@update')->name('campaign.update')->middleware('admin-campaign-access');
	Route::post('/search' , 'CampaignController@search')->middleware('admin-campaign-access');
    Route::get('/show' , 'CampaignController@show')->name('campaign.show')->middleware('admin-campaign-access');



		Route::get('/mylive' , 'CampaignController@mylive');
		Route::get('/mylivestat/{stat}' , 'CampaignController@mylivestat');

		Route::post('/searchBySales' , 'CampaignController@searchBySales');
		Route::get('/{id}/view' , 'CampaignController@index');

		




// get primary contact ajax
	Route::post('/getPrimaryContacts' , 'CampaignController@getPrimaryContacts');
	Route::post('/getEditPrimaryContacts' , 'CampaignController@getEditPrimaryContacts');
 });



	
	// Route::resource('user' , 'UserController');


    // Route::resource('account' , 'AccountController');

     // Route::resource('campaign' , 'CampaignController');


	Route::post('users/edit_users' , 'UserController@update_delete');

});

