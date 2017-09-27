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

Auth::routes();

Route::group(['namespace' => 'admin'], function () {
	Route::get('/', 'EmployeesController@list');	
	Route::get('admin', 'EmployeesController@list');
	Route::get('admin/empleado/{id}', 'EmployeesController@show');
	Route::get('admin/salario', 'EmployeesController@salary');
	Route::post('employees/buscar', 'EmployeesController@showEmail');
	Route::post('employees/salario', 'EmployeesController@showSalary');
});	

Route::group(['namespace' => 'api'], function () {
	Route::get('api/webapi', 'WebApiController@index');
});	