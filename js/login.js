
function valida() {
    if (document.login_form.login.value == "" || document.login_form.password.value == "") {
        Swal.fire({
            title: "Attenzione",
            text: "Email o password non inserite",
            icon: "warning",
            confirmButtonText: "Chiudi",
            confirmButtonTextcolor: "red"
        });
        return false;
    }
    return true;
}

function StoreData() {
    var remember = document.getElementById("rmb");

    if (remember.checked) {
        var email = document.getElementById("login1");
        var pass = document.getElementById("password1");
        localStorage.SetPsw = pass.value;
        localStorage.SetEmail = email.value;
        console.log("ciao sono qui")
    }
    else {
        localStorage.SetPsw = "";
        localStorage.SetEmail = "";
    }

}




function SavedData() {
    var email = document.getElementById("login1");
    var pass = document.getElementById("password1");
    var remember = document.getElementById("rmb");
    if (localStorage.SetEmail != undefined && localStorage.SetPsw != undefined) {
        if (localStorage.SetEmail != "" && localStorage.SetPsw != "") {
            console.log("ciao ora sono in saved data")
            email.value = localStorage.SetEmail;
            pass.value = localStorage.SetPsw;
            remember.checked = true;
        }
    }

}














