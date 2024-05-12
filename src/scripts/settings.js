function update_image() {
    var fileInput = document.getElementById('file-input');
    var image = document.getElementById('user-image');
    var file = fileInput.files[0];
    var reader = new FileReader();

    reader.onload = function (e) {
        image.src = e.target.result;
    }

    reader.readAsDataURL(file);
}