function cercacompagno() {
    if (document.compagno.nome.value == "" || document.compagno.cognome.value == "" || document.compagno.email.value == "" || document.compagno.data_nascita.value == "" || document.compagno.evento.value == "" || document.invia_evento.img.value == "") {
        Swal.fire({
            title: "Attenzione",
            text: "Inserire tutti i campi",
            icon: "warning",
            confirmButtonText: "Chiudi"
        });
        return false;
    }
    const inputField = document.getElementById('descr');

    inputField.addEventListener('input', function () {
        if (this.value.length > 100) {
            this.value = this.value.slice(0, 100); // Limita il valore ai primi 100 caratteri
        }
    });
    
    return true;
}

function accetta(){
    var rememberCheckbox = document.getElementById("rmb");
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
    