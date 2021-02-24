<?php

use Illuminate\Support\Facades\Route;

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



Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::resource('/users', 'UsersController');
});


Route::get('/home', 'UserController@index');
/*User Route*/
Route::get('/profile' , 'UserController@profile');

/*Auth*/ 
Auth::routes();
Route::get('/checkUser', 'RegisterCotroller@checkUser');
/*Exercise Route*/

Route::get('/exercise','ExercisesController@index')->name('exercise.list');
Route::get('/exercise/record/{id}','ExercisesController@getRecord')->where('id','[0-9]+');
Route::delete('/exercise/delete/{id}','ExercisesController@delete')->where('id','[0-9]+');
Route::POST('/exercise/update','ExercisesController@update')->name('exercise.updateExercise');
Route::post('/exercise/create' , 'ExercisesController@save')->name('exercise.save');





