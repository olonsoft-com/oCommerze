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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


// Route group for ajax
Route::middleware(['ajax'])->group(function () {
    Route::get('/ajax/location', 'AjaxFrontController@location')->name('front.ajax.location');
    
    Route::get('/ajax/category', 'AjaxFrontController@category')->name('front.ajax.category');

    //get special filterable fields by subcategory
    Route::post('/ajax/category/filters', 'AjaxFrontController@frontAdditionalFilters')->name('front.ajax.additional.filters');

    //dashboard ajax
    Route::post( '/dashboard/ajax/category/add', 'Dashboard\AjaxController@add_category' )->name('dashboard.ajax.category.add');

    //upload options elements
    Route::post('/dashboard/ajax/jqupload', 'Dashboard\AjaxController@jqupload' )->name('dashboard.ajax.jqupload');

    //retrieve city for search filter section
    Route::post('/ajax/city','AjaxFrontController@city')->name('front.ajax.city');

    //retrieve city for search filter section
    Route::post('/ajax/subcategory','AjaxFrontController@subcategory')->name('front.ajax.subcategory');

    //retrieve brands for search filter section
    Route::post('/ajax/loadbrands','AjaxFrontController@retrieveBrands')->name('front.ajax.retrieveBrands');

    //update notification status and count
    Route::post('/ajax/notification','AjaxFrontController@notification')->name('front.ajax.notification');

    //update child status and count
    Route::post('/ajax/child_category_retrieve','AjaxFrontController@child_category_retrieve')->name('front.ajax.child_category_retrieve');

    //retrieve brand model
    Route::post('/ajax/model_retrieve','AjaxFrontController@model_retrieve')->name('front.ajax.model_retrieve');

    //retrieve additional fields
    Route::get('/ajax/additional_fields', 'AjaxFrontController@getAdditionalFields')->name('front.ajax.retrieve.additionalfields');

    //upload products
    Route::middleware(['auth'])->group(function(){
        Route::post('/ajax/product/submit', 'Dashboard\AjaxController@productSubmit')->name('front.ajax.product.submit');
    });
});

