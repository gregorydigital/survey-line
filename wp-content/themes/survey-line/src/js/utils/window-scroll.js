export default function initWindowScroll() {
  let lastScrollY = window.scrollY;
    const header = document.querySelector('header'); // Make sure your header uses the <header> tag or change this selector

    window.addEventListener('scroll', () => {
    const currentScrollY = window.scrollY;

    if (currentScrollY > 100) {

        header.classList.add('header--fill');

        if (currentScrollY > lastScrollY) {
            // Scrolling down
            header.classList.add('header--hidden');

        } else {
            // Scrolling up
            header.classList.remove('header--hidden');
        }
    } else {
      header.classList.remove('header--fill');
    }

    lastScrollY = currentScrollY;
  });
}