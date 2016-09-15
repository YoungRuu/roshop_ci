$(document).ready(function(e){
	$('.keysearch_products').keyup(function(e){
		key_search(this);
	});
    load_city_district('.receiver_city');
});

function key_search(hihi){
	var get_keysearch = $(hihi).val();
	$.ajax({
        url: '/admin/admin_orders/searchproducts',
        type: 'POST',
        dataType:'json',
        data:{
            keysearch:get_keysearch
        },
        success: function (data) {
            var html = '';
            var html_img = '';
            var link_img = '';
            if(data == '' && get_keysearch.length > 1){
                html += '<div class="item-product-search-null">';
                html += '<p>Không tìm thấy kết quả nào</p>';
                html += '</div>';
            }else{
                $.each(data,function(key,value){
                    if(value.price_sell_new == '0'){var price_product = value.price_sell_old;}else{var price_product = value.price_sell_new;}
                    $.each(JSON.parse(value.list_image),function(key3,value3){
                        html_img = '<img src="/uploads/thumb/thumb75x60_'+value3+'" alt="Images products"> ';
                        link_img = value3;
                    });
                    html += '<div class="item-product-search" data-product-id='+value.id+' data-product-code='+value.code+' data-product-quantity='+value.quantity+' data-product-price='+price_product+' data-product-name="'+value.name+'" data-product-image="'+link_img+'" data-product-size="" data-product-color="">';
                    html += '<div class="box-left-search">';
                    html += html_img;
                    html += '</div>';
                    html += '<div class="box-right-search">';
                    html += '<p class="name-search">'+value.name+'</p>';
                    html += '<p class="code-search">Mã sản phẩm : '+value.code+'</p> ';
                    html += '<p>';
                        html += '<span> Màu sắc: ';
                        $.each(JSON.parse(value.color),function(key2,value2){
                            html += '<span class="color-search" style="background:'+value2+'" data-color="'+value2+'"></span>';
                        });
                        html += '</span>';
                        html += '<span> Size: ';
                        $.each(JSON.parse(value.size),function(key3,value3){
                            html += '<span class="size-search" data-size="'+value3+'">'+value3+'</span>';
                        });
                        html += '</span>';
                    html += '</p>';
                    html += '<p><span class="price-search">Giá : '+number_format(price_product,0,'.',',')+' VNĐ</span> - <span class="qty-search">Tồn kho : <span class="number-qty">'+number_format(value.quantity,0,'.',',')+'</span></span></p> ';
                    html += '</div>';
                    html += '<span class="tick-select-product"  onclick="add_list_product(this)" >Chọn</span>';
                    html += '<div class="clearfix"></div>';
                    html += '</div>';
                });
            }
            $('.full-box-product-search').empty().append(html);
            $('.full-box-product-search').css({'display':'block'}); 
            
        }
    });
}

$('.btn-add-orders').click(function(e){
    add_orders();
});

