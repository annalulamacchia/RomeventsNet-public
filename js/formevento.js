function invievento() {
    if (document.invia_evento.nome.value == "" || document.invia_evento.luogo.value == "" || document.invia_evento.data.value == "" || document.invia_evento.orario.value == "" || document.invia_evento.email.value == "" || document.invia_evento.image.value == "") {
        Swal.fire({
            title: "Attenzione",
            text: "Inserire tutti i campi",
            icon: "warning",
            confirmButtonText: "Chiudi"
        });
        return false;
    }
    return true;
}