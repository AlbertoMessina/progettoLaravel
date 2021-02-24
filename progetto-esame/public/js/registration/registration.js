/*Ajax call for email check  */
const email = document.querySelecton('email');
email.addEventListener('onfocusout', emailCheck);

function emailCheck(){
    if(email!=null){
        data = email.value.trim();   
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200){

            }    
        }
        xhttp.open('get','user/checkUser/', true );
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        xhttp.setRequestHeader("X-CSRF-Token", token);
        xhttp.send(data); 
    }
}
/*Ajax call for registration*/
