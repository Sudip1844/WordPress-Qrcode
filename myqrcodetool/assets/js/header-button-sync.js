/**
 * Move Dark Theme Button Inside Header
 * Ensures button stays with header always - menu & title style
 */
(function() {
    'use strict';

    const moveButtonToHeader = () => {
        const header = document.querySelector('header');
        const themeButton = document.querySelector('[class*="theme-toggle"], button[title*="theme"], button[aria-label*="theme"], [class*="dark-toggle"]');

        if (!header || !themeButton) {
            // Try again in 300ms if elements not found yet
            setTimeout(moveButtonToHeader, 300);
            return;
        }

        // Check if button is already inside header
        if (header.contains(themeButton)) {
            return; // Already inside, nothing to do
        }

        // Move button inside header
        header.appendChild(themeButton);
        
        // Ensure button doesn't have conflicting positioning
        themeButton.style.position = 'relative';
        themeButton.style.display = 'block';
        themeButton.style.visibility = 'visible';
        themeButton.style.opacity = '1';
    };

    // Start when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', moveButtonToHeader);
    } else {
        moveButtonToHeader();
    }

    // Also run after delays to catch dynamically rendered elements
    setTimeout(moveButtonToHeader, 500);
    setTimeout(moveButtonToHeader, 1000);
    setTimeout(moveButtonToHeader, 2000);
})();
