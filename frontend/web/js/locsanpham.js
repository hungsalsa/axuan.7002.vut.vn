var filterProducts = {
    // expandFeature: function() {
    //     var criteria =$(".criteria");
    //     criteria.each(function(index, el) {
    //     // criteria.removeClass('expand');
    //     $(this).click(function() {
    //         criteria.not(this).removeClass('expand');
    //         criteria.not(this).next('.property').slideUp(300);
    //         var n, t;
    //         // $(".criteria").removeClass('expand')
    //        /* $(this).addClass('expand')
    //         if($(this).next('.property').children('.prop').find('.check').length==0){
    //             $(this).removeClass('expand')
    //         }*/
    //             $(this).toggleClass('expand')
    //         // $(".criteria").not(this).parent().removeClass("expand");
    //         // $(".criteria").not(this).next().hide();
    //         // n = $(this);
    //         $(this).next().slideToggle(100);
    //         // setTimeout(function() {
    //         //     index.toggleClass("expand")
    //         // }, 200);
    //         t = $(this).parent().parent().hasClass("laptop") ? $(".filter.laptop") : $(".filter");
    //         $("body,html").animate({
    //             scrollTop: t.offset().top
    //         }, 300)
    //     });
    //     $(".closefilter").click(function() {
    //         $(this).parent().hide(  );
    //         $(this).parent().prev().removeClass("expand")
    //     });
    // });
    // },

    checkProductFilter: function() {
        // var listGroup = $('.filter .manu.manufactures a');
        var menuSelect = $('.filter .dropdown-menu a.dropdown-item')
        // var target = $(".manu.manufactures a");
            // $("#about").animate({right: "-700px"}, 2000);
            menuSelect.on('click', function(e) {
                e.stopPropagation();
            // prevent the default action, in this case the following of a link
            // var slug = $('.breadcrumb.list_danhmuc li>a.active').attr('href');
            // if (menuSelect.hasClass("check")) {
                $(this).toggleClass('check');
                e.preventDefault();
                    // capture the href attribute of the a element
                modelSelect = $('.filter .dropdown-menu a.check');//.data('id');
                // Map cac id select lai voi nhau
                
                var model = modelSelect.map( function() {
                    return $(this).attr('data-id');
                }).get();

// console.log(model.length)
//                
// console.log(model);
                // featureSelect = $('.filter .feature .property a.check');//.data('id');
                // // Map cac id select lai voi nhau
                // var feature = featureSelect.map( function() {
                //     return $(this).attr('data-id');
                // }).get();

                // featureSelect.parent().parent('.property').prev('.feature').addClass('expand');
                // console.log(featureSelect.data('id'));
// console.log(model.length);
                var urlRequet = '';
                if (model.length>0) {
                    urlRequet += '#m:'+model.join(";");
                }
                // console.log(urlRequet);
                // if(feature.length>0){
                //     urlRequet += '&f:'+feature.join(";");
                // }
                let refresh = window.location.protocol + "//" + window.location.host + window.location.pathname +urlRequet;
                // let refresh = window.location.protocol + "//" + window.location.host + window.location.pathname + '#m:'+model.join(";")+'&p:'+price+'&f:'+feature;
                window.history.pushState({ path: refresh }, '', refresh);

                url = $(this).attr('href').replace('#', '');
                data = {model : model,url : url};
                // console.log(data);
                // console.log(url);

                $.ajax({
                    url: '/product/filter',
                    data: data,
                    type:"POST",
                    datatype:'json',
                    beforeSend: function() {
                            // setting a timeout
                            $('#listProductData').css({
                                height: '4000px',
                                background: '#fff'
                            });
                            $('#listProductData').html('<div style="margin:5% 47%" class="fa fa-spinner fa-spin"></div>');
                    },
                    success: function(data) {
                        // console.log(data);
                        // console.log(data)
                        // val = data.split('"***"');
                        // $('#txtPriceProduct').text(val[2])
                        // // $("#get_item_cart").html(data);
                        if (data.length>0) {
                            $("#listProductData").css('height', 'auto');;
                            $("#listProductData").html(data);
                            $("#phantrang").hide();
                        }
                        // $("#count_shopping_cart_store").text(val[1]);
                    },
                    error:function(request, error){
                        console.log(error);
                    }
                    // dataType: dataType
                });

            });
        },
        };
