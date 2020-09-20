<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ExerciseRequest;
use App\Http\Requests\ExerciseUpdateRequest;

class ExercisesController extends Controller
{
   public function index()
   {

      $queryBuilder = Exercise::orderBy('id', 'desc');
      $exercise = $queryBuilder->get();
      return view('exercise', ['exercise' => $exercise]);
   }

   public function save(ExerciseRequest $request)
   {
      //$this->validate($request,$this->newRecord);
      $request->all();
      $exercise = new Exercise();
      $exercise->name = $request->exercise_name;
      if(is_null($request->exercise_info)){
         $exercise->description ="No description";   
      }else{
         $exercise->description = $request->exercise_info;
      }
      
      
      $exercise->difficulty = $request->exercise_difficulty;
      $exercise->img_path = "none";
      $exercise->custom_id = 1;
      $saved = $exercise->save();
      if ($saved) {
         if ($this->processfile($exercise->id, $request, $exercise)) {
            $exercise->save();
         }
      }
      $insertedId = $exercise->id;
      return response()->json(array('success' => true, 'insertedId' => $insertedId), 200);
   }

   public function getRecord(Request $request)
   {
      $id = $request->input('id');
      $queryBuilder = Exercise::where('id', $id);
      $data = $queryBuilder->get();
      return response()->json(array('success' => true, 'exercise' => $data), 200);
   }

   public function delete($id)
   {
      $exercise = Exercise::find($id);
      $img = $exercise->img_path;
      $disk = config('filesystems.default');
      $res = Exercise::where('id', $id)->delete();
      if ($res) {
         if ($img && Storage::disk($disk)->exists($img)) {
            Storage::disk($disk)->delete($img);
         }
      }
      return $res;
   }

   public function update(ExerciseUpdateRequest $request)
   {
      $request->all();
      $id = $request->update_id;
      $exercise = Exercise::find($id);
      $exercise->name = $request->update_name;
      $exercise->description = $request->update_info;
      $exercise->difficulty = $request->update_difficulty;
      $this->processfile($id, $request, $exercise);
      $res = $exercise->save();
      return $res;
   }

   public function processFile($id, Request $request, &$exercise): bool
   {
      if (!$request->hasfile('img_path')) {
         return false;
      }
      $file = $request->file('img_path');
      if (!$file->isValid()) {
         return false;
      }
      $fileName = '/' . $id . '.' . $file->extension();
      $file->storeAs(env('IMG_EXERCISE_DIR'), $fileName, 'public');
      $exercise->img_path = env('IMG_EXERCISE_DIR') . $fileName;

      return true;
   }
}
