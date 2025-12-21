/**
 * Aggressive Header-Button Sync
 * Hides button completely when header is hidden
 * Prevents user interaction when header not visible
 */
(function() {
    'use strict';

    let lastHeaderVisible = true;
    let scrollThreshold = 50;

    const isHeaderHidden = (header) => {
        if (!header) return true;
        const style = window.getComputedStyle(header);
        const isHidden = style.display === 'none' || 
                        style.visibility === 'hidden' || 
                        style.opacity === '0' ||
                        parseInt(style.height) === 0;
        return isHidden;
    };

    const hideButton = (button) => {
        if (!button) return;
        button.style.cssText = `
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
            pointer-events: none !important;
        `;
    };

    const showButton = (button) => {
        if (!button) return;
        button.style.cssText = `
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            pointer-events: auto !important;
        `;
    };

    const syncButtonVisibility = () => {
        const header = document.querySelector('header');
        const button = document.querySelector('[class*="theme-toggle"], button[title*="theme"], button[aria-label*="theme"], [class*="dark-toggle"]');

        if (!header || !button) return;

        const headerHidden = isHeaderHidden(header);

        // Also hide if scrolled too far
        const scrolledDown = window.scrollY > scrollThreshold;

        if (headerHidden || scrolledDown) {
            if (lastHeaderVisible) {
                hideButton(button);
                lastHeaderVisible = false;
            }
        } else {
            if (!lastHeaderVisible) {
                showButton(button);
                lastHeaderVisible = true;
            }
        }
    };

    const initialize = () => {
        const header = document.querySelector('header');
        const button = document.querySelector('[class*="theme-toggle"], button[title*="theme"], button[aria-label*="theme"], [class*="dark-toggle"]');

        if (!header || !button) {
            setTimeout(initialize, 300);
            return;
        }

        // Initial sync
        syncButtonVisibility();

        // Scroll listener - AGGRESSIVE
        window.addEventListener('scroll', syncButtonVisibility, { passive: true, capture: true });

        // Resize listener
        window.addEventListener('resize', syncButtonVisibility, { passive: true });

        // Header mutation observer
        const headerObserver = new MutationObserver(() => {
            syncButtonVisibility();
        });

        headerObserver.observe(header, {
            attributes: true,
            style: true,
            attributeFilter: ['style', 'class'],
            subtree: false
        });

        // Continuous check (fallback)
        setInterval(syncButtonVisibility, 50);
    };

    // Start initialization
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initialize);
    } else {
        initialize();
    }

    // Retry initialization
    setTimeout(initialize, 500);
    setTimeout(initialize, 1500);
})();
