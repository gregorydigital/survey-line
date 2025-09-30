export default function initMobileNav() {
   const menuToggle = document.querySelector(".menu-toggle");
   const mainNav = document.querySelector(".main-nav-container");
   const parents = mainNav.querySelectorAll('.menu-item-has-children');

   menuToggle.addEventListener("click", function() {
      mainNav.classList.toggle("active");
      menuToggle.classList.toggle("open");
      document.documentElement.classList.toggle("no-scroll");
   });

   parents.forEach(parent => {
      const link = parent.firstElementChild;

      link.addEventListener('click', function(e) {
         e.preventDefault();

         // close other parents
         parents.forEach(i => {
            if (i !== parent) {
               i.classList.remove("open");
            }
         });

         // toggle current parent
         parent.classList.toggle('open');

         // ✅ Only add body class if this parent has a mega menu child
         if (parent.classList.contains('open') && parent.querySelector('.mega-menu')) {
            document.body.classList.add("mega-menu-open");
         } else {
            // If no mega menu open at all, remove class
            if (!mainNav.querySelector('.menu-item-has-children.open .mega-menu')) {
               document.body.classList.remove("mega-menu-open");
            }
         }
      });
   });

   document.addEventListener("click", function (e) {
      if (!e.target.closest(".menu-item-has-children")) {
         parents.forEach(item => item.classList.remove("open"));
         document.body.classList.remove("mega-menu-open"); // ✅ Reset
      }
   });

   const mediaQuery = window.matchMedia("(min-width: 768px)");

   function handleScreenChange(e) {
      if (e.matches) {
         mainNav.classList.remove("active");
         menuToggle.classList.remove("open");
         document.documentElement.classList.remove("no-scroll");
         parents.forEach(item => item.classList.remove("open"));
         document.body.classList.remove("mega-menu-open"); // ✅ Reset on resize
      }
   }

   handleScreenChange(mediaQuery);
   mediaQuery.addEventListener("change", handleScreenChange);
}