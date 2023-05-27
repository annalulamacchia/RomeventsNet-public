function preview() {
    imagePreview.src = URL.createObjectURL(event.target.files[0]);
}

function clearImage() {
    document.getElementById('image').value = null;
    imagePreview.src = "";
}