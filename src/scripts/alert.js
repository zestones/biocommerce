function showAlert(description, title = '', type = 'error') {
    const alertElement = document.getElementById('custom-alert');
    const iconClass = type === 'success' ? 'fa fa-check-circle' : 'fa fa-exclamation-triangle';
    const iconColor = type === 'success' ? '#28a745' : '#dc3545';

    const alertHTML = `
        <div class="alert ${type}">
            <div class="alert-title">
                <i class="${iconClass}" style="color: ${iconColor};"></i>
                ${title ? `<strong>${title}</strong> ` : ''}
            </div>
            <div class="alert-content">
                ${description}
            </div>
            <button class="close-btn" onclick="closeAlert()">&times;</button>
        </div>
    `;

    alertElement.innerHTML = alertHTML;
    setTimeout(() => {
        alertElement.innerHTML = '';
    }, 5000);
}

function closeAlert() {
    document.getElementById('custom-alert').innerHTML = '';
}
