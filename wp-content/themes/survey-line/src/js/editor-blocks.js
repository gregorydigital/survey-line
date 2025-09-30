// Import functions from src/js/blocks
import initCarousels from './blocks/carousels.js';
import initSliders from './blocks/sliders.js';

// Track initialized state to prevent duplicate initialization
let isObserverInitialized = false;
let isInitialized = false;

// Initialize blocks within a specific container
function initializeBlocks(container = document) {
    initCarousels(container);
    initSliders(container);
}

// Initialize all blocks on the page
function initializeAllBlocks() {
    if (isInitialized) return;
    
    initializeBlocks();
    
    isInitialized = true;
}

// Initialize blocks in newly added nodes only
function initializeNewBlocks(addedNodes) {
    addedNodes.forEach(node => {
        if (node.nodeType === Node.ELEMENT_NODE) {
            // Check if the node itself or its children contain block elements
            const hasBlockElements = node.matches && (
                node.matches('.tab-group, .logo-carousel, .quote-slider, .js-xs-trigger, .js-md-trigger, .forminator-button, .forminator-button-submit') ||
                node.querySelector('.tab-group, .logo-carousel, .quote-slider, .js-xs-trigger, .js-md-trigger, .forminator-button, .forminator-button-submit')
            );
            
            if (hasBlockElements) {
                initializeBlocks(node);
                // Handle forminator buttons within this node
                if (node.querySelector('.forminator-button, .forminator-button-submit')) {
                    wrapForminatorButtonsWithSpan(node);
                }
            }
        }
    });
}

// Debounce utility function
function debounce(func, delay) {
    let timeout;
    return (...args) => {
        clearTimeout(timeout);
        timeout = setTimeout(() => func(...args), delay);
    };
}

// Watch for DOM changes and re-init blocks only for new content
function observeDOMChanges() {
    if (isObserverInitialized) return;
    
    const debouncedCallback = debounce((mutations) => {
        const addedNodes = [];
        
        mutations.forEach((mutation) => {
            if (mutation.addedNodes.length > 0) {
                mutation.addedNodes.forEach(node => {
                    if (node.nodeType === Node.ELEMENT_NODE) {
                        addedNodes.push(node);
                    }
                });
            }
        });
        
        if (addedNodes.length > 0) {
            initializeNewBlocks(addedNodes);
        }
    }, 150);

    const observer = new MutationObserver(debouncedCallback);

    // Observe a specific container instead of the entire document body
    const targetContainer = document.querySelector('#main-content') || document.body;
    observer.observe(targetContainer, {
        childList: true,
        subtree: true
    });
    
    isObserverInitialized = true;
}

// Watch for content loaded and initialize blocks 
document.addEventListener('DOMContentLoaded', function() {
    initializeAllBlocks();
    observeDOMChanges();
});

// Listen for ACF field changes (debounced to prevent excessive calls)
const debouncedACFHandler = debounce(() => {
    // Reset initialization state for ACF changes
    isInitialized = false;
    initializeAllBlocks();
}, 300);

document.addEventListener('acf/change', debouncedACFHandler);

// Handle block editor specific events
if (typeof wp !== 'undefined' && wp.blocks) {
    // Listen for block editor updates
    wp.domReady(() => {
        if (wp.data && wp.data.subscribe) {
            let previousBlocks = [];
            
            wp.data.subscribe(() => {
                const currentBlocks = wp.data.select('core/block-editor')?.getBlocks() || [];
                
                if (currentBlocks.length !== previousBlocks.length) {
                    // Debounce block editor changes
                    setTimeout(() => {
                        isInitialized = false;
                        initializeAllBlocks();
                    }, 200);
                }
                
                previousBlocks = currentBlocks;
            });
        }
    });
}
