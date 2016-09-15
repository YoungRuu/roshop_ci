/**
 * @type {string}
 */
const CART_IS_EMPTY = lang.text_cart_empty;
const CART_IS_LOADING = lang.text_cart_loading;
const CART_LOAD_ERROR = lang.text_cart_loading_error;
const CART_CURRENCY = '$';
var fix_shipping_fee;
var autoUpdateCart;
var updateCartAjaxProcess;

function calcShipping() {
    $.ajax({
        url: '/index.php?route=checkout/cart/getCartShippingFee',
        data: {
            zone_id: $('input[name=shipping_zone_id]').val()
        },
        success: function(data) {
            $('.price-block .total').html(data.total_display);
            $('.price-block .shipping_fee').html(data.shipping_fee_display);
            $('#checkout_right_col .shipping_fee').html(data.shipping_fee_display);
            $('input[name=shipping_fee]').val(data.shipping_fee);
        }
    })
}

function update_cart(data) {
    if ($('ul.cart-product').length) {
        p_list = $('ul.cart-product');
    }

    if (data.cartCount) {
        $('.shopping-cart').addClass('has-item');
        $('.shopping-cart .cart-shopping-box .num').text(data.cartCount);
        $('.shopping-cart-page .sum .total').html(data.total_display);
        $('.shopping-cart .sum-price-box .price').html(data.total_display);
        $('ul.cart-product').attr('data-total', data.total);
        $('.shopping-cart .cart-shopping-dropdown .item-list-s2').css('height', '422px');
        $('.description-scroll').tinyscrollbar();
    } else {
        cart_empty();
    }

    if (data.delete) {
        $('ul.cart-product li.item_' + data.delete).remove();
    }
    else {
        if (data.id) {
            setTimeout(function () {
                p_list.each(function () {
                    if ($(this).hasClass('on-header')) {
                        $(this).html(data.html2);
                    } else {
                        $(this).html(data.html);
                    }
                });
            }, 2000);
        } else {
            p_list.each(function () {
                if ($(this).hasClass('on-header')) {
                    $(this).html(data.html2);
                } else {
                    $(this).html(data.html);
                }
            });
        }
    }

    if (data.hasOwnProperty("p")) {
        cartProduct(data.p);
    }

    calcShipping();
}

function currency_format(total , sub) {
	if (sub){
		return CURRENCY_SYMBOL_LEFT + numeral(total).format('0,0') + "<sup>" + CURRENCY_SYMBOL_RIGHT + "</sup>";
	} else {
		return CURRENCY_SYMBOL_LEFT + numeral(total).format('0,0') + CURRENCY_SYMBOL_RIGHT;
	}
    
}

function cart_empty() {
    $('.shopping-cart').removeClass('has-item');
    $('.shopping-cart .cart-shopping-dropdown .item-list-s2').css('height', '15px');
    $('.cart-shopping-dropdown .item-list-s2 .cart-item-list').html('<li class="text-center">'+lang.text_cart_empty+'</li>');
    if ($('.shopping-cart-page').length > 0) {
    	if ($('.shopping-cart-page').length > 0) {
	        document.location.href = '/index.php?route=checkout/cart/clear';
	    }
    	return;
    	try {
    		$('#cart-empty-poup').dialog('open');
    	}  catch (e){
    	}
    }
}

function cart_clear() {
    window.location.href = '/index.php?route=checkout/cart/clear';
}

