function toggleSort() {
    var sortSection = document.querySelector('.sort-section');
    sortSection.classList.toggle('show');
}

function _sort_by_prices(announceArray) {
    var prices = announceArray.map(function (announce) {
        var priceText = announce.querySelector('.price').textContent;
        var price = parseFloat(priceText.replace('€', ''));
        return price;
    });

    // sort the prices
    prices.sort(function (a, b) {
        return a - b;
    });

    // sort the announce elements based on the sorted prices
    announceArray.sort(function (a, b) {
        var priceA = parseFloat(a.querySelector('.price').textContent.replace('€', ''));
        var priceB = parseFloat(b.querySelector('.price').textContent.replace('€', ''));
        return priceA - priceB;
    });
}

function _sort_by_rating(announceArray) {
    announceArray.sort(function (a, b) {
        var ratingA = _count_star(a.querySelector('.rating'));
        var ratingB = _count_star(b.querySelector('.rating'));
        return ratingB - ratingA;
    });
}

function _count_star(ratingElement) {
    var stars = ratingElement.querySelectorAll('.fa-star.checked').length;
    return stars;
}

function sort(criteria) {
    var announces = document.querySelectorAll('.announce');
    var announceArray = Array.from(announces);

    if (criteria == 'price') {
        _sort_by_prices(announceArray);
    } else if (criteria == 'rating') {
        _sort_by_rating(announceArray);
    }

    // Clear the announce section
    var announceSection = document.querySelector('.announce-section');
    announceSection.innerHTML = '';

    // Append the sorted announce elements back to the announce section
    announceArray.forEach(function (announce) {
        announceSection.appendChild(announce);
    });

    // Hide the sort section
    var sortSection = document.querySelector('.sort-section');
    sortSection.classList.remove('show');
}


function view(type) {
    const announceContainers = document.querySelectorAll('.announce');
    const viewButtons = document.querySelectorAll('.view button');

    if (type === 'grid') {
        announceContainers.forEach(container => {
            container.style.flexDirection = 'column';
            container.style.minWidth = '250px';
            container.style.height = '350px';
        });
        const images = document.querySelectorAll(".announce img");
        images.forEach(image => {
            image.style.height = '65%';
            image.style.width = '100%';
            image.style.borderRadius = '10px 10px 0 0';
            image.style.border = '1px solid var(--text)';
        });
    } else if (type === 'list') {
        announceContainers.forEach(container => {
            container.style.flexDirection = 'row';
            container.style.minWidth = '100%';
            container.style.width = '100%';
            container.style.height = '150px';
        });

        const images = document.querySelectorAll(".announce img");
        images.forEach(image => {
            image.style.width = '150px';
            image.style.height = '100%';
            image.style.borderRadius = '10px 0 0 10px';
        });
    }

    // Toggle active class for view buttons
    viewButtons.forEach(button => {
        button.classList.remove('active');
        if (button.dataset.view === type) {
            button.classList.add('active');
        }
    });
}

// number results
function numberResults() {
    const results = document.querySelectorAll('.announce').length;
    const numberResults = document.getElementById('number-results');
    numberResults.textContent = "(" + results + ")";
}

numberResults();


function search() {
    const selectedCategories = Array.from(document.querySelectorAll('input[name="category"]:checked'))
        .map(checkbox => checkbox.id.replace("-category", ""));

    const minPrice = document.getElementById('slider-1').value;
    const maxPrice = document.getElementById('slider-2').value;

    const keyword = document.getElementById('search').value;

    fetch('../php/filter-annouce.php', {
        method: 'POST',
        body: JSON.stringify({
            category: selectedCategories,
            minPrice: minPrice,
            maxPrice: maxPrice,
            keyword: keyword
        }),
        headers: { 'Content-Type': 'application/json' }
    })
        .then(response => response.text())
        .then(data => {
            document.querySelector('.announce-section').innerHTML = data;
            document.getElementById('search').value = '';
            numberResults();
        })
        .catch(error => console.error('Error:', error));

}

document.querySelectorAll('input[name="category"], #slider-1, #slider-2').forEach(input => {
    input.addEventListener('change', search);
});