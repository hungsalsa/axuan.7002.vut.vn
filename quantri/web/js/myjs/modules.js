$(document).ready(function() {
    var typeModule =$('#module_type_select');
    if ( typeModule.val()== 'product' || typeModule.val()== 'news') {
        $('#_SettingModules_count_pro').show();
    }else{
        $('#_SettingModules_count_pro').hide();
    }
    $('#module_type_select').on('change', function(e) {
        var value = $(this).val();
        if (value == 'custom'||value == 'form') {
            // alert(value);
            $('#module_type_cateid_out').css('display', 'none');
            $('#SettingModules_hienthi').html('');
            $('#Parent_SettingModules_hienthi').hide();
            $('#_SettingModules_count_pro').hide();
            // $('#module_content').css('display', 'block');
        }else{
            $('#module_type_cateid_out').css('display', 'block');
            $('#Parent_SettingModules_hienthi').show();
            $('#_SettingModules_count_pro').show();
            // $('#module_content').css('display', 'none');
        }
        $.ajax({
            url: '/quantri/setting/setting-modules/category',
            type: 'GET',
            // dataType: 'JSON',
            data : {
                type: value
            },
            success: function(data) {
                console.log(data)
                return_value = data.split('**')
                $('#module_positions').html(return_value[0]);
                if(value !='custom'){
                    cate = return_value[1].split('hienthi');

                    $('#module_type_cateid').html(cate[0]);
                    $('#SettingModules_hienthi').html(cate[1]);
                    // $('#Modules_page_show').html(cate[2]);
                }
                if(value =='form'){
                    // page_show = cate[1].split('**');
                    $('#Modules_page_show').html(return_value[1]);
                }
            }
        });

        // }
        e.preventDefault();
    });


    $('#SettingModules_parent_id').on('change', function(e) {
        var value = $(this).val();
        
        if (value > 0 && value !=''  ) {
            
            $.ajax({
                url: '/quantri/setting/setting-modules/position',
                type: 'GET',
                dataType: 'JSON',
                data : {
                    id: value
                },
                success: function(data) {
                    // console.log(data)
                    $('#Parent_module_positions').hide();
                    $('#_SettingModules_status').hide();
                    $('#_SettingModules_page_show').hide();
                    $('#_SettingModules_count_pro').hide();
                    $('#Parent_SettingModules_hienthi').hide();
                    $("#module_positions").val(data).change();
                }
            });
        }else{
            $('#Parent_module_positions').show();
            $('#_SettingModules_status').show();
            $('#_SettingModules_page_show').show();
            $('#_SettingModules_count_pro').show();
            $('#Parent_SettingModules_hienthi').show();
            // $("#module_positions").val(data).change();
            $("#module_positions").val(null).change();
        }
        /*if (!value){
            $("#module_positions").val(null).change();
            $('#Parent_module_positions').show()
        }*/
        
console.log(value)
        // }
        e.preventDefault();
    });
});