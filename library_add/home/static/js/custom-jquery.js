$(document).ready(function(){
	$('ul.size li').click(function(e){
		select_size(this);
	});

	$('ul.color li').click(function(e){
		select_color(this);
	});

	$('.qty .l-btn').click(function(e){
		function_quantity_down(this);
		total_money_item();
	});

	$('.qty .r-btn').click(function(e){
		function_quantity_up(this);
		total_money_item();
	});
	total_money_item();
	active_menu();
	load_city_district('.receiver_city');
	$('.datepicker > div').css({'display':'none'});
	$('.datepicker').css({'padding':'0px'});
});
$('#birthday_account').datepicker({
    format: 'dd-mm-yyyy',
});
$('#birthday_register').datepicker({
    format: 'dd-mm-yyyy',
});
$('#birthday_account , #birthday_register').click(function(e){
	$('.datepicker').css({'position':'absolute','z-index':'5000','background':'#fff','border':'1px solid #e6e6e6'});
	$('.datepicker-days').css({'display':'block'});
});

$('.btn-hide-show-collap').click(function(e){
	var get_id_collapse = $(this).attr('data-collapse-id');
	var check_class = $('#order-content').find('tr.item_list_'+get_id_collapse).hasClass('open');
	if($(this).text() == 'Hiện'){
		$(this).text('Ẩn');
	}else{
		$(this).text('Hiện');
	}
	if(check_class == true){
		$('#order-content').find('tr.item_list_'+get_id_collapse).removeClass('open');
	}else{
		$('#order-content').find('tr.item_list_'+get_id_collapse).addClass('open');
	}
})

function active_menu(){
	var url      = window.location.href;     // Returns full URL
	$('.active-topmenu li>a').each(function(e){
		var get_link = $(this).attr('href');
		if(url == get_link){
			$(this).parents('li').addClass('active');
		}
	});
}

function select_size(hihi){
	var get_size_id = $(hihi).find('a').attr('data-size');
	$('ul.size li').removeClass('active');
	$('ul.size li').find('a[data-size='+get_size_id+']').parents('li').addClass('active');
	$('.add-to-cart').find('input[name=size_id]').val(get_size_id);
	/*Form mua nhanh*/
	$('#form-quick-buy .size').text(get_size_id);
	$('#form-quick-buy').find('input[name=size_id]').val(get_size_id);
}
function select_color(hihi){
	var get_color_id = $(hihi).find('a').attr('data-color');
	$('ul.color li').removeClass('active');
	$('ul.color li').find('a[data-color='+get_color_id+']').parents('li').addClass('active');
	$('.add-to-cart').find('input[name=color_id]').val(get_color_id);
	/*Form mua nhanh*/
	$('#form-quick-buy .color').css({'background':''+get_color_id+''});
	$('#form-quick-buy').find('input[name=color_id]').val(get_color_id);
}
function function_quantity_down(hihi){
	var get_qty = $('.qty').find('input[name=quantity]').val();
	get_qty = parseInt(get_qty);
	if(get_qty == 1){
		return false;
	}
	$('.qty').find('input[name=quantity]').val(get_qty-1);
}
function function_quantity_up(hihi){
	var get_qty = $('.qty').find('input[name=quantity]').val();
	get_qty = parseInt(get_qty);
	$('.qty').find('input[name=quantity]').val(get_qty+1);
}
function total_money_item(){
	var get_qty = $('.qty').find('input[name=quantity]').val();
	get_qty = parseInt(get_qty);
	var get_price = $('.price-product').val();
	get_price = parseInt(get_price);
	$('.total-buy span').empty().append('</span>'+number_format(get_qty*get_price,0,'.',',')+'</span><sup> đ</sup>');
}

function validateEmail(elementValue){        
   var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
   return emailPattern.test(elementValue);   
}

function validatePhone(elementValue){        
   var phonePattern = /^[\d\s]+$/;
   return (phonePattern.test(elementValue)) &&  Boolean(14 > elementValue.length);
}

$('.receiver_city').change(function(e){
    load_city_district(this);
});

function load_city_district(hihi){
    var parent_id = $(hihi).find('option:selected').val() ? $(hihi).find('option:selected').val() : 9999;
    $.ajax({
        url: '/home/home_index/get_city_district',
        type: 'post',
        dataType: 'json',
        data: {
            parent_id : parent_id,
        },
        success: function(data){
            var html = '<option value="">--Vui lòng chọn--</option>';
            $.each(data,function(key,value){
                html += '<option value='+value.id+'>'+value.name+'</option>';
            });
            $('select.receiver_district').empty().append(html);
        }
    });
}

