function increment() {
    const count = document.getElementById('count');
    count.innerText = parseInt(count.innerText) + 1;
}

function decrement() {
    const count = document.getElementById('count');
    count.innerText = Math.max(parseInt(count.innerText) - 1, 0);
}