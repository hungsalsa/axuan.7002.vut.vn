// $(function() {
// 	var selectedClass = "";
// 	$(".filter").click(function(){
// 		selectedClass = $(this).attr("data-rel");
// 		$("#gallery").fadeTo(100, 0.1);
// 		$("#gallery div").not("."+selectedClass).fadeOut().removeClass('animation');
// 		setTimeout(function() {
// 			$("."+selectedClass).fadeIn().addClass('animation');
// 			$("#gallery").fadeTo(300, 1);
// 		}, 300);
// 	});
// });


// init Masonry
var $grid = $('.grid').masonry({
  itemSelector: '.grid-item',
  percentPosition: true,
  columnWidth: '.grid-sizer'
});

// layout Masonry after each image loads
$grid.imagesLoaded().progress( function() {
  $grid.masonry();
});