$('.buying').click(function(e){
	var check_size = $('ul.size').find('li.active');
	var check_color = $('ul.color').find('li.active');
	if(check_size.length == 0){
		alert('Vui lòng chọn size cho sản phẩm');
		return false;
	}
	if(check_color.length == 0){
		alert('Vui lòng chọn màu sắc cho sản phẩm');
		return false;
	}
	$('.nine_background').addClass('background_modal');
	$('.nine_modal').addClass('ruu_modal');
});
$('.ruu-close-modal').click(function(e){
	$('.nine_background').removeClass('background_modal');
	$('.nine_modal').removeClass('ruu_modal');
})

$('.btn-order-product').click(function(e){
	add_orders('order_one');
});
$('.btn-order-product-multi').click(function(e){
	add_orders('order_multi');
})
function add_orders(type_order = ''){
    var receiver_name    = $('.receiver_name').val();
    var receiver_phone   = $('.receiver_phone').val();
    var receiver_email   = $('.receiver_email').val();
    var receiver_address = $('.receiver_address').val();
    var receiver_city    = $('.receiver_city').val();
    var receiver_district= $('.receiver_district').val();
    var receiver_note    = $('.receiver_note').val();
    var quantity         = $('input[name=quantity]').val();
    var color        	 = $('input[name=color_id]').val();
    var coupon        	 = $('input[name=coupon]').val() ? $('input[name=coupon]').val() : '';
    var size         	 = $('input[name=size_id]').val();
    var product_id       = $('input[name=product_id]').val();
    var flag = 0;
	if(receiver_name == '' || receiver_name === null){
		$('.receiver_name').closest(':has(em.message)').addClass('error');
    	$('.receiver_name').closest(':has(em.message)').find('em.message').html('Tên không được để trống');
    	flag = 1;
	}else{
		$('.receiver_name').closest(':has(em.message)').removeClass('error');
    	$('.receiver_name').closest(':has(em.message)').find('em.message').html('');
	}
	if(receiver_phone == '' || receiver_phone === null){
		$('.receiver_phone').closest(':has(em.message)').addClass('error');
    	$('.receiver_phone').closest(':has(em.message)').find('em.message').html('Số điện thoại không được để trống');
    	flag = 1;
	}else if(receiver_phone != '' && !validatePhone(receiver_phone)){
		$('.receiver_phone').closest(':has(em.message)').addClass('error');
    	$('.receiver_phone').closest(':has(em.message)').find('em.message').html('Số điện thoại không đúng định dạng');
    	flag = 1;
	}else{
		$('.receiver_phone').closest(':has(em.message)').removeClass('error');
    	$('.receiver_phone').closest(':has(em.message)').find('em.message').html('');
	}
	if(receiver_email != '' && !validateEmail(receiver_email)){
		$('.receiver_email').closest(':has(em.message)').addClass('error');
    	$('.receiver_email').closest(':has(em.message)').find('em.message').html('Email không đúng định dạng');
    	flag = 1;
	}else{
		$('.receiver_email').closest(':has(em.message)').removeClass('error');
    	$('.receiver_email').closest(':has(em.message)').find('em.message').html('');
	}
	if(receiver_address == '' || receiver_address === null){
		$('.receiver_address').closest(':has(em.message)').addClass('error');
    	$('.receiver_address').closest(':has(em.message)').find('em.message').html('Địa chỉ không được để trống');
    	flag = 1;
	}else{
		$('.receiver_address').closest(':has(em.message)').removeClass('error');
    	$('.receiver_address').closest(':has(em.message)').find('em.message').html('');
	}
	if(receiver_district == '' || receiver_district === null){
		$('.receiver_district').closest(':has(em.message)').addClass('error');
    	$('.receiver_district').closest(':has(em.message)').find('em.message').html('Yêu cầu chọn 1 vị trí');
    	flag = 1;
	}else{
		$('.receiver_district').closest(':has(em.message)').removeClass('error');
    	$('.receiver_district').closest(':has(em.message)').find('em.message').html('');
	}
	if(flag == 1){
		return false;
	}
    if(flag == 0 && type_order == 'order_one'){
    	$('body').append('<div class="background-spin"><span class="fa fa-spinner"></span></div>');
    	setTimeout(function(){
	    	$.ajax({
		        url: '/home/home_index/add_orders_fast',
		        type: 'post',
		        dataType: 'json',
		        data: {
		            receiver_name    : receiver_name,
		            receiver_phone   : receiver_phone,
		            receiver_email   : receiver_email,
		            receiver_address : receiver_address,
		            receiver_city    : receiver_city,
		            receiver_district: receiver_district,
		            quantity         : quantity,
		            color            : color,
		            coupon           : coupon,
		            size             : size,
		            product_id       : product_id,
		        },
		        success: function(data){
		            if(data.status == 'true'){
		            	$('div.background-spin').remove();
		            	$('.nine_background').removeClass('background_modal');
						$('.nine_modal').removeClass('ruu_modal');
		            	alert(data.message);
		            	window.location.href = '/dat-hang-thanh-cong';
		            }else{
		            	$('div.background-spin').remove();
		            	alert(data.message);
		            }
		        }
		    });
    	}, 1500);
    }else if(flag == 0 && type_order == 'order_multi'){
    	$('body').append('<div class="background-spin"><span class="fa fa-spinner"></span></div>');
    	setTimeout(function(){
	    	$.ajax({
		        url: '/home/home_index/add_orders_multi',
		        type: 'post',
		        dataType: 'json',
		        data: {
		            receiver_name    : receiver_name,
		            receiver_phone   : receiver_phone,
		            receiver_email   : receiver_email,
		            receiver_address : receiver_address,
		            receiver_city    : receiver_city,
		            receiver_district: receiver_district,
		            receiver_note    : receiver_note,
		            coupon           : coupon,
		        },
		        success: function(data){
		            if(data.status == 'true'){
		            	$('div.background-spin').remove();
		            	$('.nine_background').removeClass('background_modal');
						$('.nine_modal').removeClass('ruu_modal');
		            	window.location.href = '/dat-hang-thanh-cong';
		            }else{
		            	$('div.background-spin').remove();
		            	alert(data.message);
		            }
		        }
		    });
    	}, 1500);
    }
}

