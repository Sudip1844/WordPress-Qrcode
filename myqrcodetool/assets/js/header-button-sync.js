/**
 * Perfect Sync: Dark Theme Button with Header Visibility
 * Continuously mirrors header's display/visibility/opacity to button
 */
(function() {
    'use strict';

    let lastHeaderState = null;
    let isMonitoring = false;

    const getHeaderComputedState = (header) => {
        if (!header) return null;
        const style = window.getComputedStyle(header);
        return JSON.stringify({
            display: style.display,
            visibility: style.visibility,
            opacity: style.opacity,
            height: style.height
        });
    };

    const applyHeaderStateToButton = (header, button) => {
        if (!header || !button) return;

        const headerStyle = window.getComputedStyle(header);
        const headerDisplay = headerStyle.display;
        const headerVisibility = headerStyle.visibility;
        const headerOpacity = headerStyle.opacity;

        // Apply exact same visibility to button
        if (headerDisplay === 'none') {
            button.style.display = 'none !important';
            button.style.visibility = 'hidden !important';
            button.style.opacity = '0 !important';
        } else if (headerVisibility === 'hidden') {
            button.style.display = 'none !important';
            button.style.visibility = 'hidden !important';
            button.style.opacity = '0 !important';
        } else if (headerOpacity === '0') {
            button.style.display = 'none !important';
            button.style.visibility = 'hidden !important';
            button.style.opacity = '0 !important';
        } else {
            button.style.display = '' !important;
            button.style.visibility = 'visible' !important;
            button.style.opacity = '1' !important;
        }
    };

    const startMonitoring = (header, button) => {
        if (isMonitoring) return;
        isMonitoring = true;

        // Continuous polling for header state changes
        setInterval(() => {
            const currentState = getHeaderComputedState(header);
            if (currentState !== lastHeaderState) {
                lastHeaderState = currentState;
                applyHeaderStateToButton(header, button);
            }
        }, 100); // Check every 100ms

        // Also listen to scroll
        window.addEventListener('scroll', () => {
            applyHeaderStateToButton(header, button);
        }, { passive: true });

        // Listen to window resize
        window.addEventListener('resize', () => {
            applyHeaderStateToButton(header, button);
        }, { passive: true });

        // MutationObserver for any header attribute changes
        const observer = new MutationObserver(() => {
            applyHeaderStateToButton(header, button);
        });

        observer.observe(header, {
            attributes: true,
            attributeOldValue: true,
            attributeFilter: ['style', 'class'],
            subtree: false
        });

        // Initial sync
        applyHeaderStateToButton(header, button);
    };

    const findAndSyncButton = () => {
        const header = document.querySelector('header');
        const themeButton = document.querySelector('[class*="theme-toggle"], button[title*="theme"], button[aria-label*="theme"], [class*="dark-toggle"]');

        if (!header || !themeButton) {
            // Try again in 200ms if elements not found
            setTimeout(findAndSyncButton, 200);
            return;
        }

        startMonitoring(header, themeButton);
    };

    // Start when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', findAndSyncButton);
    } else {
        findAndSyncButton();
    }

    // Also try after delays
    setTimeout(findAndSyncButton, 300);
    setTimeout(findAndSyncButton, 1000);
})();
