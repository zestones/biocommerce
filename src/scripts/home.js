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
