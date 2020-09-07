var host = window.location.href; //backend
host = host.split("backend");




/*tinymce.init({
  selector: "textarea.content",
    theme: "modern",
    width: "",
    height: 150,
    plugins: [
         "code advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking spellchecker",
         "table contextmenu directionality emoticons paste textcolor responsivefilemanager fullscreen"
   ],
   toolbar1: "code undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "| responsivefilemanager | image | media | link unlink anchor | print preview fullscreen",
    menubar: false,
    toolbar_items_size: 'small',
    relative_urls: false,
    remove_script_host:false,

    filemanager_title:"Responsive Filemanager",
    // filemanager_crossdomain: true,
    external_filemanager_path: host[0]+"filemanager/",
    external_plugins: { "filemanager" : host[0]+"filemanager/plugin.min.js"},
    filemanager_access_key:"ae8c77efd8f0ccaa1aed347113d4a6c2" ,
  
   image_advtab: true,
   image_title: true,
   image_description: true,
  image_dimensions: true,
  image_class_list: [
      { title: "Responsive", value: "lazy img-responsive img-post" }
  ],

 });
*/

tinymce.init({
  selector: "textarea.content",
  element_format : 'html',
  theme : "modern",
  // theme: "silver",
  height: 280,
  // forced_root_block : 'div',
    // width: 220,
    // plugins: "paste",
    // theme_modern_font_sizes: "10px,12px,13px,14px,16px,18px,20px",
    // font_size_style_values: "12px,13px,14px,16px,18px,20px",
    plugins: [
    "code autolink link image lists charmap print preview hr anchor pagebreak",
    "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking spellchecker",
    "table contextmenu directionality emoticons paste textcolor responsivefilemanager fullscreen"
    ],
    theme_advanced_buttons3_add : "pastetext,pasteword,selectall",
    toolbar1: "code undo redo | bold italic underline fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
    toolbar2: "responsivefilemanager | pastetext removeformat searchreplace | table | media |link unlink anchor| print preview fullscreen",
  fontsize_formats: "8px 10px 12px 14px 16px 18px 20px 22px 24px 36px",
    menubar: false,
    toolbar_items_size: 'small',
    relative_urls: false,
    remove_script_host:false,
    // paste_as_text: true
    // paste_as_text: true
    // paste_text_sticky : true,
    // paste_text_sticky_default: true
    // paste_as_text: true
    // images_upload_base_path: 'uploads/',
    // file_browser_callback: "openmanager",
    // open_manager_upload_path: 'uploads/',

    filemanager_title:"Quản lý file",
    // filemanager_crossdomain: true,
    external_filemanager_path: host[0]+"filemanager/",
    external_plugins: { "filemanager" : host[0]+"filemanager/plugin.min.js"},
    filemanager_access_key:"dfc78fb912939b31a2798211ae7e950c",



// image_advtab: true,
// image_title: true,
// image_description: true,
// image_dimensions: true,
// branding: false

});

$(document).ready(function(){

$("#imageFile").click(function (event) {
    $("#myModal").modal();
  })

  $('#myModal').on('hidden.bs.modal', function () {
    imgsrc = $("#imageFile").val();
    // alert(imgsrc);
    $("#previewImage").attr('src', imgsrc);
  })

imgsrc = $("#imageFile").val();
if (imgsrc!=null) {
    $("#previewImage").attr('src', imgsrc);
}

  function ChangeToSlug()
  {
    var title, slug;

    //Lấy text từ thẻ input title 
    title = document.getElementById("title_slug").value;

    //Đổi chữ hoa thành chữ thường
    slug = title.toLowerCase();

    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi khoảng daaus cham thành ký tự rong
    // slug = slug.replace(/\./gi, "");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/[^a-zA-Z0-9]/gi, '-');
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');

    // $str = slug.replace('/([\s]+)/gi', '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //Đổi chữ hoa thành chữ thường
    slug = slug.toLowerCase();
    //In slug ra textbox có id “slug”
    document.getElementById('slug_url').value = slug;
  }
  
  $("#title_slug").blur(function(event) {
    ChangeToSlug();
  });

  
});

function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
