//Controll on submit

/*  Add event listener to button    */
const registrationBtn = document.querySelector("#registrationBtn");

/*Check for each field*/

/*Check for name */
const userName = document.querySelector("#name");
userName.addEventListener('change', checkName);

function checkName() {
    let name = userName.value.trim();
    if (hasNumber(name) || string_has_spec_char(name)) {
        //not valid
        errorValidation(userName,"#nameError",registrationBtn);
    }
    else {
        successValidation(userName,"#nameError",registrationBtn);     
    }
}

/*Check for surname */
const userSurname = document.querySelector("#surname");
userSurname.addEventListener('change', checkSurname);

function checkSurname() {
    let surname = userSurname.value.trim();
    if (hasNumber(surname) || string_has_spec_char(surname)) {
        errorValidation(userSurname,"#surnameError", registrationBtn);
    }
    else {
        successValidation(userSurname,"#surnameError", registrationBtn);
    }
}

/*Check for match password*/
const confirmPassword = document.querySelector("#password_confirmation");
confirmPassword.addEventListener('change', matchPassword);

function matchPassword(){
    let password = document.querySelector("#password");
    if( checkPassword(password.value.trim(), confirmPassword.value.trim()))
    {        
         successValidation(confirmPassword,"#passwordError", registrationBtn);
    }
    else{
        errorValidation(confirmPassword,"#passwordError",registrationBtn);
    }
}

/*Check for password format*/
const password = document.querySelector("#password");
password.addEventListener('change', passwordFormat);

function passwordFormat(){  
    if( passwordValidation(password.value.trim()))
    {    
        successValidation(password,"#passwordFormatError",registrationBtn);
        confirmPassword.disabled = false;
    }
    else{
        errorValidation(password,"#passwordFormatError",registrationBtn);
        confirmPassword.disabled = true;
    }
}

/*Chek for AGE*/
const age = document.querySelector("#birth");
age.addEventListener('change', checkAge);

function checkAge(){
    if (futureDate(age.value)){
        errorMessageSet(age, "#ageError", "Welcome time Traveler");
        registrationBtn.disabled = true;
        return;
    }
    else{
        document.querySelector("#ageError").innerHTML="<strong> You mast have 14 to join</strong>"
        if( validateAge(age.value)){      
            successValidation(age,"#ageError" ,registrationBtn);
       }
       else{
           errorValidation(age,"#ageError" ,registrationBtn);
       }
    } 
}

/*Check for email*/ 
const email = document.querySelector("#email");
email.addEventListener('change', checkMail);

function checkMail(){
    if(validateEmail(email.value.trim())){
        successValidation(email, "#emailError", registrationBtn);
    }
    else{
        errorValidation(email, "#emailError", registrationBtn);
    }

}
/* VALIDATION RULES */

//if the string has a number

function hasNumber(str) {
    var reg = /\d/g;
    return reg.test(str);
}
// if the string has special characters
function string_has_spec_char(str) {
    var reg = /[~`!#@$%\^&*+=\-\[\]\\';,_./{}\(\)\|\\":<>\?]/g;
    return reg.test(str);
}
// check if string has spaces
function string_has_spaces(str) {
    var reg = /\s/g;
    return reg.test(str);
}

function validateEmail(str) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(str);
}

function validateAge(userinput) {

    let dob = new Date(userinput);
    //calculate month difference from current date in time
    let month_diff = Date.now() - dob.getTime();

    //convert the calculated difference in date format
    let age_dt = new Date(month_diff);

    //extract year from date    
    let year = age_dt.getUTCFullYear();

    //now calculate the age of the user
    let age = Math.abs(year - 1970);

    //display the calculated age
   
    validation = true;

    if (age < 14 || age > 116) {
        validation = false;
    }
    return (validation);

}

function futureDate(userinput){
    let dob = new Date(userinput);
  
    let currentDate = new Date();
   
    let validation = false;
    if(Date.parse(dob) > Date.parse(currentDate) ){
        validation = true;
    }
    return validation;
}

function checkPassword(password, confirmPassword) {
    validation = false;
    if (password.localeCompare(confirmPassword) == 0) {
        validation = true;
    }
    return validation;
}

function passwordValidation(password){
    validation = false;
    if(hasNumber(password) && string_has_spec_char(password) &&  !string_has_spaces(password) && (password.length >= 8)) 
    {
        validation = true
    };
    return validation;
}

function errorValidation(container, errorIdContainer, disableBtn){
    container.style.border = "1px solid red";
    document.querySelector(errorIdContainer).style.display = "block";
    disableBtn.disabled = true;
}
function successValidation(container,  errorIdContainer, enableBtn){
    container.style.border = "1px solid lightgrey";
    document.querySelector(errorIdContainer).style.display = "none";
    enableBtn.disabled = false;
        
}

function errorMessageSet(container , errorIdContainer, message){
    container.style.border = "1px solid red";
    document.querySelector(errorIdContainer).style.display = "block";
    document.querySelector(errorIdContainer).innerHTML="<strong> "+ message +"</strong>"
    
}