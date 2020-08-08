<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;

class ExercisesController extends Controller
{
    //
    public Function index()
    {

      $queryBuilder = Exercise::orderBy('id' , 'desc');
      $exercise = $queryBuilder->get();
      return view('exercise', ['exercise' => $exercise]);
   }

   public function save(Request $req){
      $exercise = new Exercise();
      $exercise-> name = $req ->name;
      $exercise-> description = $req->description;
      $exercise-> difficulty = $req->difficulty;
      $exercise-> img_path= "none";
      $exercise-> custom_id = 1;
      $saved = $exercise->save();

      $insertedId = $exercise->id;
      return response()->json(array('success' => true , 'insertedId' => $insertedId) , 200);
  }

  public function getRecord(Request $request){
      $id = $request->input('id');
      $queryBuilder = Exercise::where('id', $id);
      $data = $queryBuilder->get();
      return response()->json(array('success' => true , 'exercise' => $data) , 200);
 }

 public function delete(Request $request){
     $id = $request->input('id');
     $res = Exercise::where('id', $id)->delete();
     return $res;
      }

 public function update(Request $request){
   
          $id = $request->input('id');
          $exercise = Exercise::find($id);
          $exercise->name = $request->input('name');
          $exercise->description = $request->input('info');
          $exercise->difficulty = $request->input('difficulty');
          $res = $exercise->save();
          return $res;
          }
}
