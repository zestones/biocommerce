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

function add_wishlist_item(announce_id) {
    fetch('../php/add-wishlist-item.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ announce_id: announce_id }),
    })
        .then(response => response.json())
        .then(data => {
            if (data["saved"] == true) {
                const icon = document.getElementById(announce_id + '-wish-icon');
                icon.style.color = 'var(--secondary)';
            } else if (data["removed"] == true) {
                const icon = document.getElementById(announce_id + '-wish-icon');
                icon.style.color = 'var(--white)';
            }
            else console.error('An error occurred');
        })
        .catch((error) => console.error(error));
}

function add_cart_item(announce_id) {
    fetch('../php/add-cart-item.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ announce_id: announce_id, quantity: 1 }),
    })
        .then(response => response.json())
        .then(data => {
            if (data["saved"] == true) {
                const icon = document.getElementById(announce_id + '-cart-icon');
                icon.style.color = 'var(--secondary)';
            } else if (data["removed"] == true) {
                const icon = document.getElementById(announce_id + '-cart-icon');
                icon.style.color = 'var(--white)';
            }
            else console.error('An error occurred');
        })
        .catch((error) => console.error(error));
}

function increment(announce_id) {
    const count = document.getElementById('count-' + announce_id);
    const quantity = parseInt(count.innerText);
    count.innerText = quantity + 1;
    update_subtotal(quantity + 1, announce_id);
}

function decrement(announce_id) {
    const count = document.getElementById('count-' + announce_id);
    const quantity = Math.max(parseInt(count.innerText) - 1, 0);
    count.innerText = quantity;
    update_subtotal(quantity, announce_id);
}

function update_subtotal(quantity, announce_id) {
    const price = parseFloat(document.getElementById('price-' + announce_id).innerText);
    const subtotal = price * quantity;
    document.getElementById('subtotal-' + announce_id).innerText = subtotal.toFixed(2) + '€';
    update_total_price();
}

function update_total_price() {
    const subtotals = document.querySelectorAll('.subtotal');
    let total = 0;
    for (let i = 0; i < subtotals.length; i++) {
        total += parseFloat(subtotals[i].innerText);
    }
    const totalElement = document.querySelectorAll('.total-price');
    for (let i = 0; i < totalElement.length; i++) {
        totalElement[i].innerText = total.toFixed(2) + '€';
    }
}


function update_cart() {
    const cart = [];
    const quantities = document.querySelectorAll('[id^="count-"]');

    for (let i = 0; i < quantities.length; i++) {
        const quantity = parseInt(quantities[i].innerText);
        if (quantity > 0) {
            const announce_id = quantities[i].id.split('-')[1];
            cart.push({ announce_id: announce_id, quantity: quantity });
        }
    }

    fetch('../php/update-cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ cart: cart }),
    })
        .then(response => response.json())
        .then(data => {
            if (!data) {
                console.error('No rows affected');
            }
        })
        .catch((error) => console.error(error));
}