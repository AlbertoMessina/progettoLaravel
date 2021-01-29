
//MODAL NEW EXERCISE



/*  Add event listener to button    */
const addLinkBtn = document.querySelector("#addLink");
addLinkBtn.addEventListener("click", showNewExercise);

/*  Get newExerciseModal  */
const newExerciseModal = document.querySelector("#newExeciseModal")

/*  Show newExerciseModal   */
function showNewExercise(){
     /*FORM RESET */
     document.querySelector('#exerciseForm').reset();
     document.querySelector('#imgThumbnailPreview').innerHTML= "";
    newExerciseModal.style.display = "block";
};

/*  Add event listener to form  */ 
const creationForm = document.querySelector("#exerciseForm");
creationForm.addEventListener("submit", recordCreation);

/*  Ajax call Record Creation */

function recordCreation(event){
    event.preventDefault();
    
    /*Get value and create object*/
    let name = document.querySelector("#exerciseName").value;
    let difficulty = document.querySelector("#exerciseDifficulty").value;
    let info = document.querySelector("#exerciseInfo").value;

    let fd = new FormData();
    fd.append("exercise_name" , name);
    fd.append("exercise_difficulty", difficulty);
    fd.append("exercise_info", info);
    let data = { 
        "exercise_name" : name ,
        "exercise_difficulty" : difficulty,
        "exercise_info": info
    };
    
    //ajax call

    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          
            let json = JSON.parse(xhttp.response);
            let id = json.insertedId;
            console.log(id + '   inderted id');
           
             // set new li id
            let newId = document.querySelector('#exerciseTable').getElementsByTagName("li").length;
                      
            let newElem = document.createElement("li");
            newElem.classList.add('list-group-item');
            newElem.setAttribute('id', 'li_'+newId );
            newElem.classList.add("list-group-item");
                newElem.innerHTML = '<div class="container_internal">'+
                '<div id ="li_'+ newId+'_name"'+'class ="width-25 exercise-name"  data-id='+id+ ' data-name = '+name+'>'+
                 name +
                '</div>' +
                '<div class ="width-25 exercise-difficulty  data-difficulty = '+ difficulty+ '" >' +
                difficulty +
                '</div>' +
                '<div  class ="width-25  button-container">' +
                '<a class="btn  show" data-toggle="tooltip" data-placement="top" title="Show"  role = "button" data-li-reference ="li_'+newId+'">' +
                '<i class="far fa-eye show-exercise icon-table">' +
                '</i>' + '</a>' +
                '<a class="btn  edit" data-toggle="tooltip" data-placement="top" title="Edit" role"button" data-li-reference ="li_'+newId+'">' +
                '<i class="far fa-edit edit-execise icon-table">'+
                '</i>' + '</a>' +
                '<a class="btn  delete" data-toggle="tooltip" data-placement="top" title="Delete" role="button" data-li-reference ="li_'+newId+'">' +
                '<i class="fas fa-trash trash-exercise icon-table">' +
                '</i>' + '</a>'
                +'</div>'+
            '</div >';
            
            //insert new exercise as first
            let referenceNode = document.querySelector("#exerciseTable li:first-child");
            referenceNode.parentNode.insertBefore(newElem, referenceNode.nextSibling);
            newExerciseModal.style.display = "none";
            
         
            // event listner to new button
            //WORKPOINT
            let deleteBtn = document.querySelector('#li_'+newId).querySelector('.delete');
            deleteBtn.addEventListener("click", showDeleteExercise);

            let editBtn = document.querySelector('#li_'+newId).querySelector('.edit');
            editBtn.addEventListener("click", showUpdateExercise);

            let showBtn = document.querySelector('#li_'+newId).querySelector('.show');
            showBtn.addEventListener("click", showExercise);
            operationSuccessShow();
            document.querySelector('#exerciseForm').reset();
            document.querySelector('#imgThumbnailPreview').innerHTML= "";
        }
        //SOLVE VALIDATION ERROR
        if (this.readyState == 4 && this.status > 400) {
            operationFailedShow();
        }
      };

    xhttp.open('POST', "/exercise/create", true );
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    xhttp.setRequestHeader("X-CSRF-Token", token);
    xhttp.send(fd);
    

}

