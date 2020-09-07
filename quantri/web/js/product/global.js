var Global =
{
    ClickButton: function(){
        // Click để thay đổi
        var link = $('.Quickchange');
        link.each(function() {
            $(this).click(function(e) {
                $(this).hide();
                width_ = "10%";
                var field = $(this).data('field');
                if ( field =='cateName' || field =='ManName' || field =='cate_id' || field =='name'|| field =='parent_id') {
                    width_ = "20%";
                }
                // alert(field);
                $(this).parent('td').css("width", width_);
                $(this).next('.updateProduct'+$(this).data('id')).show();
                $("#"+field+$(this).data('id')).focus();
                e.preventDefault();
            })
        });
        // Click vào hủy ko thay đổi
        var Cancel = $('.Cancel');
        Cancel.each(function() {
            $(this).click(function(e) {
                var divcha = $(this).parent('div.proUpdate');
                divcha.hide();

                $(this).parent('.proUpdate').parent('td').css("width", "auto");
                $(this).parent('.proUpdate').prev('.Quickchange').show();
                // divcha.prev('button.changePrices').show();
                e.preventDefault();
            })
        });

    },
    
    changeStatus: function() {
        // LUU VAO CSDL SU DUNG AJAX
        var status = $('.Quickactive');
        status.each(function() {
            $(this).click(function(e) {
                e.preventDefault();
                // var button = $('#active'+$(this).data('id'));
                var url = $(this).data('url');
                // var field = $(this).data('field');
                // console.log(field);
                var currentLink = $(this)
                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'JSON',
                    data : {
                        id : $(this).data('id'),
                        field : $(this).data('field'),
                    },
                    beforeSend: function() {
                        currentLink.html('loading...')
                    },
                    success: function(data) {
                        if(data.value_post == 1)
                        {                   
                            currentLink.text(data.postValue);
                            // currentLink.html(data.postValue);
                            currentLink.removeClass('btn-danger');
                            currentLink.addClass('btn-success');
                        }
                        else
                        {                     
                            currentLink.text(data.postValue);
                            // currentLink.html(data.postValue);
                            currentLink.removeClass('btn-success');
                            currentLink.addClass('btn-danger');
                        }
                        
                        if (data.message) {
                            message =data.message;
                        } else {
                            message ="Bạn đã : "+data.postValue+" -> "+data.name+" !";
                        }
                        $.notify({
                            icon: 'pe-7s-gift',
                            message: message
                        },{
                            type: 'info',
                            timer: 500
                        });
                        // console.log(data);
                    }
                });
                return false;
            });
        })

    },
    quickChangeActive: function() {
        // LUU VAO CSDL SU DUNG AJAX
        var status = $('.quickChangeActive');
        status.each(function() {
            $(this).click(function(e) {
                e.preventDefault();
                var field = $(this).data('field'),
                 button = $('#'+field+$(this).data('id')), url = $(this).data('url');
                // var field = $(this).data('field');
                console.log(field);
                console.log(button);
                var currentLink = $(this)
                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'JSON',
                    data : {
                        id : $(this).data('id'),
                        field : $(this).data('field'),
                    },
                    beforeSend: function() {
                        currentLink.html('loading...')
                    },
                    success: function(data) {
                        if(data.value_post == 1)
                        {                   
                            currentLink.text('Kích hoạt');
                            // currentLink.html(data.postValue);
                            currentLink.removeClass('btn-danger');
                            currentLink.addClass('btn-success');
                        }
                        else
                        {                     
                            currentLink.text('Ẩn');
                            // currentLink.html(data.postValue);
                            currentLink.removeClass('btn-success');
                            currentLink.addClass('btn-danger');
                        }

                        $.notify({
                            icon: 'pe-7s-gift',
                            message: "Bạn đã : "+data.postValue+" -> "+data.name+" !"
                        },{
                            type: 'info',
                            timer: 500
                        });
                        console.log(data);
                    }
                });
                return false;
            });
        })

    },
    changeOrder: function() {
        // LUU VAO CSDL SU DUNG AJAX
        var saveOrder = $('.saveOrder');
        saveOrder.each(function() {
            $(this).click(function() {

                var box = $(this).parent('.proUpdate');
                var url = $(this).data('url');
                var order_post = $('#order'+$(this).data('id')).val();
                // console.log(sort_val);
                // console.log(price);

                if (order_post=='') {
                    order_post = 1;
                }
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'JSON',
                    data : {
                       id : $(this).data('id'),
                       field : 'order',
                       value_post : order_post,
                   },
                   success: function(data) {
                    box.hide();
                    var boxprice = box.prev('button.Quickchange');
                    boxprice.show();
                    boxprice.text(data.postValue);
                    $.notify({
                        icon: 'pe-7s-gift',
                        message: "Bạn đã : "+data.value_post+" "+data.name+" thành "+data.postValue+" !"
                    },{
                        type: 'info',
                        timer: 500
                    });
                        console.log(data);
                        // console.log(boxprice);
                    }
                });

                
                return false;
            })
        })

    },
};
// Product.init();
$(document).ready(function() {
    Global.ClickButton();
    // Global.quickChangeActive();
    Global.changeOrder();
    // Global.changePriceSale();
    // Global.changeCateName();
    // Global.changeLocation();
    Global.changeStatus();
    // Global.changeMotorbike();
    $("#imageFile").click(function (event) {
        alert('ađâ');
        $("#myModal").modal();
    })

    $('#myModal').on('hidden.bs.modal', function () {
        imgsrc = $("#imageFile").val();
        $("#previewImage").attr('src', imgsrc);
    })
});
