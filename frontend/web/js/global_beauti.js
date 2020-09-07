$(document).ready(function() {
    $('.btn-open-mobile').click(function() {
        $(this).children('.fa').toggleClass('fa-times');
        $(this).children('.fa').toggleClass('fa-bars');
        $(this).next('.vertical-menu-content').toggleClass('show-mega-menu');
    });


});

$("#owl-example").owlCarousel({

    items: 1,
    singleItem: true,
    responsiveClass: true,

    nav: true,
    autoplay: true,
    autoplayTimeout: 5000,
    dots: true,
    loop: true,
    animateIn: 'fadeIn',
    animateOut: 'fadeOut',

    smartSpeed: 200,

    slideSpeed: 200,
    paginationSpeed: 300,

    autoPlay: true,
    stopOnHover: false,

    navigation: true,
    navigationText: ["prev", "next"],
    rewindNav: true,
    scrollPerPage: false,

    pagination: true,
    paginationNumbers: false,




});

$("#brand-carousel-1").owlCarousel({
    items: 5,
    itemsDesktop: [1199, 10],
    itemsDesktopSmall: [980, 9],
    itemsTablet: [768, 5],
    itemsTabletSmall: [768, 5],
    itemsMobile: [479, 4],

    autoplay: true,
    autoplayTimeout: 5000,

    smartSpeed: 500,

    dots: false,
    smartSpeed: 200,

    slideSpeed: 200,
    paginationSpeed: 300,
    responsiveClass: true,

    loop: true,

    responsive: {
        0: {
            items: 4,
            loop: true,
        },
        600: {
            items: 5,
            loop: true,
        },
        1000: {
            items: 6,
            nav: true,
            loop: true,
        }
    }
});
$(".owl-carousel.homepromo").owlCarousel({
    items: 5,
    itemsTablet: [768, 5],
    itemsTabletSmall: [768, 8],
    nav: true,
    autoplayTimeout: 5000,

    smartSpeed: 500,

    dots: false,
    smartSpeed: 200,

    slideSpeed: 200,
    paginationSpeed: 300,
    responsiveClass: true,


    responsive: {
        0: {
            items: 2,
            loop: true,
        },
        600: {
            items: 4,
            loop: true,
        },
        1000: {
            items: 6,
            nav: true,
            loop: true,
        }
    }
});