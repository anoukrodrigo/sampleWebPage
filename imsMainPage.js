  document.addEventListener('DOMContentLoaded', function() {
        console.log('Script loaded');
        document.getElementById('redirectButton').addEventListener('click', function() {
            console.log('Button clicked');
            window.location.href = 'user.php'; // Replace with your actual URL or path
        });
    });

  document.addEventListener('DOMContentLoaded', function() {
    const elements = document.querySelectorAll('.animated');

    function checkVisibility() {
        const windowHeight = window.innerHeight;

        elements.forEach(el => {
            const rect = el.getBoundingClientRect();
            if (rect.top < windowHeight - 100) { // Trigger before the element is fully visible
                el.classList.add('visible');
            } else {
                el.classList.remove('visible'); // Reset animation if element is not visible
            }
        });
    }

    window.addEventListener('scroll', checkVisibility);
    checkVisibility(); // Initial check
});


   const passwordInput = document.getElementById('password');
const strengthIndicator = document.getElementById('password-strength');
const form = document.getElementById('registrationForm');
let passwordStrength = '';

// Function to evaluate password strength
function evaluatePasswordStrength(password) {
    if (password.length < 6) {
        passwordStrength = 'Weak';
        strengthIndicator.className = 'weak';
    } else if (password.length >= 6 && /[A-Z]/.test(password) && /[0-9]/.test(password) && /[!@#$%^&*]/.test(password)) {
        passwordStrength = 'Strong';
        strengthIndicator.className = 'strong';
    } else {
        passwordStrength = 'Medium';
        strengthIndicator.className = 'medium';
    }

    strengthIndicator.textContent = `Password strength: ${passwordStrength}`;
}

// Listen for input on the password field
passwordInput.addEventListener('input', function() {
    evaluatePasswordStrength(passwordInput.value);
});

// Prevent form submission if the password is not strong
form.addEventListener('submit', function(event) {
    if (passwordStrength !== 'Strong') {
        event.preventDefault(); // Prevent form submission
        alert('Please enter a strong password before submitting the form.');
    }
});
