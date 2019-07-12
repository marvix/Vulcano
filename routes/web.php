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

Route::get('/', 'Admin\VulcanController@start');

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
Route::get('/profile/edit', 'Admin\ProfilesController@edit')->name('profile.edit');
Route::put('/profile/{id}', 'Admin\ProfilesController@update')->name('profile.update');
Route::get('/profile/deleteAvatarProfile', 'Admin\ProfilesController@deleteAvatarProfile')->name('delete.avatar.profile');
Route::get('/profile/password', 'Admin\ProfilesController@editPassword')->name('profile.password.edit');
Route::put('/profile/password/{id}', 'Admin\ProfilesController@updatePassword')->name('profile.password.save');

/*
 * ----------------------------------------------------------------------------
 * Rotas para a tabela de usuários
 * ----------------------------------------------------------------------------
 */
Route::get('/users/getdata',  'Admin\UsersController@getData')->name('users.getdata');
Route::get('/users', 'Admin\UsersController@index')->name('users.index');
Route::get('/users/create', 'Admin\UsersController@create')->name('users.create');
Route::post('/users', 'Admin\UsersController@store')->name('users.store');
Route::get('/users/{id}', 'Admin\UsersController@show')->name('users.show');
Route::get('/users/{id}/edit', 'Admin\UsersController@edit')->name('users.edit');
Route::put('/users/{id}', 'Admin\UsersController@update')->name('users.update');
Route::get('/users/deleteavataruser/{id}', 'Admin\UsersController@deleteAvatarUser')->name('delete.avatar.user');
Route::get('/users/delete/{id}', 'Admin\UsersController@getDelete')->name('users.delete');

/*
 * ----------------------------------------------------------------------------
 * Rotas para a tabela de configuração do sistema
 * ----------------------------------------------------------------------------
 */
Route::get('/config/editvalues', 'Admin\ConfigController@editvalues')->name('config.editvalues');
Route::post('/config/savevalues', 'Admin\ConfigController@savevalues')->name('config.savevalues');

Route::get('/config', 'Admin\ConfigController@index')->name('config.index');
Route::get('/config/create', 'Admin\ConfigController@create')->name('config.create');
Route::post('/config', 'Admin\ConfigController@store')->name('config.store');
Route::get('/config/{id}', 'Admin\ConfigController@show')->name('config.show');
Route::get('/config/{id}/edit', 'Admin\ConfigController@edit')->name('config.edit');
Route::put('/config/{id}', 'Admin\ConfigController@update')->name('config.update');
Route::get('/config/delete/{id}', 'Admin\ConfigController@getDelete')->name('config.delete');
/*
 * ----------------------------------------------------------------------------
 * Rotas para a tabela de papéis
 * ----------------------------------------------------------------------------
 */
Route::get('/roles', 'Admin\RolesController@index')->name('roles.index');
Route::get('/roles/create', 'Admin\RolesController@create')->name('roles.create');
Route::post('/roles', 'Admin\RolesController@store')->name('roles.store');
Route::get('/roles/{id}', 'Admin\RolesController@show')->name('roles.show');
Route::get('/roles/{id}/edit', 'Admin\RolesController@edit')->name('roles.edit');
Route::put('/roles/{id}', 'Admin\RolesController@update')->name('roles.update');
Route::get('/roles/delete/{id}', 'Admin\RolesController@getDelete')->name('roles.delete');

/*
 * ----------------------------------------------------------------------------
 * Rotas para a tabela de permissions
 * ----------------------------------------------------------------------------
 */
Route::get('/permissions', 'Admin\PermissionsController@index')->name('permissions.index');
Route::get('/permissions/create', 'Admin\PermissionsController@create')->name('permissions.create');
Route::post('/permissions', 'Admin\PermissionsController@store')->name('permissions.store');
Route::get('/permissions/{id}', 'Admin\PermissionsController@show')->name('permissions.show');
Route::get('/permissions/{id}/edit', 'Admin\PermissionsController@edit')->name('permissions.edit');
Route::put('/permissions/{id}', 'Admin\PermissionsController@update')->name('permissions.update');
Route::get('/permissions/delete/{id}', 'Admin\PermissionsController@getDelete')->name('permissions.delete');

/*
 * ----------------------------------------------------------------------------
 * Rotas para a tabela de modules
 * ----------------------------------------------------------------------------
 */
Route::get('/modules', 'Admin\ModulesController@index')->name('modules.index');
Route::get('/modules/create', 'Admin\ModulesController@create')->name('modules.create');
Route::post('/modules', 'Admin\ModulesController@store')->name('modules.store');
Route::get('/modules/{id}', 'Admin\ModulesController@show')->name('modules.show');
Route::get('/modules/{id}/edit', 'Admin\ModulesController@edit')->name('modules.edit');
Route::put('/modules/{id}', 'Admin\ModulesController@update')->name('modules.update');
Route::get('/modules/delete/{id}', 'Admin\ModulesController@getDelete')->name('modules.delete');
