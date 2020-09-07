var host = window.location.href; //backend
host = host.split("quantri");

tinymce.init({
	selector: "textarea.content",
	// element_format : 'html',
	theme : "modern",
	relative_urls: false,
	height: 200,
	plugins: 'responsivefilemanager code print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern',
	toolbar1: "code undo redo | bold italic underline fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
	toolbar2: 'bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | pastetext removeformat searchreplace |responsivefilemanager image table |image media |link unlink anchor| print preview fullscreen',
	theme_advanced_buttons3_add : "pastetext,pasteword,selectall",
	fontsize_formats: "8px 10px 12px 14px 16px 18px 20px 22px 24px 36px",
	// menubar: true,
	apply_source_formatting : true,
	remove_script_host : true,
	// code_dialog_height: 200,
	// toolbar_items_size: 'small',
	 allow_html_in_named_anchor: true,
	// relative_urls: false,
	// remove_script_host:false,
	filemanager_title:"Quản lý file",
	external_filemanager_path: host[0]+"filemanager/",
	external_plugins: { "filemanager" : host[0]+"filemanager/plugin.min.js"},
	filemanager_access_key:"dfc78fb912939b31a2798211ae7e950c",
});
// alert(host[0])
var Album =
{
    ClickImage: function(){
        var imageA = $('.add-image');
            imageA.click(function(e) {
                $("#modalAdimage").modal();
                e.preventDefault();
            })
    },
    AddNewImage: function(){
            
        $('#AddNewImage').click(function(e) {
        	var action = $(this).data('action'),imageFile = $("#imageFile"),
                    Imagetitle = $("#Imagetitle"),
                    Imagedescriptions = $("#Imagedescriptions");
        	var count = $(".listimage").length;
        	var url = '/quantri/news/album-images/addimage';
            // $("#modalAdimage").modal();
            $.ajax({
                url: url,
                type: 'get',
                // dataType: 'JSON',
                data : {
                	count: count,
                    imageFile : imageFile.val(),
                    Imagetitle : Imagetitle.val(),
                    Imagedescriptions : Imagedescriptions.val(),
                },
                // beforeSend: function() {
                //     currentLink.html('loading...')
                // },
                success: function(data) {
                	alert(count);
                    $("#ImageListAlbum").append(data);
                    console.log(data);
                }
            });
            return false;
            e.preventDefault();
        })
    }
}
$(document).ready(function(){

	Album.ClickImage();
	Album.AddNewImage();


	$("#imageFile").click(function (event) {
		$("#myModal").modal();
	})
	$('#myModal').on('hidden.bs.modal', function () {
		imgsrc = $(".imageAlbum").val();
		// alert(imgsrc);
		$("#previewImage").attr('src', imgsrc);
	})


	// function ChangeToSlug()
	// {
	// 	var title, slug;

	// 	//Lấy text từ thẻ input title 
	// 	title = document.getElementById("name_slug").value;

	// 	//Đổi chữ hoa thành chữ thường
	// 	slug = title.toLowerCase();

	// 	//Đổi ký tự có dấu thành không dấu
	// 	slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
	// 	slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
	// 	slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
	// 	slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
	// 	slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
	// 	slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
	// 	slug = slug.replace(/đ/gi, 'd');
	// 	//Xóa các ký tự đặt biệt
	// 	slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
	// 	//Đổi khoảng trắng thành ký tự gạch ngang
	// 	slug = slug.replace(/ /gi, "-");
	// 	//Đổi khoảng daaus cham thành ký tự rong
	// 	// slug = slug.replace(/\./gi, "");
	// 	//Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
	// 	//Phòng trường hợp người nhập vào quá nhiều ký tự trắng
	// 	slug = slug.replace(/[^a-zA-Z0-9]/gi, '-');
	// 	slug = slug.replace(/\-\-\-\-\-/gi, '-');
	// 	slug = slug.replace(/\-\-\-\-/gi, '-');
	// 	slug = slug.replace(/\-\-\-/gi, '-');
	// 	slug = slug.replace(/\-\-/gi, '-');

	// 	// $str = slug.replace('/([\s]+)/gi', '-');
	// 	//Xóa các ký tự gạch ngang ở đầu và cuối
	// 	slug = '@' + slug + '@';
	// 	slug = slug.replace(/\@\-|\-\@|\@/gi, '');
	// 	//Đổi chữ hoa thành chữ thường
	// 	slug = slug.toLowerCase();
	// 	//In slug ra textbox có id “slug”
	// 	document.getElementById('seo_slug').value = slug;
	// }
	
	// $("#name_slug").keydown(function(event) {
	// 	ChangeToSlug();
	// 	if ($("#seo_title").length) {
	// 		$("#seo_title").val($(this).val());
	// 	}
	// });

	
});
