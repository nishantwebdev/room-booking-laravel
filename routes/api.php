<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

});
Route::get('get-states', 'Admin\CustomersController@getStates')->name('get.states');
Route::get('get-cities', 'Admin\CustomersController@getCities')->name('get.cities');