jQuery(function ($) {
    $(document).on("click", "ul.cart-product a.remove", function (event) {
        event.preventDefault();
        var fav = $(event.target);
        try {
	        if (event.target.nodeName == "I"){
	        	fav = $(event.target).parent();
	        }
        } catch (e){}
        var loading = '<div class="loading msg"><div class="av"></div><div class="ct"><p>Loading...</p><p></p></div></div>';
        f_p = fav;
        $jq_loading = $(loading);
        f_p.after($jq_loading);
        var curRemove = $(this).data('cartid');
        $.ajax({
            url: fav.attr('href') + '&_=' + Date.now(), // '/index.php?route=checkout/cart/ajaxRemoveItem&_='
														// + Date.now(),
            cache: false,
            success: function (data) {
                if (data) {
                	$(".ul-checkout .checkout-cart-id-" + curRemove).remove();
                    update_cart(data);
                    updateCartCheckoutRight(data);
                    $jq_loading.remove();
                    show_ntf(lang.text_cart_item_has_been_deleted, 'success');
                } else {
                    $jq_loading.remove();
                }
            }
        });
    });

    $(document).on("click", "ul.products a.fav.ajax", function (event) {
        event.preventDefault();
        var fav = $(event.target);

        var loading = '<div class="loading msg"><div class="av"></div><div class="ct"><p>Loading...</p><p></p></div></div>';
        f_p = fav;
        $jq_loading = $(loading);
        f_p.after($jq_loading);
        $.ajax({
            url: fav.attr('href'),
            cache: false,
            success: function (data) {
                if (data == 0) // check login
                {

                }
                else {
                    $('#temp').html(data);
                }
                $jq_loading.remove();
            }
        });
    });

    /**
	 * Increase product quantity by press key-up
	 */
    $(document).on("keyup", ".qty input", function (event)
        // $('.qty input').keyup(function()
    {
        obj1 = $(event.target);
        check_quantity(obj1, 1)
        $('body').click(function (event) {
            check_quantity(obj1)
        });
        obj1.click(function (event) {
            event.stopPropagation();
        })
        obj1.parent().parent().find('button.button-cart').click(function (event) {
            event.stopPropagation();
        });

        f = obj1.closest("form");
        if (f.attr('id') == 'form-quick-buy') {
            quickBuyUpdateTotal();
        }
    });

    /**
	 * Increase product quantity by press key-up
	 */
    $(document).on("keyup", "form.update-cart .qty input", function (event)
        // $('form.updatecart-form .qty input').focus(function()
    {
        obj2 = $(event.target);
        update_cart_listen(obj2);
    });

    /**
	 * Increase product quantity by click button
	 */
    $(document).on("click", "form.updatecart-form .qty button", function (event)
        // $('form.updatecart-form .qty button').click(function()
    {
        obj3 = $(event.target).parent().find('input');
        oldval = obj3.val();

    });

    /**
	 * Add to cart action
	 */
    $(document).on("submit", "form.update-cart", function (event) {

        var domElement = $(event.target);
        event.preventDefault();

        f = domElement;
        qty = f.find('.qty input');
        var check = check_quantity(qty);
        if (check === true) {
            form_c = f.serializeArray();
            f_p = f.parent().parent();
            var loading = '<div class="loading msg"><div class="av"></div><div class="ct"><p>Loading...</p><p></p></div></div>';
            $jq_loading = $(loading);
            f_p.after($jq_loading);
            c = $.ajax({
                url: f.attr('action'),// f.attr('action'),
                type: f.attr('method'),
                data: form_c, // id, quantity
                // async: false,
                cache: false,
                success: function (data) {
                    if (data.error) {
                        // Xử lý lỗi
                        if (data.error == 1) {
                            inline_error(qty, data.msg);
                            $jq_loading.remove();
                        }
                        // Hết hàng
                        else {
                            $jq_loading.remove();
                            var msg_s = '<div class="error msg"><div class="av"></div><div class="ct">Hết Hàng</div></div>';
                            $jq_s = $(msg_s);
                            f_p.after($jq_s);
                            setTimeout(function () {
                                $jq_s.remove()
                            }, 2000);
                        }
                    }
                    // check thành công
                    else {
                        update_cart(data);
                        $('.product_' + data.id).addClass('incart');
                        $jq_loading.remove();
                        if (f.hasClass('update-cart') === false) {
                            var msg_s = '<div id="m-'+data.id+'" class="success msg"><div class="av"></div><div class="ct"><div class="icon"></div><p>' +
                                lang.text_cart_item_has_been_added + '</p></div></div>';
                        }
                        else {
                            var msg_s = '<div id="m-'+data.id+'" class="success msg"><div class="av"></div><div class="ct"><div class="icon"></div><p>' +
                                lang.text_cart_item_quantity_changed + '</p></div></div>';
                        }
                        $jq_s = $(msg_s);
                        f_p.after($jq_s);
                        setTimeout(function () {
                            $('#m-'+data.id).remove();
                        }, 2000);
                    }
                },
                error: function (xhr, status, error) {
                    var error_msg = '<div class="error msg"><div class="av"></div><div class="ct"><p>' +
                        lang.text_error_connection + '</p><p><button>' + lang.text_try_again +'</button></p></div></div>';
                    $jq_elem = $(error_msg);
                    f_p.after($jq_elem);
                    $jq_elem.find('button').click($jq_elem.remove());
                }

            });
            $jq_loading.click(function () {
                c.abort();
                $jq_loading.remove()
            })
        }
    });

    /**
	 * Load mini-cart's data after page was loaded
	 */
    $(document).ready(function () {
        if ($('.shopping-cart-page').length > 0) {
            return false;
        }
        $.ajax({
            url: '/index.php?route=checkout/cart/ajaxGetCartData&_=' + Date.now(),
            type: 'GET',
            dataType: "json",
            cache: false,
            success: function (data) {
                if (data.cartCount > 0) {
                    update_cart(data);
                    if (typeof(productID) != "undefined"){
	                    $.each (data.products , function(index, value){
	                    	if (value['product_id'] == productID){
	                    		$(".has-order-cart").show();
	                    	}
	                    })
                    }
                }
            }
        });
    });

    $(document).on("click", ".qty button", function (event)
    {
        var button = $(event.target);
        var obj = button.parent().find("input");
        var oldValue = obj.val();
        var orgVal = obj.attr('data-incart');
        // var price = obj.attr('data-price');
        // rm_inline_error(obj);
        check_quantity(obj);
        obj.trigger('keyup');

        if (button.text() == "+") {
            var newVal = parseFloat(oldValue) + 1;
        }
        else {
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
                inline_error(obj, lang.error_quantity_type)
            }

        }
        // alert('xxx');

        obj.val(newVal);
        if (orgVal) {
            // obj.trigger('focus');
            update_cart_listen(obj);
            try{
        		updateCartAjaxProcess.abort();
        	} catch(e){};
            try {
            	clearTimeout(autoUpdateCart);
            } catch (e){};
            autoUpdateCart = setTimeout(function(){
            	updateCartIntoDb(obj.attr('data-cart-id'));
            } , 1000);
        }

        f = obj.closest("form");
        if (f.attr('id') == 'form-quick-buy') {
            quickBuyUpdateTotal();
        }
    });
});
function updateCartCheckoutRight(data){
	var html  = '';
	$.each (data.products , function(index , value){
		html += '<li class="checkout-cart-id-' + value.cart_id + '">'
			 + '<span class="checkout-left-row">' + value.name +  ' x <span class="quantity">' + value.quantity + '</span></span>'
			 + '<span class="checkout-right-row">' + value.total_display + '</span></li>';
	});
	html += '<li class="clearfix"></li>';
	$('#checkout_right_col .price-block .ul-checkout').html(html);
	$('#checkout_right_col .price-block .total').text(data.total_display);
	
}
function updateCartIntoDb(cartID){
	var f = $("form.update-cart-id-" + cartID);
	qty = f.find('.qty input');
    var check = check_quantity(qty);
    if (check === true) {
        form_c = f.serializeArray();
        f_p = f.parent().parent();
        updateCartAjaxProcess = $.ajax({
            url: f.attr('action'),// f.attr('action'),
            type: f.attr('method'),
            data: form_c, // id, quantity
            // async: false,
            cache: false,
            success: function (data) {
                if (data.error) {
                    // Xử lý lỗi
                    if (data.error == 1) {
                        inline_error(qty, data.msg);
                    }
                    // Hết hàng
                    else {
                        
                    }
                }
                // check thành công
                else {
                    update_cart(data);
                    updateCartCheckoutRight(data);
                    $('.product_' + data.id).addClass('incart');
                }
            },
            error: function (xhr, status, error) {
                var error_msg = '<div class="error msg"><div class="av"></div><div class="ct"><p>' +
                    lang.text_error_connection + '</p><p><button>' + lang.text_try_again +'</button></p></div></div>';
                $jq_elem = $(error_msg);
                f_p.after($jq_elem);
                $jq_elem.find('button').click($jq_elem.remove());
            }

        });
    }
}

