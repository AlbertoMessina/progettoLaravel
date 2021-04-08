//Add EventListner
const addButton = document.querySelector("#addLink");
addButton.addEventListener('click', showUpdateWorkout);

const newWorkoutModal = document.querySelector("#updateWorkoutModal");

const cardiolist = document.querySelector('#exerciseCardioList');
const corelist = document.querySelector('#exerciseCoreList');
const upperBodylist = document.querySelector('#exerciseUpperList');
const lowerBodylist = document.querySelector('#exerciseLowerList');
const fullBodylist = document.querySelector('#exerciseFullList');

const cardioSelect = document.querySelector('#exerciseCardioSelect');
const coreSelect = document.querySelector('#exerciseCoreSelect');
const upperBodySelect = document.querySelector('#exerciseUpperSelect');
const lowerBodySelect = document.querySelector('#exerciseLowerSelect');
const fullBodySelect = document.querySelector('#exerciseFullSelect');

/*  Show newWorkoutModal   */
function showUpdateWorkout(){
    /*FORM RESET */
    document.querySelector('#workoutForm').reset();
    /*list reference*/

    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    /*Ajax call*/
    let request = new Request('/exercise/record', {headers: { "X-CSRFToken":token }});
    fetch(request)
    .then(response => {
        if(response.ok){
            return response.json()
            alert("response ok ciccio")
        }
        if (response.status >= 400 && response.status < 499) {
            alert("Richiesta errata");
         }
         if (response.status >= 500 && response.status < 599) {
            alert("Errore sul server");
         }
    })
    .then(data => {
        let exercises = data.exercise;
        /*Array sort*/
        exercises.sort((e1, e2) => {
            if(e1.type>e2.type) return 1;
            if(e1.type<e2.type) return -1;
            if(e1.type==e2.type) return 0;
        });
        /*End*/

        /*splitting the array*/
        let cardioExercise = exercises.filter(exercise => exercise.type == "cardio");
        let coreExercise = exercises.filter(exercise => exercise.type == "core");
        let fullExercise = exercises.filter(exercise => exercise.type == "fullBody");
        let lowerExercise  = exercises.filter(exercise => exercise.type == "lowerBody");
        let upperExercise = exercises.filter(exercise => exercise.type == "upperBody");

        console.log(cardioExercise);
        console.log(coreExercise);
        console.log(fullExercise);
        console.log(lowerExercise);
        console.log(upperExercise);
      
        /*list creation */
        
        optionsCreate(cardioExercise, cardiolist);
        optionsCreate(coreExercise, corelist);
        optionsCreate(fullExercise,fullBodylist);
        optionsCreate(lowerExercise,lowerBodylist);
        optionsCreate(upperExercise, upperBodylist);
       
    
      }).catch(error => console.log("Si è verificato un errore!"));
    /*Modal display*/ 
    newWorkoutModal.style.display = "block";
};

function optionsCreate(objectList , listReference){
    [].forEach.call(objectList, function (exercise) {
      
        let name = exercise.name;  
        let option = document.createElement('option');
        option.text = name;
        listReference.add(option);
    });
}
/*Select option Event listner */
const typeSelect = document.querySelector('#typeSelect');
typeSelect.addEventListener('change' , optionShow);

function optionShow(){
    let type = this.value; 
    if(type == "cardio"){
        cardioSelect.style.display = "block";
        coreSelect.style.display = "none";
        fullBodySelect.style.display = "none";
        lowerBodySelect.style.display = "none";
        upperBodySelect.style.display = "none";
    }
    if(type == "core"){
        cardioSelect.style.display = "none";
        coreSelect.style.display = "block";
        fullBodySelect.style.display = "none";
        lowerBodySelect.style.display = "none";
        upperBodySelect.style.display = "none";
    }
    if (type == "fullbody"){
        cardioSelect.style.display = "none";
        coreSelect.style.display = "none";
        fullBodySelect.style.display = "block";
        lowerBodySelect.style.display = "none";
        upperBodySelect.style.display = "none";
    }
    if (type == "lowerbody"){
        cardioSelect.style.display = "none";
        coreSelect.style.display = "none";
        fullBodySelect.style.display = "none";
        lowerBodySelect.style.display = "block";
        upperBodySelect.style.display = "none";
    }
    if (type == "upperbody"){
        cardioSelect.style.display = "none";
        coreSelect.style.display = "none";
        fullBodySelect.style.display = "none";
        lowerBodySelect.style.display = "none";
        upperBodySelect.style.display = "block";
    }
}


//close modal
function closeModal(button){
    button.parentNode.parentNode.parentNode.style.display="none";
}

// When user clicks anywhere outside of the modalCompanies, close it
window.addEventListener("click", function(event) {
    if (event.target == newWorkoutModal) {
        newWorkoutModal.style.display = "none";       
    }
});