<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
      $queryBuilder->where('custom_id','=', 0);
      $queryBuilder->orWhere('custom_id','=', Auth::user()->id);
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
      $exercise->type = $request->exercise_type;
      $exercise->custom_id = Auth::user()->id;
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
      $this->removeFile($id);
      $exercise = Exercise::find($id);
      $res = Exercise::where('id', $id)->delete();
      return $res;
   }

   public function update(Request $request)
   {   
      $request->all();
      $id = $request->update_id;
      $exercise = Exercise::find($id);
      $exercise->name = $request->update_name;
      $exercise->description = $request->update_info;
      $exercise->difficulty = $request->update_difficulty;
      $exercise->type = $request->update_type;
      if ($request->hasFile('img_path')) {
         $count = count($request->file('img_path'));
         if($count > 0 ){
            $this->removeFile($id);
            $this->processfile($id, $request);
         }
      }     
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

   public function removeFile($id){
      $disk = config('filesystems.default');
      $queryBuilder = Photo::where('exercise_id', $id);
      $photos = $queryBuilder->get();
      foreach($photos as $photo){
         $img = $photo->url;
         if ($img && Storage::disk($disk)->exists($img)) {
            Storage::disk($disk)->delete($img);
         }
      }
      $queryBuilder->delete();    
      Storage::deleteDirectory(env('IMG_EXERCISE_DIR').'/'.$id);
   }

 
}