function update_cart_listen(obj) {
    oldval = parseFloat(obj.attr('data-incart'));
    s_price = parseFloat(obj.attr('data-price'));
    c_total = parseFloat($('ul.cart-product').attr('data-total'));
    cart_id = parseInt(obj.attr('data-cart-id'));
    // recalculate(c_total);

    newval = obj.val();
    if (newval != oldval && check_quantity(obj, 1) === true) {
        // obj.parent().parent().addClass('change');
        // obj.parentsUntil('.add2cart', '.updatecart-form').addClass('change');
        obj.parentsUntil('.info', '.col-md-12').find('span.product-price-total').text(
            currency_format(newval * s_price)
        );

        $('li.checkout-cart-id-' + cart_id).find('span.quantity').text(newval);
        $('.item_' + cart_id).find('input[name=quantity]').val(newval);
        // obj.parentsUntil('.viewport', '.item_' +
		// cart_id).find('input[name=quantity]').val(newval);
        $('li.checkout-cart-id-' + cart_id).find('span.checkout-right-row').text(currency_format(newval * s_price));
        recalculate(c_total - oldval * s_price + newval * s_price);
    }
    else {
        // obj.parent().parent().removeClass('change');
        obj.parentsUntil('.info', '.col-md-12').find('span.product-price-total').text(
            currency_format(oldval * s_price)
        );
        recalculate(c_total);
    }

    $(document).mousedown(function () {
        // obj.parent().parent().removeClass('change');
        obj.val(obj.attr('data-incart'));
        obj.parentsUntil('.info', '.desc').find('.price_tt span.n').text(
            currency_format(oldval * s_price)
        );
        recalculate();
    });

    obj.parentsUntil('.add2cart').mousedown(function (event) {
        event.stopPropagation();
    });

    obj.parentsUntil('.add2cart').find('button').addClass('1')
    $(document).mousedown(function (event) {
        event.stopPropagation();
    });
}

function recalculate(total, free_delivery) {
    if (!total) total = parseFloat($('ul.cart-product').attr('data-total'));
    if (!free_delivery) free_delivery = parseFloat($('ul.cart-product').attr('data-free-delivery'));

    $('.shopping-cart-page div.tips').show();
    if (free_delivery > 0 && parseFloat(total) >= parseFloat(free_delivery)) {
        $('.shopping-cart-page div.tips').html('Đơn hàng của bạn sẽ được miễn phí vận chuyển');
        $('.shopping-cart-page .sum .total').text(
            currency_format(parseFloat(total) )
        );
    }
    else {
        get_free = parseFloat(free_delivery) - parseFloat(total);
        if (free_delivery > 0) {
            $('.shopping-cart-page div.tips').html('Khách hàng cần đặt thêm <span class="n curr">' + currency_format(get_free) + '</span> nữa để được miễn phí vận chuyển');
        } else {
            $('.shopping-cart-page div.tips').hide();
        }

        $('.shopping-cart-page .sum .total').html(currency_format(parseFloat(total)));
    }
}