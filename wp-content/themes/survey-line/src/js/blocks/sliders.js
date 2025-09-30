export default function initSliders(container = document) {

    const galleryCarousel = container.querySelectorAll(".gallery-carousel");
    const infoCardCarousel = container.querySelectorAll(".gallery-info-cards");

    galleryCarousel.forEach((gallery => {
        if (gallery.classList.contains('splide--initialized')) return;

        new Splide(gallery, {
            type: "loop",
            perPage: 4,
            pagination: false,
            arrows: true,
            perMove: 1,
            gap: '20px',
            padding: '5rem',
            breakpoints: {
                760: {
                    perPage: 1,
                    padding: '3rem',
                },
            }
        }).mount();
    }))

    infoCardCarousel.forEach((carousel => {
        if (carousel.classList.contains('splide--initialized')) return;

        new Splide(carousel, {
            type: "slide",
            autoplay: true,
            interval: 3000,
            perMove: 1,
            perPage: 4,
            pagination: false,
            arrows: true,
            gap: '20px',
            breakpoints: {
                760: {
                    perPage: 1,
                },
            }
        }).mount();
    }))
}
