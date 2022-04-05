<?php


Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/admin')->namespace('Admin')->group(function(){
	//Login Route
	Route::match(['get','post'],'/', 'AdminController@login');

	Route::group(['middleware' => ['admin']],function(){
		//all admin routes will be added here
		Route::get('dashboard', 'AdminController@dashboard');
		Route::get('logout', 'AdminController@logout');

		//settings route
		Route::get('settings', 'AdminController@settings');
		Route::POST('check-current-pwd','AdminController@chkCurrentPassword');
		Route::POST('update-current-pwd','AdminController@updateCurrentPassword');
		Route::match(['get','post'],'update-admin-details', 'AdminController@updateAdminDetails');

        // Packages
        Route::get('users','UserController@users');
        Route::post('update-user-status', 'UserController@updateUserstatus');
		Route::get('delete-user/{id}','UserController@deleteUser');
        Route::match(['get','post'],'add-edit-user/{id?}','UserController@addEditUser');


	});


});


Route::namespace('Front')->group(function(){
    //Route::get('/','IndexController@index');

        // Login/Register page
    Route::get('/login',['as'=>'login','uses'=>'UsersController@loginRegister']);
    //Longin Users
    Route::post('/user-login','UsersController@loginUser');
    // Logout User
    Route::get('/logout','UsersController@logoutUser');
    Route::get('/contact_us','IndexController@contact');
    // Confirm Account
    Route::match(['GET','POST'],'/confirm/{code}','UsersController@confirmAccount');
    // Forgot Password
    Route::match(['get','post'],'forgot-password','UsersController@forgotPassword');


    Route::group(['middleware' => ['auth']],function(){
        Route::match(['GET','POST'],'/','IndexController@index');
        Route::match(['GET','POST'],'/account','UsersController@account');
        // Check User Current Password
        Route::post('/check-user-pwd','UsersController@chkUserPassword');
        //updatePassword function.
        Route::post('/update-user-pwd','UsersController@updatePassword');
        //update profile details
        Route::match(['GET','POST'],'/update-account','UsersController@updateAccountDetails');
        Route::match(['GET','POST'],'/update-profile','UsersController@updateProfile');
    });



});

///Auth::routes()
