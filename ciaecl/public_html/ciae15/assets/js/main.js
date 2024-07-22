(function ($) {
    "use strict";

    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner(0);


    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('#image-logo').attr('src', 'assets/img/logo-ciae-udc-15.png');
            $('.fixed-top .container').addClass('shadow-sm').css('max-width', '100%');
            $('#navbar-primary').addClass('bg-light').css('background-color', '#FFFFFF !important');
            $('.navbar .navbar-nav .nav-link').addClass('scrolled');
            $('.navbar-brand  h1').addClass('text-brand');
            $('.navbar-brand h1').removeClass('text-white');
        } else {
            $('#image-logo').attr('src', 'assets/img/logo-ciae-blanco.png');
            $('.fixed-top .container').removeClass('shadow-sm').css('max-width', '85%');
            $('#navbar-primary').removeClass('bg-light').css('background-color', 'transparent !important');
            $('.navbar .navbar-nav .nav-link').removeClass('scrolled');
            $('.navbar-brand h1').removeClass('text-brand');
            $('.navbar-brand  h1').addClass('text-white');
        }
    });

    $('[data-toggle="counter-up"]').counterUp({
        delay: 5,
        time: 2000
    });

    $(".testimonials-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: false,
        dots: false,
        loop: true,
        margin: 25,
        nav: true,
        navText: [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            992: {
                items: 2
            },
            1200: {
                items: 3
            }
        }
    });


    window.addEventListener('load', () => {
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        })
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
        return false;
    });

    $('.lightbox .close-btn, #btn-close').click(function () {
        closeLightbox();
    });


    var timelines = document.querySelectorAll('.timeline');
    timelines.forEach(function (timeline) {
        timeline.addEventListener('click', function () {
            var icon = this.querySelector('.timeline-icon i'); 
            var description = this.querySelector('.description').innerHTML;
            var iconClass = icon.classList[1]; 
            var data = {
                description: description,
                iconClass: iconClass
            };

            openLightbox(data); 
        });
    });

    function openLightbox(data) {
        console.log("data:", data);
        var lightbox = $("#lightbox");
        var boxIcon = $("#box-icon-content");
        var descriptionContent = $("#box-description-content");
        boxIcon.removeClass();
        boxIcon.addClass("fas fa-4x text-primary " + data.iconClass);
        descriptionContent.html(data.description);
        lightbox.css("display", "block");
    }

    function closeLightbox() {
        console.log('cerrar');
        var lightbox = document.getElementById("lightbox");
        lightbox.style.display = "none";
    }

    new Swiper('.alianzas-slider', {
        speed: 600,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false
        },
        slidesPerView: 'auto',
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 20
            },

            1200: {
                slidesPerView: 3,
                spaceBetween: 20
            }
        }
    });
    new Swiper('.cars-slider', {
        speed: 600,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false
        },
        slidesPerView: 'auto',
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 20
            },

            1200: {
                slidesPerView: 3,
                spaceBetween: 5
            }
        }
    });
    const maxImages = 37;

    const galleryContainer = document.querySelector('#galeria .swiper-wrapper');
    const imagesToExclude = [18, 19, 36];  
    for (let i = 1; i <= maxImages; i++) {
        if (imagesToExclude.includes(i)) {
            continue;  
        }
    
        const slideDiv = document.createElement('div');
        slideDiv.classList.add('swiper-slide');
        const galleryItemDiv = document.createElement('div');
        galleryItemDiv.classList.add('galery-item');
        const img = document.createElement('img');
        img.src = `assets/img/galeria/imagen${i}.jpg`; 
        img.classList.add('alianzas-img');
        img.alt = `Imagen ${i}`; 
        img.setAttribute('data-fancybox', 'gallery');
        galleryItemDiv.appendChild(img);
        slideDiv.appendChild(galleryItemDiv);
        galleryContainer.appendChild(slideDiv);
    }
    

    new Swiper('.gallery-slider', {
        speed: 600,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false
        },
        slidesPerView: 'auto',
        navigation: {
            nextEl: '.swiper-button-next', 
            prevEl: '.swiper-button-prev', 
        },
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 20
            },
            1200: {
                slidesPerView: 3,
                spaceBetween: 5
            }
        }
    });



})(jQuery);