//END MODAL NEW EXERCISE

//MODAL DELETE

/*Add event listner*/
const deleteBtns = document.querySelectorAll('.delete');
for(let i = 0 ; i < deleteBtns.length; i++){
    deleteBtns[i].addEventListener("click", showDeleteExercise);
}

/*  Get deleteExerciseModal  */
const deleteExerciseModal = document.querySelector("#deleteExeciseModal")

/*  Show deleteModal   */
function showDeleteExercise(){
    deleteExerciseModal.style.display = "block";

//reference for deleting element    
    //id reference 
    let li_id = this.getAttribute('data-li-reference');
    let id = document.querySelector('#'+li_id +'_name').getAttribute('data-id');
    //set exercise id into modal div with data-attribute
    document.querySelector('#deletedId').setAttribute('data-id', id);
    document.querySelector('#checkId').innerHTML = 'Number id' +' ' + id;
    //Set li-id into modal div with data-attribute
    document.querySelector('#deletedLi').setAttribute('data-li', li_id);
};

/*Add event listner delete confirm*/
const confirmDeleteBtn = document.querySelector('#confirmDeleteBtn');
confirmDeleteBtn.addEventListener("click", deleteExercise);
/*  Ajax call Record delete */
function deleteExercise(event){
    event.preventDefault();
    let id =  document.querySelector('#deletedId').getAttribute('data-id');
    //get stored id of the li to remove
    let li_id = document.querySelector('#deletedLi').getAttribute('data-li');
    //get reference of li
    let selected_li =  document.querySelector('#'+ li_id);
   
    /* Ajax call for delete */ 
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log('element' + id + 'deleted');
            //remove li 
            selected_li.remove();
            operationSuccessShow();
            //close modal
            deleteExerciseModal.style.display = "none";
        }
    }
    xhttp.open('DELETE', 'exercise/delete/'+ id , true );
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    xhttp.setRequestHeader("X-CSRF-Token", token);
    xhttp.send(); 
}

//END MODAL DELETE


// UPDATE MODAL 
/*Add event listner*/
const updateBtns = document.querySelectorAll('.edit');
for(let i = 0 ; i < updateBtns.length; i++){
    updateBtns[i].addEventListener("click", showUpdateExercise);
}

/*  Get updateExerciseModal  */
const updateExerciseModal = document.querySelector("#updateExeciseModal")

/*  Show updateModal   */
function showUpdateExercise(){   
    // get the refence
    let li_id = this.getAttribute('data-li-reference');
    let id = document.querySelector('#'+li_id +'_name').getAttribute('data-id');
    console.log(id + 'update');
    //Ajax call for set values
    let xhttp = new XMLHttpRequest()
    xhttp.onreadystatechange = function(){
        // setting of value getting from server
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(xhttp.response);
            console.log(data);
            let name = data.exercise[0].name;
            let difficulty = data.exercise[0].difficulty;
            let info = data.exercise[0].description;
            
            document.querySelector('#updateName').setAttribute('value', name);
            document.querySelector('#updateDifficulty').setAttribute('value', difficulty);
            document.querySelector('#updateInfo').value = info;  
            document.querySelector('#updateId').setAttribute('data-id', id ); 
            document.querySelector('#updateli').setAttribute('li-id', li_id);          
            setTimeout(function(){updateExerciseModal.style.display = "block"; }, 200);
            
        }     
    };
   xhttp.open('GET', 'exercise/record/'+ id , true );
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    xhttp.setRequestHeader("X-CSRF-Token", token);
    xhttp.send(); 
}
//Update submit listner
const updateSubmitbtn = document.querySelector('#updateExerciseForm');
updateSubmitbtn.addEventListener('submit', updateExercise);

