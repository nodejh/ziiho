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


    function getUrlVars() {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (var i = 0; i < hashes.length; i++) {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }

    function getUrlVar(name) {
        return getUrlVars()[name];
    }


    $('#company-list').hide();
    var urlVar = getUrlVar('ac');
    if(urlVar == 'company') {
        $('#company-list').show(300);
    }
    $('#company-url-'+urlVar).css('background-color', '#e7e7e7');
    $('.company-tab-hd.clearfix.o-cuser-infotitle li a').each(function() {
        $(this).click(function() {
           console.log($(this).text());
            var title = $(this).text();
            $('#company-center-title').text(title);
        });
    });



});