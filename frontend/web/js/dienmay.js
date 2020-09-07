function $readyMenu() {
    function n(n) {
        var u = $(this),
            i = null,
            r = [],
            f = null,
            e = null,
            t = $.extend({
                rowSelector: "> li",
                submenuSelector: "*",
                submenuDirection: "right",
                tolerance: 75,
                enter: $.noop,
                exit: $.noop,
                activate: $.noop,
                deactivate: $.noop,
                exitMenu: $.noop
            }, n),
            h = 3,
            c = 300,
            l = function(n) {
                r.push({
                    x: n.pageX,
                    y: n.pageY
                });
                r.length > h && r.shift()
            },
            a = function() {
                e && clearTimeout(e);
                t.exitMenu(this) && (i && t.deactivate(i), i = null)
            },
            v = function() {
                e && clearTimeout(e);
                t.enter(this);
                s(this)
            },
            y = function() {
                t.exit(this)
            },
            p = function() {
                o(this)
            },
            o = function(n) {
                n != i && (i && t.deactivate(i), t.activate(n), i = n)
            },
            s = function(n) {
                var t = w();
                t ? e = setTimeout(function() {
                    s(n)
                }, t) : o(n)
            },
            w = function() {
                function a(n, t) {
                    return (t.y - n.y) / (t.x - n.x)
                }
                var s, h;
                if (!i || !$(i).is(t.submenuSelector)) return 0;
                var n = u.offset(),
                    v = {
                        x: n.left,
                        y: n.top - t.tolerance
                    },
                    p = {
                        x: n.left + u.outerWidth(),
                        y: v.y
                    },
                    y = {
                        x: n.left,
                        y: n.top + u.outerHeight() + t.tolerance
                    },
                    l = {
                        x: n.left + u.outerWidth(),
                        y: y.y
                    },
                    o = r[r.length - 1],
                    e = r[0];
                if (!o || (e || (e = o), e.x < n.left || e.x > l.x || e.y < n.top || e.y > l.y) || f && o.x == f.x && o.y == f.y) return 0;
                s = p;
                h = l;
                t.submenuDirection == "left" ? (s = y, h = v) : t.submenuDirection == "below" ? (s = l, h = y) : t.submenuDirection == "above" && (s = v, h = p);
                var w = a(o, s),
                    b = a(o, h),
                    k = a(e, s),
                    d = a(e, h);
                return w < k && b > d ? (f = o, c) : (f = null, 0)
            };
        u.mouseleave(a).find(t.rowSelector).mouseenter(v).mouseleave(y).click(p);
        $(document).mousemove(l)
    }
    $.fn.menuAim = function(t) {
        return this.each(function() {
            n.call(this, t)
        }), this
    }
}

function wait$() {
    if (typeof $ == "undefined") {
        setTimeout(wait$, 10);
        return
    }
    globalEvent.emit("jqready")
}

