// Theme color settings
$(document).ready(function () {
    var getUrlBase = window.location;
    getUrlBase = getUrlBase.origin + "/backend/";
    // console.log(getUrlBase);
    function store(name, val) {
        if (typeof (Storage) !== "undefined") {
            localStorage.setItem(name, val);
        } else {
            window.alert('Please use a modern browser to properly view this template!');
        }
    }
    $("*[data-theme]").click(function (e) {
        e.preventDefault();
        var currentStyle = $(this).attr('data-theme');
        store('theme', currentStyle);
        $('#theme').attr({
            href: getUrlBase + 'css/colors/' + currentStyle + '.css'
        })
    });

    var currentTheme = get('theme');
    if (currentTheme) {
        $('#theme').attr({
            href: getUrlBase + 'css/colors/' + currentTheme + '.css'
        });
    }
    // color selector
    $('#themecolors').on('click', 'a', function () {
        $('#themecolors li a').removeClass('working');
        $(this).addClass('working')
    });

// });



// $(document).ready(function () {
    $("*[data-theme]").click(function (e) {
        e.preventDefault();
        var currentStyle = $(this).attr('data-theme');
        store('theme', currentStyle);
        $('#theme').attr({
            href: getUrlBase + 'css/colors/' + currentStyle + '.css'
        })
    });

    var currentTheme = get('theme');
        // console.log(currentStyle)
    if (currentTheme) {
        $('#theme').attr({
            href: getUrlBase + 'css/colors/' + currentTheme + '.css'
        });
    }
    // color selector
    $('#themecolors').on('click', 'a', function () {
        var working = $('#themecolors li a').removeClass('working');
        // console.log(working)
        $(this).addClass('working')
    });
});
function get(name) {

}