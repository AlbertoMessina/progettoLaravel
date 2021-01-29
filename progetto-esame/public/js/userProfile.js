


// Get the modal 
const modal = document.getElementById("myModal");
const modal2 = document.getElementById("myModal2");

// Get the button that opens the modal
const btn = document.getElementById("myBtn");
btn.addEventListener("click", showModal);

const btn2 = document.querySelector("#myBtn2");
btn2.addEventListener("click", showModal2);

// When the user clicks the button, open the modal 
function showModal() {
  modal.style.display = "block";
}

function showModal2() {
    modal2.style.display = "block";
  }



// When user clicks anywhere outside of the modalCompanies, close it
window.addEventListener("click", function(event) {
    if (event.target == modal) {
        modal.style.display = "none";       
    }
    if (event.target == modal2) {
        modal2.style.display = "none";       
    }
})

//Gestione chiusura modale
function closeModal(button){
    button.parentNode.parentNode.parentNode.style.display="none";
}