<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\Photo;
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

      $request-> all();  
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
         $this->processfile($exercise->id, $request);
      }
      
      $insertedId = $exercise->id;
      return response()->json(array('success' => true, 'insertedId' => $insertedId), 200);
   }

   public function getRecord($id)
   {
      
     /* $queryBuilder = Exercise::join('photos', 'exercises.id','=','photos.exercise_id' )
      ->where('exercises.id', $id)->select("exercises.name","exercises.description","photos.url","photos.sequence");
      $data = $queryBuilder->get();
      */
      $queryBuilder = Exercise::where('id', $id);
      $exercise = $queryBuilder->get();
      $queryBuilder = Photo::where('exercise_id', $id)
      ->select('sequence',"url", "description");
      $files = $queryBuilder->get();

      $data = [
         "exercise" => $exercise,
         "files"=> $files
      ];
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
      return response()->json(array('success' => true, 'res' => $res), 200);
   }

   public function processFile($id, Request $request): bool
   {
      if (!$request->hasFile('img_path')) {
         return false;
      } 
      $files = $request->file('img_path');
      $i = 0; 
      foreach($files as $file){
         if (!$file->isValid()) {
            return false;
         }
         $photo = new Photo();         
         $fileName = '/' . $id .'/' . $i . '.' . $file->extension();
         $file->storeAs(env('IMG_EXERCISE_DIR'), $fileName, 'public');
         $photo->url = env('IMG_EXERCISE_DIR') . $fileName;
         $photo->exercise_id = $id;
         $photo->sequence = $i;
         $photo->description = "asd";
         $photo->save();
         $i++;
      }
     

      return true;
   }
}
