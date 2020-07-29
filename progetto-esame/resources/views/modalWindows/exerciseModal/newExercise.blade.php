<x-genericModal class="newExerciseModal" >
@slot('modalTitle' , 'New Exercise')
@slot('modalId' , 'exerciseModal')
@slot('modalSubmitButton' , 'exercise_create')
@slot('modalButton' , 'Create')
      <form id="exerciseForm"  method ="POST">

        <div class="form-group mb-5">
          <label data-error="wrong" data-success="right" for="exercise-name">Exercise name</label>
          <input type="text" id="exercise-name" class="form-control">
        </div>

        <div class="form-group mb-5">
          <label data-error="wrong" data-success="right" for="difficulty">Difficulty (betwenn 1 and 5)</label>
          <input type="number" id="exercise-difficulty" class="form-control form-control-sm validate" min="1" max ="5">
        </div>

        <div class="form-group">
          <label data-error="wrong" data-success="right" for="form8">Exercise Info</label>
          <textarea type="text" id="exercise-info" class="md-textarea form-control" rows="4"></textarea>
        </div>

        <div class="form-group">
           <div class= "container mt-2">
             <button class="btn btn-primary"> Add image</button>

            <label> No image insert </label>
           </div>

        </div>
    </form>

</x-genericModal>
