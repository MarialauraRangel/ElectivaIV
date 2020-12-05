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

/////////////////////////////////////// AUTH ////////////////////////////////////////////////////

Auth::routes(['register' => false]);
Route::get('/registro/email', 'AuthController@emailVerify');

Route::group(['middleware' => ['login']], function () {
	Route::get('/ingresar', 'AuthController@loginForm')->name('ingresar');
	Route::get('/registro', 'AuthController@registerForm')->name('registro');
	Route::get('/recuperar', 'AuthController@recoveryForm')->name('recuperar');
	Route::get('/restaurar/{slug}', 'AuthController@resetForm')->name('restaurar');
	Route::post('/ingresar', 'AuthController@login')->name('login.custom');
	Route::post('/registro', 'AuthController@register')->name('register.custom');
	Route::post('/recuperar', 'AuthController@recovery')->name('recovery.custom');
	Route::post('/restaurar', 'AuthController@reset')->name('reset.custom');
});

Route::group(['middleware' => ['session_verify']], function () {
	Route::post('/salir', 'AuthController@logout')->name('logout.custom');

	/////////////////////////////////////////////// WEB ////////////////////////////////////////////////
	Route::get('/', 'WebController@index')->name('home');
});

Route::group(['middleware' => ['auth', 'admin']], function () {


	/////////////////////////////////////// ADMIN ///////////////////////////////////////////////////

	// Inicio
	Route::get('/admin', 'AdminController@index')->name('admin');
	Route::get('/admin/perfil', 'AdminController@profile')->name('profile');
	Route::get('/admin/perfil/editar', 'AdminController@profileEdit')->name('profile.edit');
	Route::put('/admin/perfil/', 'AdminController@profileUpdate')->name('profile.update');

	// Administradores
	Route::get('/admin/administradores', 'AdministratorController@index')->name('administradores.index');
	Route::get('/admin/administradores/registrar', 'AdministratorController@create')->name('administradores.create');
	Route::post('/admin/administradores', 'AdministratorController@store')->name('administradores.store');
	Route::get('/admin/administradores/{slug}', 'AdministratorController@show')->name('administradores.show');
	Route::get('/admin/administradores/{slug}/editar', 'AdministratorController@edit')->name('administradores.edit');
	Route::put('/admin/administradores/{slug}', 'AdministratorController@update')->name('administradores.update');
	Route::delete('/admin/administradores/{slug}', 'AdministratorController@destroy')->name('administradores.delete');
	Route::put('/admin/administradores/{slug}/activar', 'AdministratorController@activate')->name('administradores.activate');
	Route::put('/admin/administradores/{slug}/desactivar', 'AdministratorController@deactivate')->name('administradores.deactivate');

	//Category
	Route::get('/admin/category', 'CategoryController@index')->name('category.index');
	Route::get('/admin/category/registrar', 'CategoryController@create')->name('category.create');
	Route::post('/admin/category', 'CategoryController@store')->name('category.store');
	Route::get('/admin/category/{slug}/editar', 'CategoryController@edit')->name('category.edit');
	Route::put('/admin/category/{slug}', 'CategoryController@update')->name('category.update');
	Route::delete('/admin/category/{slug}', 'CategoryController@destroy')->name('category.delete');
	Route::put('/admin/category/{slug}/activar', 'CategoryController@activate')->name('category.activate');
	Route::put('/admin/category/{slug}/desactivar', 'CategoryController@deactivate')->name('category.deactivate');
	
	//Articles
	Route::get('/admin/article', 'ArticleController@index')->name('article.index');
	Route::get('/admin/article/registrar', 'ArticleController@create')->name('article.create');
	Route::post('/admin/article', 'ArticleController@store')->name('article.store');
	Route::get('/admin/article/{slug}/editar', 'ArticleController@edit')->name('article.edit');
	Route::put('/admin/article/{slug}', 'ArticleController@update')->name('article.update');
	Route::delete('/admin/article/{slug}', 'ArticleController@destroy')->name('article.delete');
	Route::put('/admin/article/{slug}/activar', 'ArticleController@activate')->name('article.activate');
	Route::put('/admin/article/{slug}/desactivar', 'ArticleController@deactivate')->name('article.deactivate');
	Route::get('/admin/article/{slug}', 'ArticleController@show')->name('article.show');

	//Customers
	Route::get('/admin/customer', 'UserController@indexC')->name('customer.index');
	Route::get('/admin/customer/registrar', 'UserController@createC')->name('customer.create');
	Route::post('/admin/customer', 'UserController@storeC')->name('customer.store');
	Route::get('/admin/customer/{slug}/editar', 'UserController@editC')->name('customer.edit');
	Route::get('/admin/customer/{slug}', 'UserController@showC')->name('customer.show');
	Route::put('/admin/customer/{slug}', 'UserController@updateC')->name('customer.update');
	Route::delete('/admin/customer/{slug}', 'UserController@destroyC')->name('customer.delete');
	Route::put('/admin/customer/{slug}/activar', 'UserController@activateC')->name('customer.activate');
	Route::put('/admin/customer/{slug}/desactivar', 'UserController@deactivateC')->name('customer.deactivate');
 
	//Providers
	Route::get('/admin/provider', 'UserController@indexP')->name('provider.index');
	Route::get('/admin/provider/registrar', 'UserController@createP')->name('provider.create');
	Route::post('/admin/provider', 'UserController@storeP')->name('provider.store');
	Route::get('/admin/provider/{slug}/editar', 'UserController@editP')->name('provider.edit');
	Route::get('/admin/provider/{slug}', 'UserController@showP')->name('provider.show');
	Route::put('/admin/provider/{slug}', 'UserController@updateP')->name('provider.update');
	Route::delete('/admin/provider/{slug}', 'UserController@destroyP')->name('provider.delete');
	Route::put('/admin/provider/{slug}/activar', 'UserController@activateP')->name('provider.activate');
	Route::put('/admin/provider/{slug}/desactivar', 'UserController@deactivateP')->name('provider.deactivate');

	//Incomes
	Route::get('/admin/income', 'IncomeController@index')->name('income.index');
	Route::get('/admin/income/registrar', 'IncomeController@create')->name('income.create');
	Route::post('/admin/income', 'IncomeController@store')->name('income.store');
	Route::get('/admin/income/{slug}/editar', 'IncomeController@edit')->name('income.edit');
	Route::put('/admin/income/{slug}', 'IncomeController@update')->name('income.update');
	// Route::delete('/admin/income/{slug}', 'IncomeController@destroy')->name('income.delete');
	Route::put('/admin/income/{slug}/activar', 'IncomeController@activate')->name('income.activate');
	Route::put('/admin/income/{slug}/desactivar', 'IncomeController@deactivate')->name('income.deactivate');

	

	// Rol
	Route::get('/admin/rol', 'RolController@index')->name('rol.index');
	Route::get('/admin/rol/registrar', 'RolController@create')->name('rol.create');
	Route::post('/admin/rol', 'RolController@store')->name('rol.store');
	Route::get('/admin/rol/{slug}/editar', 'RolController@edit')->name('rol.edit');
	Route::put('/admin/rol/{slug}', 'RolController@update')->name('rol.update');
	Route::delete('/admin/rol/{slug}', 'RolController@destroy')->name('rol.delete');
	Route::put('/admin/rol/{slug}/activar', 'RolController@activate')->name('rol.activate');
	Route::put('/admin/rol/{slug}/desactivar', 'RolController@deactivate')->name('rol.deactivate');

	Route::resource('/admin/income','IncomeController');

});