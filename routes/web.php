<?php
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('app.logs');
Route::get('/', function () {
    return redirect('/admin/home');
});

$this->get('register', 'RegisterController@registerPage')->name('register.page');
$this->post('save-register', 'RegisterController@store')->name('register.save');

Route::get('qr-code', function () {


    $pngImage = QrCode::margin(0)->format('png')
                        ->size(750)->errorCorrection('H')
                        ->generate('1');

        return response($pngImage)->header('Content-type','image/png');

});
// Authentication Routes...

$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');

    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);

    Route::resource('categories', 'Admin\CategoryController');
    Route::post('categories_mass_destroy', ['uses' => 'Admin\CategoryController@massDestroy', 'as' => 'categories.mass_destroy']);
    Route::post('categories_restore/{id}', ['uses' => 'Admin\CategoryController@restore', 'as' => 'categories.restore']);
    Route::delete('categories_perma_del/{id}', ['uses' => 'Admin\CategoryController@perma_del', 'as' => 'categories.perma_del']);

    Route::resource('countries', 'Admin\CountriesController');
    Route::post('countries_mass_destroy', ['uses' => 'Admin\CountriesController@massDestroy', 'as' => 'countries.mass_destroy']);
    Route::post('countries_restore/{id}', ['uses' => 'Admin\CountriesController@restore', 'as' => 'countries.restore']);
    Route::delete('countries_perma_del/{id}', ['uses' => 'Admin\CountriesController@perma_del', 'as' => 'countries.perma_del']);
    Route::resource('wings', 'Admin\WingsController');
    Route::post('wings_mass_destroy', ['uses' => 'Admin\WingsController@massDestroy', 'as' => 'wings.mass_destroy']);
    Route::post('wings_restore/{id}', ['uses' => 'Admin\WingsController@restore', 'as' => 'wings.restore']);
    Route::delete('wings_perma_del/{id}', ['uses' => 'Admin\WingsController@perma_del', 'as' => 'wings.perma_del']);
    Route::resource('buildings', 'Admin\BuildingsController');
    Route::post('buildings_mass_destroy', ['uses' => 'Admin\BuildingsController@massDestroy', 'as' => 'buildings.mass_destroy']);
    Route::post('buildings_restore/{id}', ['uses' => 'Admin\BuildingsController@restore', 'as' => 'buildings.restore']);
    Route::delete('buildings_perma_del/{id}', ['uses' => 'Admin\BuildingsController@perma_del', 'as' => 'buildings.perma_del']);
    Route::resource('customers', 'Admin\CustomersController');
    Route::post('customers_import', ['uses' => 'Admin\CustomersController@import', 'as' => 'customers.import']);
    Route::post('customers_mass_destroy', ['uses' => 'Admin\CustomersController@massDestroy', 'as' => 'customers.mass_destroy']);
    Route::post('customers_restore/{id}', ['uses' => 'Admin\CustomersController@restore', 'as' => 'customers.restore']);
    Route::delete('customers_perma_del/{id}', ['uses' => 'Admin\CustomersController@perma_del', 'as' => 'customers.perma_del']);
    Route::resource('rooms', 'Admin\RoomsController');
    Route::post('rooms_mass_destroy', ['uses' => 'Admin\RoomsController@massDestroy', 'as' => 'rooms.mass_destroy']);
    Route::post('rooms_restore/{id}', ['uses' => 'Admin\RoomsController@restore', 'as' => 'rooms.restore']);
    Route::delete('rooms_perma_del/{id}', ['uses' => 'Admin\RoomsController@perma_del', 'as' => 'rooms.perma_del']);
    Route::resource('bookings', 'Admin\BookingsController', ['except' => 'bookings.create']);
     Route::get('bookings/create/', ['as' => 'bookings.create', 'uses' => 'Admin\BookingsController@create']);
     Route::post('bookings/store/ajax', ['as' => 'bookings.store.ajax', 'uses' => 'Admin\BookingsController@storeAjax']);
     Route::get('bookings-confirmed', ['as' => 'bookings.confirmed', 'uses' => 'Admin\BookingsController@confirm']);
    Route::post('bookings_mass_destroy', ['uses' => 'Admin\BookingsController@massDestroy', 'as' => 'bookings.mass_destroy']);
    Route::post('bookings_restore/{id}', ['uses' => 'Admin\BookingsController@restore', 'as' => 'bookings.restore']);
    Route::delete('bookings_perma_del/{id}', ['uses' => 'Admin\BookingsController@perma_del', 'as' => 'bookings.perma_del']);
    //Route::resource('/find_rooms', 'Admin\FindRoomsController', ['except' => 'create']);
    Route::get('/find_rooms', 'Admin\FindRoomsController@index')->name('find_rooms.index');
    Route::post('/find_rooms', 'Admin\FindRoomsController@index');
    Route::post('/find_users_ajax', 'Admin\FindRoomsController@findUsersAjax')->name('find_users.ajax');
    Route::post('/getBuilding', 'Admin\FindRoomsController@getBuilding');
    Route::post('/getRoom', 'Admin\FindRoomsController@getRoom');

    /*Route::get('/bookings/create/', [
        'as' => 'find_rooms.create',
        'uses' => 'Admin\BookingsController@create'
    ]);*/

    /**
     * Punit Routes
     */
    Route::get('customer/print-card/{id}','Admin\CustomersController@printIcard');
    Route::get('check-qr-scan','ScannerController@index');
    Route::POST('get-sacnning-data','ScannerController@getData');
    Route::POST('exit-scanning-data','ScannerController@exitScan');
    Route::get('exit-out-scanning-data','ScannerController@exit');
    Route::get('confirm-card/{id}','Admin\CustomersController@confirmCard');

    // JATIN
    Route::get('token/edit', 'Admin\PrintController@edit');
    Route::post('token/update', 'Admin\PrintController@update');


});

Route::get('set-token','HomeController@setToken');
