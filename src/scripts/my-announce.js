function open_edit_announce_modal(id, title, description, price, quantity) {
    document.getElementById('save-btn').id = 'save-btn-' + id;
    var modal = document.getElementById('edit-announce-modal');

    // Fill the form fields with the announce data
    document.getElementById('edit-title').value = title;
    document.getElementById('edit-description').value = description;
    document.getElementById('edit-price').value = price;
    document.getElementById('edit-quantity').value = quantity;

    modal.style.display = "flex";
}

function close_edit_announce_modal() {
    var modal = document.getElementById('edit-announce-modal');
    modal.style.display = "none";

    var saveBtnId = modal.querySelector('.save-btn').id;
    if (saveBtnId.startsWith('save-btn-')) {
        modal.querySelector('.save-btn').id = 'save-btn';
    }
}


function save_edited_announce(id) {
    id = id.replace('save-btn-', '');

    var form = document.getElementById('edit-announce-form');
    var formData = new FormData(form);
    formData.append('id', id);

    var url = form.getAttribute('action');

    fetch(url, {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            close_edit_announce_modal();
            showAlert(data.message, 'Success', 'success');
            // Update the announce data in the table
            var row = document.getElementById('wishlist-item-' + id);
            row.querySelector('.title').textContent = data.title;
            row.querySelector('.price').textContent = data.price + '€';
            row.querySelector('.quantity').textContent = data.quantity;
        })
        .catch(error => {
            console.error('There was an error with the fetch request:', error);
            showAlert(error, 'Error', 'error');
        });

    close_edit_announce_modal();
}

