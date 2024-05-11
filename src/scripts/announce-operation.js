function delete_wishlist_item(id) {
    fetch('../php/delete-wishlist-item.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id }),
    })
        .then(response => response.json())
        .then(data => {
            if (data) {
                const wishlistItem = document.getElementById('wishlist-item-' + id);
                wishlistItem.remove();
            }
            else console.error('An error occurred');
        })
        .catch((error) => console.error(error));
}

function add_wishlist_item(id) {

    fetch('../php/add-wishlist-item.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id }),
    })
        .then(response => response.json())
        .then(data => {
            if (data) {
                const announce = document.getElementById(id + '-announce');
                announce.style.border = '1px solid var(--secondary)';
                announce.style.boxShadow = '0 0 5px var(--secondary)';

                // modify the button icon style
                const icon = document.getElementById(id + '-wish-icon');
                icon.style.color = 'var(--secondary)';
            }
            else console.error('An error occurred');
        })
        .catch((error) => console.error(error));
}