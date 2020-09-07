$(document).ready(function() {
    $(".owl-carousel.homepromo").owlCarousel({
    items:5,
    // itemsDesktop : [1199,10],
    // itemsDesktopSmall : [980,9],
    itemsTablet: [768,5],
    itemsTabletSmall: [768,8],
    // // itemsTabletSmall: false,
    // itemsMobile : [479,4],
    nav: true,
    // autoplay: true,
    autoplayTimeout:5000,

    // margin: 0,
    // responsiveClass: true,
    smartSpeed: 500,

    // singleItem : true,
    dots: false,
    // loop: true,
    smartSpeed: 200,

    //Basic Speeds
    slideSpeed : 200,
    paginationSpeed : 300,
    responsiveClass:true,

    // loop:true,
    // merge:true,
    // center:true,

    responsive:{
        0:{
            items:2,
            loop:true,
        },
        600:{
            items:4,
            loop:true,
        },
        1000:{
            items:6,
            nav:true,
            loop:true,
        }
    }
});


    $(".owl-carousel.brands").owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        autoplayTimeout:5000,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    })

});