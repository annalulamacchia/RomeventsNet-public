function newsl(){
const campo = document.getElementById("news");
const bottone = document.getElementById("butt");

campo.addEventListener("input", function() {
  if (campo.value.trim() !== "") {
    bottone.disabled = false;
  } else {
    bottone.disabled = true;
  }
});
document.forms["news"].addEventListener("submit", function(event) {
    if (campo.value.trim() === "") {
      event.preventDefault();
     
    }
  });
}


