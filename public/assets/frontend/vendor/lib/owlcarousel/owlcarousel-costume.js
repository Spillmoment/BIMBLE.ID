$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 20,
    responsiveClass: true,
    dots: true,
    nav: true,
    navText: [
        '<i class="fas fa-arrow-left"></i>',
        '<i class="fas fa-arrow-right"></i>'

    ],
    responsive: {
        0: {
            items: 1,
            nav: true
        },
        600: {
            items: 2,
            nav: false
        },
        1000: {
            items: 4,
            nav: true,
            loop: false
        }
    }
})