Route::group(['prefix' => '/dashboard', 'middleware' => ['web', 'auth']], function() {
	Route::get('/', 'Dashboard\DashboardController@index')->name('dashboard.index');

	//user management
	Route::group(['prefix' => 'area'], function(){
		Route::get('/', 'Dashboard\AreaController@index')->name('dashboard.area.index');
		Route::get('/create', 'Dashboard\AreaController@create')->name('dashboard.area.create');
	});

	//user management
	Route::group(['prefix' => 'customer'], function(){
		Route::get('/', 'Dashboard\CustomerController@index')->name('dashboard.customer.index');

		Route::get('/show/{user}', 'Dashboard\CustomerController@show')->name('dashboard.customer.show');

		Route::get('/create', 'Dashboard\CustomerController@create')->name('dashboard.customer.create');

		Route::post('/store', 'Dashboard\CustomerController@store')->name('dashboard.customer.store');

		Route::get('/edit/{user}', 'Dashboard\CustomerController@edit')->name('dashboard.customer.edit');

		Route::put('/update/{id}', 'Dashboard\CustomerController@update')->name('dashboard.customer.update');

		Route::delete('/delete/{id}', 'Dashboard\CustomerController@destroy')->name('dashboard.customer.delete');

		Route::get('/logout', 'Dashboard\CustomerController@logout')->name('dashboard.customer.logout');

		Route::group(['prefix' => '/requests'], function() {
			Route::get('/', 'Dashboard\RequestController@index')->name('dashboard.request.index');
		});

		Route::group(['prefix' => '/package'], function() {
			Route::get('/', 'Dashboard\PackageController@index')->name('dashboard.package.index');
			Route::get('/create', 'Dashboard\PackageController@create')->name('dashboard.package.create');
		});
	});

	//billing prefix
	Route::group(['prefix' => 'billing'], function() {
		Route::get('/', 'Dashboard\BillingController@index')->name('dashboard.billing.index');
	});

	//billing prefix
	Route::group(['prefix' => 'payment'], function() {
		Route::get('/', 'Dashboard\PaymentController@index')->name('dashboard.payment.index');
		Route::get('/pay', 'Dashboard\PaymentController@create')->name('dashboard.payment.pay');
		Route::post('/store', 'Dashboard\PaymentController@pay')->name('dashboard.payment.store');
		Route::post('/edit/{id}', 'Dashboard\PaymentController@edit')->name('dashboard.payment.edit');
		Route::put('/update/{id}', 'Dashboard\PaymentController@update')->name('dashboard.payment.update');
		Route::delete('/delete', 'Dashboard\PaymentController@pay')->name('dashboard.payment.delete');
	});

	//billing prefix
	Route::group(['prefix' => 'report'], function() {
		Route::get('/', 'Dashboard\ReportController@index')->name('dashboard.report.index');

		Route::group(['prefix' => 'billing'], function(){
			Route::get('/', 'Dashboard\ReportController@index')->name('dashboard.report.billing.index');
			Route::get('/daily', 'Dashboard\ReportController@index')->name('dashboard.report.billing.daily');
			Route::get('/weekly', 'Dashboard\ReportController@index')->name('dashboard.report.billing.weekly');
			Route::get('/monthly', 'Dashboard\ReportController@index')->name('dashboard.report.billing.monthly');
		});

		Route::group(['prefix' => 'payment'], function() {
			Route::get('/', 'Dashboard\ReportController@index')->name('dashboard.report.payment.index');
			Route::get('/', 'Dashboard\ReportController@index')->name('dashboard.report.payment.daily');
			Route::get('/', 'Dashboard\ReportController@index')->name('dashboard.report.payment.weekly');
			Route::get('/', 'Dashboard\ReportController@index')->name('dashboard.report.payment.monthly');
		});

		Route::group(['prefix' => 'customer'], function() {
			Route::get('/', 'Dashboard\ReportController@index')->name('dashboard.report.customer.index');
		});
	});

	//user management
	Route::group(['prefix' => 'support'], function(){
		Route::get('/', 'Dashboard\AreaController@index')->name('dashboard.support.index');
		Route::get('/create', 'Dashboard\SupportController@create')->name('dashboard.support.create');
	});

	//user management
	Route::group(['prefix' => 'user'], function(){
		Route::get('/', 'Dashboard\UserController@index')->name('dashboard.user.index');

		Route::get('/show/{user}', 'Dashboard\UserController@show')->name('dashboard.user.show');

		Route::get('/profile', 'Dashboard\UserController@profile')->name('dashboard.user.profile');

		Route::get('/create', 'Dashboard\UserController@create')->name('dashboard.user.create');

		Route::post('/store', 'Dashboard\UserController@store')->name('dashboard.user.store');

		Route::get('/edit/{user}', 'Dashboard\UserController@edit')->name('dashboard.user.edit');

		Route::put('/update/{id}', 'Dashboard\UserController@update')->name('dashboard.user.update');

		Route::delete('/delete/{id}', 'Dashboard\UserController@destroy')->name('dashboard.user.delete');

		Route::get('/logout', 'Dashboard\UserController@logout')->name('dashboard.user.logout');
	});

	//Roles management
	Route::group(['prefix' => 'role'], function(){
		Route::get('/', 'Dashboard\RoleController@index')->name('roles.index');

		Route::get('/show/{id}', 'Dashboard\RoleController@show')->name('roles.show');

		Route::get('/create', 'Dashboard\RoleController@create')->name('roles.create');

		Route::post('/store', 'Dashboard\RoleController@store')->name('roles.store');
		Route::get('/edit/{id}', 'Dashboard\RoleController@edit')->name('roles.edit');

		Route::put('/update/{id}', 'Dashboard\RoleController@update')->name('roles.update');

		Route::delete('/delete/{id}', 'Dashboard\RoleController@destroy')->name('roles.delete');
	});

	//Permissions management
	Route::group(['prefix' => 'permission'], function(){
		Route::get('/', 'Dashboard\PermissionController@index')->name('dashboard.permissions.index');

		Route::get('/show/{id}', 'Dashboard\PermissionController@show')->name('dashboard.permissions.show');

		Route::get('/create', 'Dashboard\PermissionController@create')->name('dashboard.permissions.create');

		Route::get('/edit/{id}', 'Dashboard\PermissionController@edit')->name('dashboard.permissions.edit');

		Route::post('/store', 'Dashboard\PermissionController@store')->name('dashboard.permissions.store');

		Route::put('/update/{id}', 'Dashboard\PermissionController@update')->name('dashboard.permissions.update');

		Route::delete('/delete/{id}', 'Dashboard\PermissionController@destroy')->name('dashboard.permissions.delete');
	});

    //option group routes under dashboard prefix
    Route::group(['prefix' => '/option'], function () {
        Route::get('/', 'Dashboard\OptionController@index')->name('dashboard.option.index');
        Route::post('/store', 'Dashboard\OptionController@store')->name('dashboard.option.store');
    });
});
