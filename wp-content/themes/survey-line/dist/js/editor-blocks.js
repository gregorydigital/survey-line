(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = initAccordions;
function initAccordions() {
  var container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;
  // Mobile accordion
  var mobileTriggers = container.querySelectorAll(".js-xs-trigger");
  mobileTriggers.forEach(function (trigger) {
    // Check if event listener is already attached
    if (trigger.hasAttribute('data-accordion-initialized')) return;
    trigger.addEventListener("click", function () {
      this.parentNode.classList.toggle("active");
    });
    trigger.setAttribute('data-accordion-initialized', 'true');
  });

  // Desktop accordion 
  var desktopTriggers = container.querySelectorAll('.js-md-trigger');
  var contents = container.querySelectorAll('.accordion__content');
  desktopTriggers.forEach(function (trigger) {
    // Check if event listener is already attached
    if (trigger.hasAttribute('data-desktop-accordion-initialized')) return;
    trigger.addEventListener('click', function () {
      var targetId = this.getAttribute('data-accordion-target');
      var targetContent = document.getElementById(targetId);
      desktopTriggers.forEach(function (content) {
        return content.classList.remove('active');
      });
      contents.forEach(function (content) {
        return content.classList.remove('active');
      });
      trigger.classList.add('active');
      targetContent.classList.add('active');
    });
    trigger.setAttribute('data-desktop-accordion-initialized', 'true');
  });
}

},{}],2:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = initCarousels;
function initCarousels() {
  var container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;
  var logoCarousels = container.querySelectorAll(".logo-carousel");
  if (typeof Splide === 'undefined') {
    return;
  }
  logoCarousels.forEach(function (slider) {
    if (slider.classList.contains('splide--initialized')) return;
    var options = {
      rewind: true,
      type: "loop",
      autoplay: true,
      pagination: false,
      arrows: false,
      focus: "left",
      gap: "20px",
      perPage: 7,
      interval: 2000,
      speed: 3000,
      easing: "linear",
      breakpoints: {
        1200: {
          perPage: 7,
          fixedWidth: "150px"
        }
      }
    };
    try {
      var splide = new Splide(slider, options).mount();
      slider.classList.add('splide--initialized');

      // Use .wp-block if in editor, .container if on frontend
      var blockContainer = slider.closest('.wp-block') || slider.closest('.container');
      if (blockContainer) {
        var btnNext = blockContainer.querySelector(".carousel__next");
        var btnPrev = blockContainer.querySelector(".carousel__prev");
        if (btnNext && splide) {
          btnNext.addEventListener("click", function () {
            return splide.go("+1");
          });
        }
        if (btnPrev && splide) {
          btnPrev.addEventListener("click", function () {
            return splide.go("-1");
          });
        }
      }
    } catch (error) {
      // Optionally handle error
    }
  });
}

},{}],3:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = initSliders;
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
function initSliders() {
  var container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;
  var quoteSliders = container.querySelectorAll(".quote-slider");
  if (typeof Splide === 'undefined') {
    return;
  }
  quoteSliders.forEach(function (slider) {
    if (slider.classList.contains('splide--initialized')) return;
    var options = _defineProperty({
      type: "loop",
      autoplay: true,
      pagination: false,
      arrows: false,
      perPage: 1,
      interval: 5000,
      easing: "ease-in-out"
    }, "pagination", true);
    try {
      var splide = new Splide(slider, options).mount();
      slider.classList.add('splide--initialized');

      // Use .wp-block if in editor, .container if on frontend
      var blockContainer = slider.closest('.wp-block') || slider.closest('.container');
      if (blockContainer) {
        var btnNext = blockContainer.querySelector(".carousel__next");
        var btnPrev = blockContainer.querySelector(".carousel__prev");
        if (btnNext && splide) {
          btnNext.addEventListener("click", function () {
            return splide.go("+1");
          });
        }
        if (btnPrev && splide) {
          btnPrev.addEventListener("click", function () {
            return splide.go("-1");
          });
        }
      }
    } catch (error) {
      // Optionally handle error
    }
  });
}

},{}],4:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = initTabs;
function initTabs() {
  var container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;
  var tabGroups = container.querySelectorAll(".tab-group");
  // Get the sticky header element
  var stickyHeader = document.querySelector('.header');
  var stickyHeaderHeight = stickyHeader ? stickyHeader.offsetHeight : 0; // Get its height, default to 0 if not found

  // Define the additional offset
  var additionalOffset = 20;
  if (tabGroups.length > 0) {
    tabGroups.forEach(function (tabGroup) {
      var tabs = tabGroup.querySelectorAll(".js-tab");
      var tabPanels = tabGroup.querySelectorAll(".js-tab-panel");
      var tabPanelContent = tabGroup.querySelectorAll(".js-tab-panel > .js-tab-panel-content");
      tabs.forEach(function (trigger) {
        trigger.addEventListener("click", function () {
          var thisTargetID = this.dataset.target;
          var thisTarget = tabGroup.querySelector("#".concat(thisTargetID));

          // Remove active classes on click
          tabPanels.forEach(function (element) {
            element.classList.remove('is-active');
          });
          tabs.forEach(function (element) {
            element.classList.remove('is-active');
          });
          tabPanelContent.forEach(function (element) {
            element.classList.remove('is-active');
          });

          // Add active classes to tab panel and inner content
          thisTarget.classList.add('is-active');
          this.classList.add('is-active');
          setTimeout(function () {
            var tabPanelContent = thisTarget.querySelector(".js-tab-panel-content");
            tabPanelContent.classList.add("is-active");
          }, 300);

          // Scroll to the top of the active tab panel on mobile
          if (window.innerWidth < 768) {
            // Calculate the target scroll position with header height and additional offset
            var elementPosition = thisTarget.getBoundingClientRect().top;
            var offsetPosition = elementPosition + window.scrollY - (stickyHeaderHeight + additionalOffset + 86);
            window.scrollTo({
              top: offsetPosition,
              behavior: 'smooth'
            });
          }
        });
      });
    });
  }
}

},{}],5:[function(require,module,exports){
"use strict";

var _tabs = _interopRequireDefault(require("./blocks/tabs.js"));
var _carousels = _interopRequireDefault(require("./blocks/carousels.js"));
var _accordions = _interopRequireDefault(require("./blocks/accordions.js"));
var _sliders = _interopRequireDefault(require("./blocks/sliders.js"));
var _forms = _interopRequireDefault(require("./global/forms.js"));
function _interopRequireDefault(e) { return e && e.__esModule ? e : { "default": e }; }
// Import functions from src/js/blocks

// Track initialized state to prevent duplicate initialization
var isObserverInitialized = false;
var isInitialized = false;

// Initialize blocks within a specific container
function initializeBlocks() {
  var container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;
  (0, _tabs["default"])(container);
  (0, _carousels["default"])(container);
  (0, _accordions["default"])(container);
  (0, _sliders["default"])(container);
}

// Initialize all blocks on the page
function initializeAllBlocks() {
  if (isInitialized) return;
  initializeBlocks();
  (0, _forms["default"])();
  isInitialized = true;
}

// Initialize blocks in newly added nodes only
function initializeNewBlocks(addedNodes) {
  addedNodes.forEach(function (node) {
    if (node.nodeType === Node.ELEMENT_NODE) {
      // Check if the node itself or its children contain block elements
      var hasBlockElements = node.matches && (node.matches('.tab-group, .logo-carousel, .quote-slider, .js-xs-trigger, .js-md-trigger, .forminator-button, .forminator-button-submit') || node.querySelector('.tab-group, .logo-carousel, .quote-slider, .js-xs-trigger, .js-md-trigger, .forminator-button, .forminator-button-submit'));
      if (hasBlockElements) {
        initializeBlocks(node);
        // Handle forminator buttons within this node
        if (node.querySelector('.forminator-button, .forminator-button-submit')) {
          (0, _forms["default"])(node);
        }
      }
    }
  });
}

// Debounce utility function
function debounce(func, delay) {
  var timeout;
  return function () {
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }
    clearTimeout(timeout);
    timeout = setTimeout(function () {
      return func.apply(void 0, args);
    }, delay);
  };
}

// Watch for DOM changes and re-init blocks only for new content
function observeDOMChanges() {
  if (isObserverInitialized) return;
  var debouncedCallback = debounce(function (mutations) {
    var addedNodes = [];
    mutations.forEach(function (mutation) {
      if (mutation.addedNodes.length > 0) {
        mutation.addedNodes.forEach(function (node) {
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
  var observer = new MutationObserver(debouncedCallback);

  // Observe a specific container instead of the entire document body
  var targetContainer = document.querySelector('#main-content') || document.body;
  observer.observe(targetContainer, {
    childList: true,
    subtree: true
  });
  isObserverInitialized = true;
}

// Watch for content loaded and initialize blocks 
document.addEventListener('DOMContentLoaded', function () {
  initializeAllBlocks();
  observeDOMChanges();
});

// Listen for ACF field changes (debounced to prevent excessive calls)
var debouncedACFHandler = debounce(function () {
  // Reset initialization state for ACF changes
  isInitialized = false;
  initializeAllBlocks();
}, 300);
document.addEventListener('acf/change', debouncedACFHandler);

// Handle block editor specific events
if (typeof wp !== 'undefined' && wp.blocks) {
  // Listen for block editor updates
  wp.domReady(function () {
    if (wp.data && wp.data.subscribe) {
      var previousBlocks = [];
      wp.data.subscribe(function () {
        var _wp$data$select;
        var currentBlocks = ((_wp$data$select = wp.data.select('core/block-editor')) === null || _wp$data$select === void 0 ? void 0 : _wp$data$select.getBlocks()) || [];
        if (currentBlocks.length !== previousBlocks.length) {
          // Debounce block editor changes
          setTimeout(function () {
            isInitialized = false;
            initializeAllBlocks();
          }, 200);
        }
        previousBlocks = currentBlocks;
      });
    }
  });
}

},{"./blocks/accordions.js":1,"./blocks/carousels.js":2,"./blocks/sliders.js":3,"./blocks/tabs.js":4,"./global/forms.js":6}],6:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = wrapForminatorButtonsWithSpan;
function wrapForminatorButtonsWithSpan() {
  document.querySelectorAll('.forminator-button, .forminator-button-submit').forEach(function (btn) {
    // Only add span if not already present
    if (!btn.querySelector('span')) {
      btn.innerHTML = '<span>' + btn.innerHTML + '</span>';
    }
  });
}

},{}]},{},[5]);