/*checkProductFilter: function() {
    var hasmodel = window.location.hash,
    param = hasmodel.search('&'),

    menuSelect = $('.filter .manu.manufactures a:not(.show_more)');
    if (param==-1) {
             // sear = hasmodel.search(':');
             model =  hasmodel.substr(hasmodel.search(':')+1);
             // console.log(sear);
             model = model.split(";");
             for (var i = 0; i < model.length; i++) {
                 // menuSelect.each(function(index, el) {
                     // $(".filter .manu.manufactures a").find(`[data-id='${model[i]}']`)
                     // console.log($(".filter .manu.manufactures a").find("[data-id='" + model[i] + "']"));
                     // $(".filter .manu.manufactures a").find("[data-id='" + model[i] + "']").addClass('check'); 
                     $(".filter .manu.manufactures a[data-id='" + model[i] +"']").addClass('check')
                     // if(menuSelect.data('id')== model[i]){
                     //     menuSelect.addClass('check');
                         // console.log(model[i]);
                     // }
                 // });
             }
             // console.log(model);
         }else{
           model = hasmodel.substr(0,param);
       }
   },
*/
    /*aFix: function() {
        $('.back-to-top').click(function() {
            $('html, body').animate({
                scrollTop: 0
            })
        });
        $(window).scroll(function() {
            if ($(window).scrollTop() > 0) {
                $('.header').addClass('menuFixed');
                $('.menu-top').addClass('fixed')
            } else {
                $('.header').removeClass('menuFixed');
                $('.menu-top').removeClass('fixed')
            }
            if ($(window).scrollTop() >= 300) {
                $('.back-to-top').fadeIn()
            } else {
                $('.back-to-top').fadeOut()
            }
        })
    },
    categories: function() {
        var listGroup = $('.list-group-item');
        listGroup.each(function() {
            var subMenu = $(this).find('.sub-categories');
            $(this).hover(function() {
                if (subMenu.is(':visible')) {
                    return false
                }
                $('.sub-categories').hide();
                $(this).find('.sub-categories').show()
            });
            $(this).mouseleave(function() {
                if (!subMenu.is(':visible')) {
                    return false
                }
                $(this).find('.sub-categories').hide()
            })
        })
    }*/

//     function loadmoreProducts(show,slug,manufacture) {
//             // show = $(this).data('show');
//     // $(this).attr('data-show', show+1);
//     // url = url.split(";");
//     // console.log(manufacture);
//     // url = url.replace(/\\/g,'');
//     // obj = JSON.parse(url);
//     // alert(show);
//     var data = { slug : slug,manufacture : manufacture, show : show };
//     console.log(data);
//     // console.log(obj.action);
//     $.ajax({
//         url: '/frontend/productsListManufacture',
//         type:"POST",
//         datatype:'json',
//         data: data,
//         success:function(data){
//             split_ = data.split('***countProducts***');
//             console.log(split_[1]);
//             $("#removeshowmore_").remove();

//             if (parseInt(split_[1])>0) {
//                 $("#viewMoreProducts .countPro").text(split_[1]);
//             } else {
//                 // alert('het roi, xoa di');
//                 $("#viewMoreProducts .countPro").text(0);
//                 $("#viewMoreProducts").remove();
//             }
//             $('.row.homeproduct').append(split_[0]).fadeIn();
//             console.log(split_[1]);
//             // console.log(show);
//         }
//         ,error:function(request, error){
//             console.log(error);
//         }
//     });
// };



$(document).ready(function() {
    // filterProducts.expandFeature();
    filterProducts.checkProductFilter();
    // filterProducts.checkManufactures();
});