function updateExercise(event){
    event.preventDefault();
    let name = document.querySelector('#updateName').value;
    let difficulty = document.querySelector('#updateDifficulty').value;
    let info = document.querySelector('#updateInfo').value;

    if(info == null || info == ''){
        info ="No description";
  }
  if(name !='' && difficulty !='' && difficulty <= 5 && difficulty > 0 ){
      //get id for ajax call

    let id =  document.querySelector('#updateId').getAttribute('data-id');

    //form data creation
    let fd = new FormData();
    fd.append("update_name" , name);
    fd.append("update_difficulty", difficulty);
    fd.append("update_info", info);
    fd.append("update_id", id);
    //Ajax Call
    let xhttp = new XMLHttpRequest()
    xhttp.onreadystatechange = function(){
        // setting of value getting from server
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(xhttp.response);
            console.log(data);
            //change value on li
            let li_id = document.querySelector('#updateli').getAttribute('li-id');
            document.querySelector('#'+li_id + '_name').innerHTML = name;
            document.querySelector('#'+li_id + '_difficulty').innerHTML = difficulty;
            
            //show snackbar
            operationSuccessShow();
            //close modal
            updateExerciseModal.style.display = "none";
        }     
    };
    xhttp.open('POST', "/exercise/update", true );
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    xhttp.setRequestHeader("X-CSRF-Token", token);
    xhttp.send(fd);
  }
}

//END UPDATE MODAL


// SHOW MODAL
/*Add event listner*/
const showBtns = document.querySelectorAll('.show');
for(let i = 0 ; i < showBtns.length; i++){
    showBtns[i].addEventListener("click", showExercise);
}
/*  Get showExercisModal  */
const showExerciseModal = document.querySelector("#showExerciseModal");

/*  Show deleteModal   */
function showExercise(){
    //carousel flush
    document.querySelectorAll('.carousel-indicators-exercise').innerHTML = "";
    document.querySelectorAll('.carousel-inner-exercise').innerHTML = "";
    // get id for ajax call
    let li_id = this.getAttribute('data-li-reference');
    let id = document.querySelector('#'+li_id +'_name').getAttribute('data-id');
    //ajax call 
    let xhttp = new XMLHttpRequest()
    xhttp.onreadystatechange = function(){
        // setting of value getting from server
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(xhttp.response);
            
            let name = data.exercise[0].name;
            
            let info = data.exercise[0].description;
            console.log('Exercise'+ '  ' + name  + "  " + info);
                     
            document.querySelector('#infoText').innerHTML = info;  
            document.querySelector('.show-right-title').innerHTML = ">"+name;
            setTimeout(function(){showExerciseModal.style.display = "block"; }, 200);
            
        }     
    };
   xhttp.open('GET', 'exercise/record/'+ id , true );
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    xhttp.setRequestHeader("X-CSRF-Token", token);
    xhttp.send(); 
}
//END SHOW MODAL
//SnackBar handle

function operationSuccessShow(){
    let snackbar = document.querySelector('.snackbar');
    let i = document.querySelector('.snackbar i');
    let span =document.querySelector('.snackbar span');
    snackbar.classList.add("operationSuccess");
    span.innerHTML = 'Operation Success';
    // add maring
    i.classList.add('fas','fa-check', 'mr-1');
  
    setTimeout(function(){snackbar.classList.remove("operationSuccess")}, 3000);
}

function operationFailedShow(){
    let snackbar = document.querySelector('.snackbar');
    snackbar.classList.add("operationFailed");
    document.querySelector('.snackbar i').classList.add('fas', 'fa-exclamation-triangle','mr-1');
    document.querySelector('.snackbar span').innerHTML = 'Operation Failed';
    setTimeout(function(){snackbar.classList.remove("operationFailed")}, 3000);
}

//MODAL HANDLE

//close modal
function closeModal(button){
    button.parentNode.parentNode.parentNode.style.display="none";
}


// When user clicks anywhere outside of the modalCompanies, close it
window.addEventListener("click", function(event) {
    if (event.target == newExerciseModal) {
        newExerciseModal.style.display = "none";       
    }
})