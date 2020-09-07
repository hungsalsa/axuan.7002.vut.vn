var Product =
{
    changeMenuName: function() {
        
        // LUU VAO CSDL SU DUNG AJAX
        var saveMenuName = $('.saveMenuName');
        saveMenuName.each(function() {
            $(this).click(function() {
                var boxName = $(this).parent('.proUpdate');
                var url = $(this).data('url');
                var field = $(this).data('field');
                var value_post = $('#menuName'+$(this).data('id')).val();
                // var value_post = $('#status'+$(this).data('id')).val();
                // console.log(currentLink);
                if (field=='parent_id') {
                    var value_post = $('#parent_id'+$(this).data('id')).val();
                }
console.log(value_post);
                // if (value_post=='') {
                //     alert('Bạn phải nhập tên sản phẩm')
                // }else{
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'JSON',
                        data : {
                           id : $(this).data('id'),
                           field : field,
                           value_post : value_post,
                       },
                       success: function(data) {
                            boxName.hide();
                            var cateName = boxName.prev('.Quickchange');
                            // cateName.text(data.postValue);
                            cateName.text(data.postValue);
                            cateName.parent('td').attr("width","auto");
                            cateName.removeClass('btn-info');
                            cateName.addClass('btn-success');
                            cateName.show();
                            console.log(data);

                        }
                    });
                // }

                
                return false;
            })
        })

    },
    
};

$(document).ready(function() {
    Product.changeMenuName();
    
});
