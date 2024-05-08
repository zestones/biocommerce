const green_logo = window.location.origin + '/assets/logo/agrovia-green.png';
const white_logo = window.location.origin + '/assets/logo/agrovia-white.png';


document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById("checkbox")
    checkbox.addEventListener('change', () => {
        document.body.classList.toggle('dark-theme');
        document.body.classList.toggle('light-theme');

        if (document.body.classList.contains('light-theme')) {
            document.getElementById('logo').src = green_logo;
        } else {
            document.getElementById('logo').src = white_logo;
        }

        localStorage.setItem('theme', document.body.classList.contains('light-theme') ? 'light' : 'dark');
    });
});

function load_theme() {
    document.addEventListener('DOMContentLoaded', function () {
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-theme');
            document.getElementById('logo').src = white_logo;
        } else {
            document.body.classList.add('light-theme');
            document.getElementById('logo').src = green_logo;
        }
    });
}