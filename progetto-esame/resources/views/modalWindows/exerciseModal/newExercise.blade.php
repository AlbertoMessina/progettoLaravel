<x-genericModal class="newExerciseModal" >
@slot('modalTitle' , 'New Exercise')
@slot('modalId' , 'exerciseModal')
@slot('modalSubmitButton' , '')
@slot('modalButton' , '')

      <form id="exerciseForm"  method ="POST"  enctype="multipart/form-data">

        <div class="form-group mb-5">
          <label data-error="wrong" data-success="right" for="exercise-name">Exercise name</label>
          <input type="text" id="exercise-name" name='exercise_name' class="form-control">
        </div>

        <div class="form-group mb-5">
          <label data-error="wrong" data-success="right" for="difficulty">Difficulty (betwenn 1 and 5)</label>
          <input type="number" id="exercise-difficulty" name='exercise_difficulty' class="form-control form-control-sm validate" min="1" max ="5">
        </div>

        <div class="form-group">
          <label data-error="wrong" data-success="right" for="form8">Exercise Info</label>
          <textarea type="text" id="exercise-info" name='exercise_info' class="md-textarea form-control" rows="4"></textarea>
        </div>

        <div class="form-group mb-5">
           <label data-error="wrong" data-success="right" for="loadImg">LoadImage</label>
           <input type="file" id="update-image" name="img_path" class="form-control validate">
         </div>
        <div>
        <input type='submit' id="exercise_create"  class="btn btn-success btn-unique" value="CREATE">
     </div>
    </form>

</x-genericModal>
