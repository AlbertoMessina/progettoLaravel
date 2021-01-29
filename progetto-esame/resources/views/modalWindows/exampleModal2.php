<!-- The Modal -->
<div id="myModal2" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">

      <h2>Esempio MODALE NUMMERO DUEEEH</h2>
      <span class="close" onclick="closeModal(this)">&times;</span>
    </div>
    <div class="modal-body">

      <form id="exerciseForm2" method="POST" enctype="multipart/form-data">

        <div class="form-group mb-5">
          <label class="form-label" data-error="wrong" data-success="right" for="exercise-name"><span>Exercise name</span></label>
          <input type="text" id="exercise-name" name='exercise_name' class="form-control" required>
        </div>

        <div class="form-group mb-5">
          <label class="form-label" data-error="wrong" data-success="right" for="difficulty"><span>Difficulty (between 1 and 5)</span></label>
          <input type="number" id="exercise-difficulty" name='exercise_difficulty' class="form-control form-control-sm validate" min="1" max="5" required>
        </div>

        <div class="form-group">
          <label class="form-label" data-error="wrong" data-success="right" for="form8"><span>Exercise Info</span></label>
          <textarea type="text" id="exercise-info" name='exercise_info' class="md-textarea form-control" rows="4"></textarea>
        </div>

        <div class="form-group pb-3">
          <label class="form-label" data-error="wrong" data-success="right" for="loadImg"><span>LoadImage</span></label>
          <div class="multiple-img-upload">
            <input type="file" id="update-image" name="img_path" class="form-control validate">

          </div>
        </div>
        <div class="center-centered">
          <input type='submit' id="exercise_create" class="btn btn-success btn-unique" value="CREATE">
        </div>
      </form>
    </div>

  </div>

</div>