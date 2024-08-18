function checkVideosVisibility() {
    const videos = document.querySelectorAll('.myVideo');
    const viewportHeight = window.innerHeight;

    videos.forEach(video => {
        const videoRect = video.getBoundingClientRect();
        
        // Check if the video is within the viewport
        if (videoRect.top < viewportHeight && videoRect.bottom >= 0) {
            if (video.paused) {
                video.play();
            }
        } else {
            if (!video.paused) {
                video.pause();
            }
        }
    });
}

// Debounce function to limit the rate of scroll event handling
function debounce(func, wait) {
    let timeout;
    return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
    };
}

// Add event listener for scroll with debounce
document.addEventListener('scroll', debounce(checkVideosVisibility, 100));

// Initial check in case the videos are in the viewport on load
document.addEventListener('DOMContentLoaded', checkVideosVisibility);









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

