
function toggle_navigation() {
    var navigation = document.getElementById("navbar");
    navigation.classList.toggle("active");
}

const checkbox = document.getElementById("checkbox")
checkbox.addEventListener('change', () => {
    document.body.classList.toggle('dark-theme');
    document.body.classList.toggle('light-theme');

    // if the theme is light, then load the light logo
    if (document.body.classList.contains('light-theme')) {
        document.getElementById('logo').src = '../assets/logo/agrovia-green.png';
    } else {
        document.getElementById('logo').src = '../assets/logo/agrovia-white.png';
    }

    // TODO: remove ?
    toggle_navigation();
});
