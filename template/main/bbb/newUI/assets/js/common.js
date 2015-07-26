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




    //download script
    //jQuery('.s_download').on("click", function(e) {
    //    var semail = jQuery("#itzurkarthi_email").val();
    //    if(semail == '')
    //    {
    //        alert('Enter Email');
    //        return false;
    //    }
    //    var str = "sub_email="+semail
    //    jQuery.ajax({
    //        type: "POST",
    //        url: "download.php",
    //        data: str,
    //        cache: false,
    //        success: function(htmld){
    //            jQuery('#down_update').html(htmld);
    //        }
    //    });
    //});

    $('.zh-learn-div').hover(function(){
        $(this).css({'-moz-box-shadow':'0px 0px 20px #ABABAB', '-webkit-box-shadow':'0px 0px 20px #ABABAB', 'box-shadow':'0px 0px 20px #ABABAB'});
    }, function() {
        $(this).css({'-moz-box-shadow':'0px 0px 4px #D3D1D1', '-webkit-box-shadow':'0px 0px 4px #D3D1D1', 'box-shadow':'0px 0px 4px #D3D1D1'});
    });

    $('.zh-learn-view').hover(function(){
        $(this).css({'-moz-box-shadow':'0px 5px 20px rgb(0, 134, 223)', '-webkit-box-shadow':'0px 5px 20px rgb(0, 134, 223)', 'box-shadow':'0px 5px 20px rgb(0, 134, 223)', 'background-color': 'rgb(0, 134, 223)'});
    }, function() {
        $(this).css({'-moz-box-shadow':'0px 0px 10px #A2DDF8', '-webkit-box-shadow':'0px 0px 10px #A2DDF8', 'box-shadow':'0px 0px 10px #A2DDF8', 'background-color':'#71B9D1'});
    });


    $('.zh-thumbnail').hover(function(){
        $(this).css({'-moz-box-shadow':'0px 0px 20px #ABABAB', '-webkit-box-shadow':'0px 0px 20px #ABABAB', 'box-shadow':'0px 0px 20px #ABABAB'});
        $(this).find('.zh-material-img').css('height', '170px');
    }, function() {
        $(this).css({'-moz-box-shadow':'0px 0px 4px #D3D1D1', '-webkit-box-shadow':'0px 0px 4px #D3D1D1', 'box-shadow':'0px 0px 4px #D3D1D1'});
        $(this).find('.zh-material-img').css('height', '160px');
    });




    //
    //$.fn.hoverDelay = function(options){
    //    var defaults = {
    //        hoverDuring: 200,
    //        outDuring: 200,
    //        hoverEvent: function(){
    //            $.noop();
    //        },
    //        outEvent: function(){
    //            $.noop();
    //        }
    //    };
    //    var sets = $.extend(defaults,options || {});
    //    var hoverTimer, outTimer;
    //    return $(this).each(function(){
    //        $(this).hover(function(){
    //            clearTimeout(outTimer);
    //            hoverTimer = setTimeout(sets.hoverEvent, sets.hoverDuring);
    //        },function(){
    //            clearTimeout(hoverTimer);
    //            outTimer = setTimeout(sets.outEvent, sets.outDuring);
    //        });
    //    });
    //}


   //$(".zh-learn-div").hoverDelay({
   //     hoverEvent: function(){
   //        $(this).css({'-moz-box-shadow':'1px 0px 20px #ABABAB', '-webkit-box-shadow':'1px 0px 20px #ABABAB', 'box-shadow':'1px 0px 20px #ABABAB'});
   //     },
   //     outEvent: function(){
   //         $(this).css({'-moz-box-shadow':'1px 0px 4px #E7E7E7', '-webkit-box-shadow':'1px 0px 4px #E7E7E7', 'box-shadow':'1px 0px 4px #E7E7E7'});
   //     }
   //});

});