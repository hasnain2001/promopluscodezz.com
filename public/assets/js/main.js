        document.addEventListener('DOMContentLoaded', function() {
            const slidesContainer = document.getElementById('slides-container');
            const slides = document.querySelectorAll('#slides-container > div');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const indicators = document.querySelectorAll('.indicator');

            let currentSlide = 0;
            const totalSlides = slides.length;

            // Update slider position
            function updateSlider() {
                slidesContainer.style.transform = `translateX(-${currentSlide * 100}%)`;

                // Update active indicator
                indicators.forEach((indicator, index) => {
                    if (index === currentSlide) {
                        indicator.classList.remove('bg-white/50');
                        indicator.classList.add('bg-white');
                    } else {
                        indicator.classList.remove('bg-white');
                        indicator.classList.add('bg-white/50');
                    }
                });
            }

            // Next slide
            function nextSlide() {
                currentSlide = (currentSlide + 1) % totalSlides;
                updateSlider();
            }

            // Previous slide
            function prevSlide() {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                updateSlider();
            }

            // Auto-play
            let slideInterval = setInterval(nextSlide, 5000);

            // Reset interval when user interacts
            function resetInterval() {
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, 5000);
            }

            // Event listeners
            nextBtn.addEventListener('click', () => {
                nextSlide();
                resetInterval();
            });

            prevBtn.addEventListener('click', () => {
                prevSlide();
                resetInterval();
            });

            indicators.forEach(indicator => {
                indicator.addEventListener('click', () => {
                    currentSlide = parseInt(indicator.getAttribute('data-index'));
                    updateSlider();
                    resetInterval();
                });
            });

            // Initialize
            updateSlider();
        });
