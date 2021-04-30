/*  Button Reference    */
const settingBtnSubmit = document.querySelector("#profileSettingSubmit");


/*Check for name */
const userName = document.querySelector("#name");
userName.addEventListener('change', checkName);

function checkName() {
    let name = userName.value.trim();
    if (hasNumber(name) || string_has_spec_char(name)) {
        //not valid
        errorValidation(userName,"#nameError",settingBtnSubmit);
    }
    else {
        successValidation(userName,"#nameError",settingBtnSubmit);     
    }
}

/*Check for surname */
const userSurname = document.querySelector("#surname");
userSurname.addEventListener('change', checkSurname);

function checkSurname() {
    let surname = userSurname.value.trim();
    if (hasNumber(surname) || string_has_spec_char(surname)) {
        errorValidation(userSurname,"#surnameError", settingBtnSubmit);
    }
    else {
        successValidation(userSurname,"#surnameError", settingBtnSubmit);
    }
}

/*Chek for AGE*/
const age = document.querySelector("#birth");
age.addEventListener('change', checkAge);

function checkAge(){
    if (futureDate(age.value)){
        errorMessageSet(age, "#ageError", "Welcome time Traveler");
        settingBtnSubmit.disabled = true;
        return;
    }
    else{
        document.querySelector("#ageError").innerHTML="<strong> You mast have 14 to join</strong>"
        if( validateAge(age.value)){      
            successValidation(age,"#ageError" ,settingBtnSubmit);
       }
       else{
           errorValidation(age,"#ageError" ,settingBtnSubmit);
       }
    } 
}
