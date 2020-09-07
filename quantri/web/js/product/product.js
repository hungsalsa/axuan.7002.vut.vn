var Global =
{
    showShortDescription: function(){
        // Click để thay đổi
        $('.add_short_description').click(function(e) {
            $(this).hide();
            $('#product_short_introduction').show();
        });
        $('#show_product_time_status').click(function(e) {
            $(this).hide();
            $('#product_time_status').show();
            e.preventDefault();
        });
        $('#product_time_status .icon-list-demo').click(function(e) {
            var parent = $('#product_time_status');
            parent.hide();
            parent.prev('#show_product_time_status').show();
            // $('#product_time_status').show();
            e.preventDefault();
        });
    },
    addProductImages: function () {

        $("#UpdateImagePro").click(function(event) {
            // event.preventDefault();
    // event.stopPropagation();

            
            let action = $("#imageAction").val(),pro_id = $(this).data('proid'),id = $("#imageId").val(),image = $("#imageFile"),title = $("#imagetitle"),alt = $("#imagealt"),order = $("#imageorder");
            if (image.val()!='') {
                let data_tran = {
                    action : action,
                    idIma : id,
                    pro_id : pro_id,
                    image : image.val(),
                    title : title.val(),
                    alt : alt.val(),
                    order : order.val(),
                    count_row_image : $(".row_image").length
                }
                // console.log(data_tran);
                // data_tran ={};
                $.ajax({
                    url: $(this).data('url'),
                    data: data_tran,
                    success: function(data) {
                        
                        if (action=='update') {
                            // $("#imageFile_"+idIma).attr("src",data.image);
                            // $("#body_images_list").html(data);
                            var message ='Bạn đã sửa thành công !'
                        }
                        if (action=='create') {
                            // $("#imageFile_"+idIma).attr("src",data.image);
                            var message ='Bạn đã thêm ảnh thành công !'
                        }
                            $("#body_images_list").html(data);
                        $("#modalAddImages").modal('hide');
                        $.notify({
                            icon: 'pe-7s-gift',
                            message: message
                        },{
                            type: 'info',
                            timer: 5
                        });
                    },
                });
            } else {
                alert('Bạn chưa nhập ảnh')
            }
        });
        return false;
        e.preventDefault();
    },
    addProductVersion: function () {

        $("#UpdateVersionPro").click(function(e) {
            

            var id = $("#idVersion").val(),action = $("#versionAction").val(),product = $("#versionProduct_id").val(),pro_id = $(this).data('id'),name = $("#productVersionName"),date = $("#productVersionDate"),price_1 = $("#productVersion_price_1"),price_sale_1 = $("#productVersion_price_sale_1"),price_2 = $("#productVersion_price_2"),price_3 = $("#productVersion_price_3"),status = $("#proversionstatus");

                name_val = name.val();
                price_1_val = price_1.val();
                price_sale_1_val = parseInt(price_sale_1.val());


                price_2_val = parseInt(price_2.val());
                price_3_val = parseInt(price_3.val());
                
                if (isNaN(price_sale_1_val)) {
                    price_sale_1_val = 0;
                }
                if (isNaN(price_2_val)) {
                    price_2_val =0;
                }
                if (isNaN(price_3_val)) {
                    price_3_val =0;
                }

// console.log(date.val())
            // if (name_val == '' || name_val === undefined || name_val === null|| price_1_val < price_sale_1_val || price_1_val <= 0 || price_1_val === '' || price_1_val === undefined || price_1_val === null) {
                if (name_val == '' || name_val === undefined || name_val === null) {
                    alert('Bạn chưa nhập tên ');
                }else if (parseInt(price_1_val) < 0 || price_1_val == '' || price_1_val === undefined || price_1_val === null) {
                    alert('Bạn chưa nhập giá gốc');
                }else if (parseInt(price_1_val) <= price_sale_1_val) {
                    // console.log('goc')
                    // console.log(price_1_val)
                    // console.log('khM')
                    // console.log(price_sale_1_val)
                    alert('giá gốc <= 0, hoặc giá gốc <= giá bán');

                
            } else {
                if (price_sale_1_val=='NaN') {
                    price_sale_1_val = null;
                }
                
                var data_tran = {
                    id      : id,
                    product : product,
                    action : action,
                    date : date.val(),
                    pro_id : pro_id,
                    name : name_val,
                    price_1 : price_1_val,
                    price_sale_1 : price_sale_1_val,
                    price_2 : price_2_val,
                    price_3 : price_3_val,
                    status : status.val(),
                    count_row_versions : $(".row_versions").length
                }
                        // console.log(data_tran);
                // $("#body_versions_list").html('');
                $.ajax({
                    url: $(this).data('url'),
                    data: data_tran,
                    success: function(data) {
                        $("#body_versions_list").html(data);
                        $("#modalProductVersion").modal('hide');
                        // val = data.split('"***"');
                        // $("#get_item_cart").html(data);
                        // $("#get_item_cart").html(val[0]);
                        // $("#count_shopping_cart_store").text(val[1]);
                    },
                    // dataType: dataType
                });

            }

            /*$.ajax({
                url: $(this).data('url'),
                type: 'post',
                dataType: 'JSON',
                data : data,
                success: function(data) {
            // console.log(data)
                    console.log(data);
                    // if (data.save === true) {
                        $("#body_versions_list").html(data);
                        if (action='update') {
                            $("#versionName_"+id).text(data.date);
                            $("#versionName_"+id).text(data.name);
                            $("#versionPrice_"+id).text(data.price_1);
                            $("#productVersion_price_"+id).text(data.price_sale_1);
                            $("#productVersion_price_"+id).text(data.price_2);
                            $("#productVersion_price_"+id).text(data.price_3);
                            $("#versionStatus_"+id).text(data.status);
                            $("#row_versions_"+id).html(data.row_versions);
                            var message ='Bạn đã sửa thành công !'
                        }
                        if (action='create') {
                            // $("#imageFile_"+idIma).attr("src",data.image);
                            $("#body_versions_list").append(data.row_versions);
                        }
                            var message ='Bạn đã thêm phiên bản thành công !'
                    // } else {
                        // var message ='Bạn đã sửa thất bại !';
                        // alert('bạn đã sửa thất bại');
                        // $("#modalAddImages").css('z-index', '1030');
                        // $(".modal-backdrop").css('z-index', '1029');
                    // }

                
                    $.notify({
                        icon: 'pe-7s-gift',
                        message: message
                    },{
                        type: 'info',
                        timer: 5
                    });
                }
            });*/
        });
        return false;
    },
    EditProImage: function() {
        EditProImage = $(".EditProImage");
        EditProImage.each(function(index, val) {
            $(this).on('click',(function(event) {
                // console.log($(this).data('id'));
                // console.log(val);

                // $("#modalAddImages").modal();
                // $("#UpdateImagePro").attr('data-id', id);
                // $("#UpdateImagePro").attr('data-action', 'update');
                // $("#UpdateImagePro").text('Chỉnh sửa');
                // console.log(id);
                $.ajax({
                    url: '/quantri/products/anhsanpham/update-new-image',
                    type: 'get',
                    dataType: 'JSON',
                    data : {id : $(this).data('id')},
                    success: function(data) {
                        $("#imageId").val(data.id);
                        $("#imageAction").val('update');
                        $("#UpdateImagePro").attr('data-id', data.id);
                        $("#UpdateImagePro").attr('data-action', 'update');
                        $("#UpdateImagePro").text('Chỉnh sửa');

            // alert($("#imageFile").val(data.image).replace(window.location.origin, ""));
            // $("#modalAddImages_content").html(data.image);
            $("#imageFile").val(data.image);
            $("#previewImage").attr('src', data.image);
            $("#imagetitle").val(data.title);
            $("#imagealt").val(data.alt);
            $("#imageorder").val(data.order);
            $("#modalAddImages").modal();
            // console.log(data)
        }
    });


            })
            )
            /* iterate through array or object */
        });
    },
   

    checkTenThuoctinh: function() {
        // LUU VAO CSDL SU DUNG AJAX
        var name = $('.modelThuoctinhName');
        name.each(function() {
            $(this).on('change', function(e) {
                
                // var button = $('#active'+$(this).data('id'));
                // var url = $(this).data('url');
                // var field = $(this).data('field');
                // console.log(field);
                var currentLink = $(this)
                $.ajax({
                    url: '/quantri/products/thuoctinhsp/checkname',
                    type: 'get',
                    dataType: 'JSON',
                    data : {
                        name : $(this).val(),
                        // field : $(this).data('field'),
                    },
                    // beforeSend: function() {
                    //     currentLink.html('loading...')
                    // },
                    success: function(data) {
                    }
                });
                e.preventDefault();
                return false;
            });
        })

    }
};
// var counter = 0;


