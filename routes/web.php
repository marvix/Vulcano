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

Route::get('/', 'VulcanController@start');

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
 * ----------------------------------------------------------------------------
 * Rotas para edição do profile do usuário
 * ----------------------------------------------------------------------------
 */
Route::get('/profile/edit', 'ProfilesController@edit')->name('profile.edit');
Route::put('/profile/{id}', 'ProfilesController@update')->name('profile.update');
Route::get('/profile/deleteAvatarProfile/', 'ProfilesController@deleteAvatarProfile')->name('delete.avatar.profile');

/*
 * ----------------------------------------------------------------------------
 * Rotas para a tabela de usuários
 * ----------------------------------------------------------------------------
 */
Route::get('/users', 'UsersController@index')->name('users.index');
Route::get('/users/create', 'UsersController@create')->name('users.create');
Route::post('/users', 'UsersController@store')->name('users.store');
Route::get('/users/{id}', 'UsersController@show')->name('users.show');
Route::get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');
Route::put('/users/{id}', 'UsersController@update')->name('users.update');
//Route::delete('/users/{id}/delete', 'UsersController@destroy')->name('users.destroy');
Route::get('/users/deleteavataruser/{id}', 'UsersController@deleteAvatarUser')->name('delete.avatar.user');
Route::get('/users/active/{id}', 'UsersController@activeUser')->name('users.active');
Route::get('/users/desactive/{id}', 'UsersController@desactiveUser')->name('users.desactive');
Route::get('/users/delete/{id}', 'UsersController@getDelete')->name('users.delete');

/*
 * ----------------------------------------------------------------------------
 * Rotas para a tabela de configuração do sistema
 * ----------------------------------------------------------------------------
 */
Route::get('/config/editvalues', 'ConfigController@editvalues')->name('config.editvalues');
Route::post('/config/savevalues', 'ConfigController@savevalues')->name('config.savevalues');

Route::get('/config', 'ConfigController@index')->name('config.index');
Route::get('/config/create', 'ConfigController@create')->name('config.create');
Route::post('/config', 'ConfigController@store')->name('config.store');
Route::get('/config/{id}', 'ConfigController@show')->name('config.show');
Route::get('/config/{id}/edit', 'ConfigController@edit')->name('config.edit');
Route::put('/config/{id}', 'ConfigController@update')->name('config.update');
Route::get('/config/delete/{id}', 'ConfigController@getDelete')->name('config.delete');
/*
 * ----------------------------------------------------------------------------
 * Rotas para a tabela de papéis
 * ----------------------------------------------------------------------------
 */
Route::get('/roles', 'RolesController@index')->name('roles.index');
Route::get('/roles/create', 'RolesController@create')->name('roles.create');
Route::post('/roles', 'RolesController@store')->name('roles.store');
Route::get('/roles/{id}', 'RolesController@show')->name('roles.show');
Route::get('/roles/{id}/edit', 'RolesController@edit')->name('roles.edit');
Route::put('/roles/{id}', 'RolesController@update')->name('roles.update');
Route::get('/roles/delete/{id}', 'RolesController@getDelete')->name('roles.delete');

/*
 * ----------------------------------------------------------------------------
 * Rotas para a tabela de permissions
 * ----------------------------------------------------------------------------
 */
Route::get('/permissions', 'PermissionsController@index')->name('permissions.index');
Route::get('/permissions/create', 'PermissionsController@create')->name('permissions.create');
Route::post('/permissions', 'PermissionsController@store')->name('permissions.store');
Route::get('/permissions/{id}', 'PermissionsController@show')->name('permissions.show');
Route::get('/permissions/{id}/edit', 'PermissionsController@edit')->name('permissions.edit');
Route::put('/permissions/{id}', 'PermissionsController@update')->name('permissions.update');
Route::get('/permissions/delete/{id}', 'PermissionsController@getDelete')->name('permissions.delete');
