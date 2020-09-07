function addCart(id) {
	num = $("#number").val();
	number = 1;
	if(num > 0){
		number = num;
	}
	$("#productNumber").text(num);

	img = $("#img_"+id).attr('src');
	$("#productImgPreview").attr('src', img);
	txtPro = $("#txtPro_"+id).text();
	$("#txtNameProduct").text(txtPro);

	// txtPrice = $("#txtPrice_"+id).text();
	txtPrice = $("#txtPrice_"+id).text();
	// alert(txtPrice);
	if (txtPrice==null) {
		console.log(txtPrice)
		$('#txtPriceProduct').text('Liên hệ');

	} else {
		$('#txtPriceProduct').text(txtPrice+' đ')
	}

	$("#shoppingcart").modal();
	$.get(
		'/shopping-addcart/'+id+'/'+number,
		function(data){
			val = data.split('"***"');
			// $("#get_item_cart").html(data);
			$("#get_item_cart").html(val[0]);
			$("#count_shopping_cart_store").text(val[1]);
			// $("#total").text(val[1]);
		}
	);
};

var idPro;
function itemDown(id) {
	idPro = id;
	quantity = parseInt($("#quantity_"+id).val()) - 1;
	if(quantity>0){
		$("#quantity_"+id).val(quantity);
		updateCart(id,quantity)
	}else{
		img = $("#img_"+id).attr('src');
		$("#imgPreviewdel").attr('src', img);
	// alert(img);
		txtPro = $("#txtPro_"+id).text();
		$("#txtNameProductdel").text(txtPro);

		txtPrice = $("#txtPrice_"+id).text();
		$("#txtpricedel").text(txtPrice);

		$("#modal_delete").attr('data-id', id);

		$("#deleteshopping").modal();
		// alert('Giá trị nhỏ nhất là bằng 1. hoặc bạn xóa sản phẩm đi');
	}
	
}

function itemUp(id) {
	// idPro = id;
	quantity = parseInt($("#quantity_"+id).val()) + 1;
	// console.log(quantity);
	$("#quantity_"+id).val(quantity);
	updateCart(id,quantity)
}

// function onchange_num(id) {
// 	idPro = id;
// 	quantity = parseInt($("#quantity_"+id).val());
// 	if(quantity>0){
// 		updateCart(id,quantity)
// 	}else{
// 		$("#modal_delete").attr('data-id', id);
// 		$("#deleteshopping").modal();
// 	}
// }
function onchangeAmount(id,price_attribute=null) {
	idPro = id;
	// console.log(price_attribute)
	if (price_attribute===null) {
		quantity = parseInt($("#quantity_"+id).val());
	} else {
		quantity =parseInt($("#quantity_"+price_attribute+"_"+id).val());

	}
		// console.log(quantity)
	if(quantity > 0){
		updateCart(id,quantity,price_attribute)
	}else{
		$("#modal_delete").attr('data-id', id);
		$("#deleteshopping").modal();
	}
}


function updateCart(id,quantity,price_attribute) {
	$.get(
		'/shopping/updatecart',
		 {id:id,number:quantity,price_attribute:price_attribute},
		 function(data) {
			result = data.split('("*count_cart*")');
		// console.log(result[1]);
			$("#listCartShopping").html(result[0]);
			if (result[1]==0) {
				$("#shopping_book").remove();
			}
		// 	// $("#get_item_cart").html(data);
		// $("#get_item_cart").html(value[1]);
		// $("#count_shopping_cart_store").text(value[2]);
	});
}

// function deleteCart(id) {
// 	// body...
// }

function deleteItem(id) {
	if(id == 0){
	console.log(id)
		// proId = idPro;
		img = $("#img_"+id).attr('src');
		$("#imgPreviewdel").attr('src', img);
	// alert(img);
		txtPro = $("#txtPro_"+id).text();
		$("#txtNameProductdel").text(txtPro);
		
		proId = $("#modal_delete").data('id');
		$("#deleteshopping").modal('hide');
		updateCart(proId,0,0);
	}else{
		img = $("#img_"+id).attr('src');
		$("#imgPreviewdel").attr('src', img);
	// alert(img);
		txtPro = $("#txtPro_"+id).text();
		$("#txtNameProductdel").text(txtPro);

		/*txtPrice = $("#txtPrice_"+id).text();
		$("#txtpricedel").text(txtPrice);*/

		$("#modal_delete").attr('data-id', id);

		$("#deleteshopping").modal();
		// if (confirm('Bạn muốn xóa sản phẩm này khỏi giỏ hàng ?')) {
			// proId = id;
		// }
	}
	// console.log(proId);
	// console.log(id);
}

/*function isNumberKey(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode;
	if ((charCode < 48 || charCode > 57))
		return false;

	return true;
}*/


$(document).ready(function(evt) {
	var link = $('._Hg0912_');
	link.each(function() {
		$(this).keypress(function(event) {
			var charCode = (evt.which) ? evt.which : event.keyCode;
			if ((charCode < 48 || charCode > 57))
				return false;

			return true;
		});
	});

	$('#deleteshopping').on('hidden.bs.modal', function (e) {
	    // do something…
	    $("#modal_delete").attr('data-id', '');
		e.preventDefault();
	});

	$("#gotoShopping").click(function(event) {
		count = $(this).attr("data-count");
		if (count<=0) {
			$.notify({
				icon: 'pe-7s-gift',
				message: 'Giỏ hàng của bạn đang rỗng !'
			},{
				type: 'info',
				timer: 5
			});
		}
	});

	
	$("#modal_delete").click(function(event) {
		event.preventDefault();
		// console.log($("#deleteshopping").data('id'));
		
		// console.log($(this).attr("data-id"))
	  $.get(
			'/shopping/deletecart',
			{id:$(this).attr("data-id")},
			function(data) {
				// console.log(data);

				result = data.split('("*count_cart*")');
				// console.log(result[1]);
				$("#listCartShopping").html(result[0]);
				if (result[1]==0) {
					$("#shopping_book").remove();
				}
		});
	});



	$('#Payment_orders').on('change', function () {
		var selectVal = $("#Payment_orders option:selected").val();
		if (selectVal=='chuyenkhoan') {
			$(".payment .bank_account").fadeIn('3000');
		}else{
			$(".payment .bank_account").fadeOut('3000');
		}
		// alert(selectVal);
	});
	// $("#Payment_orders")
});