function add_orders(){
    var customer_id      = $('.customer_id').find('option:selected').val();
    var receiver_name    = $('.receiver_name').val();
    var receiver_phone   = $('.receiver_phone').val();
    var receiver_email   = $('.receiver_email').val();
    var receiver_address = $('.receiver_address').val();
    var receiver_city    = $('.receiver_city').find('option:selected').val();
    var receiver_district= $('.receiver_district').find('option:selected').val();
    var receiver_note    = $('.receiver_note').val();
    var receiver_coupon  = $('.receiver_coupon').val() ? $('.receiver_coupon').val() : '';

    if(receiver_name.trim().length < 1){
        alert('Yêu cầu nhập tên người nhận');
        return false;
    }
    if(receiver_phone.trim().length < 1){
        alert('Yêu cầu nhập số điện thoại người nhận');
        return false;
    }else if(receiver_phone.trim().length >= 1 && isNaN(receiver_phone.trim()) == true){
        alert('Số điện thoại người nhận phải là số');
        return false;
    }
    if(receiver_address.trim().length < 1){
        alert('Yêu cầu nhập địa chỉ người nhận');
        return false;
    }

    var list_product = '';
    var flag         = 0;
    var total_quantity = 0;
    $('.item-product-select').each(function(index) {
        var id       = $(this).attr('data-id');
        id = parseInt(id);
        var name     = $(this).attr('data-name');
        var price    = $(this).attr('data-price');
        var quantity = $(this).find('.quantity-product-select').val();
        quantity = parseInt(quantity);
        var get_color    = '';
        $(this).find('.color-product-select').each(function(index1){
            var check_active_color = $(this).hasClass('active-color');
            if(check_active_color == true){
                get_color    = $(this).attr('data-color');
            }
        });
        if(get_color == ''){
            alert('Yêu cầu chọn màu cho sản phẩm : '+name+' ');
            flag = 1;
            return flag;
        }

        var get_size     = '';
        $(this).find('.size-product-select').each(function(index2){
            var check_active_size = $(this).hasClass('active-size');
            if(check_active_size == true){
                get_size    = $(this).attr('data-size');
            }
        });
        if(get_size == ''){
            alert('Yêu cầu chọn size cho sản phẩm : '+name+' ');
            flag = 1;
            return flag;
        }

        price        = price != '' ? price : 0;
        price        = parseInt(price);
        list_product += '{"id":"'+id+'","price":"'+price+'","quantity":"'+quantity+'","color":"'+get_color+'" ,"size":"'+get_size+'"},';
        /*--Set lại chuỗi rỗng sau khi add vào list_product để không lưu lại của sản phẩm khác--*/
        /*End set*/
    });
    if(flag == 1){
        return false;
    }
    list_product   = list_product.substring(0, (list_product.length - 1));
    list_product   = '['+list_product+']';
    var count_product = 0 ;
    $.each($.parseJSON(list_product),function(key,value){
        count_product++;
        if(count_product == 0){
            count_product = 0
            return count_product;
        }
    });
    if(count_product == 0){
        alert('Đơn đặt hàng phải có ít nhất 1 sản phẩm ');
        return false;
    }else{
        $.ajax({
            url: '/admin/admin_orders/add_orders',
            type: 'post',
            dataType: 'json',
            data: {
                customer_id      : customer_id,
                receiver_name    : receiver_name,
                receiver_phone   : receiver_phone,
                receiver_email   : receiver_email,
                receiver_address : receiver_address,
                receiver_city    : receiver_city,
                receiver_district: receiver_district,
                note             : receiver_note,
                coupon           : receiver_coupon,
                list_product     : list_product
            },
            success: function(data){
                console.log(data);
                if(data.status == 'true'){
                    window.location.href = '/admin/admin_orders';
                }else{
                    alert(data.message);
                    location.reload();
                }
            }
        });
    }
}

function add_list_product (e) {
    var id       = $(e).parents('.item-product-search').attr('data-product-id');
    var code     = $(e).parents('.item-product-search').attr('data-product-code');
    var quantity = $(e).parents('.item-product-search').attr('data-product-quantity');
    var price    = $(e).parents('.item-product-search').attr('data-product-price');
    var size     = $(e).parents('.item-product-search').attr('data-product-size');
    var color    = $(e).parents('.item-product-search').attr('data-product-color');
    var name     = $(e).parents('.item-product-search').attr('data-product-name');
    var image    = $(e).parents('.item-product-search').attr('data-product-image');
    if(color == ''){
        alert('Yêu cầu chọn màu sắc cho sản phẩm');
        return false;
    }
    if(size == ''){
        alert('Yêu cầu chọn size cho sản phẩm');
        return false;
    }
    /*Convert string same array to array*/
    // var arr_size = size;
    // arr_size = arr_size.replace(/'/g, '"');
    // arr_size = JSON.parse(arr_size);
    /*End Convert string same array to array*/
    /*Convert string same array to array*/
    // var arr_color = color;
    // arr_color = arr_color.replace(/'/g, '"');
    // arr_color = JSON.parse(arr_color);
    /*End Convert string same array to array*/
    var html     = ''; 
    if(quantity == 0) {
        alert('Không còn hàng trong kho, không thể đặt mua sản phẩm này');
        return false;
    }
    var check_id = $('#item-product-select-'+id);
    var check_color = $('#item-product-select-'+id).find('.color-product-select').attr('data-color');
    var check_size = $('#item-product-select-'+id).find('.size-product-select').attr('data-size');
    var count = 0
    $('.full-box-product-select').each(function(e){
        if(check_id.length != 0 && check_color == color && check_size == size) {
            up_quantity(id);
            count = 1;
            return count;
        }
    });
    if(count == 1){
        return false;
    }
    html += '<div class="item-product-select" id="item-product-select-'+id+'" data-id="'+id+'" data-price="'+price+'" data-name="'+name+'">';
        html += '<div class="box-remove-product-select">';
            html += '<span class="remove-product-select icon-remove" onclick="remove_product_select('+id+')"></span>';
        html += '</div>';
        html += '<div class="box-left-select">';
            html += '<img src="/uploads/thumb/thumb75x60_'+image+'" alt="Images products"> ';
        html += '</div>';
        html += '<div class="box-right-select">';
            html += '<p class="name-product-select">'+name+'</p>';
            html += '<div class="box-right-bottom-left-select">';
                html += '<p>Màu sắc: ';
                    html += '<span class="color-product-select active-color" style="background:'+color+'" data-color="'+color+'"></span>';
                html += '</p>';
                html += '<p>Size: ';
                    html += '<span class="size-product-select active-size" data-size="'+size+'" >'+size+'</span>';
                html += '</p>';
            html += '</div>';
            html += '<div class="box-right-bottom-center-select">';
                    html += '<span class="price-product-select">'+number_format(price,0,'.',',')+'</span> VNĐ';
            html += '</div>';
            html += '<div class="box-right-bottom-right-select form-group">';
                html += '<p>';
                    html += '<span class="icon-chevron-up btn-product-up" data-id="'+id+'" style="margin-right:5px;"></span>';
                    html += '<input type="number" max="'+quantity+'" class="quantity-product-select form-control value-quantity-'+id+'" value="1" readonly=""> ';
                    html += '<span class="icon-chevron-down btn-product-down" data-id="'+id+'"></span> ';
                html += '</p>';
            html += '</div>';
        html += '</div>';
    html += '<div class="clearfix"></div>';
    html += '</div>';
    $('.full-box-product-select').prepend(html);
}

