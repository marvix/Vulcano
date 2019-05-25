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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
 * ----------------------------------------------------------------------------
 * Rotas para edição do profile do usuário
 * ----------------------------------------------------------------------------
 */
Route::get('/profile/edit', 'UsersController@editProfile')->name('profile.edit');
Route::put('/profile/{id}', 'UsersController@updateProfile')->name('profile.update');

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
Route::delete('/users/{id}/delete', 'UsersController@destroy')->name('users.destroy');
Route::get('/users/deleteavataruser/{id}', 'UsersController@deleteAvatarUser')->name('delete.avatar.user');
Route::get('/users/active/{id}', 'UsersController@activeUser')->name('users.active');
Route::get('/users/desactive/{id}', 'UsersController@desactiveUser')->name('users.desactive');

/*
 * ----------------------------------------------------------------------------
 * Rotas para tratamento dos avatares dos usuários
 * ----------------------------------------------------------------------------
 */
Route::get('/profile/deleteAvatarProfile/', 'UsersController@deleteAvatarProfile')->name('delete.avatar.profile');
