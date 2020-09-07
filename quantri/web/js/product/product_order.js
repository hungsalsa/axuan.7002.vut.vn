function changeStatusOrder(id) {
    $.ajax({
        url: '/quantri/products/order/status-change',
        type: 'get',
        dataType: 'JSON',
        data : {
            id : id,
            // field : $(this).data('field'),
        },
        beforeSend: function() {
            $("#orderStatus").html('loading...')
        },
        success: function(data) {
            if(data.value_post == 1)
            {                   
                $("#orderStatus").text(data.postValue);
                // $(this).html(data.postValue);
                $("#orderStatus").removeClass('btn-danger');
                $("#orderStatus").addClass('btn-success');
            }
            else
            {                     
                $("#orderStatus").text(data.postValue);
                // $("#orderStatus").html(data.postValue);
                $("#orderStatus").removeClass('btn-success');
                $("#orderStatus").addClass('btn-danger');
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
}

function changeStatus(id) {
    let that = $("#orderStatus");
    console.log(that.data('field'))
    console.log(that.data('url'))
    $.ajax({
        url: that.data('url'),
        type: 'get',
        dataType: 'JSON',
        data : {
            // id : id,
            field : $(this).data('field'),
        },
        // beforeSend: function() {
        //     $("#orderStatus").html('loading...')
        // },
        success: function(data) {
    // alert('đấ')
            // console.log(data);
            if (data.error) {
                message = data.error;
            } else {
                if(data.value_post == 1)
                {                   
                    $("#orderStatus").text(data.postValue);
                    // $(this).html(data.postValue);
                    $("#orderStatus").removeClass('btn-danger');
                    $("#orderStatus").addClass('btn-success');
                }
                else
                {                     
                    $("#orderStatus").text(data.postValue);
                    // $("#orderStatus").html(data.postValue);
                    $("#orderStatus").removeClass('btn-success');
                    $("#orderStatus").addClass('btn-danger');
                }
                message = data.message;
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
}