
var bLoader = false;
const followerUserBtn = document.querySelector('#followerBtn');
const publicUserBtn = document.querySelector('#publicBtn');

followerUserBtn.addEventListener('click', showFollower);
publicUserBtn.addEventListener('click', showPublic);

const publicSection = document.querySelector('.user-public-container');
const followerSection = document.querySelector('.user-follower-container');

function showFollower() {
    followerSection.style.display = "flex";
    publicSection.style.display = "none";
    followerUserBtn.classList.add("active-item");
    publicUserBtn.classList.remove("active-item");
}

function showPublic() {
    publicSection.style.display = "flex";
    followerSection.style.display = "none";
    publicUserBtn.classList.add("active-item");
    followerUserBtn.classList.remove("active-item");
}

const publicUser = document.querySelectorAll('.user-card-link');
for (let i = 0; i < publicUser.length; i++) {
    publicUser[i].addEventListener("click", function () {
        if (!bLoader) {
            showUserWorkout(this);
        }
    });
 }
function showUserWorkout(elem) {
    //modal reset 
    if (!bLoader) {
        bLoader = true;
        document.querySelector('.workouts-list-div').style.display = "block";
        document.querySelector('.workout-div').style.display = "none";
        document.querySelector('#workoutTable').innerHTML = "";
        let id = elem.getAttribute('data-id');
        let name = elem.querySelector('.user-name').getAttribute('data-name');
        let surname = elem.querySelector('.user-name').getAttribute('data-surname');

        document.querySelector('#showPublicWorkoutsModal').querySelector('.show-right-title').innerHTML = ' > ' + name + ' ' + surname;

        //Ajax for retive workout
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let headers = new Headers();
        headers.append("X-CSRF-Token", token);
        fetch('/publicWorkouts/' + id, {
            method: 'GET',
            headers: headers,
        })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                if (response.status >= 400 && response.status < 499) {
                    alert("Richiesta errata");
                    operationFailedShow();
                }
                if (response.status >= 500 && response.status < 599) {
                    alert("Errore sul server");
                    operationFailedShow();
                }
            }).then(data => {
                let workouts = data.workouts;
                console.log(data);
                console.log(workouts);
                for (let i = 0; i < workouts.length; i++) {
                    workout = workouts[i];
                    let name = workout['name'];
                    let publicationDate = workout['publication_date'];
                    let id = workout['id'];

                    // set new li id in the workout table
                    let newId = document.querySelector('#workoutTable').getElementsByTagName("li").length;
                    let newElem = document.createElement("li");
                    newElem.setAttribute('id', 'li_' + newId);
                    newElem.innerHTML = '<div class="table-item">' +
                        '<div id ="li_' + newId + '_name"' + 'class ="workout-name"  data-id=' + id + ' data-name = "' + name + '">' +
                        name +
                        '</div>' +
                        '<div id ="li_' + newId + '_publication"' + 'class ="workout-type  data-pubbliation = "' + publicationDate + '" >' +
                        publicationDate +
                        '</div>' +
                        '<div  class ="button-container">' +
                        '<a class="btn  show" role = "button" data-li-reference ="li_' + newId + '">' +
                        '<i class="far fa-eye show-icon icon-table" >' +
                        '</i>' + '</a>' +
                        '</div>' +
                        '</div >';
                    //insert new workout as first workoutTable
                    let referenceNode = document.querySelector("#workoutTable li:first-child");

                    if (referenceNode == null) {
                        //first element of table;
                        document.querySelector("#workoutTable").appendChild(newElem);
                    }
                    else {
                        referenceNode.parentNode.insertBefore(newElem, referenceNode);    // referenceNode.nextSibling
                    }
                }
                let showBtns = document.querySelector('#workoutTable').querySelectorAll('.show');
                for (let i = 0; i < showBtns.length; i++) {
                    showBtns[i].addEventListener('click', showWorkout);
                }
                setTimeout(function () {
                    document.querySelector('#showPublicWorkoutsModal').style.display = "block";
                }, 0);
                bLoader= false;
            }).catch(error => {
                console.log("Si è verificato un errore!");
                operationFailedShow();
            });
    }
}
function showWorkout() {

    document.querySelector('#exerciseWorkoutList').innerHTML = "";
    let li_id = this.getAttribute('data-li-reference');
    let id = document.querySelector('#' + li_id + '_name').getAttribute('data-id')
    //Ajax call  let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    /*Ajax call*/
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let request = new Request('/workout/record/' + id, { headers: { "X-CSRFToken": token } });
    fetch(request)
        .then(response => {
            if (response.ok) {
                return response.json()
            }
            if (response.status >= 400 && response.status < 499) {
                alert("Richiesta errata");
            }
            if (response.status >= 500 && response.status < 599) {
                alert("Errore sul server");
            }
        })
        .then(data => {
            //WORKPOINT
            let workout = data.workout;
            let description = data.workout_description;
            for (let i = 0; i < workout.length; i++) {
                console.log(workout[i]);
                elem = workout[i];
                let newElem = document.createElement("li");
                newElem.innerHTML = '<div class="exercise-list-elem">' +
                    '<div class="exercise-name">' + elem.name +
                    '</div>' +
                    '<div  class="exercise-seris">' + elem.series +
                    '</div>' +
                    '<div class="exercise-repetiton">' + elem.repetition +
                    '</div>';
                document.querySelector('#exerciseWorkoutList').appendChild(newElem);
            }
            document.querySelector('#showDescription').innerHTML = data.workout_description['0'].description;
            setTimeout(function () {
                document.querySelector('.workouts-list-div').style.display = "none";
                document.querySelector('.workout-div').style.display = "flex";
            }, 100);
        }).catch(error => console.log("Si è verificato un errore!"));
}

const goBackBtn = document.querySelector('.go-back');
goBackBtn.addEventListener('click', goBack);

function goBack(){
    document.querySelector('.workouts-list-div').style.display = "block";
     document.querySelector('.workout-div').style.display = "none";
}
//MODAL HANDLER
//close modal
function closeModal(button) {
    button.parentNode.parentNode.parentNode.style.display = "none";
}
