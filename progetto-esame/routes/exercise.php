
<?php

use Illuminate\Support\Facades\Route;

Route::get('/','ExercisesController@index')->name('exercise.list');
Route::get('/record','ExercisesController@getRecord')->name('exercise.getRecord');
Route::delete('/delete/{id}','ExercisesController@delete')->where('id','[0-9]+');
Route::POST('/update','ExercisesController@update')->name('exercise.updateExercise');

Route::post('/' , 'ExercisesController@save')->name('exercise.save');
