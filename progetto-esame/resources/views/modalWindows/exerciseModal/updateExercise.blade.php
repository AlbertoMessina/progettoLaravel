<x-genericModal class="newExerciseModal" >
@slot('modalTitle' , 'Update Exercise')
@slot('modalId' , 'exercise_update_modal')


      <form id="updateExerciseForm"  method ="POST" enctype="multipart/form-data">
       <div style="display:none" id='liTarget'></div>
       <div style="display:none" id='updateId'></div>
        <div class="form-group mb-5">
          <label  class="form-label" data-error="wrong" data-success="right" for="exercise-name"><span>Exercise name</span></label>
          <input type="text" id="update-name"  name="update_name" class="form-control" required>
        </div>

        <div class="form-group mb-5">
          <label  class="form-label" data-error="wrong" data-success="right" for="difficulty"><span>Difficulty (betwenn 1 and 5)</span></label>
          <input type="number" id="update-difficulty" name="update_difficulty" class="form-control form-control-sm validate" min="1" max ="5" required>
        </div>
         <div class="form-group mb-5">
            <label  class="form-label" data-error="wrong" data-success="right" for="loadImg"><span>LoadImage</span></label>
            <input type="file" id="update-image" name="img_path" class="form-control validate">
          </div>
          <div>
             <img id = "update-miniature-img"> </img>
           </div>
        <div class="form-group">
          <label  class="form-label" data-error="wrong" data-success="right" for="form8"><span>Exercise Info</span></label>
          <textarea type="text" id="update-info" name="update_info" class="md-textarea form-control" rows="4"></textarea>
        </div>
        <div class="center-centered">
          <input type='submit' id="exercise_update"  class="btn btn-success btn-unique" value='UPDATE'>
       </div>
    </form>

</x-genericModal>