/*----------Add item cart---------*/
function addToCart(id_form){
	var op_pathname             = window.location.pathname; // Returns path only
	var op_url                  = window.location.href;     // Returns full URL
	var product_id              = $(id_form).find('input[name=product_id]').val();
	var name                    = $('.title-box').find('h1.title').text();name  = name.trim();
	var price                   = $('#product-price').val();
	var quantity                = $(id_form).find('input[name=quantity]').val();
	var op_color                = $(id_form).find('input[name=color_id]').val();
	var op_size                 = $(id_form).find('input[name=size_id]').val();
	var op_code                 = $('#code-product').text();op_code  = op_code.trim();
	var op_img                  = $('#current-product').find('p.pic img').attr('src');op_img = op_img.trim();
	var add_cart                = {};
	var add_option_cart         = {};
	add_option_cart['op_color'] = op_color;
	add_option_cart['op_size']  = op_size;
	add_option_cart['op_code']  = op_code;
	add_option_cart['op_img']   = op_img;
	add_option_cart['op_link']  = op_url;
	add_cart['id']              = product_id;
	add_cart['name']            = name;
	add_cart['price']           = price;
	add_cart['qty']             = quantity;
	add_cart['options']         = JSON.stringify(add_option_cart);
	var data_add_cart           = JSON.stringify(add_cart);
	if(op_size == ''){
		alert('Vui lòng chọn size cho sản phẩm');
		return false;
	}
	if(op_color == ''){
		alert('Vui lòng chọn màu cho sản phẩm');
		return false;
	}
	var cart = $('.cart-shopping-box');
    var imgtodrag = $('.left-detail-info').find('.carousel-stage').find('ul').find('li').find("img").eq(0);
    if (imgtodrag) {
        var imgclone = imgtodrag.clone()
            .offset({
            top: imgtodrag.offset().top,
            left: imgtodrag.offset().left
        })
            .css({
            'opacity': '0.5',
                'position': 'absolute',
                'height': '150px',
                'width': '150px',
                'z-index': '100'
        })
            .appendTo($('body'))
            .animate({
            'top': cart.offset().top + 20,
                'left': cart.offset().left + 45,
                'width': 75,
                'height': 75
        }, 1000, 'easeInOutExpo');

        imgclone.animate({
            'width': 0,
                'height': 0
        }, function () {
            $(this).detach()
        });
    }
	$.ajax({
		url: '/home/home_index/ajaxAdditemorders',
        type: 'post',
        dataType: 'json',
        data: {
            add_cart : data_add_cart
        },
        success: function(data){
            if(data.status == 'true'){
            	setTimeout(function(){
            		$('span.num-item').text(data.total_items);
            		if(data.total_items > 0){
            			var check_class = $('.shopping-cart-menu').hasClass('has-item');
            			$('.sum-price-box p.price').text(number_format(data.total_money,0,'.',',')+' đ');
            			if(check_class == false){
            				$('.shopping-cart-menu').addClass('has-item');
            			}
            			var html = '';
            			$.each(data.data,function(key,value){
            				html += '<li class="item_id" data-rowid="'+value.rowid+'">';
            					html += '<a class="close-btn-new remove" href="javascript:void(0)" title="'+value.name+'">';
            						html += '<i class="fa fa-remove"></i>';
            					html += '</a>';
            					html += '<p class="pic">';
            						html += '<a href="'+value.options.op_link+'">';
            							html += '<img src="'+value.options.op_img+'">';
            						html += '</a>';
            					html += '</p>';
            					html += '<div class="desc">';
            						html += '<p class="title">';
	            						html += '<a href="'+value.options.op_link+'">';
	            							html += ''+value.name+'';
	            						html += '</a>';
            						html += '</p>';
            						html += '<div class="p-row size">';
            							html += '<h3>Size</h3>';
            							html += '<span class="money">'+value.options.op_size+'</span>';
            						html += '</div>';
            						html += '<div class="p-row color">';
            							html += '<h3>Màu</h3>';
            							html += '<span class="color" style="background-color: '+value.options.op_color+'"></span>';
            						html += '</div>';
            						html += '<div class="p-row price">';
            							html += '<h3>Giá</h3>';
            							html += '<span class="money">'+number_format(value.price,0,'.',',')+'đ</span>';
            						html += '</div>';
            						html += '<div class="p-row amount">';
            							html += '<h3>Số lượng</h3>';
            							html += '<form action="#" method="post" class="update-cart">';
            								html += '<div class="add2cart-frm">';
	            								html += '<span class="qty-giohang">';
	            									html += '<button class="l-btn" type="button">-</button>';
	            									html += '<input type="text" name="quantity" value="'+value.qty+'" data-price="'+value.price+'" data-cartid="'+value.id+'" data-rowid="'+value.rowid+'" readonly="">';
	            									html += '<button class="r-btn" type="button">+</button>';
	            								html += '</span>';
	            								html += '<input type="hidden" name="size_id" value="'+value.options.op_size+'">';
	            								html += '<input type="hidden" name="color_id" value="'+value.options.op_color+'">';
	            							html += '</div>';
            							html += '</form>';
            						html += '</div>';
            					html += '</div>';
            				html += '</li>';
            			}); /*-End each-*/
            			$('ul.cart-item-list').empty().append(html);
            			$('.description-scroll').tinyscrollbar();	
            		}
				}, 1000);
             	
            }else{
            	alert(data.message);
            }
        }
	})
}

