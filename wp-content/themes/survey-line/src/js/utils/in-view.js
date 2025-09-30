// Watch for all elements with the class 'aoe' (animate on entry)
// Run the observer function to add the class 'in-view' when the element is in view
// Runs once on entry by default. To run multiple times, set data-run-once to 'false'

function onEntry(className = 'in-view') {
   const elements = document.querySelectorAll(".aoe");

   
   elements.forEach((element) => {
      if (element.dataset.delay) {
         element.style.transitionDelay = element.dataset.delay;
      }
   });

   const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
         // Default to run once unless data-run-once is explicitly set to 'false'
         const runOnce = entry.target.dataset.runOnce !== 'false';
         
         if (entry.isIntersecting) {
            entry.target.classList.add(className);
            if (runOnce) {
               observer.unobserve(entry.target);
            }
         } else if (!runOnce) {
            entry.target.classList.remove(className);
         }
      });
   }, {
      threshold: 0 // 30% of the element is visible
   });

   elements.forEach((element) => {
      observer.observe(element);
   });
}

export default function initOnEntry() {
   onEntry();
}