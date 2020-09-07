var host = window.location.href; //backend
host = host.split("quantri");

tinymce.init({
	selector: "textarea.content",
	element_format : 'html',
	theme : "modern",
	language : "vi", 
	height: 350,
	plugins: [
		"advlist autolink link image lists charmap print preview hr anchor pagebreak",
		"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
		"save table contextmenu directionality emoticons template paste textcolor"
	],
    //plugins: 'responsivefilemanager searchreplace autolink codesample table toc imagetools colorpicker textpattern',
	/* toolbar */
	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
	toolbar1: "code undo redo | bold italic underline strikethrough fontsizeselect | forecolor backcolor | styleselect pastetext pasteword removeformat | link unlink anchor | searchreplace | responsivefilemanager image table media | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | preview print fontName fullscreen",
	//toolbar2: '',
	theme_advanced_buttons3_add : "pastetext,pasteword,selectall",
	fontsize_formats: "10px 12px 14px 16px 18px 20px 22px 24px 36px 48px",

	style_formats: [
            {title: 'Heading 2', format: 'h2'},
            {title: 'Heading 3', format: 'h3'},
            {title: 'Heading 4', format: 'h4'},
            {title: 'Heading 5', format: 'h5'},
            {title: 'Heading 6', format: 'h6'},
            {title: 'Normal', block: 'p'}
    ],
    /*formats : {
        alignleft : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'left'},
        aligncenter : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'center'},
        alignright : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'right'},
        alignfull : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'full'},
        bold : {inline : 'span', 'classes' : 'bold'},
        italic : {inline : 'span', 'classes' : 'italic'},
        underline : {inline : 'span', 'classes' : 'underline', exact : true},
        strikethrough : {inline : 'del'},
                forecolor : {inline : 'span', classes : 'forecolor', styles : {color : '%value'}},
                hilitecolor : {inline : 'span', classes : 'hilitecolor', styles : {backgroundColor : '%value'}},
        custom_format : {block : 'h1', attributes : {title : "Header"}, styles : {color : red}}
    },*/
	
	// menubar: true,
	// menubar: "tools",
	relative_urls: false,
    remove_script_host:false,
	apply_source_formatting : true,
	extended_valid_elements : "script[src|async|defer|type|charset]",
	//code_dialog_height: 200,
	toolbar_items_size: 'small',
	allow_html_in_named_anchor: true,
	
	filemanager_title:"Quản lý file",
	external_filemanager_path: host[0]+"filemanager/",
	external_plugins: { "filemanager" : host[0]+"filemanager/plugin.min.js"},
	filemanager_access_key:"dfc78fb912939b31a2798211ae7e950c",
});
// alert(host[0])
$(document).ready(function(){

$("#imageFile").click(function (event) {event.preventDefault();$("#myModal").modal();})

	$('#myModal').on('hidden.bs.modal', function () {
		imgsrc = $("#imageFile").val();
		// alert(imgsrc);
		$("#previewImage").attr('src', imgsrc);
	});


	$("#imageFilebanner").click(function (e) {
		e.preventDefault();
			$("#ModalBanner").modal();
		})

	$('#ModalBanner').on('hidden.bs.modal', function () {
			imgsrc = $(".imageFile").val();
			// alert(imgsrc);
			$(".previewImage").attr('src', imgsrc);
		});

	var body = $("body");

	// $(window).scroll(function(event) {
	// 	var pos_body = $('html,body').scrollTop();
 //      // console.log(pos_body);
 //      if(pos_body>60){
      	
 //      	$('.navbar-default.sidebar').addClass('co-dinh-menu');
 //      }
 //      else {
 //      	$('.navbar-default.sidebar').removeClass('co-dinh-menu');
 //      }
 //      if(pos_body>1200){
 //      	$('.back-to-top').addClass('hien-ra');
 //      }
 //      else{
 //      	$('.back-to-top').removeClass('hien-ra');
 //      }
 //  });
	$('.back-to-top').click(function(event) {
		$('html,body').animate({scrollTop: 0},1400);
	});

	
});