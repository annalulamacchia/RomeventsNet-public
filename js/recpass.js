function recuperap() {
    if (document.form_reset_pass.password.value == "" || document.form_reset_pass.pass_repeate.value == "" || document.form_reset_pass.risposta.value == "") {
        Swal.fire({
            title: "Attenzione",
            text: "Inserire tutti i campi",
            icon: "warning",
            confirmButtonText: "Chiudi"
        });
        return false;
    }
    if (document.form_reset_pass.password.value != document.form_reset_pass.pass_repeate.value) {
        Swal.fire({
            title: "Attenzione",
            text: "Le due password non corrispondono",
            icon: "warning",
            confirmButtonText: "Chiudi"
        });
        return false;
    }
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;

    const isValid = passwordRegex.test(document.form_reset_pass.password.value);

    if (!isValid) {
        Swal.fire({
            title: "Attenzione",
            text: "La password deve contenere almeno 8 caratteri,un numero, un simbolo @$!%*#?& e una lettere maiuscola",
            icon: "warning",
            confirmButtonText: "Chiudi"
        });
        return false;
    }
    return true;
}