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
            close_edit_announce_modal();
            showAlert(data.message, 'Success', 'success');
            // Update the announce data in the table
            var item = document.getElementById('wishlist-item-' + id);
            if (item == null) {
                item = document.getElementById('my-announce-quick-view');
            }

            item.querySelector('.title').textContent = data.title;
            item.querySelector('.price').textContent = data.price + '€';

            const quantityElement = item.querySelector('.quantity');
            if (quantityElement) {
                quantityElement.textContent = data.quantity;
            }
        })
        .catch(error => {
            console.error('There was an error with the fetch request:', error);
            showAlert(error, 'Error', 'error');
        });

    close_edit_announce_modal();
}

function delete_announce(id) {
    open_confirmation_modal("Delete Announce", "Are you sure you want to delete this announce? This action cannot be undone.", function () {
        fetch("../php/delete-announce.php", {
            method: 'POST',
            body: JSON.stringify({ id: id })
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                showAlert(data.message, 'Success', 'success');
                var row = document.getElementById('wishlist-item-' + id);
                if (row) {
                    row = document.getElementById('my-announce-quick-view');
                    row.remove();
                    return;
                }

                // redirect to home page
                window.location.href = '../pages/home.php';
            })
            .catch(error => {
                console.error('There was an error with the fetch request:', error);
                showAlert(error, 'Error', 'error');
            });
    });
}