function clicktabversion(buttonShow,buttonHide) {
    // alert('sdada')
    if ($(this).hasClass('active')) {
        $("#"+buttonShow).show();
        $("#"+buttonHide).hide();
    } else {
        $("#"+buttonHide).hide();
        $("#"+buttonShow).show();
    }
}

function editVersionPro(id) {
    $("#idVersion").val(id);
    $("#versionAction").val("update");
    $("#UpdateVersionPro").text('Chỉnh sửa');
    // $("#UpdateVersionPro").attr('data-action', 'update');

     // ($("#versionName_"+id).text('sdfsfs'));

    $.ajax({
        url: '/quantri/products/product-versions/info-update',
        type: 'get',
        dataType: 'JSON',
        data : {id : id},
        success: function(data) {
            // console.log(data)
            if (data) {
                $("#productVersionDate").val(data.date);
                $("#productVersionName").val(data.name);
                $("#productVersion_price_1-disp").val(data.price_1);
                $("#productVersion_price_1").val(data.price_1);
                $("#productVersion_price_sale_1-disp").val(data.price_sale_1);
                $("#productVersion_price_sale_1").val(data.price_sale_1);
                $("#productVersion_price_2-disp").val(data.price_2);
                $("#productVersion_price_2").val(data.price_2);
                $("#productVersion_price_3-disp").val(data.price_3);
                $("#productVersion_price_3").val(data.price_3);
                $("#proversionstatus").val(data.status);

                $("#modalProductVersion").modal();
            } else {
                $.notify({
                    icon: 'pe-7s-gift',
                    message: "Phiên bản này ko có !"
                },{
                    type: 'info',
                    timer: 500
                });
            }
            
        }
    });
}