function $ready() {
    $.ajaxSetup({
        cache: !1
    });
    $.ajaxPrefilter(function(n, t) {
        var i = getUrlParam("clearcache");
        if (i != null && i != "") switch (typeof t.data) {
            case "undefined":
                n.data = "clearcache=" + i;
                break;
            case "string":
                n.data = t.data + "&clearcache=" + i;
                break;
            default:
                n.data = $.param($.extend(t.data, {
                    clearcache: i
                }))
        }
    });
    $("#tomobile").attr("href", location.pathname + (location.search === "" ? "?view=mobile" : location.search + "&view=mobile"));
    provincesBox();
    corebrain();
    cookieADR();
    $("#main-search").submit(function(n) {
        typeof IsSearchAccessories == "undefined" && (n.preventDefault(), typeof AutoComplete != "undefined" && AutoComplete.prototype.goToSearchPage($("#skw").val()))
    });
    $(window).load(function() {
        initMenu();
        viewedproduct();
        var n = 5e3,
            t = $(location).attr("pathname");
        ["/tag/tivi", "/tag/may-giat", "/tag/tivi-samsung", "/tag/may-giat-samsung", "/tag/noi-com", "/tag/noi-com-sunhouse", "/tag/binh-giu-nhiet", "/tag/may-say-toc", "/tag/bep-gas", "/tag/noi-com-dien", "/tag/lo-vi-song", "/tag/tivi-sony", "/tag/may-loc-nuoc", "/tivi", "/gia-dung"].indexOf(t) >= 0 && (n = 0);
        setTimeout(function() {
            (function(n, t, i, r, u) {
                n[r] = n[r] || [];
                n[r].push({
                    "gtm.start": (new Date).getTime(),
                    event: "gtm.js"
                });
                var e = t.getElementsByTagName(i)[0],
                    f = t.createElement(i),
                    o = r != "dataLayer" ? "&l=" + r : "";
                f.async = !0;
                f.src = "https://www.googletagmanager.com/gtm.js?id=" + u + o;
                e.parentNode.insertBefore(f, e)
            })(window, document, "script", "dataLayer", "GTM-TSZQM9")
        }, n)
    });
    goTopdmx();
    $("#skw").on("click", function() {
        $(".menu").hasClass("actmenu") && $(".menu").click();
        getAutocomplete();
        $(this).val() != "" ? $("#skw").trigger("keyup") : searching || ($("#search-result").html(""), $("#main-search .viewedproduct-suggest").remove(), $.get("/webapi/suggestviewedproduct", {}, function(n) {
            $("#search-result ul li").length || ($("#main-search").append("<div class='viewedproduct-suggest autocomplete'>" + n + "<\/div>"), $(".viewed a").click(function() {
                $.get("/aj/homev4/removeviewhistory", {}, function() {
                    $(".viewedproduct-suggest").remove()
                })
            }))
        }))
    });
    $(document).click(function(n) {
        var t = $("#search-result,header .topinput");
        t.is(n.target) || t.has(n.target).length !== 0 || $(".suggest").hide()
    });
    $(".wraphead a.kinhnghiemhay").hover(function() {
        $(".wraphead .hover-box").show();
        $(".wraphead a.kinhnghiemhay span > label.arr-down").addClass("up")
    }, function() {
        $(".wraphead .hover-box").hover(function() {
            $(".wraphead a.kinhnghiemhay span > label.arr-down").addClass("up")
        }, function() {
            $(".wraphead a.kinhnghiemhay span > label.arr-down").removeClass("up")
        });
        $(".wraphead .hover-box").hide();
        $(".wraphead a.kinhnghiemhay span > label.arr-down").removeClass("up")
    });
    window.location.href.indexOf("kinh-nghiem-hay") > -1 ? $(".wraphead .hover-box > a.item-hb.knh").addClass("active") : window.location.href.indexOf("/khuyen-mai") > -1 && $(".wraphead .hover-box > a.item-hb.km").addClass("active")
}

function showmorefootlink(n) {
    $(n).parents(".colfoot").find(".hidden").show();
    $(n).parents(".colfoot").find(".hidden").removeClass("hidden");
    $(n).parent().remove()
}

function goTopdmx() {
    $("#gb-top-page").length && ($("#gb-top-page").hide(), $(window).scroll(function() {
        $(this).scrollTop() > 100 ? $("#gb-top-page").fadeIn() : $("#gb-top-page").fadeOut()
    }), $("#gb-top-page").click(function() {
        return $("body,html").animate({
            scrollTop: 0
        }, 800), !1
    }))
}

function slugify(n) {
    return n.toLowerCase().replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a").replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e").replace(/ì|í|ị|ỉ|ĩ/g, "i").replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o").replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u").replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y").replace(/đ/g, "d").replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "-").replace(/\s+/g, "-").replace(/[^\w\-]+/g, "").replace(/\-\-+/g, "-").replace(/^-+/, "").replace(/-+$/, "")
}

