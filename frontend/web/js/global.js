$(document).ready(function() {
	$('.btn-open-mobile').click(function() {
		$(this).children('.fa').toggleClass('fa-times');
		$(this).children('.fa').toggleClass('fa-bars');
		$(this).next('.vertical-menu-content').toggleClass('show-mega-menu');
	});

	
});

$("#owl-example").owlCarousel({
 
    // Most important owl features
    items : 1,
    // itemsDesktop : [1199,1],
    // itemsDesktopSmall : [980,1],
    // itemsTablet: [768,1],
    // itemsTabletSmall: false,
    // itemsMobile : [479,1],
    singleItem : true,
    responsiveClass:true,
// autoWidth:true,

    // slideSpeed : 2000,
    // center: true,
    // mergeFit: false,
    nav: true,
    autoplay: true,
    autoplayTimeout:5000,
    dots: true,
    loop: true,
    animateIn: 'fadeIn',
    animateOut: 'fadeOut',

    smartSpeed: 200,

    //Basic Speeds
    slideSpeed : 200,
    paginationSpeed : 300,
    // rewindSpeed : 1000,
 
    //Autoplay
    autoPlay : true,
    stopOnHover : false,
 
    // Navigation
    navigation : true,
    navigationText : ["prev","next"],
    rewindNav : true,
    scrollPerPage : false,
 
    //Pagination
    pagination : true,
    paginationNumbers: false,
 
    // Responsive 
    // responsive: true,
    // responsiveRefreshRate : 200,
    // responsiveBaseWidth: window,
 
    // CSS Styles
    // baseClass : "owl-carousel",
    // theme : "owl-theme",
 
    // //Lazy load
    // lazyLoad : false,
    // lazyFollow : true,
 
    // //Auto height
    // autoHeight : false,
 
    // //JSON 
    // jsonPath : false, 
    // jsonSuccess : false,
 
    // //Mouse Events
    // mouseDrag : true,
    // touchDrag : true,
 
    // //Transitions
    // transitionStyle : false,
 
    // // Other
    // addClassActive : false,
 
    // //Callbacks
    // beforeInit: false, 
    // afterInit: false, 
    // beforeMove: false, 
    // afterMove: false,
    // afterAction: false,
    // startDragging : false
 
});

$("#brand-carousel-1").owlCarousel({
    items:5,
    itemsDesktop : [1199,10],
    itemsDesktopSmall : [980,9],
    itemsTablet: [768,5],
    itemsTabletSmall: [768,5],
    // itemsTabletSmall: false,
    itemsMobile : [479,4],

    autoplay: true,
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

    loop:true,
    // merge:true,
    // center:true,

    responsive:{
        0:{
            items:4,
            loop:true,
        },
        600:{
            items:5,
            loop:true,
        },
        1000:{
            items:6,
            nav:true,
            loop:true,
        }
    }
});
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