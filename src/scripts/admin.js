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
