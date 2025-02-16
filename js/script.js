const form = document.getElementById('loginForm');
const email = document.getElementById('email');
const emailError = document.getElementById('emailError');

form.addEventListener('submit', (e) => {
    e.preventDefault();

    // Basic email validation
    const emailValue = email.value.trim();
    if (!validateEmail(emailValue)) {
        emailError.style.display = 'block';
    } else {
        emailError.style.display = 'none';
        alert('Login successful!');
    }
});

function validateEmail(email) {
    const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return re.test(email);
}
let currentIndex = 0;
let currentIndex = 0;

function moveSlide(direction) {
    const track = document.querySelector('.carousel-track');
    const images = document.querySelectorAll('.carousel-image');
    const totalImages = images.length;
    const imageWidth = images[0].clientWidth;

    // Update current index
    currentIndex += direction;

    // Wrap around logic
    if (currentIndex < 0) {
        currentIndex = totalImages - 1; // Go to the last image
    } else if (currentIndex >= totalImages) {
        currentIndex = 0; // Go back to the first image
    }

    // Move the track
    track.style.transform = `translateX(-${currentIndex * imageWidth}px)`;
}
