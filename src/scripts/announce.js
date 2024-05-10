function increment() {
    const count = document.getElementById('count');
    count.innerText = parseInt(count.innerText) + 1;
}

function decrement() {
    const count = document.getElementById('count');
    count.innerText = Math.max(parseInt(count.innerText) - 1, 0);
}

document.addEventListener("DOMContentLoaded", function () {
    const feedbackSection = document.querySelector('.feedback-section');
    const feedbackItems = feedbackSection.querySelectorAll('.feedback-item');
    const showMoreButton = document.createElement('button');
    showMoreButton.classList.add('show-more-button');

    let start = 3;
    let limit = 3;

    function showNextItems() {
        for (let i = start; i < start + limit && i < feedbackItems.length; i++) {
            feedbackItems[i].style.display = 'block';
        }
        start += limit;
        if (start >= feedbackItems.length) {
            showMoreButton.style.display = 'none';
        } else {
            showMoreButton.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    showMoreButton.textContent = 'Show More';
    showMoreButton.addEventListener('click', showNextItems);

    // Initially hide all items after the first 5
    for (let i = 3; i < feedbackItems.length; i++) {
        feedbackItems[i].style.display = 'none';
    }

    // Add the show more button after the last displayed item
    feedbackSection.appendChild(showMoreButton);
});