function deleteVersionPro(id){
    if (confirm("Bạn có chắc muốn xóa phiên bản sản phẩm ?")) {
        $.ajax({
            url: '/quantri/products/product-versions/delete-version',
            type: 'get',
            dataType: 'JSON',
            data : {id : id},
            success: function(data) {
                // console.log(tr)
                if (data.successful===true) {
                        // $("#UpdateVersionPro").hide();

                        $("#row_versions_"+id).remove();
                        // $("#productVersionName").val(data.name);
                        // $("#productVersionPrice").val(data.price);
                        // $("#productVersionPriceSale").val(data.price_sale);
                        // $("#proversionstatus").val(data.status);

                        // $("#modalProductVersion").modal();

                        // setTimeout(function(){
                        //     $("#modalProductVersion").modal('hide');
                        // }, 1500);
                        message = data.message;
                                     // Set a timeout to hide the element again
                }else{
                    message = "Xóa thất bại !"
                }
                $.notify({
                    icon: 'pe-7s-gift',
                    message: message
                },{
                    type: 'info',
                    timer: 500
                });
            }
        });
    }
}


function editImagePro(id) {
    
    $("#UpdateImagePro").attr('data-id', id);
    $("#UpdateImagePro").attr('data-action', 'update');
    $("#UpdateImagePro").text('Chỉnh sửa');
    $("#imageAction").val('update');
    $("#imageId").val(id);
    // console.log(id);

    $.ajax({
        url: '/quantri/products/anhsanpham/update-new-image',
        type: 'get',
        dataType: 'JSON',
        data : {id : id},
        success: function(data) {
            // alert($("#imageFile").val(data.image).replace(window.location.origin, ""));
            // $("#modalAddImages_content").html(data.image);
            $("#imageFile").val(data.image);
            $("#previewImage").attr('src', data.image);
            $("#imagetitle").val(data.title);
            $("#imagealt").val(data.alt);
            $("#imageorder").val(data.order);
            $("#modalAddImages").modal();
            // console.log(data)
        }
    });
}


function deleteImagePro(id){
    if (confirm("Bạn có chắc muốn xóa ảnh sản phẩm ?")) {
        $.ajax({
            url: '/quantri/products/anhsanpham/remove-image',
            type: 'get',
            dataType: 'JSON',
            data : {id : id},
            success: function(data) {
                // console.log(tr)
                if (data.successful===true) {
                        $("#row_image_"+id).remove();
                        $("#imageFile").val(data.image);
                        $("#previewImage").attr('src', data.image);
                        $("#imagetitle").val(data.title);
                        $("#imagealt").val(data.alt);
                        $("#imageorder").val(data.order);
                        $("#UpdateImagePro").hide();
                        $("#modalAddImages").modal();

                        setTimeout(function(){
                            $("#modalAddImages").modal('hide');
                        }, 1500);
                                     // Set a timeout to hide the element again
                }else{
                    $.notify({
                        icon: 'pe-7s-gift',
                        message: "Xóa thất bại !"
                    },{
                        type: 'info',
                        timer: 500
                    });
                }
            }
        });
    }
}

/*function format_keyup_value(id) {
    var value = $("#"+id).val();
    // console.log(value)
    return $("#"+id).val(number_format(BigInt(value), 0, ',', '.'));
}

// ================Định dang số=======================
function number_format(number, decimals, dec_point, thousands_sep) {
    number = number.toFixed(decimals);

    var nstr = number.toString();
    nstr += '';
    x = nstr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? dec_point + x[1] : '';
    var rgx = /(\d+)(\d{3})/;

    while (rgx.test(x1))
        x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');

    return x1 + x2;
}*/



