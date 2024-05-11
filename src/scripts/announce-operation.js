function delete_wishlist_item(id) {
    fetch('../php/delete-wishlist-item.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
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