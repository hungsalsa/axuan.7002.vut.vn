var Global =
{
	ClickCollapse: function(){
        var link = $('.collapseverticalProduct');
        link.each(function() {
        	$(this).click(function(e) {
        		var childI = $(this).children('i');
        		$(this).children('i').find('.fa-plus').removeClass("fa-plus").addClass("fa-minus");
        		// if(childI.hasClass('fa-plus')){
        		// 	// childI.addClass('fa-minus');
        		// 	// childI.html('<i class="fas fa-minus"></i>');
        		// 	childI.attr('class', 'fas fa-minus');
        		// 	// alert(childI.attr('class'));
        		// // console.log(childI.attr('class'))
        		// }
        		if(childI.hasClass('fa-minus')){
        			// childI.attr('class', 'fas fa-plus');
        			// childI.removeClass('fa-minus');
        			// childI.addClass('fa-plus');
        		}
        		// console.log(childI.attr('class'))
        		e.preventDefault();
        	});
        });
    },
}


// =================================== Filter
$(document).ready(function(){
	// Global.ClickCollapse();
    $("#gotoShopping").click(function(event) {
        count = $(this).attr("data-count");
        if (count<=0) {
            $.notify({
                icon: 'pe-7s-gift',
                message: 'Giỏ hàng của bạn đang rỗng !'
            },{
                type: 'info',
                timer: 200
            });
        }
    });
// =================================== Togglable tabs
$('#myTabs a').click(function (e) {
	e.preventDefault()
	$(this).tab('show')
})
	$("#filter-1").click(function(){
		$("#ul-filter-1").slideToggle(500);
	});
	$("#filter-2").click(function(){
		$("#ul-filter-2").slideToggle(500);
	});

    $(".cart-summary,#get_item_cart").hover(function(){
        $(".cart-summary").css("background-color", "#a07b8129");
        $("#get_item_cart").css({
            transform: 'scale3d(1, 1, 1)',
            width: '165%'
        });
        // $("#get_item_cart").css('transform', 'scaleY(1)');
    }, function(){
        $("#get_item_cart").css({
            transform: 'scale3d(1,0,1)',
            width: '100%'
        });
        $(".cart-summary").css("background-color", "#fefefe");
    });
    

    var owlastop = $(".owl-carousel.homepromo.stop");
    if(owlastop.length>0){
        owlastop.owlCarousel({
            // items:5,
            // itemsDesktop : [1199,10],
            // itemsDesktopSmall : [980,9],
            // itemsTablet: [768,5],
            // itemsTabletSmall: [768,8],
            // // itemsTabletSmall: false,
            // itemsMobile : [479,4],
            nav: true,
            autoplay: false,
            loop:false,
            autoplayTimeout:5000,
            // margin: 0,
            // responsiveClass: true,
            // smartSpeed: 500,

            // singleItem : true,
            dots: false,
            // loop: true,
            // smartSpeed: 200,
            //Basic Speeds
            // slideSpeed : 200,
            // paginationSpeed : 300,
            responsiveClass:true,


            // loop:true,
            // merge:true,
            // center:true,

            responsive:{
                0:{
                    items:2,
                    // loop:true,
                    // autoplayTimeout:1000,
                },
                600:{
                    items:2,
                    // loop:true,
                    // autoplayTimeout:1000,
                },
                768:{
                    items:3,
                    // loop:true,
                    // autoplayTimeout:1000,
                },
                1000:{
                    items:4,
                    // slide stop
                    // nav:true,
                    // loop:false,
                    // autoplayTimeout:1000,
                }
            }
        });
    }
    var owl = $(".owl-carousel.homepromo.auto");
    if(owl.length>0){
        owl.owlCarousel({
            // items:5,
            // itemsDesktop : [1199,10],
            // itemsDesktopSmall : [980,9],
            // itemsTablet: [768,5],
            // itemsTabletSmall: [768,8],
            // // itemsTabletSmall: false,
            // itemsMobile : [479,4],
            nav: true,
            autoplay: true,
            loop:true,
            autoplayTimeout:5000,
            // margin: 0,
            // responsiveClass: true,
            // smartSpeed: 500,

            // singleItem : true,
            dots: false,
            // loop: true,
            // smartSpeed: 200,
            //Basic Speeds
            // slideSpeed : 200,
            // paginationSpeed : 300,
            responsiveClass:true,

            // loop:true,
            // merge:true,
            // center:true,

            responsive:{
                0:{
                    items:2,
                    // loop:true,
                    // autoplayTimeout:1000,
                },
                600:{
                    items:4,
                    // loop:true,
                    // autoplayTimeout:1000,
                },
                1000:{
                    items:4,
                    // slide auto - slide hot
                    // nav:true,
                    // loop:false,
                    // autoplayTimeout:1000,
                }
            }
        });
    }

    $('.play').on('click',function(){
        owl.trigger('play.owl.autoplay',[1000])
    })
    $('.stop').on('click',function(){
        owl.trigger('stop.owl.autoplay')
    })

    /*Logo đối tác - Brands*/
    var brands = $(".owl-carousel.brands");
    if(brands.length>0){
            brands.owlCarousel({
            loop:true,
            margin:10,
            nav:true,
        // nav: true,
        autoplay: true,
        loop:true,
        autoplayTimeout:5000,
        dots: false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:10
            }
        }
        });
    }






});

