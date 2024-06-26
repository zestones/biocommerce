document.addEventListener("DOMContentLoaded", function () {
    const authForm = document.getElementById('auth-form');
    const signupLink = document.querySelector('.signup-link');
    const loginLink = document.querySelector('.login-link');
    const phoneNumberField = document.querySelector('.phone-number');
    const connexionHeader = document.getElementById('connexion-header');
    const emailSpan = document.getElementById('email-span');
    const passwordSpan = document.getElementById('password-span');
    const errorMessageDiv = document.getElementById('error-message');

    const hrLine = document.querySelector('.header hr');
    positionHrLine();

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
        errorMessageDiv.style.transform = 'translateY(25px)';

        positionHrLine();
        switchMode("../php/signup.php", "Signup");
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
        errorMessageDiv.style.transform = 'translateY(0)';

        positionHrLine();
        switchMode("../php/login.php", "Login");
    });

    function switchMode(action, buttonText) {
        authForm.action = action;
        authForm.querySelector('#submit-btn').innerText = buttonText;
    }


    function positionHrLine() {
        const activeLink = document.querySelector('.header .active');
        hrLine.style.transform = `translateX(${activeLink.offsetLeft}px)`;
        hrLine.style.transition = 'transform 0.3s ease-in-out';
        hrLine.style.width = activeLink.offsetWidth + 'px';
    }

    // Add event listener to form submission
    document.getElementById('auth-form').addEventListener('submit', function (event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        var formData = new FormData(this);
        fetch(authForm.action, {
            method: 'POST',
            body: formData
        })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(errorMessage => {
                        showError(errorMessage);
                        throw new Error(errorMessage);
                    });
                }
                else {
                    window.location.href = '../pages/home.php';
                }
            })
            .then(message => {
                document.getElementById('error-message').textContent = message;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    function showError(message) {
        const errorMessageDiv = document.getElementById('error-message');
        errorMessageDiv.textContent = message;
        errorMessageDiv.classList.add('shake');
        setTimeout(() => {
            errorMessageDiv.classList.remove('shake');
        }, 500);
    }
});

