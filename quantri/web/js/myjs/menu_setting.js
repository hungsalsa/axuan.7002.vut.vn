var Global =
{
    changeMenuType: function () {
        $('#MenuSettingType').on('change', function(e) {        
        // alert($(this).val())
        var id = $(this).val();
            if (id==4) {
                // alert($(this).val());
                $("#parentMenuSettinglink_cate").hide();
                $("#MenuSettingContent").show();
                $("#parentSeo_slug").hide();
// console.log($("#menus-parent_id").val())
                if ($("#menus-parent_id").val()== '' ||$("#menus-parent_id").val()== null || $("#menus-parent_id").val()=='undefined') {
                    $('.help-block-success').show();
                    $.notify({
                        icon: 'pe-7s-gift',
                        message: 'Bạn hãy chọn thuộc tính thẻ liên kết (a) là:  data-hover="dropdown" class="dropdown-toggle" nếu muốn menu có cấp dưới'
                    },{
                        type: 'info',
                        timer: 5
                    });

                }

                 

            }else{
                $('.help-block-success').hide();
                $("#parentMenuSettinglink_cate").show();
                $("#MenuSettingContent").hide();
                $("#parentSeo_slug").hide();
            }

            $.get(
                $(this).data('url'),
                { id:  id},
                function (data) {
                    $("#MenuSettinglink_cate").html(data);
                }
            );
            e.preventDefault();
        });
        // return false;
    },

};
// var counter = 0;
$(document).ready(function() {
    Global.changeMenuType();
    $("#name_slug").blur(function(event) {
        $("#seo_title").val($(this).val());
        // ChangeToSlug();
        // if ($("#seo_title").length) {
        //     $("#seo_title").val($(this).val());
        // }
    });
});