function suggestSearch(n) {
    var i, t, r;
    if (n.preventDefault(), i = "#search-result", t = $("#skw").val().replace(/\./g, " "), t = t.replace(/:|;|!|@@|#|\$|%|\^|&|\*|'|"|>|<|,|\.|\?|`|~|\+|=|_|\(|\)|{|}|\[|\]|\\|\|/gi, ""), r = t.trim().toLowerCase(), r.length < MIN_SSKEYWORD_LENGTH) {
        $(i).html("");
        return
    }
    if (n.which == 40 || n.which == 38) {
        UpDownSuggest(n.which);
        return
    }
    if (n.which == 13) {
        if ($("#search-result ul.suggest li.selected").length > 0) {
            location.href = $("#search-result ul.suggest li.selected a").attr("href");
            return
        }
    } else n.type == "submit" ? goToSearchPage(t) : typeof IsSearchAccessories == "undefined" && location.href.indexOf("may-doi-tra") < 0 && (searching || (clearTimeout(timmer), timmer = setTimeout(function() {
        callSuggestSearch(n)
    }, 600)))
}

function callSuggestSearch(n) {
    var i, r, t;
    if (!searching) {
        if (n.preventDefault(), searching = !0, i = $("#skw").val().replace(/\./gi, " "), i = i.replace(/:|;|!|@@|#|\$|%|\^|&|\*|'|"|>|<|,|\.|\?|`|~|\+|=|_|\(|\)|{|}|\[|\]|\\|\|/gi, ""), r = i.trim().toLowerCase(), t = $("#search-result"), r.length < MIN_SSKEYWORD_LENGTH) {
            t.html("");
            searching = !1;
            return
        }
        r.length >= MIN_SSKEYWORD_LENGTH && $.get("/webapi/suggestsearch", {
            keywords: r,
            provinceId: document.provinceId,
            categoryId: "-1"
        }, function(n) {
            clearTimeout(timmer);
            $("#main-search .viewedproduct-suggest").remove();
            t.html(n);
            $(t).find("li").length > 0 ? t.show() : t.hide();
            searching = !1
        })
    }
}

function UpDownSuggest(n) {
    var t = "#search-result ul.suggest li:not(.ttitle)",
        i;
    n == 40 ? $(t + ".selected").length == 0 ? $(t + ":first").addClass("selected") : $(t).last().hasClass("selected") ? ($(t + ".selected").removeClass("selected"), $(t + ":first").addClass("selected")) : (i = $(t + ".selected").next(), i.hasClass("ttitle") && (i = i.next()), $(t + ".selected").removeClass("selected"), i.addClass("selected")) : n == 38 && ($(t + ".selected").length == 0 ? $(t + ":last").addClass("selected") : $(t).first().hasClass("selected") ? ($(t + ".selected").removeClass("selected"), $(t + ":last").addClass("selected")) : (i = $(t + ".selected").prev(), i.hasClass("ttitle") && (i = i.prev()), $(t + ".selected").removeClass("selected"), i.addClass("selected")));
    return
}

function getAutocomplete() {
    typeof AutoComplete == "undefined" ? include(document.cdn + "/Scripts/global/autocomplete" + document.minv + ".js", function() {
        globalEvent.emit("autocomplete")
    }) : globalEvent.emit("autocomplete")
}

function getUrlParam(n, t) {
    t || (t = window.location.href);
    n = n.replace(/[\[\]]/g, "\\$&");
    var r = new RegExp("[?&]" + n + "(=([^&#]*)|&|#|$)"),
        i = r.exec(t);
    return i ? i[2] ? decodeURIComponent(i[2].replace(/\+/g, " ")) : "" : null
}

function provincesBox() {
    var n = JSON.parse(monster.get("DMX_Personal"));
    $(".provinces-box .dd ul > li").on("click", function() {
        $.post("/aj/Common/ChangeProvince", {
            id: $(this).data("id"),
            url: location.href
        }, function(n) {
            history.replaceState(null, null, n);
            window.location.reload(!0)
        })
    });
    $(".provinces-box .dd .close").on("click", function() {
        $(".provinces-box .dd").hide();
        $(".pddefault").remove();
        n.IsDefault && $.post("/aj/Common/ChangeProvince", {
            id: document.provinceId
        })
    });
    $(".provinces-box > span").mouseenter(function() {
        $(".provinces-box .dd").removeAttr("style")
    });
    $(".provinces-box > span").on("click", function() {
        changeLocation();
        $("#lc_btn-change").hide()
    });
    $(".search-province").on("keyup", function() {
        _ = $(this);
        $(".provinces-box ul li").hide();
        $(".provinces-box ul li:icontains('" + _.val() + "')").show()
    });
    $.expr[":"].icontains = function(n, t, i) {
        return slugify($(n).text().toUpperCase()).match("^" + slugify(i[3].toUpperCase()))
    }
}

function corebrain() {
    var t, n, i;
    document.showCoreBrain != undefined && document.showCoreBrain && $("header .cart").length > 0 && monster.get("DMX_CBCart") != undefined && (t = monster.get("DMX_CBCart"), n = JSON.parse(t), n != null && Object.keys(n).length > 0 && (i = Object.keys(n.BasicData).length, $("#cbCount").text(i), i > 0 ? ($("header #cart-box").removeClass("hidecart"), $("header #main-search").removeClass("ncart"), $.get("/webapi/corebrain/get", {
        data: t,
        provinceId: document.provinceId
    }, function(n) {
        $(document.head).append(n["<Css>k__BackingField"]);
        $("#cart-box").append(n["<Html>k__BackingField"]);
        $(document.body).append(n["<Js>k__BackingField"]);
        monster.set("DMX_CBCart", n["<Json>k__BackingField"], 7)
    })) : ($("header #cart-box").addClass("hidecart"), $("header #main-search").addClass("ncart"))), $("#cart-box").hover(function() {
        $("#list-cart img[data-src]").each(function() {
            $(this).attr("src", $(this).attr("data-src")).removeAttr("data-src")
        })
    }))
}

function viewedproduct() {
    var n = "";
    n += '<div class="nopro">';
    n += "<img src='" + document.cdn + "/Content/images/2018/nopro.png' alt='Không có sản phẩm'>";
    n += "<span>Bạn chưa xem sản phẩm nào<\/span>";
    n += "<\/div>";
    $(".btnviewed").hover(function() {
        if ($("header .btnviewed").length > 0 && monster.get("utm_thegioididong_viewedproduct") != undefined) {
            var t = monster.get("utm_thegioididong_viewedproduct");
            t.length > 0 ? $(".viewedproduct").html() == undefined && $.get("/webapi/viewedproduct", function(n) {
                $(".btnviewed").append(n)
            }) : $("header .nopro").html() == undefined && $(".btnviewed").append(n)
        } else $("header .nopro").html() == undefined && $(".btnviewed").append(n)
    })
}

function showLoading() {
    $("#loading").show();
    $(document.body).css({
        overflow: "hidden"
    })
}

function hideLoading() {
    $("#loading").hide();
    $(document.body).css({
        overflow: "auto"
    })
}

function showstablestore(n, t) {
    t === 1 ? window.location.href = $("#divfstore_" + n).find("a").attr("href") : $("#divfstore_" + n).toggle()
}

function initMenu() {
    function n(n) {
        var t = $(n),
            i = t.data("submenu-id"),
            r = $("#" + i),
            u = $menu.outerHeight(),
            f = $menu.outerWidth();
        $(".mainmenu li").removeClass("active");
        t.addClass("active");
        r.css({
            display: "block"
        });
        t.find("a").addClass("maintainHover")
    }

    function i(n) {
        var t = $(n),
            i = t.data("submenu-id"),
            r = $("#" + i);
        r.css("display", "none");
        $(".mainmenu li").removeClass("active");
        t.find("a").removeClass("maintainHover")
    }
    if ($menu = $("#menu2017"), $menu.menuAim({
            activate: n,
            deactivate: i,
            exitMenu: function() {
                $(".subcate").css("display", "none");
                $(".mainmenu li").removeClass("active");
                $("a.maintainHover").removeClass("maintainHover")
            },
            enter: function(t) {
                $(".maintainHover").length == 0 && ($(".subcate").hide(), n(t))
            }
        }), typeof isHome == "undefined" || isHome == !1) {
        var t = !1;
        $(".mainmenu").hover(function() {
            $menu.show()
        }, function() {
            t || $menu.hide()
        })
    }
}

function cookieADR() {
    if (document.URL.indexOf("utm_source") != -1 && document.URL.indexOf("traffic_id") != -1) {
        var t = getParameterByName("utm_source", document.URL),
            n = getParameterByName("traffic_id", document.URL);
        t != null && t == "ecomobi" && n != null && n != "" && createCookie("ecomobi", n, 30)
    }
}

function getParameterByName(n, t) {
    t || (t = window.location.href);
    n = n.replace(/[\[\]]/g, "\\$&");
    var r = new RegExp("[?&]" + n + "(=([^&#]*)|&|#|$)"),
        i = r.exec(t);
    return i ? i[2] ? decodeURIComponent(i[2].replace(/\+/g, " ")) : "" : null
}

function FirstLoadPersonalize() {
    $.ajax({
        url: "/webapi/common/GetCurrentLocationId",
        type: "GET",
        cache: !1,
        beforeSend: function() {},
        success: function(n) {
            var t, i, u, r;
            n != "" && (t = JSON.parse(n), t.DistrictName != "" ? ($(".provinces-box >b").html("Giao tới :"), $(".provinces-box > span").first().html(t.FullLocation), $(".provinces-box > span").first().css("font-size", "9px")) : $(".provinces-box > span").first().html(t.provinceName), t.wardId != 0 ? $("#cookie_detail_shipping").text("Có địa chỉ giao hàng") : $("#cookie_detail_shipping").text("Không"), t.FullLocation != "" ? (t.DistrictType != "" ? ($("#lc_detail-dis").find("span").text(t.DistrictType + ": "), $("#lc_detail-dis").find("strong").text(t.DistrictName), $("#lc_detail").show(), $("#locationbox__showfull").hide()) : $("#lc_detail-dis").hide(), t.WardType != "" ? ($("#lc_detail-ward").find("span").text(t.WardType + ": "), $("#lc_detail-ward").find("strong").text(t.WardName)) : $("#lc_detail-ward").hide(), t.CustomerAddress != "" ? $("#lc_detail-address").find("strong").text(t.CustomerAddress) : $("#lc_detail-address").hide()) : ($("#lc_detail").hide(), $("#locationbox__showfull").show()), $("#boxprovProvince").text(t.provinceName), $("#hdLocationProvinceId").val(t.provinceId), $("#hdLocationDisId").val(t.districtId), $("#hdLocationWardId").val(t.wardId), $("#hdLocationAddress").val(t.CustomerAddress), $("#locationAddress").val(t.CustomerAddress), $("#lstDistrict").html(t.lstDistrict), t.lstWard != "" && ($("#lstWard").html(t.lstWard), $("#boxprovWard").removeClass("disabled")), i = parseInt($("#hdLocationDisId").val()), u = parseInt($("#hdLocationWardId").val()), i > 0 && (r = $("#location_listDistrict").find("a[data-dis=" + i + "]"), $(r).length > 0 && ($("#boxprovDistrict").text($(r).text()), locationChangeDistrict(t.provinceId, t.districtId, null, u))))
        },
        error: function(n) {
            console.log(n)
        }
    })
}

function LocaltionShowAll(n) {
    var t = $(n).next();
    $(".boxprov__listTT--scroll").not(t).hide();
    $(t).slideToggle()
}

function searchLocation(n) {
    var t = $(n).val();
    $(n).next(".flex").find("a").each(function(n, i) {
        var r = $(i).text(),
            u = /[\-\[\]{}()*+?.,\\\^$|#\s]/g,
            f = new RegExp(t.replace(u, "\\$&"), "gi"),
            e = new RegExp(slugify(t).replace(u, "\\$&"), "gi");
        r.search(f) !== -1 || slugify(r).search(f) !== -1 || slugify(r).search(e) !== -1 ? $(i).parent("li").show() : $(i).parent("li").hide()
    })
}

function locationChangeProvince(n, t) {
    if (n == parseInt($("#hdLocationProvinceId").val())) return $(t).closest(".boxprov__listTT--scroll").hide(), !1;
    $("#lc_detail-dis").hide();
    $("#lc_detail-ward").hide();
    $("#lc_detail-address").hide();
    $("#boxprovDistrict").text("Vui lòng chọn Quận/Huyện");
    $("#boxprovWard").text("Vui lòng chọn Phường/Xã");
    $("#boxprovWard").addClass("disabled");
    $("#lc_detail").is(":visible") && $("#lc_btn-changeLc").is(":visible") == !1 && locationChangeLocation();
    $.ajax({
        url: "/webapi/common/GetAllDistrictsByProvince",
        type: "GET",
        data: {
            provinceId: n
        },
        cache: !1,
        beforeSend: function() {
            $("#dlding").show()
        },
        success: function(i) {
            i != "" && ($("#boxprovProvince").text($("#location_listPro").find("a[data-value=" + n + "]").text()), $("#location_listDistrict").find(".flex").html(i), $(t).closest(".boxprov__listTT--scroll").hide(), $(".locationbox__showfull").hasClass("no-after") == !0 && $("#lc_btn-changeLc").is(":visible") == !1 && $("#location_listDistrict").find(".boxprov__listTT--scroll").slideDown(), $("#lc_btn-changeLc").is(":visible") == !0 && $("#lc_btn-changeLc").text() == "Chọn địa chỉ khác" && ($("#lc_btn-changeLc").html("<b>Chọn đầy đủ địa chỉ nhận hàng<\/b> để biết chính xác thời gian giao"), $("#lc_btn-changeLc").addClass("locationbox__showfull")), $(".errWard").hide(), $("#hdLocationProvinceId").val(n), $("#hdLocationDisId").val(0), $("#hdLocationWardId").val(0), $("#hdLocationAddress").val(""));
            $("#dlding").hide()
        },
        error: function(n) {
            console.log(n);
            $("#dlding").hide()
        }
    })
}

function locationChangeDistrict(n, t, i, r) {
    if (t == parseInt($("#hdLocationDisId").val()) && (typeof r == "undefined" || r <= 0)) return $(i).closest(".boxprov__listTT--scroll").hide(), !1;
    (typeof r == "undefined" || r <= 0) && $("#boxprovWard").text("Vui lòng chọn Phường/Xã");
    $.ajax({
        url: "/webapi/common/GetAllWardByDisId",
        type: "GET",
        data: {
            provinceId: n,
            districtId: t
        },
        cache: !1,
        beforeSend: function() {},
        success: function(u) {
            if (u != "" && ($("#boxprovDistrict").text($("#location_listDistrict").find("a[data-dis=" + t + "]").text()), $("#boxprovWard").removeClass("disabled"), $("#location_listWard").find(".flex").html(u), $(i).closest(".boxprov__listTT--scroll").hide(), (typeof r == "undefined" || r <= 0) && ($("#location_listWard").find(".boxprov__listTT--scroll").slideDown(), $("#hdLocationWardId").val(0)), $("#hdLocationProvinceId").val(n), $("#hdLocationDisId").val(t), $("#hdLocationAddress").val(""), $(".errWard").hide(), typeof r != "undefined" && r > 0)) {
                var f = $("#location_listWard").find("a[data-ward=" + r + "]");
                $(f).length > 0 && r > 0 && ($("#boxprovWard").text("Đang tải dữ liệu..."), $("#boxprovWard").removeClass("disabled"), $("#boxprovWard").text($(f).text()))
            }
            $("#dlding").hide()
        },
        error: function(n) {
            console.log(n);
            $("#dlding").hide()
        }
    })
}

function locationChangeWard(n) {
    if ($("#location_listWard").find(".boxprov__listTT--scroll").hide(), n == parseInt($("#hdLocationWardId").val())) return !1;
    $("#boxprovWard").text($("#location_listWard").find("a[data-ward=" + n + "]").text());
    $("#hdLocationWardId").val(n)
}

function locationShowFull() {
    $(".locationbox__area").show();
    $(".locationbox__showfull").css("color", "#000");
    $(".locationbox__showfull").addClass("no-after")
}

function locationConfirm() {
    var n = {
            Address: $("#locationAddress").val(),
            DistrictName: $("#boxprovDistrict").text(),
            ProvinceName: $("#boxprovProvince").text(),
            WardName: $("#boxprovWard").text(),
            ProvinceId: $("#hdLocationProvinceId").val(),
            DistrictId: $("#hdLocationDisId").val(),
            WardId: $("#hdLocationWardId").val()
        },
        t;
    if ($(".errWard").hide(), n.DistrictId > 0 && n.WardId <= 0) {
        $(".errWard").length ? $(".errWard").show() : $("#location_listWard").parent().append('<div class="errWard" style="color: #dd4b39;padding: 5px 0 0 2px;">Vui lòng chọn phường xã<\/div>');
        return
    }
    t = {
        ca: n,
        productId: 0,
        wardId: $("#hdLocationWardId").val(),
        wardLat: 0,
        wardLn: 0,
        isld: !0
    };
    $.ajax({
        url: "/aj/ProductV3/GetDeliveryTime",
        type: "POST",
        data: t,
        cache: !1,
        beforeSend: function() {
            $("#dlding").show()
        },
        success: function(n) {
            var t, r, i;
            n.mes != "" ? $(".errWard").length ? $(".errWard").show() : $("#location_listWard").parent().append('<div class="errWard" style="color: #dd4b39;padding: 5px 0 0 2px;">Vui lòng chọn phường xã<\/div>') : (t = window.location.href, t.indexOf("itm_source") > -1 && (t = removeParams("itm_source", t)), r = t.indexOf("?") > -1 ? "&" : "?", i = r + "itm_source=city", $("#hdLocationWardId").val() != "0" && (i = r + "itm_source=detail_location"), t = t.indexOf("#") > -1 ? t.substr(0, t.indexOf("#")) + i + t.substr(t.indexOf("#")) : t + i, n.isMB ? window.location.replace(t.replace("may-lanh", "dieu-hoa").replace("may-nuoc-nong", "binh-tam-nong-lanh")) : t.indexOf("quat-dieu-hoa") == -1 ? window.location.replace(t.replace("dieu-hoa", "may-lanh").replace("binh-tam-nong-lanh", "may-nuoc-nong")) : window.location.replace(t.replace("binh-tam-nong-lanh", "may-nuoc-nong")));
            $("#dlding").hide()
        },
        error: function(n) {
            console.log(n)
        }
    })
}

function removeParams(n) {
    for (var t = window.location.href.split("?")[0] + "?", f = decodeURIComponent(window.location.search.substring(1)), u = f.split("&"), i, r = 0; r < u.length; r++) i = u[r].split("="), i[0] != n && (t = t + i[0] + "=" + i[1] + "&");
    return t.substring(0, t.length - 1)
}

function skipLocation() {
    $("#lc_pop--sugg").hide();
    $(".locationbox__overlay").hide();
    $(".provinces-box").removeClass("showlocation");
    $("header").removeClass("showlocation");
    $(".wraphead").removeClass("showlocation")
}

function changeLocation() {
    $("#lc_pop--choose").is(":visible") ? ($("#lc_pop--choose").hide(), $(".locationbox").hide(), $(".locationbox__overlay").hide(), $(".scrolltolst").show(), $(".boxprov__listTT--scroll").hide(), $(".provinces-box").removeClass("active")) : ($("#lc_detail-dis").find("span").text() != "" && ($("#lc_detail").show(), $("#locationbox__showfull").hide()), $("#lc_pop--choose").show(), $(".locationbox__overlay").show(), $("#lc_pop--sugg").hide(), $(".provinces-box").removeClass("showlocation"), $("header").removeClass("showlocation"), $(".wraphead").removeClass("showlocation"), $(".locationbox__area").hide(), $(".scrolltolst").hide(), $(".locationbox").show(), $(".provinces-box").addClass("active"), $("#locationbox__showfull").removeClass("no-after").css("color", "#4A90E2"))
}

function locationChangeLocation() {
    $("#lc_detail").hide();
    $("#locationbox__showfull").show();
    locationShowFull()
}

function getCookieQuy(n) {
    var i, t;
    try {
        var r = n + "=",
            f = decodeURIComponent(document.cookie),
            u = f.split(";");
        for (i = 0; i < u.length; i++) {
            for (t = u[i]; t.charAt(0) == " ";) t = t.substring(1);
            if (t.indexOf(r) == 0) return t.substring(r.length, t.length)
        }
        return ""
    } catch (e) {
        return ""
    }
}

function getCookieBo(n) {
    var i = "; " + document.cookie,
        t = i.split("; " + n + "=");
    if (t.length == 2) return t.pop().split(";").shift()
}

function setCookieQuy(n, t, i) {
    var r = new Date,
        u;
    r.setTime(r.getTime() + i * 864e5);
    u = "expires=" + r.toUTCString();
    document.cookie = n + "=" + t + ";" + u + ";path=/"
}
var monster = {
        set: function(n, t, i, r, u) {
            var f = new Date,
                o = "",
                s = typeof t,
                e = "",
                h = "",
                c = location.host.replace("www", "").replace("beta", "").replace("staging", "");
            if (r = r || "/", i && (f.setTime(f.getTime() + i * 864e5), o = "; expires=" + f.toUTCString()), s === "object" && s !== "undefined") {
                if (!("JSON" in window)) throw "Bummer, your browser doesn't support JSON parsing.";
                e = encodeURIComponent(JSON.stringify({
                    v: t
                }))
            } else e = encodeURIComponent(t);
            u && (h = "; secure");
            document.cookie = n + "=" + e + o + "; path=" + r + "; domain=" + c + h
        },
        get: function(n) {
            for (var t, f = n + "=", e = document.cookie.split(";"), i = "", o = "", r = {}, u = 0; u < e.length; u++) {
                for (t = e[u]; t.charAt(0) == " ";) t = t.substring(1, t.length);
                if (t.indexOf(f) === 0) {
                    if (i = decodeURIComponent(t.substring(f.length, t.length)), o = i.substring(0, 1), o == "{") try {
                        if (r = JSON.parse(i), "v" in r) return r.v
                    } catch (s) {
                        return i
                    }
                    return i == "undefined" ? undefined : i
                }
            }
            return null
        },
        remove: function(n) {
            this.set(n, "", -1)
        },
        increment: function(n, t) {
            var i = this.get(n) || 0;
            this.set(n, parseInt(i, 10) + 1, t)
        },
        decrement: function(n, t) {
            var i = this.get(n) || 0;
            this.set(n, parseInt(i, 10) - 1, t)
        }
    },
    globalEvent, clear, timmer, MIN_SSKEYWORD_LENGTH, searching, createCookie;
smokesignals = {
    convert: function(n, t) {
        return t = {}, n.on = function(i, r) {
            return (t[i] = t[i] || []).push(r), n
        }, n.once = function(t, i) {
            function r() {
                i.apply(n.off(t, r), arguments)
            }
            r.h = i;
            return n.on(t, r)
        }, n.off = function(i, r) {
            for (var f = t[i], u = 0; r && f && f[u]; u++) f[u] != r && f[u].h != r || f.splice(u--, 1);
            return u || delete t[i], n
        }, n.emit = function(i) {
            for (var r = t[i], u = 0; r && r[u];) r[u++].apply(n, r.slice.call(arguments, 1));
            return n
        }, n
    }
};
include = function() {
    function e() {
        var n = this.readyState;
        (!n || /ded|te/.test(n)) && (t--, !t && f && u())
    }
    var n = arguments,
        r = document,
        t = n.length,
        u = n[t - 1],
        f = u.call,
        i;
    for (f && t--, i = 0; i < t; i++) n = r.createElement("script"), n.src = arguments[i], n.async = !0, n.onload = n.onerror = n.onreadystatechange = e, (r.head || r.getElementsByTagName("head")[0]).appendChild(n)
};
globalEvent = {};
smokesignals.convert(globalEvent);
globalEvent.on("jqready", $readyMenu);
(document.cookie.match(/DMX_CBCart/g) || []).length > 1 && (clear = "DMX_CBCart=; expires=Fri, 31 Dec 1999 23:59:59 GMT;", document.cookie = clear, document.cookie = clear + " domain=." + location.host + ";");
document.cdn == undefined && (document.cdn = "");
document.minv == undefined && (document.minv = ""),
    function() {
        document.addEventListener("DOMContentLoaded", function() {
            var n, t, i;
            if (document.getElementsByClassName || (document.getElementsByClassName = function(n) {
                    for (var r = document.getElementsByTagName("a"), t = [], u = 0, i; i = r[u++];) i.className == n ? t[t.length] = i : null;
                    return t
                }), n = document.getElementsByClassName("dmca-badge"), n.length > 0 && n[0].getAttribute("href").indexOf("refurl") < 0)
                for (t = 0; t < n.length; t++) i = n[t], i.href = i.href + (i.href.indexOf("?") === -1 ? "?" : "&") + "refurl=" + document.location
        }, !1)
    }();
globalEvent.on("jqready", $ready);
wait$();
MIN_SSKEYWORD_LENGTH = 3;
searching = !1;
slugify = function(n) {
    return n.toLowerCase().replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a").replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e").replace(/ì|í|ị|ỉ|ĩ/g, "i").replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o").replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u").replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y").replace(/đ/g, "d").replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "-").replace(/\s+/g, "-").replace(/[^\w\-]+/g, "").replace(/\-\-+/g, "-").replace(/^-+/, "").replace(/-+$/, "")
};
goToSearchPage = function(n) {
    var r, t = slugify(n),
        u = n.replace(/\./g, " "),
        f = u.replace(/:|;|!|@@|#|\$|%|\^|&|\*|'|"|>|<|,|\.|\?|`|~|\+|=|_|\(|\)|{|}|\[|\]|\\|\|/gi, ""),
        e = f.trim(),
        i = encodeURIComponent(e).replace(/%20/gi, "+").replace(/ /g, "+");
    r = location.href.indexOf(".com/may-doi-tra") > 0 || location.href.indexOf("type=-2") > 0 ? "/tag/" + t + "?key=" + i + "&type=-2" : location.href.indexOf(".com/kinh-nghiem-hay") > 0 || location.href.indexOf("kinh-nghiem-hay") > 0 || location.href.indexOf("/khuyen-mai") > 0 ? "/tag-kinh-nghiem-hay/" + t + "?key=" + i : "/tag/" + t + "?key=" + i;
    location.href = r
};
createCookie = function(n, t, i) {
    var u, r;
    i ? (r = new Date, r.setTime(r.getTime() + i * 864e5), u = "; expires=" + r.toGMTString()) : u = "";
    document.cookie = n + "=" + t + u + "; path=/"
};
window.addEventListener("load", function() {
    var n, t, i;
    document.root == !0 ? (n = getCookieBo("DMX_showlocation"), (n == "" || typeof n == "undefined") && (n = getCookieQuy("DMX_showlocation")), (n == "" || typeof n == "undefined") && (setCookieQuy("DMX_showlocation", "1", 365), t = document.documentElement, i = (window.pageYOffset || t.scrollTop) - (t.clientTop || 0), i < 100 && ($("#lc_pop--sugg").show(), $(".locationbox").show(), setTimeout(() => {
        $("#lc_pop--choose").is(":visible") == !1 && skipLocation()
    }, 5e3))), FirstLoadPersonalize()) : $(".provinces-box").addClass("location")
}, !0);