$('.full-box-product-search').on('click','.color-search',function(e){
    var get_color      = $(this).attr('data-color');
    var check_hasclass = $(this).hasClass('active-color');
    if(check_hasclass != true){
        $(this).parents('.item-product-search').find('span.color-search').removeClass('active-color');
        $(this).parents('.item-product-search').attr('data-product-color',get_color);
        $(this).addClass('active-color');
    }
})

$('.full-box-product-search').on('click','.size-search',function(e){
    var get_size      = $(this).attr('data-size');
    var check_hasclass = $(this).hasClass('span.active-size');
    if(check_hasclass != true){
       $(this).parents('.item-product-search').find('span.size-search').removeClass('active-size');
       $(this).parents('.item-product-search').attr('data-product-size',get_size);
       $(this).addClass('active-size');
    }
})

$('.full-box-product-select').on('click','.btn-product-up',function(e){
    var btn_id = $(this).attr('data-id');
    up_quantity(btn_id);
})
$('.full-box-product-select').on('click','.btn-product-down',function(e){
    var btn_id = $(this).attr('data-id');
    down_quantity(btn_id);
})
function up_quantity(id){
    var get_value = $('.value-quantity-'+id).val();
    get_value = parseInt(get_value);
    $('.value-quantity-'+id).val(get_value + 1);
}
function down_quantity(id){
    var get_value = $('.value-quantity-'+id).val();
    get_value = parseInt(get_value);
    if(get_value == 1){
       return false;
    }else{
       $('.value-quantity-'+id).val(get_value - 1);
    }
}

function remove_product_select(id){
    $("#item-product-select-"+id).remove();
}

$('.receiver_city').change(function(e){
    load_city_district(this);
});

function load_city_district(hihi){
    var parent_id = $(hihi).find('option:selected').val() ? $(hihi).find('option:selected').val() : 99999999;
    $.ajax({
        url: '/admin/admin_ajax/get_city_district',
        type: 'post',
        dataType: 'json',
        data: {
            parent_id : parent_id,
        },
        success: function(data){
            var html = '';
            $.each(data,function(key,value){
                html += '<option value='+value.id+'>'+value.name+'</option>';
            });
            $('select.receiver_district').empty().append(html);
            $('.receiver_district').selectpicker('refresh');
        }
    });
}

