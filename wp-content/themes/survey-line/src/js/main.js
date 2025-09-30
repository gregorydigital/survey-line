// Base imports
import {mq, dataLayer} from './base/config.js';

// Utility imports
import initSmoothScroll from './utils/smooth-scroll.js';
import initWindowScroll from './utils/window-scroll.js';
import initOnEntry from './utils/in-view.js';

// Global Imports
import initMobileNav from './global/nav.js';

// Blocks imports
import initFAQ from './blocks/faq.js';
import initSliders from './blocks/sliders.js';
import initSliderModal from './blocks/gallery-modal.js';
import initCardInfo from './blocks/card-info.js';

/**
 * Initialize all modules when DOM is ready
*/

window.onload = function() {
    // Initialize base config
    mq;
    dataLayer;

    initMobileNav();

    // Initialize utility modules
    initSmoothScroll();
    initWindowScroll();
    initOnEntry(); // set to true to run once, false to run on each entry

    // Initialize blocks
    initSliders();
    initFAQ();
    initSliderModal();
    initCardInfo();

    AOS.init({
      duration: 950,
      once: true,
      disable: 'mobile',
    });
};

/**
 * Handle errors gracefully
*/

window.addEventListener('error', (e) => {
    console.warn('JS Error:', e.message);
});