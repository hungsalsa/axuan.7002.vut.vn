$(document).ready(function() {

	var owl = $("#owl-demo-product-detail");

	owl.owlCarousel({
		// dotsContainer: '.owl-dots',
		items : 1, //10 items above 1000px browser width
		nav : true, //10 items above 1000px browser width
		itemsDesktop : [1000,5], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,3], // betweem 900px and 601px
		itemsTablet: [600,2], //2 items between 600 and 0
		itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
		dotsContainer: '#carousel-custom-dots'
	});
	// $(".owl-stage-outer").css('height', '500px');
	// Custom Navigation Events
	//   $(".next").click(function(){
	//     owl.trigger('owl.next');
	// })
	//   $(".prev").click(function(){
	//     owl.trigger('owl.prev');
	// })
	//   $(".play").click(function(){
	//     owl.trigger('owl.play',1000); //owl.play event accept autoPlay speed as second parameter
	// })
	//   $(".stop").click(function(){
	//     owl.trigger('owl.stop');
	// })

	$(".owl-carousel.owl-theme.productRelated").owlCarousel({
		items:5,
		// itemsDesktop : [1199,10],
		// itemsDesktopSmall : [980,9],
		itemsTablet: [768,5],
		itemsTabletSmall: [768,8],
		// // itemsTabletSmall: false,
		// itemsMobile : [479,4],
		nav: true,
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

		loop:false,
		// merge:true,
		// center:true,

		responsive:{
				0:{
						items:2,
						// loop:true,
				},
				600:{
						items:4,
						// loop:true,
				},
				1000:{
						items:6,
						nav:true,
						// loop:true,
				}
		}
	});

	/*$("#txtPro_9").click(function(event) {
		$(this).css( "background-color", "red" );

		// $(".area-price").find('.item').removeClass('active');
		
		$(".area-price").find('.item.active').css( "background-color", "blue" );
		idversion = $(".area-price").find('.item.active').data('id');

		alert(idversion);
	});*/
});

function addCart(idPro,idVersion=0) {
	selectVersion = $(".area-price").find('.item.active');
	// if (selectVersion.length > 0) {
	// 	idVersion = selectVersion.data('id');
	// 	// alert(idVersion);
	// } else {
	// 	idVersion = null;
	// }
// $( "#mydiv" ).hasClass( "bar" )
		
	num = $("#number").val();
	number = 1;
	if(num > 0){
		number = num;
	}
	data  = { idPro: idPro, idVersion:idVersion, number: number};
	$("#productNumber").text(num);

	img = $("#img_"+idPro).attr('src');
	$("#productImgPreview").attr('src', img);
	txtPro = $("#txtPro_"+idPro).text();
	$("#txtNameProduct").text(txtPro);

	// txtPrice = $("#txtPrice_"+idPro).text();

	$.ajax({
		url: '/shopping/addcart',
		data: data,
		success: function(data) {
			// console.log(data)
			val = data.split('"***"');
			$('#txtPriceProduct').text(val[2])
			// $("#get_item_cart").html(data);
			$("#get_item_cart").html(val[0]);
			$("#count_shopping_cart_store").text(val[1]);
		},
		// dataType: dataType
	});
	$("#shoppingcart").modal();

	/*$.get(
		// '/shopping-addcart/'+id+'/'+number,
		'/shopping-addcart',
		{ id: id, number: number, idVersion:idVersion},
		function(data){
			val = data.split('"***"');
			// $("#get_item_cart").html(data);
			$("#get_item_cart").html(val[0]);
			$("#count_shopping_cart_store").text(val[1]);
			// $("#total").text(val[1]);
		}
	);*/
};

function changeActivePrice(id) {
	$(".price .item").removeClass('active');
	var item = $("#price_item_"+id);
	item.addClass('active');
	$("#nameVersion_display").text(item.children('span').text())
	// console.log(item)
	console.log($("#price_item_"+id).children('span').text())
	// alert(item.children('.name').text());

	// $( "li.item-ii" ).find( "li" ).css( "background-color", "red" );

		// $(this).parent().remove();
		// $(this).next('.item').css( "background-color", "red" );

	// var parent = $(this).parent('div.price');
	// parent.css('display', 'none');;
	// $.get(
	// 	'/shopping-addcart/'+id+'/'+number,
	// 	function(data){
	// 		val = data.split('"***"');
	// 		// $("#get_item_cart").html(data);
	// 		$("#get_item_cart").html(val[0]);
	// 		$("#count_shopping_cart_store").text(val[1]);
	// 		// $("#total").text(val[1]);
	// 	}
	// );
};

