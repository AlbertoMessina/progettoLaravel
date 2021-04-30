<x-genericModal class="new-workout-modal">
    @slot('modalTitle' , 'New Workout')
    @slot('modalId' , 'newWorkoutModal')
    <form id="workoutForm" method="POST" enctype="multipart/form-data">

        <div class="form-group-element">
            <label class="form-label" for="workoutName"><span>Workout name</span></label>
            <input type="text" id="workoutName" name='name' class="form-control" required />
            <span class="feedback" id="nameError">
                <strong> Name can't contain special element or number</strong>
            </span>
        </div>

        <div class="form-group-element ">
            <label class="form-label" for="publicationDate"><span>Pubblication Date</span></label>
            <input type="date" id="publicationDate" name='publication_date' class="form-control" required />
            <div class="feedback" id="dateError">
                <strong>Nope </strong>
            </div>
        </div>
        <div class="center-centered">
            <input type='submit' id="workoutCreate" class="btn btn-success" value="CREATE">
        </div>
    </form>
</x-genericModal>