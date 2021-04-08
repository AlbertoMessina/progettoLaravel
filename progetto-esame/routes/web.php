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


/*Auth*/ 
Auth::routes();

//Auth middleware 
Route::get('/checkUser/{mail}', 'UserController@findUserEmail');
Route::group(['middleware' => 'auth'],
    function(){
        Route::get('/home', 'UserController@index');
        /*User Route*/
        Route::get('/profile' , 'UserController@profile');
        Route::POST('/profile/update', 'UserController@update');

        /*Exercise Route*/

        Route::get('/exercise','ExercisesController@index')->name('exercise.index');
        Route::get('/exercise/record/{id}','ExercisesController@getRecord')->where('id','[0-9]+');
        Route::get('/exercise/record', 'ExercisesController@getAllRecord');
        Route::delete('/exercise/delete/{id}','ExercisesController@delete')->where('id','[0-9]+');
        Route::POST('/exercise/update','ExercisesController@update')->name('exercise.updateExercise');
        Route::post('/exercise/create' , 'ExercisesController@save')->name('exercise.save');

        /*Workout route*/
        
        Route::get('/workout', 'WorkoutController@index')->name('workout.index');
        Route::get('/workout/{id}', 'WorkoutController@indexUpdate');
        Route::POST('/workout/create', 'WorkoutController@create');
        Route::delete('/workout/delete/{id}','WorkoutController@destroy')->where('id','[0-9]+');

    }
);

