
/*=============================================================
    Authour URI: www.binarytheme.com
    License: Commons Attribution 3.0

    http://creativecommons.org/licenses/by/3.0/

    100% Free To use For Personal And Commercial Use.
    IN EXCHANGE JUST GIVE US CREDITS AND TELL YOUR FRIENDS ABOUT US
   
    ========================================================  */

(function ($) {
    "use strict";
    var mainApp = {
       
        reviews_fun:function()
        {
            ($)(function () {
                $('#carousel-example').carousel({
                    interval: 3000 //TIME IN MILLI SECONDS
                });
            });

        },
     
        custom_fun:function()
        {


            /*====================================
             WRITE YOUR   SCRIPTS  BELOW
            ======================================*/
            
            highlight_active_link();
            setup_ftp_info();
            setup_copy_buttons();




        },

    }
   
   
    $(document).ready(function () {
        mainApp.reviews_fun();
        mainApp.custom_fun();

    });

    function highlight_active_link() {
        const uri = location.href.split(location.host)[1];

        $('a', '.nav')
            .filter(function () {
                const link = this.href.split(location.host)[1];
                
                return link === uri
            })
            .addClass('active-menu-item');
    }

    function setup_ftp_info() {
        const domain = $('#domain', '.ftp-info'), password = $('#password', '.ftp-info'), toggleBtn = $('#togglePassword', '.ftp-info');

        $(domain).val(location.host || 'localhost');
        
        $(toggleBtn).click(function () {
            const current = $(password).attr('type');

            $(password).attr('type', current === 'text' ? 'password' : 'text');
        });
    }

    function setup_copy_buttons() {
        const buttons = $('.copy');

        $(buttons).click(function () {
            const field = $(this).parents('.input-group').find('input');

            navigator.clipboard.writeText($(field).val());

            $(this).find('i.fa').toggleClass('fa-clipboard').toggleClass('fa-check');

            setTimeout(() => $(this).find('i.fa').toggleClass('fa-clipboard').toggleClass('fa-check'), 800);
        });
    }
}(jQuery));


