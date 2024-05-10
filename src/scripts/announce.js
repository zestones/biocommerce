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


function submit_feedback() {
    const textArea = document.getElementById('feedback');

    fetch('../php/submit-feedback.php', {
        method: 'POST',
        body: JSON.stringify({ feedback: textArea.value }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            const feedbackSection = document.querySelector('.feedback-section');
            const feedbackItem = document.createElement('div');
            feedbackItem.classList.add('feedback-item');
            feedbackItem.textContent = data.feedback;
            feedbackSection.insertBefore(feedbackItem, feedbackSection.firstChild);
            textArea.value = '';
        });
}

document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll('.rating-stars .fa-star');
    let rating = 0;

    stars.forEach((star, index) => {
        star.addEventListener('mouseenter', () => {
            highlightStars(index);
        });

        star.addEventListener('mouseleave', () => {
            highlightStars(rating - 1);
        });

        star.addEventListener('click', () => {
            rating = index + 1;
            highlightStars(index);
        });
    });

    function highlightStars(index) {
        stars.forEach((star, i) => {
            if (i <= index) {
                star.style.color = 'orange';
            } else {
                star.style.color = '';
            }
        });
    }
});
