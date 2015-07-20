$(document).ready(function() {

    $("#com-header").cjslip({
        type: 'menu',
        effect: "slideDown",
        speed: 80,
        defaultShow: false,
        mainState: ".uinfo_101",
        mainEl: ".ui_box"
    });

    $('#dropdown-title').mouseover(function() {
        $('#dropdown-title').css('color', '#000');
    });

    $('#dropdown-title').mouseout(function() {
        $('#dropdown-title').css('color', '#fff');
    });

    $('#dropdow-title').blur(function() {
        $('#dropdown-title').css('color', '#fff');
    });

    $('#dropdow-menu a').hover(function() {
        $('#dropdown-title').css('color', '#000');
    });

    $('#dropdow-menu a').mouseout(function() {
        $('#dropdown-title').css('color', '#fff');
    });
    $('#dropdow-menu a').hover(function() {
        $('#dropdown-title').css('color', '#000');
    });

    $('#dropdow-menu a').mouseout(function() {
        $('#dropdown-title').css('color', '#fff');
    });


    $('.dropdown').mouseover(function() {
        $('.dropdown-toggle').css(
            {
                'color': '#000',
                'background-color': '#e7e7e7'
            }
        );
    });

    $('.dropdown').mouseout(function() {
        $('.dropdown-toggle').css(
            {
                'color': '#fff',
                'background-color': '#00C0FF'
            }
        );
    });

    $('.dropdown li').mouseover(function() {
        $('.dropdown-toggle').css(
            {
                'color': '#000',
                'background-color': '#e7e7e7'
            }
        );
    });

    $('.dropdown li').blur(function() {
        $('.dropdown-toggle').css(
            {
                'color': '#fff',
                'background-color': '#00C0FF'
            }
        );
    });
});