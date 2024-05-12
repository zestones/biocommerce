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

document.getElementById('password-form').addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData(this);
    fetch(this.action, {
        method: this.method,
        body: formData
    })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error('Error:', error));
});