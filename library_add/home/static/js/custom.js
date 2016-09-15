jQuery(document).ready(function () {

    //carousel
    function _carousel(){
        $('.jcarousel').jcarouselAutoscroll({
            autostart: true
        });
    }

    //scroll
    function list_scroll(){
        $('.description-scroll').tinyscrollbar();
    }

    //topmenu
    $('.header .mainhead .topmenu >li').hover(
      function() {
        //$('.header .mainhead .topmenu >li.active').addClass("noline");
        $(this).addClass("open");
      }, function() {
        //$('.header .mainhead .topmenu >li.active').removeClass("noline");
        $(this).removeClass("open");
      }
    );
    $('.topmenu .menu-dropdown .sub-menu .sub-menu-2 >li').hover(
      function() {
        $(this).parents('.sub-menu-2').children().removeClass("active");
        $(this).addClass("active");
      }
    );

    //show box
    // $('.orders-page .order-item-view').click(function() {
    //     if (!$(this).hasClass('open')){
    //         $(this).addClass('open');
    //         $(this).parents('tr').addClass('open');
    //         $(this).parents('tr').next().addClass('open');
    //         $(this).text(lang.button_hide_detail)
    //     }
    //     else{
    //         $(this).removeClass('open');
    //         $(this).parents('tr').removeClass('open');
    //         $(this).parents('tr').next().removeClass('open');
    //         $(this).text(lang.button_show_detail);
    //     }
    // });

    //show add new address
    $('.add-new-addr-btn').click(function() {
        if (!$(this).hasClass('open')){
            $(this).addClass('open');
            $('.add-new-addr-box').addClass('open');
        }
        else{
            $(this).removeClass('open');
            $('.add-new-addr-box').removeClass('open');
        }
    });

    //show edit new address
    $('.edit-addr-btn').click(function() {
        if (!$(this).hasClass('open')){
            $(this).addClass('open');
            $(this).parents('tr').next().addClass('open');
        }
        else{
            $(this).removeClass('open');
            $(this).parents('tr').next().removeClass('open');
        }
    });

    //account-page (show box) 
    $('.account-page .t-btn').click(function() {
        $(this).addClass('open');
        $(this).next().addClass('open');
        $(this).parents('.ac-box').addClass('open');
    });
    $('.account-page .ac-box .cancel').click(function() {
        $(this).parents('.frm-box').prev().removeClass('open');
        $(this).parents('.ac-box').removeClass('open');
        $(this).parents('.frm-box').removeClass('open');
    });

    //shopping cart login
    $('.shopping-cart-page .sc-login-btn').click(function() {
        if ($(this).next().is(":hidden")){
            $(this).next("").slideDown(200);
        }
        else{
            $(this).next("").slideUp(200);
        }
    });

    //load
    _carousel();
    list_scroll();
    //sc_width_login_box();

    $('.scroll-related-product').click(function() {
        $('html, body').animate({
            scrollTop: $("#related-product").offset().top
        }, 2000);
    });

    $(window).on("load", function() {
        //filter block 
        if ($('.filter-block').length > 0) {
            var filter_block_height = $('.filter-block').position().top;
            var max = $('.step-shipping').offset().top - 600;

        }

        if ($('.right-detail-info #current-product').length > 0) {
            var top_sale_height = $('.right-detail-info #current-product').offset().top;
            var max2 = $('.container > .detail-tabs').offset().top - $('.right-detail-info #current-product').height();

        }

        if ($('.filter-block').length > 0 || $('.right-detail-info #current-product').length > 0) {
            $(window).scroll(function() {
                var height = $(window).scrollTop();
                //filter search
                if ($('.filter-block').length > 0) {
                    if(height  > filter_block_height && height < max) {
                        $('.filter-block').addClass('fix-filter');
                        $('.filter-block').css({width: $('.container').width()});
                    }  else {
                        $('.filter-block').removeClass('fix-filter');
                        $('.filter-block').css({width: 'auto'});

                    }
                }

                //top sale
                if ($('.right-detail-info #current-product').length > 0) {
                    if (height <= top_sale_height) {
                        $('.right-detail-info #current-product').css({
                            position: 'static',
                            top: 'auto'
                        });
                    }
                    
                    if(height  > top_sale_height) {
                        $('.right-detail-info #current-product').css({
                            position: 'fixed',
                            top: 0
                        });
                    } 

                    if (height >= max2) {
                        $('.right-detail-info #current-product').css({
                            position: 'absolute',
                            top: max2 + 'px'
                        });
                    }
                }
            });
        }
    });
    
    $(document).on('click', '.shopping-cart:not(.has-item) .cart-shopping-box', function(event) {
        $('#cart-empty-modal').dialog('open');
        event.preventDefault();
    })

    $( "#cart-empty-modal" ).dialog({
      autoOpen: false,
      resizable: false,
      modal: true,
      width: 720,
      open: function(){
          $('.ui-widget-overlay').bind('click',function(){
              $('#cart-empty-modal').dialog('close');
          })
      },
      create: function (event, ui) {
          $(".ui-widget-header").hide();
      },
    });
});
