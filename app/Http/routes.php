<?php

Route::post('/person/store', 'PersonController@store');

Route::post('/valid_login', 'PersonController@valid');

Route::post('/loginEmployee', 'EmployeeController@valid');

Route::post('/ubication/store', 'UbicationController@store');

Route::get('/municipality', 'MunicipalityController@index');

Route::get('/ubication/list/{id}', 'UbicationController@list');

Route::get('/search/contact/{nombre}/{id}', 'PersonController@searchContact');

Route::get('/ubications', 'UbicationController@getUbications');

Route::get('/orders/{id}', 'OrderController@listOrders');

Route::get('/update/order/{id}', 'OrderController@updateOrder');

Route::get('/', function () {
    return view('welcome');
});