$('.cart-item-list , .box-item-giohang').on('click','.qty-giohang .r-btn',function(def){
	var get_qty_item = $(this).parents('.qty-giohang').find('input[name=quantity]').val();
	get_qty_item = parseInt(get_qty_item);
	$(this).parents('.qty-giohang').find('input[name=quantity]').val(get_qty_item+1);
	cartUpdateqtyitem(this);
})

$('.cart-item-list , .box-item-giohang').on('click','.qty-giohang .l-btn',function(def){
	var get_qty_item = $(this).parents('.qty-giohang').find('input[name=quantity]').val();
	get_qty_item = parseInt(get_qty_item);
	if(get_qty_item == 1){
		return false;
	}
	$(this).parents('.qty-giohang').find('input[name=quantity]').val(get_qty_item-1);
	cartUpdateqtyitem(this);
})

$('ul.cart-item-list').on('click','.close-btn-new',function(e){
	 cartRemoveitem(this);
});

$('.remove-item-btn').click(function(he){
	var get_rowid = $(this).parent('li').attr('data-rowid');
	$('#del-item-confirm').modal('show');
	$('#del-item-confirm').find('.modal-body').find('.item_id').attr('data-rowid',get_rowid);
});

function cartRemoveitem(hihi){
	var get_rowid = $(hihi).parents('li.item_id').attr('data-rowid');
	$.ajax({
		url: '/home/home_index/ajaxRemoveitemorders',
        type: 'post',
        dataType: 'json',
        data: {
            rowid : get_rowid
        },
        success: function(data){
            if(data.status == 'true'){
            	$('.description-scroll').tinyscrollbar();
            	$(hihi).parents('li.item_id').remove();
            	$('.box-item-giohang').find('li[data-rowid='+get_rowid+']').remove();
            	$('.sum-price-box p.price').text(number_format(data.total_money,0,'.',',')+' đ');
            	$('.ul-checkout-right').find('li[data-rowid='+get_rowid+']').remove();
            	$('.total-money-page').text(number_format(data.total_money,0,'.',','));
            	$('span.num-item').text(data.total_items);
            	$('#product_amout').text(data.total_items);
            	if(data.total_items == 0){
            		$('.shopping-cart-menu').removeClass('has-item');
            		var pathname      = window.location.pathname; // Returns path only
            		if(pathname == '/thong-tin-gio-hang'){
            			window.location.href = '/gio-hang-trong';
            		}
            	}
            }else{
            	alert(data.message);
            	return false;
            }
        }
	})
}

