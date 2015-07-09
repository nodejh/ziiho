$(document).ready(function() {
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