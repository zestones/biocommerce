function update_admin_status(user_id, is_admin) {

    console.log({ user_id: user_id, is_admin: is_admin })

    fetch("../php/update-user-admin-status.php", {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ user_id: user_id, is_admin: is_admin })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const input = document.getElementById(`admin-switch-${user_id}`);
                input.checked = data.is_admin;
                showAlert(data.message, 'Success', 'success');
            }
            else {
                console.error('An error occurred');
                showAlert(data.message, 'Error', 'error');
            }
        })
        .catch(error => {
            console.error('There was an error with the fetch request:', error);
            showAlert(error, 'Error', 'error');
        });
}

function delete_user_account(user_id) {
    open_confirmation_modal("Delete User Account", "Are you sure you want to delete this user's account? This action cannot be undone.", function () {
        fetch("../php/delete-user-account.php", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ user_id: user_id })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const userRow = document.getElementById(`user-item-${user_id}`);
                    userRow.parentNode.removeChild(userRow);
                    showAlert(data.message, 'Success', 'success');
                }
                else {
                    console.error('An error occurred');
                    showAlert(data.message, 'Error', 'error');
                }
            })
            .catch(error => {
                console.error('There was an error with the fetch request:', error);
                showAlert(error, 'Error', 'error');
            });
    });
}