function cartRemoveitem_page(hihi){
	var get_rowid = $(hihi).parents('li.item_id').attr('data-rowid');
	$.ajax({
		url: '/home/home_index/ajaxRemoveitemorders',
        type: 'post',
        dataType: 'json',
        data: {
            rowid : get_rowid
        },
        success: function(data){
            if(data.status == 'true'){
            	$('.description-scroll').tinyscrollbar();
            	$('#del-item-confirm').modal('hide');
            	$('.cart-item-list').find('li[data-rowid='+get_rowid+']').remove();
            	$('.box-item-giohang').find('li[data-rowid='+get_rowid+']').remove();
            	$('.ul-checkout-right').find('li[data-rowid='+get_rowid+']').remove();
            	$('.total-money-page').text(number_format(data.total_money,0,'.',','));
            	$('span.num-item').text(data.total_items);
            	$('#product_amout').text(data.total_items);
            	if(data.total_items == 0){
            		$('.shopping-cart-menu').removeClass('has-item');
            		var pathname      = window.location.pathname; // Returns path only
            		if(pathname == '/thong-tin-gio-hang'){
            			window.location.href = '/gio-hang-trong';
            		}
            	}
            }else{
            	alert(data.message);
            	return false;
            }
        }
	});
}

function cartUpdateqtyitem(hihi){
	var get_rowid = $(hihi).parents('.qty-giohang').find('input[name=quantity]').attr('data-rowid');
	var get_qty   = $(hihi).parents('.qty-giohang').find('input[name=quantity]').val();
	$.ajax({
		url: '/home/home_index/ajaxUpdateitemorders',
        type: 'post',
        dataType: 'json',
        data: {
            rowid : get_rowid,
            qty   : get_qty
        },
        success: function(data){
        	console.log(data)
            if(data.status == 'true'){
            	$.each(data.data,function(key,value){
            		if(value.rowid == get_rowid){
            			$('.ul-checkout-right').find('li[data-rowid='+get_rowid+']').find('span.quantity').text(value.qty);
            			$('.qty-giohang').find('input[data-rowid='+get_rowid+']').val(value.qty);
            			$('.box-item-giohang').find('li[data-rowid='+get_rowid+']').find('.product-price-total').text(number_format(value.subtotal,0,'.',',')+'đ');
            		}
            	});
            	$('.shopping-cart-menu .sum-price-box p.price').text(number_format(data.total_money,0,'.',',')+'đ');
            	$('p.total-money-page').text(number_format(data.total_money,0,'.',',')+'đ');
            }else{
            	alert(data.message);
            	return false;
            }
        }
	});
}
// number_format(price_product,0,'.',',')
function number_format(number, decimals, dec_point, thousands_sep) {

    number = (number + '')
    .replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
        var k = Math.pow(10, prec);
        return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
      // Fix for IE parseFloat(0.55).toFixed(0) = 0;
      s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
      .split('.');
      if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
      }
      if ((s[1] || '')
        .length < prec) {
        s[1] = s[1] || '';
      s[1] += new Array(prec - s[1].length + 1)
      .join('0');
    }
    return s.join(dec);
}

