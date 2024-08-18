document.addEventListener('DOMContentLoaded', function() {
    const elements = document.querySelectorAll('.animated');

    function checkVisibility() {
        elements.forEach(element => {
            const rect = element.getBoundingClientRect();
            const inView = rect.top <= window.innerHeight && rect.bottom >= 0;
            
            if (inView) {
                element.classList.add('visible');
            } else {
                element.classList.remove('visible'); // Optional: Remove 'visible' if out of view
            }
        });
    }

    // Check visibility on scroll and resize
    window.addEventListener('scroll', checkVisibility);
    window.addEventListener('resize', checkVisibility); // Handle window resize
    checkVisibility(); // Initial check
});



