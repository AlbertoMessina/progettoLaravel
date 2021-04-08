<x-genericModal class="update-workout-modal">
    @slot('modalTitle' , 'Update Workout')
    @slot('modalId' , 'updateWorkoutModal')
    <div id="wizard_1" class="modal-wizard">
        <form id="updateWorkoutForm" method="POST" enctype="multipart/form-data">
            <div class="wizard-body">
                <div class="form-group-element">
                    <label class="form-label" for="updateWorkoutName"><span>Workout name</span></label>
                    <input type="text" id="updateWorkoutName" name='name' class="form-control" required>
                </div>

                <div class="form-group-element ">
                    <label class="form-label" for="pubblicationDate"><span>Pubblication Date</span></label>
                    <input type="data" id="updatePubblicationDate" name='date' class="form-control" required>
                </div>
            </div>
            <div class="wizard-footer">
                <div class="center-centered">
                    <button type="button" id="next_0" class="btn btn-success" value="NEXT">NEXT</button>
                </div>
            </div>
            
    </div>
    <div id="wizard_2" class="modal-wizard">
        <div class="wizard-body">
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
        </div>

        <div class="wizard-footer">

            <div class="button-wizard-container center-centered">
                <button type="button" id="before_1" class="btn btn-success" value="BEFORE"> BEFORE</button>
                <button type="button" id="next_1" class="btn btn-success" value="NEXT">NEXT</button>
            </div>
        </div>
    </div>
    <div id="wizard_3" class="modal-wizard">

        <div class="wizard-body">
            <div class="form-group-element">
                <label class="form-label" for="workoutName"><span>RECAP</span></label>
                
            </div>
        </div>

        <div class="wizard-footer">
            <div class="button-wizard-container center-centered">
                <button type="button" id="before_2" class="btn btn-success" value="BEFORE">BEFORE</button>
                <input type='submit' id="exerciseUpdate" class="btn btn-success" value="submit">
            </div>
        </div>
        </form>
    </div>
</x-genericModal>