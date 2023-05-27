
function accetta(){
var rememberCheckbox = document.getElementById("rmba");
  var bottone = document.getElementById("salv");

  if (rememberCheckbox.checked) {
    console.log("sto per abilitarlo");
    bottone.disabled = false; 
    console.log("ora è abilitato");
// permetti l'invio del form
  } else {
    bottone.disabled = true;
   // impedisce l'invio del form
  }
}


function validai() {
    
    if (document.iscrizione.nome.value == "" || document.iscrizione.cognome.value == "" || document.iscrizione.username.value == "" || document.iscrizione.email.value == "" || document.iscrizione.password.value == "" || document.iscrizione.password2.value == "" || document.iscrizione.domanda.value == "" || document.iscrizione.risposta.value == "") {
        Swal.fire({
            title: "Attenzione",
            text: "Inserire tutti i campi",
            icon: "warning",
            confirmButtonText: "Chiudi"
        });
        return false;
    }


    if (document.iscrizione.password.value != document.iscrizione.password2.value) {
        Swal.fire({
            title: "Attenzione",
            text: "Le password non corrispondono",
            icon: "warning",
            confirmButtonText: "Chiudi"
        });
        return false;
    }

    //la password deve contenere almeno 8 caratteri,una maiuscola,un numero e un simbolo

    const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;

    const isValid = passwordRegex.test(document.iscrizione.password.value);

    if (!isValid) {
        Swal.fire({
            title: "Attenzione",
            text: "La password deve contenere almeno 8 caratteri,un numero, un simbolo @$!%*#?& e una lettere maiuscola",
            icon: "warning",
            confirmButtonText: "Chiudi"
        });
        return false;
    }
}



