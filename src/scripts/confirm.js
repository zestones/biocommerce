function open_confirmation_modal(title, body_ttext, confirm_callback) {
    // Create modal element
    var modal = document.createElement('div');
    modal.id = 'confirmation-modal';
    modal.className = 'modal-confirmation';

    // Modal content
    modal.innerHTML = `
        <div class="modal-content">
            <div class="modal-header">
                <h2>${title}</h2>
                <span class="close" onclick="close_confirmation_modal()">&times;</span>
            </div>
            <div class="modal-body">
                <p>${body_ttext}</p>
            </div>
            <div class="modal-footer">
                <button class="cancel-btn" onclick="close_confirmation_modal()">Cancel</button>
                <button class="confirm-btn" onclick="handleConfirmationAction()">Confirm</button>
            </div>
        </div>
    `;

    // Append modal to the document body
    document.body.appendChild(modal);

    // Set confirm callback function
    handleConfirmationAction = function () {
        confirm_callback();
        close_confirmation_modal();
    };
}

function close_confirmation_modal() {
    var modal = document.getElementById('confirmation-modal');
    if (modal) {
        modal.parentNode.removeChild(modal);
    }
}


// Example usage:
// openConfirmationModal("Delete User Account", "Are you sure you want to delete this user's account? This action cannot be undone.", deleteUserAccount);
// Where deleteUserAccount is your actual delete function