function suggestSearch(event){
    // var words = $(this).val();
   // console.log(event.currentTarget.value);
   var keysearch = event.currentTarget.value.trim();
       // console.log(keysearch.trim());
   if (keysearch=='') {
       $("#button-addon2").attr('type','button');
       $("#search-result .suggest").fadeOut();
       // if (event.keyCode!=13) {
        $("#FormWebsearch").attr('action', '');
        // }
   }else{
       $("#button-addon2").attr('type','submit');
    // $("#search-result .suggest").fadeIn();
    $("#FormWebsearch").attr('action', '/product/tag');

   data = {keysearch : keysearch }
       $.ajax({
            url: '/product/search',
            data: {keysearch : keysearch },
            success: function(data) {
            $("#search-result .suggest").fadeIn();
                // $(document).mouseup(function (e){

                //     var container = $("#home-search-web,#search-result");

                //     if (container.is(e.target) && container.has(e.target).length > 0 && data.length<0){
                //         // alert('dsada');
                //         $("#search-result .suggest").fadeOut();

                //     }else{
                //         $("#search-result .suggest").fadeIn();
                //     }
                // }); 

                
                    $("#search-result .suggest").html(data);
                // if (data.length<0) {
                //     $("#search-result .suggest").fadeOut();
                // }else{
                //     // $("#search-result .suggest").show();
                // }
                // val = data.split('"***"');
                // $("#get_item_cart").html(data);
                // $("#get_item_cart").html(val[0]);
                // $("#count_shopping_cart_store").text(val[1]);
                // console.log(data); 
            },
            // dataType: dataType
        });

}
   // $.get(
   //  '/tim-kiem/tu-khoa-',
   //  {
   //      typeSearch : typeSearch
   //  },
   //  function(data){
   //      // val = data.split('"***"');
   //      //     // $("#get_item_cart").html(data);
   //      //     $("#get_item_cart").html(val[0]);
   //      //     $("#count_shopping_cart_store").text(val[1]);
   //          // $("#total").text(val[1]);
   //   
   //      }
   //  );
}

// $(function(){               

//     var $win = $(window); // or $box parent container
//     // var $box = $(".box");
//     // var $log = $(".log");
//     var $log = $("#search-result .suggest");
// var box = $("#home-search-web,#search-result");

//     $win.on("click.Bst", function(event){      
//         if ( 
//     $box.has(event.target).length == 0 //checks if descendants of $box was clicked
//     &&
//     !$box.is(event.target) //checks if the $box itself was clicked
//     ){
//             $log.text("you clicked outside the box");
//     } else {
//         $log.text("you clicked inside the box");
//     }
//     });

// });