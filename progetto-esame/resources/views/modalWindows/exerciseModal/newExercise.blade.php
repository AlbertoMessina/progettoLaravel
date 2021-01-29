<x-genericModal class="new-exercise-modal" >
@slot('modalTitle' , 'New Exercise')
@slot('modalId' , 'newExeciseModal')


      <form id="exerciseForm"  method ="POST"  enctype="multipart/form-data">

        <div class="form-group mb-5">
          <label class="form-label" data-error="wrong" data-success="right" for="exercise-name"><span>Exercise name</span></label>
          <input type="text" id="exerciseName" name='exercise_name' class="form-control" required>
        </div>

        <div class="form-group mb-5">
          <label class="form-label" data-error="wrong" data-success="right" for="difficulty"><span>Difficulty (between 1 and 5)</span></label>
          <input type="number" id="exerciseDifficulty" name='exercise_difficulty' class="form-control form-control-sm validate" min="1" max ="5" required>
        </div>

        <div class="form-group">
          <label class="form-label" data-error="wrong" data-success="right" for="form8"><span>Exercise Info</span></label>
          <textarea type="text" id="exerciseInfo" name='exercise_info' class="md-textarea form-control" placeholder="No description" rows="4" required></textarea>
        </div>

        <div class="form-group pb-3">
            <label class="form-label" data-error="wrong" data-success="right" for="loadImg"><span>LoadImage</span></label>
          <div class="multiple-img-upload">
              <input type="file" id="inputImgs" name="img_path" class="form-control validate" multiple/>
              <div style='padding:14px; margin:auto';>
                 <div id="imgThumbnailPreview">
        
                  </div>
              </div>
          </div>
        </div>  
        <div class="center-centered">
        <input type='submit' id="exerciseCreate"  class="btn btn-success btn-unique" value="CREATE">
        </div>
        
    </form>

</x-genericModal>
