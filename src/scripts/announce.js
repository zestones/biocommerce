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


function get_feedback_rating() {
    const ratingStars = document.querySelectorAll('.add-feedback .rating-stars .fa-star');
    let rating = 0;
    ratingStars.forEach((star, index) => {
        if (star.style.color === 'orange') {
            rating++;
        }
    });

    return rating;
}

function delete_feedback(id) {
    fetch('../php/delete-feedback.php', {
        method: 'POST',
        body: JSON.stringify({ feedback_id: id }),
        headers: { 'Content-Type': 'application/json' }
    })
        .then(response => {
            if (!response.ok) { throw new Error('Network response was not ok'); }
            return response.json(); // This returns a promise that resolves with the parsed JSON
        })
        .then(data => {
            const feedbackItem = document.getElementById(`feedback-${id}`);
            feedbackItem.remove();
        })
        .catch(error => console.error('Error:', error));
}

function submit_feedback() {
    const textArea = document.getElementById('feedback');
    const rating = get_feedback_rating();

    // We retrieve the announce id from the URL
    const id = (window.location.href).split('=')[1];

    console.log(textArea.value.length)
    console.log(rating)
    console.log(id)

    fetch('../php/submit-feedback.php', {
        method: 'POST',
        body: JSON.stringify({
            announce_id: id,
            rating: rating,
            comment: textArea.value
        }),
        headers: { 'Content-Type': 'application/json' }
    })
        .then(response => {
            if (!response.ok) { throw new Error('Network response was not ok'); }
            return response.json(); // This returns a promise that resolves with the parsed JSON
        })
        .then(data => {
            console.log('Success:', data);
            const feedbackSection = document.querySelector('.feedback-section');
            const newFeedbackItem = createFeedbackItem(data);

            // Append the new feedback item before all the other items
            feedbackSection.insertBefore(newFeedbackItem, feedbackSection.firstChild);

            textArea.value = "";
            const stars = document.querySelectorAll('.rating-stars .fa-star');
            stars.forEach(star => { star.style.color = ''; });
        })
        .catch(error => console.error('Error:', error));
}

function _generate_star(rating) {
    let stars = "";
    for (let i = 0; i < 5; i++) {
        stars += `<i class="fa fa-star${i < rating ? ' checked' : ''}"></i>`;
    }
    return stars;
}

function createFeedbackItem(feedbackData) {
    // Create elements for the new feedback item
    const feedbackItem = document.createElement('div');
    feedbackItem.classList.add('feedback-item');

    // Construct the HTML structure for the feedback item
    feedbackItem.innerHTML = `
        <div class="user-infos">
        <img src="https://picsum.photos/id/1005/50/50.jpg" alt="${feedbackData["user"].name}">
            <div class="user-details">
                <div class="name">${feedbackData["user"].firstname}</div>
                <div class="rating">${_generate_star(feedbackData.rating)}</div>
            </div>
        </div>
        <div class="message">
            <p>${feedbackData.comment}</p>
        </div>
        <div class="date">
            <span>${feedbackData.date}</span>
        </div>
        <hr>
    `;

    return feedbackItem;
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
