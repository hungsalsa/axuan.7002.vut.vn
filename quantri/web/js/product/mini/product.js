function clicktabversion(e,t){$(this).hasClass("active")?($("#"+e).show(),$("#"+t).hide()):($("#"+t).hide(),$("#"+e).show())}function editVersionPro(e){$("#idVersion").val(e),$("#versionAction").val("update"),$("#UpdateVersionPro").text("Chỉnh sửa"),$.ajax({url:"/quantri/products/product-versions/info-update",type:"get",dataType:"JSON",data:{id:e},success:function(e){e?($("#productVersionDate").val(e.date),$("#productVersionName").val(e.name),$("#productVersion_price_1-disp").val(e.price_1),$("#productVersion_price_1").val(e.price_1),$("#productVersion_price_sale_1-disp").val(e.price_sale_1),$("#productVersion_price_sale_1").val(e.price_sale_1),$("#productVersion_price_2-disp").val(e.price_2),$("#productVersion_price_2").val(e.price_2),$("#productVersion_price_3-disp").val(e.price_3),$("#productVersion_price_3").val(e.price_3),$("#proversionstatus").val(e.status),$("#modalProductVersion").modal()):$.notify({icon:"pe-7s-gift",message:"Phiên bản này ko có !"},{type:"info",timer:500})}})}function deleteVersionPro(e){confirm("Bạn có chắc muốn xóa phiên bản sản phẩm ?")&&$.ajax({url:"/quantri/products/product-versions/delete-version",type:"get",dataType:"JSON",data:{id:e},success:function(t){t.successful===!0?($("#row_versions_"+e).remove(),message=t.message):message="Xóa thất bại !",$.notify({icon:"pe-7s-gift",message:message},{type:"info",timer:500})}})}function editImagePro(e){$("#UpdateImagePro").attr("data-id",e),$("#UpdateImagePro").attr("data-action","update"),$("#UpdateImagePro").text("Chỉnh sửa"),$("#imageAction").val("update"),$("#imageId").val(e),$.ajax({url:"/quantri/products/anhsanpham/update-new-image",type:"get",dataType:"JSON",data:{id:e},success:function(e){$("#imageFile").val(e.image),$("#previewImage").attr("src",e.image),$("#imagetitle").val(e.title),$("#imagealt").val(e.alt),$("#imageorder").val(e.order),$("#modalAddImages").modal()}})}function deleteImagePro(e){confirm("Bạn có chắc muốn xóa ảnh sản phẩm ?")&&$.ajax({url:"/quantri/products/anhsanpham/remove-image",type:"get",dataType:"JSON",data:{id:e},success:function(t){t.successful===!0?($("#row_image_"+e).remove(),$("#imageFile").val(t.image),$("#previewImage").attr("src",t.image),$("#imagetitle").val(t.title),$("#imagealt").val(t.alt),$("#imageorder").val(t.order),$("#UpdateImagePro").hide(),$("#modalAddImages").modal(),setTimeout(function(){$("#modalAddImages").modal("hide")},1500)):$.notify({icon:"pe-7s-gift",message:"Xóa thất bại !"},{type:"info",timer:500})}})}var Global={showShortDescription:function(){$(".add_short_description").click(function(e){$(this).hide(),$("#product_short_introduction").show()}),$("#show_product_time_status").click(function(e){$(this).hide(),$("#product_time_status").show(),e.preventDefault()}),$("#product_time_status .icon-list-demo").click(function(e){var t=$("#product_time_status");t.hide(),t.prev("#show_product_time_status").show(),e.preventDefault()})},addProductImages:function(){return $("#UpdateImagePro").click(function(e){let t=$("#imageAction").val(),a=$(this).data("proid"),i=$("#imageId").val(),n=$("#imageFile"),o=$("#imagetitle"),s=$("#imagealt"),r=$("#imageorder");if(""!=n.val()){let e={action:t,idIma:i,pro_id:a,image:n.val(),title:o.val(),alt:s.val(),order:r.val(),count_row_image:$(".row_image").length};$.ajax({url:$(this).data("url"),data:e,success:function(e){if("update"==t)var a="Bạn đã sửa thành công !";if("create"==t)var a="Bạn đã thêm ảnh thành công !";$("#body_images_list").html(e),$("#modalAddImages").modal("hide"),$.notify({icon:"pe-7s-gift",message:a},{type:"info",timer:5})}})}else alert("Bạn chưa nhập ảnh")}),!1},addProductVersion:function(){return $("#UpdateVersionPro").click(function(e){var t=$("#idVersion").val(),a=$("#versionAction").val(),i=$("#versionProduct_id").val(),n=$(this).data("id"),o=$("#productVersionName"),s=$("#productVersionDate"),r=$("#productVersion_price_1"),l=$("#productVersion_price_sale_1"),c=$("#productVersion_price_2"),d=$("#productVersion_price_3"),u=$("#proversionstatus");if(name_val=o.val(),price_1_val=r.val(),price_sale_1_val=parseInt(l.val()),price_2_val=parseInt(c.val()),price_3_val=parseInt(d.val()),isNaN(price_sale_1_val)&&(price_sale_1_val=0),isNaN(price_2_val)&&(price_2_val=0),isNaN(price_3_val)&&(price_3_val=0),""==name_val||void 0===name_val||null===name_val)alert("Bạn chưa nhập tên ");else if(parseInt(price_1_val)<0||""==price_1_val||void 0===price_1_val||null===price_1_val)alert("Bạn chưa nhập giá gốc");else if(parseInt(price_1_val)<=price_sale_1_val)alert("giá gốc <= 0, hoặc giá gốc <= giá bán");else{"NaN"==price_sale_1_val&&(price_sale_1_val=null);var p={id:t,product:i,action:a,date:s.val(),pro_id:n,name:name_val,price_1:price_1_val,price_sale_1:price_sale_1_val,price_2:price_2_val,price_3:price_3_val,status:u.val(),count_row_versions:$(".row_versions").length};$.ajax({url:$(this).data("url"),data:p,success:function(e){$("#body_versions_list").html(e),$("#modalProductVersion").modal("hide")}})}}),!1},EditProImage:function(){EditProImage=$(".EditProImage"),EditProImage.each(function(e,t){$(this).on("click",function(e){$.ajax({url:"/quantri/products/anhsanpham/update-new-image",type:"get",dataType:"JSON",data:{id:$(this).data("id")},success:function(e){$("#imageId").val(e.id),$("#imageAction").val("update"),$("#UpdateImagePro").attr("data-id",e.id),$("#UpdateImagePro").attr("data-action","update"),$("#UpdateImagePro").text("Chỉnh sửa"),$("#imageFile").val(e.image),$("#previewImage").attr("src",e.image),$("#imagetitle").val(e.title),$("#imagealt").val(e.alt),$("#imageorder").val(e.order),$("#modalAddImages").modal()}})})})},checkTenThuoctinh:function(){var e=$(".modelThuoctinhName");e.each(function(){$(this).on("change",function(e){$(this);return $.ajax({url:"/quantri/products/thuoctinhsp/checkname",type:"get",dataType:"JSON",data:{name:$(this).val()},success:function(e){}}),e.preventDefault(),!1})})}};$(document).ready(function(){Global.showShortDescription(),Global.addProductImages(),Global.addProductVersion();$("#add_new_attrubuteProduct").click(function(e){$("#modalAttribute").modal()}),$("#productNewImage").click(function(e){$("#UpdateImagePro").text("Thêm mới"),$("#UpdateImagePro").attr("data-action","create"),$("#imageId").val(null),$("#imageAction").val(null),$("#imageFile").val(null),$("#previewImage").attr("src",null),$("#imagetitle").val(null),$("#imagealt").val(null),$("#imageorder").val(null),e.preventDefault()}),$("#modalAddImages").on("hidden.bs.modal",function(e){$("#UpdateImagePro").attr({"data-id":"0","data-action":"create"}),e.preventDefault()}),$("#modalProductVersion").on("hidden.bs.modal",function(e){$("#idVersion").val(null),$("#versionAction").val(null),$("#productVersionName").val(null),$("#productVersionDate").val(null),$("#productVersion_price_1-disp").val(null),$("#productVersion_price_sale_1-disp").val(null),$("#productVersion_price_2-disp").val(null),$("#productVersion_price_3-disp").val(null),e.preventDefault()}),$("#productVersion").hide(),$("#adformsubmit").click(function(){var e=$("#products-price_sales").val(),t=$("#products-start_sale").val(),a=$("#products-end_sale").val();""!=e&&(""==t||""==a?(alert("Bạn nhập giá khuyến mại nhưng chưa chọn ngày"),$(this).attr("type","button")):$(this).attr("type","submit"))})});