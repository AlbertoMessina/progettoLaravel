<x-genericModal class="new-workout-modal">
    @slot('modalTitle' , 'New Workout')
    @slot('modalId' , 'newWorkoutModal')
    <form id="workoutForm" method="POST" enctype="multipart/form-data">

        <div class="form-group-element">
            <label class="form-label" for="workoutName"><span>Workout name</span></label>
            <input type="text" id="workoutName" name='name' class="form-control" required>
        </div>

        <div class="form-group-element ">
            <label class="form-label" for="publicationDate"><span>Pubblication Date</span></label>
            <input type="date" id="publicationDate" name='publication_date' class="form-control" required>
        </div>
        <div class="center-centered">
            <input type='submit' id="workoutCreate" class="btn btn-success" value="CREATE">
        </div>
    </form>
</x-genericModal>