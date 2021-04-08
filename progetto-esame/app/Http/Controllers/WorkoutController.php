<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Workout;
use App\Models\Exercise_list;
use App\Models\Exercise;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $queryBuilder = Workout::orderBy('id', 'desc');    
        $queryBuilder->where('client_id','=', Auth::user()->id);
        $workouts = $queryBuilder->get();
        return view('workout', ['workouts' => $workouts]);
    }

    /* */
    public function indexUpdate($id){
        $queryBuilder = Workout::where('id', $id);
        $workout = $queryBuilder->get();
        $queryBuilder =Exercise_list::join('exercises','exercise_lists.exercise_id','=','exercises.id')
        ->where('exercise_lists.workout_id', $id)->select('exercises.name','exercises.type','exercises.difficulty');
        $exercises = $queryBuilder->get();
        return view('editWorkout', ['workout'=> $workout], ['exercises' => $exercises]);
    }   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->all();
        $id = $request->user_id;
        $workout = new Workout();
        $workout->name = $request->name;
        $workout->publication_date = $request->publication_date;
        $workout->client_id = $id;
        $res = $workout->save(); 
        return response()->json(array('success' => true, 'workout' => $workout), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $exercises = Exercise_list::where("workout_id", $id)->delete();
        $res =  Workout::where('id', $id)->delete();
        return $res;
    }
}
