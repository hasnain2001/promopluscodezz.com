   // Optional: Add autoplay functionality
    document.addEventListener('DOMContentLoaded', function() {
        var myCarousel = document.querySelector('#heroCarousel');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 5000, // Change slide every 5 seconds
            pause: 'hover' // Pause on hover
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.storesSwiper', {
            slidesPerView: 6,
            spaceBetween: 24,
            loop: false,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                0: { slidesPerView: 1 },
                576: { slidesPerView: 2 },
                768: { slidesPerView: 3 },
                992: { slidesPerView: 4 },
                1200: { slidesPerView: 6 }
            }
        });
    });
