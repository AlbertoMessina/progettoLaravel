
<?php

use Illuminate\Support\Facades\Route;

Route::get('/','ExercisesController@index')->name('exercise.list');
Route::get('/record','ExercisesController@getRecord')->name('exercise.getRecord');
Route::delete('/delete','ExercisesController@delete')->name('exercise.delete');
Route::post('/update','ExercisesController@update')->name('exercise.updateExercise');

Route::post('/' , 'ExercisesController@save')->name('exercise.save');
