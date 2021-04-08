<x-genericModal class="edit-workout-modal">
    @slot('modalTitle' , 'Add exercise')
    @slot('modalId' , 'updateWorkoutModal')

    <form id="workoutForm" method="POST" enctype="multipart/form-data">
        <div class="select-container">
            <div class="form-group-element">
                <label class="form-label"><span>Exercise Type</span></label>
                <div>
                    <select id="typeSelect" style="width:200px">
                        <option value="0"> Select type: </option>
                        <option value="cardio">Cardio</option>
                        <option value="core">Core</option>
                        <option value="fullbody">Full body</option>
                        <option value="lowerbody">Lower body</option>
                        <option value="upperbody">Upper body</option>
                    </select>
                </div>
            </div>
            <div class="form-group-element exercise-container">
                <label class="form-label"><span>Exercise </span></label>
                <div class="select-list" id="exerciseCardioSelect" style="width:200px">
                    <select id="exerciseCardioList" style="width:200px">
                    </select>
                </div>
                <div class="select-list" id="exerciseCoreSelect" style="width:200px">
                    <select id="exerciseCoreList" style="width:200px">
                    </select>
                </div>
                <div class="select-list" id="exerciseUpperSelect" style="width:200px">
                    <select id="exerciseUpperList" style="width:200px">
                    </select>
                </div>
                <div class="select-list" id="exerciseLowerSelect" style="width:200px">
                    <select id="exerciseLowerList" style="width:200px">
                    </select>
                </div>
                <div class="select-list" id="exerciseFullSelect" style="width:200px">
                    <select id="exerciseFullList" style="width:200px">
                    </select>
                </div>
            </div>
            <div class="form-group-element exercise-container">
                <label class="label-input" for="series">{{ __('Series') }}</label>
                <input type="number" id="series" name="series" class="form-control" required min="1" max="200">
                <label class="label-input" for="repetition">{{ __('Repetition') }}</label>
                <input type="number" id="repetition" name="repetition" class="form-control" required min="1" max="200">

            </div>
        </div>
    </form>
</x-genericModal>