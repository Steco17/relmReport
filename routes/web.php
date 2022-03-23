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
use App\Section;

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

		//section
		Route::get('sections', 'SectionsController@sections');
		Route::post('update-section-status', 'SectionsController@updateSectionStatus');
		//category admin/add-edit-category
		Route::get('categories','CategoryController@categories');
		Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
		Route::match(['get','post'],'add-edit-category/{id?}', 'CategoryController@addEditCategory');
		Route::post('append-categories-level', 'CategoryController@appendCategoryLevel');
		Route::get('delete-category-image/{id}','CategoryController@deleteCategoryImage');
		Route::get('delete-category/{id}','CategoryController@deleteCategory');

        // Packages
        Route::get('packages','PackagesController@packages');
        Route::post('update-package-status', 'PackagesController@updatePackageStatus');
		Route::get('delete-package/{id}','PackagesController@deletePackage');
        Route::match(['get','post'],'add-edit-package/{id?}','PackagesController@addEditPackage');
        Route::get('delete-package-image/{id}','PackagesController@deletePackageImage');
        Route::get('delete-package-video/{id}','PackagesController@deletePackageVideo');


        //add images
        Route::match(['get','post'],'add-images/{id}','PackagesController@addImages');
        Route::post('update-image-status','PackagesController@updateImageStatus');
        Route::get('delete-image/{id?}','PackagesController@deleteImage');

	});


});
Route::namespace('Front')->group(function(){
    Route::get('/','IndexController@index');

        // Login/Register page
    Route::get('/login-register',['as'=>'login','uses'=>'UsersController@loginRegister']);
    //Longin Users
    Route::post('/user-login','UsersController@loginUser');
    //Register Users
    Route::post('/user-register','UsersController@registerUser');
    // Logout User
    Route::get('/logout','UsersController@logoutUser');
    Route::get('/contact_us','IndexController@contact');

    //check email
    Route::match(['get','post'],'/check-email','UsersController@checkEmail');
    // Confirm Account
    Route::match(['GET','POST'],'/confirm/{code}','UsersController@confirmAccount');
    // Forgot Password
    Route::match(['get','post'],'forgot-password','UsersController@forgotPassword');


    Route::group(['middleware' => ['auth']],function(){
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
