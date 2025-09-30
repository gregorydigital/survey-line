export default function initSliderModal() { 
    // Mount ALL Splide instances
    const carousels = document.querySelectorAll('.splide.gallery-carousel');
    if (!carousels) return;

    // Lightbox elements (single global modal)
    const lb = document.getElementById('pgLightbox');
    const lbImg = document.getElementById('pgLightboxImg');
    const lbCaption = document.getElementById('pgLightboxCaption');
    const btnClose = lb.querySelector('.pg-lightbox__close');
    const btnPrev = lb.querySelector('.pg-lightbox__prev');
    const btnNext = lb.querySelector('.pg-lightbox__next');
    const backdrop = lb.querySelector('.pg-lightbox__backdrop');

    let currentImages = [];
    let currentIndex = 0;
    let lastFocused = null;

    function openLightbox(images, index) {
        currentImages = images;
        currentIndex = index;
        updateLightbox();
        lb.classList.add('is-open');
        lb.setAttribute('aria-hidden', 'false');
        lastFocused = document.activeElement;
        btnClose.focus();
        document.documentElement.classList.add('no-scroll'); // add lock
    }

    function closeLightbox() {
        lb.classList.remove('is-open');
        lb.setAttribute('aria-hidden', 'true');
        document.documentElement.classList.remove('no-scroll'); // remove lock
        if (lastFocused) lastFocused.focus();
    }

    function updateLightbox() {
        const item = currentImages[currentIndex];
        lbImg.src = item.src;
        lbImg.alt = item.alt || '';
        lbCaption.textContent = item.alt || '';
    }

    function prevImage() {
        if (!currentImages.length) return;
        currentIndex = (currentIndex - 1 + currentImages.length) % currentImages.length;
        updateLightbox();
    }

    function nextImage() {
        if (!currentImages.length) return;
        currentIndex = (currentIndex + 1) % currentImages.length;
        updateLightbox();
    }

    // Bind clicks for each carousel
    carousels.forEach((carouselEl) => {
        const slideImgs = carouselEl.querySelectorAll('.splide__slide img');
        const imagesForThisCarousel = Array.from(slideImgs).map((img) => ({
        src: img.getAttribute('src') || img.getAttribute('data-splide-lazy') || '',
        alt: img.getAttribute('alt') || '',
        }));

        slideImgs.forEach((img, idx) => {
        img.style.cursor = 'zoom-in';
        img.tabIndex = 0;
        img.addEventListener('click', () => openLightbox(imagesForThisCarousel, idx));
        img.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' || e.key === ' ') openLightbox(imagesForThisCarousel, idx);
        });
        });
    });

    // Lightbox controls
    btnClose.addEventListener('click', closeLightbox);
    backdrop.addEventListener('click', closeLightbox);
    btnPrev.addEventListener('click', prevImage);
    btnNext.addEventListener('click', nextImage);

    // Keyboard controls
    document.addEventListener('keydown', (e) => {
        if (!lb.classList.contains('is-open')) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') prevImage();
        if (e.key === 'ArrowRight') nextImage();
    });
};