$(document).ready(function() {
    // Global.EditProImage();
    Global.showShortDescription();
    Global.addProductImages();
    Global.addProductVersion();

    var str = 11000023.4545353; 
// var num = parseFloat(str.replace(/\s/g, "").replace(",", ".")); 
// console.log(number_format(426342461.55556, 0, ',', '.')); //gives 42 661,56)
    
    $("#add_new_attrubuteProduct").click(function (event) {
        $("#modalAttribute").modal();
    });

    $("#productNewImage").click(function(e) {
        
        $("#UpdateImagePro").text('Thêm mới');
        $("#UpdateImagePro").attr('data-action', 'create');
        // $("#UpdateImagePro").attr('data-id', $("#imageProduct_id").val());
        $("#imageId").val(null);
        $("#imageAction").val(null);
        $("#imageFile").val(null);
        $("#previewImage").attr('src', null);
        $("#imagetitle").val(null);
        $("#imagealt").val(null);
        $("#imageorder").val(null);
        e.preventDefault();
    });



$('#modalAddImages').on('hidden.bs.modal', function (e) {
  $("#UpdateImagePro").attr({
      'data-id': '0',
      'data-action': 'create'
  });
  e.preventDefault();
})
    // $("#productVersion").click(function(e) {
        
    //     alert('dasda')
    //     $("#productVersionDate").val(null);
    //     $("#productVersionName").val(null);
    //     $("#productVersion_price_1").val(null);
    //     $("#productVersion_price_sale_1").val(null);
    //     $("#productVersion_price_2").val(null);
    //     $("#productVersion_price_3").val(null);
    //     e.preventDefault();
    // });

    // Khi modal version đóng lại
    $('#modalProductVersion').on('hidden.bs.modal', function (e) {
        // alert('dasda')
        $("#idVersion").val(null);
        $("#versionAction").val(null);
        $("#productVersionName").val(null);
        $("#productVersionDate").val(null);
        $("#productVersion_price_1-disp").val(null);
        $("#productVersion_price_sale_1-disp").val(null);
        $("#productVersion_price_2-disp").val(null);
        $("#productVersion_price_3-disp").val(null);
        e.preventDefault();
    });

    // Kiểm tra tab trong sản phẩm
    $("#productVersion").hide();

    $("#adformsubmit").click(function() {
        var products_price_sales = $("#products-price_sales").val(),start_sale = $("#products-start_sale").val(),end_sale = $("#products-end_sale").val();
        if (products_price_sales!='') {
            if (start_sale==''||end_sale=='') {
                alert('Bạn nhập giá khuyến mại nhưng chưa chọn ngày')
                $(this).attr('type', 'button');
            }else {
                $(this).attr('type', 'submit');
            }
        } 
    })






//         $("#UpdateImagePro").click(function(event) {

//             var myVal = $(event.relatedTarget).data('id');
//   // $(this).find(".modal-body").text(myVal);
//             // console.log(myVal)

//                 // event.preventDefault();
//             console.log($("#imageProduct_id").trigger('focus').val())
//             // console.log($(this).data('action'))
//             // action = $(event.target).data('action');
// // event.preventDefault();
//             // console.log($("#UpdateImagePro").data('id'));
//             // console.log($(this).data('action'));
            
//             // let action = $(this).data('action'),pro_id = $(this).data('proid'),id = $(this).data('id'),image = $("#imageFile"),title = $("#imagetitle"),alt = $("#imagealt"),order = $("#imageorder");
//             // if (id!='' && image.val()!='') {
//     //             let data_tran = {
//     //                 action : action,
//     //                 idIma : id,
//     //                 pro_id : pro_id,
//     //                 image : image.val(),
//     //                 title : title.val(),
//     //                 alt : alt.val(),
//     //                 order : order.val(),
//     //                 count_row_image : $(".row_image").length
//     //             }
//     //             console.log(data_tran);
//     //             data_tran = undefined;
//     // event.stopPropagation();

//                /* $.ajax({
//                     url: $(this).data('url'),
//                     data: data_tran,
//                     success: function(data) {
                        
//                         if (action=='update') {
//                             // $("#imageFile_"+idIma).attr("src",data.image);
//                             // $("#body_images_list").html(data);
//                             var message ='Bạn đã sửa thành công !'
//                         }
//                         if (action=='create') {
//                             // $("#imageFile_"+idIma).attr("src",data.image);
//                             var message ='Bạn đã thêm ảnh thành công !'
//                         }
//                             $("#body_images_list").html(data);
//                         $("#modalAddImages").modal('hide');
//                         $.notify({
//                             icon: 'pe-7s-gift',
//                             message: message
//                         },{
//                             type: 'info',
//                             timer: 5
//                         });
//                     },
//                 });*/
//             // } else {
//                 // alert('Bạn chưa nhập ảnh')
//             // }
//         });



});