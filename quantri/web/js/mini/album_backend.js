var host=window.location.href;host=host.split("quantri"),tinymce.init({selector:"textarea.content",theme:"modern",relative_urls:!1,height:200,plugins:"responsivefilemanager code print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern",toolbar1:"code undo redo | bold italic underline fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",toolbar2:"bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | pastetext removeformat searchreplace |responsivefilemanager image table |image media |link unlink anchor| print preview fullscreen",theme_advanced_buttons3_add:"pastetext,pasteword,selectall",fontsize_formats:"8px 10px 12px 14px 16px 18px 20px 22px 24px 36px",apply_source_formatting:!0,remove_script_host:!0,allow_html_in_named_anchor:!0,filemanager_title:"Quản lý file",external_filemanager_path:host[0]+"filemanager/",external_plugins:{filemanager:host[0]+"filemanager/plugin.min.js"},filemanager_access_key:"dfc78fb912939b31a2798211ae7e950c"});var Album={ClickImage:function(){var e=$(".add-image");e.click(function(e){$("#modalAdimage").modal(),e.preventDefault()})},AddNewImage:function(){$("#AddNewImage").click(function(e){var t=($(this).data("action"),$("#imageFile")),a=$("#Imagetitle"),i=$("#Imagedescriptions"),n=$(".listimage").length,o="/quantri/news/album-images/addimage";return $.ajax({url:o,type:"get",data:{count:n,imageFile:t.val(),Imagetitle:a.val(),Imagedescriptions:i.val()},success:function(e){alert(n),$("#ImageListAlbum").append(e),console.log(e)}}),!1})}};$(document).ready(function(){Album.ClickImage(),Album.AddNewImage(),$("#imageFile").click(function(e){$("#myModal").modal()}),$("#myModal").on("hidden.bs.modal",function(){imgsrc=$(".imageAlbum").val(),$("#previewImage").attr("src",imgsrc)})});