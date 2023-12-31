<?php

use App\Branch;
use App\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
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
// Route::get('/Online_Complain_Entry.php', 'ComplainController@getComplaint');
// Route::get('/Online_Complain_Entry.php', function () {
//   return redirect('/online-complain');
// });

Route::get('/', function () {
  return redirect(route('login'));
});
Route::get('/clear-cache', function () {
  Artisan::call('cache:clear');
  return "Cache is cleared";
});
Route::get('/clear-route', function () {
  Artisan::call('route:clear');
  return "Route is cleared";
});
Route::get('/config-cache', function () {
  Artisan::call('config:cache');
  return "Config Cache is cleared";
});

Auth::routes(['register' => false]);

Route::post('change-user-password', 'Admin\HomeController@changePassword');
Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
  Route::get('/home', 'HomeController@index')->name('home');

  Route::get('/role/index', 'RoleController@index')->name('role.list');
  Route::get('/role/create', 'RoleController@create')->name('role.create');
  Route::post('/role/store', 'RoleController@store')->name('role.store');
  Route::get('/role/edit/{id}', 'RoleController@edit')->name('role.edit');
  Route::put('/role/update/{id}', 'RoleController@update')->name('role.update');
  Route::delete('/role/destroy/{id}', 'RoleController@destroy')->name('role.destory');

  Route::get('/designation/index', 'DesignationController@index')->name('designation.list');
  Route::get('/designation/create', 'DesignationController@create')->name('designation.create');
  Route::post('/designation/store', 'DesignationController@store')->name('designation.store');
  Route::get('/designation/edit/{id}', 'DesignationController@edit')->name('designation.edit');
  Route::put('/designation/update/{id}', 'DesignationController@update')->name('designation.update');
  Route::delete('/designation/destroy/{id}', 'DesignationController@destroy')->name('designation.destroy');

  Route::get('/section/index', 'SectionController@index')->name('section.list');
  Route::get('/section/create', 'SectionController@create')->name('section.create');
  Route::post('/section/store', 'SectionController@store')->name('section.store');
  Route::get('/section/edit/{id}', 'SectionController@edit')->name('section.edit');
  Route::put('/section/update/{id}', 'SectionController@update')->name('section.update');
  Route::delete('/section/destroy/{id}', 'SectionController@destroy')->name('section.destroy');

  Route::get('/users/index', 'UserController@index')->name('users.list');
  Route::get('/users/create', 'UserController@create')->name('users.index');
  Route::post('/users/{id}', 'UserController@destroy')->name('users.destroy');
  Route::get('/users/edit/{id}', 'UserController@edit')->name('users.edit');
  Route::post('/users/update/{id}', 'UserController@update')->name('users.update');
  // Route::post('/users/delete/{id}', 'UserController@destroy')->name('users.delete');
  Route::post('/users', 'UserController@store')->name('users');
  Route::get('/get-users-by-role', 'UserController@getUsersByRole')->name('getUsersByRole');

});
