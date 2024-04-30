document.addEventListener("DOMContentLoaded", function () {
    const signupLink = document.querySelector('.signup-link');
    const loginLink = document.querySelector('.login-link');
    const phoneNumberField = document.querySelector('.phone-number');
    const connexionHeader = document.getElementById('connexion-header');
    const emailSpan = document.getElementById('email-span');
    const passwordSpan = document.getElementById('password-span');

    signupLink.addEventListener('click', function (event) {
        event.preventDefault();
        loginLink.classList.remove('active');
        signupLink.classList.add('active');
        phoneNumberField.classList.add('visible');
        phoneNumberField.classList.remove('hidden');

        // Move phoneNumberField to the bottom right
        connexionHeader.style.transform = 'translateY(-25px)';
        emailSpan.style.transform = 'translateY(-25px)';
        passwordSpan.style.transform = 'translateY(25px)';
    });

    loginLink.addEventListener('click', function (event) {
        event.preventDefault();
        signupLink.classList.remove('active');
        loginLink.classList.add('active');
        phoneNumberField.classList.remove('visible');
        phoneNumberField.classList.add('hidden');

        // Reset transformations for other elements
        connexionHeader.style.transform = 'translateY(0)';
        emailSpan.style.transform = 'translateY(0)';
        passwordSpan.style.transform = 'translateY(0)';
    });
});
