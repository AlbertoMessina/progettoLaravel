const newWorkoutModal = document.querySelector("#newWorkoutModal");

const addLinkBtn = document.querySelector("#addLink");
addLinkBtn.addEventListener("click", showNewWorkOut);
/*Show modal new Exercise */
function showNewWorkOut(){
    /*FORM RESET */
    document.querySelector('#workoutForm').reset();
    let today = new Date();
    let dd = String(today.getDate()).padStart(2, '0');
    let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    let yyyy = today.getFullYear();
    today = yyyy + "-" + mm + "-" + dd;
     document.querySelector('#publicationDate').value = today;
    /*Modal display*/ 
    newWorkoutModal.style.display = "block";
}

/*Reference add  */
const addWorkoutBtn = document.querySelector('#workoutCreate');
addWorkoutBtn.addEventListener('click', workoutCreate );

function workoutCreate(event){
    event.preventDefault();

    let form =    document.querySelector('#workoutForm');
    let user_id = document.querySelector('#pageSectionName').getAttribute('data-id');
    let fd = new FormData(form);
    fd.append('user_id', user_id);
    
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); 
    let headers = new Headers();
    headers.append("X-CSRF-Token", token);
    console.log(token);
    fetch('/workout/create',  {
        method: 'POST',
        headers: headers,
        body: fd,        
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        }
        if (response.status >= 400 && response.status < 499) {
            alert("Richiesta errata");
        }
        if (response.status >= 500 && response.status < 599) {
            alert("Errore sul server");
        }
    }).then(data => { 
        let workout = data.workout;
        
        let id = workout['id'];
        let name = workout['name'];
        let publicationDate = workout['publication_date'];
       
       
         // set new li id in the workout table
        let newId = document.querySelector('#workoutTable').getElementsByTagName("li").length;     
        let newElem = document.createElement("li");
        newElem.setAttribute('id', 'li_'+newId );
            newElem.innerHTML = '<div class="table-item">'+
            '<div id ="li_'+ newId+'_name"'+'class ="workout-name"  data-id='+id+ ' data-name = "'+name+'">'+
             name +
            '</div>' +
            '<div id ="li_'+ newId+'_publication"'+'class ="workout-type  data-pubbliation = "'+ publicationDate+ '" >' +
            publicationDate +
            '</div>' +
            '<div  class ="button-container">' +
            '<a class="btn  show" role = "button" data-li-reference ="li_'+newId+'">' +
            '<i class="far fa-eye show-workout icon-table" >' +
            '</i>' + '</a>' +
            '<a class="btn  edit" role"button" data-li-reference ="li_'+newId+'">' +
            '<i class="far fa-edit edit-workout icon-table"  >'+
            '</i>' + '</a>' +
            '<a class="btn  delete"  role="button" data-li-reference ="li_'+newId+'">' +
            '<i class="fas fa-trash trash-workout icon-table" >' +
            '</i>' + '</a>'
            +'</div>'+
        '</div >';
        //insert new workout as first workoutTable
        let referenceNode = document.querySelector("#workoutTable li:first-child");
          
        if(referenceNode == null){
            //first element of table;
            document.querySelector("#workoutTable").appendChild(newElem);
        }
        else{
            referenceNode.parentNode.insertBefore(newElem, referenceNode);    // referenceNode.nextSibling
         }
         setTimeout(function(){window.location.href = "/workout/"+ id; }, 200);
         
        
    }).catch(error => console.log("Si è verificato un errore!"));;
}

//Delete workout
/*Add event listner*/

const deleteBtns = document.querySelectorAll('.delete');
for(let i = 0 ; i < deleteBtns.length; i++){
    deleteBtns[i].addEventListener("click", showDeleteWorkout);
}

/*  Get deleteExerciseModal  */
const deleteWorkoutModal = document.querySelector("#deleteWorkoutModal");

/*  Show deleteModal   */
function showDeleteWorkout(){
    deleteWorkoutModal.style.display = "block";

//reference for deleting element    
    //id reference 
    let li_id = this.getAttribute('data-li-reference');
    let id = document.querySelector('#'+li_id +'_name').getAttribute('data-id');
    //set workout id into modal div with data-attribute
    document.querySelector('#deletedId').setAttribute('data-id', id);
    document.querySelector('#checkId').innerHTML = 'Number id' +' ' + id;
    //Set li-id into modal div with data-attribute
    document.querySelector('#deletedLi').setAttribute('data-li', li_id);
};

/*Add event listner delete confirm*/
const confirmDeleteBtn = document.querySelector('#confirmDeleteBtn');
confirmDeleteBtn.addEventListener("click", deleteWorkout);
/*  Ajax call Record delete */
function deleteWorkout(event){
    event.preventDefault();
    let id =  document.querySelector('#deletedId').getAttribute('data-id');
    //get stored id of the li to remove
    let li_id = document.querySelector('#deletedLi').getAttribute('data-li');
    //get reference of li
    let selected_li =  document.querySelector('#'+ li_id);
   
    /* Ajax call for delete */   
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); 
    let headers = new Headers();
    headers.append("X-CSRF-Token", token);

    fetch('/workout/delete/'+id,  {
        method: 'DELETE',
        headers: headers,      
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        }
        if (response.status >= 400 && response.status < 499) {
            alert("Richiesta errata");
        }
        if (response.status >= 500 && response.status < 599) {
            alert("Errore sul server");
        }
    }).then(data => {  
        selected_li.remove();
        //close modal
        deleteWorkoutModal.style.display = "none";
     }).catch(error => console.log("Si è verificato un errore!"));;
}


//END DELETE

// UPDATE MODAL 
/*Add event listner*/
const updateBtns = document.querySelectorAll('.edit');
for(let i = 0 ; i < updateBtns.length; i++){
    updateBtns[i].addEventListener("click", showUpdateWorkout);
}
/*  Show updateModal   */
function showUpdateWorkout(){   
    let li_id = this.getAttribute('data-li-reference');
    let id = document.querySelector('#'+li_id +'_name').getAttribute('data-id')
    window.location.href = "/workout/"+ id;
}
//END UPDATE MODAL

//close modal
function closeModal(button){
    button.parentNode.parentNode.parentNode.style.display="none";
}

// When user clicks anywhere outside of the modalCompanies, close it
window.addEventListener("click", function(event) {
    if (event.target == newWorkoutModal) {
        newWorkoutModal.style.display = "none";       
    }
})