$('.btn-info-orders').click(function(e){
    var id = $(this).attr('data-id');
    $.ajax({
        url : '/admin/admin_orders/infoorders',
        type : 'POST',
        dataType : 'JSON',
        data : {
            id : id,
        },
        success: function(data){
            var data_orders = data.data_orders;
            var data_itemordes = data.list_item_orders;
            if(data_orders.orders_customername == null){
                $('#customer_name').val('Khách lẻ');
            }else{
                $('#customer_name').val(data_orders.orders_customername.fullname);
            }
            if(data_orders.orders_username == null){
                $('#admin_name').val();
            }else{
                $('#admin_name').val(data_orders.orders_username.fullname);
            }
            if(data_orders.orders_status == 0){
                $('#orders_status').val('Đang chờ');
            }else if(data_orders.orders_status == 1){
                $('#orders_status').val('Đang giao');
            }else if(data_orders.orders_status == 2){
                $('#orders_status').val('Đã giao');
            }
            $('#receiver_name').val(data_orders.orders_receivername);
            $('#receiver_email').val(data_orders.orders_receiveremail);
            $('#receiver_phone').val(data_orders.orders_receiverphone);
            $('#receiver_address').val(data_orders.orders_receiveraddress);
            $('#receiver_district').val(data_orders.orders_districtname.name);
            $('#receiver_city').val(data_orders.orders_cityname.name);
            $('#orders_created').val(data_orders.orders_created);
            $('#orders_note').val(data_orders.orders_note);
            $('#total_money_product').val(number_format(data_orders.orders_total_money_product,0,'.',','));
            $('#cash_discount').val(number_format(data_orders.orders_cashdiscount,0,'.',','));
            $('#total_money').val(number_format(data_orders.orders_total_money,0,'.',','));
            if(data_orders.orders_cashdiscount != 0 && data_orders.orders_coupon != null){
                if($('.detail-coupon').hasClass('d-n') == true){
                    $('.detail-coupon').removeClass('d-n');
                }
                $('.value-coupon').text(data_orders.orders_coupon.coupon_value+'%');
                $('.code-coupon').text(data_orders.orders_coupon.coupon_code);
            }else{
                if($('.detail-coupon').hasClass('d-n') == false){
                    $('.detail-coupon').addClass('d-n');
                }
            } 
            var html = '';
            var price_product = 0;
            $.each(data_itemordes,function(key,value){
                if(value.price_sell_new == 0){price_product = number_format(value.price_sell_old,0,'.',',');}else{price_product = number_format(value.price_sell_new,0,'.',',') ;}
                html += '<tr>';
                    $.each(value.list_image,function(key1,value1){
                        html += '<td><img src="'+value1+'" alt="'+value.products_name+'"></td>';
                    })
                    html += '<td>'+value.products_name+'</td>';
                    html += '<td><span class="color-search" style="background:'+value.ordersitem_color+'" ></span></td>';
                    html += '<td><span class="size-search">'+value.ordersitem_size+'</span></td>';
                    html += '<td>'+value.ordersitem_products_quantity+'</td>';
                    html += '<td>'+price_product+'</td>';
                html += '</tr>';
            });
            $('.custom-item-list-orders tbody').empty().append(html);

        }
    });
});


$('.btn-check-status-orders').click(function(e){
    var get_id = $(this).attr('data-id');
    var get_status = $(this).attr('data-status');
    $.ajax({
        url: '/admin/admin_orders/activeorders',
        type: 'post',
        dataType: 'json',
        data: {
            id : get_id,
            status : get_status,
        },
        success: function(data){
            if(data.status == 'true'){
                location.reload();
            }
        }
    });
});

$('.btn-delete-orders').click(function(e){
    var get_id = $(this).attr('data-id');
    var get_confirm = confirm('Bạn có chắc chắn muốn xóa đơn đặt hàng này');
    if(get_confirm == true){
        $.ajax({
            url: '/admin/admin_orders/deleteorders',
            type: 'post',
            dataType: 'json',
            data: {
                id : get_id,
            },
            success: function(data){
                if(data.status == 'true'){
                    location.reload();
                }
            }
        });
    }
    
})
// number_format(price_product,0,'.',',');
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
$(document).mouseup(function (e){
    var container = $(".full-box-product-search");
    if (!container.is(e.target) && container.has(e.target).length === 0){
        container.hide();
    }
});

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

$('.receiver_city , .receiver_district , .customer_id').selectpicker({
    liveSearch:true,
    size: 7
});