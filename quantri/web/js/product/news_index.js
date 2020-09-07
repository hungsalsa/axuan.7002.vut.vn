var Product =
{
    changeCateName: function() {
        // LUU VAO CSDL SU DUNG AJAX
        var saveproName = $('.savecateName');
        saveproName.each(function() {
            $(this).click(function() {
                var boxName = $(this).parent('.proUpdate');
                var url = $(this).data('url');
                var field = $(this).data('field');
                var value_post = $('#'+field+$(this).data('id')).val();
                
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
                            // $(this).parent('.proUpdate').hide();
                            boxName.hide();
                            var cateName = boxName.prev('button.Quickchange');
                            cateName.show();
                            var message_ ='';
                            if (typeof data.error == 'undefined'){
                                // document.write("Biến variable không được định nghĩa");
                                // cateName.text('lỗi rồi');
                                cateName.text(data.postValue);
                                message_ = "Bạn đã thay đổi : '"+data.name+" -> "+data.field+" -> "+data.postValue+"' !";
                            }else{
                                cateName.text(data.name);
                                message_ = data.value_post +" -- "+data.error;
                            }
                            cateName.parent('td').attr("width","auto");
                            // if (value_post != data.value_post) {
                                $.notify({
                                    icon: 'pe-7s-gift',
                                    message: message_
                                },{
                                    type: 'info',
                                    timer: 500
                                });
                            // }
                            // console.log(data);
                            // console.log(boxprice);

                        }
                    });
                
                return false;
            })
        })

    },
};
$(document).ready(function() {
    Product.changeCateName();
});
