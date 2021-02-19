//MODAL NEW EXERCISE

/*  Add event listener to button    */
const logInBtn = document.querySelector("#logInModalBtn");
logInBtn.addEventListener("click", showLogIn);

/*  Get logInModal  */
const logInModal = document.querySelector("#logInModal");

/*  Show logInModal   */
function showLogIn(){
     /*FORM RESET */
     logInModal.style.display = "block";
};

//close modal
function closeModal(button){
     button.parentNode.parentNode.parentNode.style.display="none";
 }
 
 
 // When user clicks anywhere outside of the modalCompanies, close it
 window.addEventListener("click", function(event) {
     if (event.target == logInModal) {
          logInModal.style.display = "none";       
     }
 })