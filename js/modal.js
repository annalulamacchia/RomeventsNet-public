function popola() {

    var log = document.getElementById("login").value;

    var opzioni = {
        url: "../form_action/domande.php",
        type: "POST",
        data: { login: log },
        success: function (risposta) {
            var l1 = risposta;
            if (l1 != "") {
                var logi = document.getElementById("login1");
                logi.innerHTML = l1;
                let ar = document.getElementsByClassName("no");
                for (let i = 0; i < ar.length; i++) {
                    ar[i].style.display = 'block';
                }
            }
            else {
                var logi = document.getElementById("login1");
                logi.innerHTML = "Username o email errati. Riprova!"
                let ar = document.getElementsByClassName("no");
                for (let i = 0; i < ar.length; i++) {
                    ar[i].style.display = 'none';
                }
            }
            return true;
        },
        error: function (xhr, status, error) {
            alert("errore")
        }
    }
    $.ajax(opzioni);
}

function refresh() {
    location.reload();
}