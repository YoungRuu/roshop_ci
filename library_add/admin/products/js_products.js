$(document).ready(function(e){
	/*--Set các Input thành colorpicker khi mới vào trang--*/
	$('.div-color').find('.input-block-color').colorpicker(); 
	$('.price_standard').keyup(function(e){
		price_standard(this);
	});
	/*--Gọi hàm colorpicker cho input khi click vào nó(Sau khi nhấn add_color)--*/
	$('.input-block-color').click(function(e){
		var get_id_block = $(this).attr('id-block');
		add_color(get_id_block);
	});
	/*--Add màu sắc cho sản phẩm (Gọi hàm add_color)--*/
	$('.full-block-color').on('click','.add-color',function(e){
		get_id_block = $('.div-color').find('.input-block-color').eq(-1).attr('id-block');
		get_id_block++;
		$('.div-color').append('<div class="box-color"><input class="padding-cus input-block-color block-color-'+get_id_block+'" id-block="'+get_id_block+'" name="color[]" readonly=""></input><i class="btn-remove-color" title="Xóa" id-color="'+get_id_block+'">&times;</i></div>')
		add_color(get_id_block);
	});
	$('.price_sale').keyup(function(e){
		var get_value_giagoc = $('.price_standard').val() ? $('.price_standard').val() : 0;
		var get_value_giamgia = $(this).val() ? $(this).val() : 0;
		var get_value_unit_giamgia = $('.unit_price_sale').val();
		get_value_giagoc = parseInt(get_value_giagoc);
		get_value_giamgia = parseInt(get_value_giamgia);

		if(get_value_unit_giamgia == 'VND'){
			$('.price_sell_old').val(get_value_giagoc-get_value_giamgia);
		}else if(get_value_unit_giamgia == '%'){
			$('.price_sell_old').val(get_value_giagoc-(get_value_giagoc/100*get_value_giamgia));
		}
	});

	$('.unit_price_sale').change(function(e){
		var get_value_unit_giamgia = $(this).val();
		var get_value_giagoc = $('.price_standard').val() ? $('.price_standard').val() : 0;
		var get_value_giamgia = $('.price_sale').val() ? $('.price_sale').val() : 0;
		get_value_giagoc = parseInt(get_value_giagoc);
		get_value_giamgia = parseInt(get_value_giamgia);
		if(get_value_unit_giamgia == 'VND'){
			$('.price_sell_old').val(get_value_giagoc-get_value_giamgia);
		}
		if(get_value_unit_giamgia == '%'){
			$('.price_sell_old').val(get_value_giagoc-(get_value_giagoc/100*get_value_giamgia));
		}
	});

	/*----------Delete Product-----------*/
	$('.btn-delete-products').click(function(e){
		var id = $(this).attr('data-id');
		var get_confirm = confirm('Bạn có chắc muốn xóa sản phẩm này');
		if(get_confirm == true){
			window.location.replace('/admin/admin_products/delete/'+id);
		}
	});

	$('.div-color').on('click','.btn-remove-color',function(e){
		color_remove(this);
	});

});

function add_color(id_block){
	$('.block-color-'+id_block).colorpicker().on('changeColor', function (ev) {
        $('.block-color-'+id_block).css('background-color', ev.color.toHex());
    });
}

function color_remove(hihi){
	var count_color = $(hihi).parents('.div-color').find('.input-block-color');
	if(count_color.length < 2){
		alert('Phải chọn ít nhất 1 màu sắc');
		return false;
		// $(hihi).parents('.div-color').find('.btn-remove-color').eq(-1).css({'visibility':'hidden'});
	}else{
		var get_id_color = $(hihi).attr('id-color');
		$(hihi).parents('.div-color').find('.block-color-'+get_id_color).remove();
		$(hihi).remove();
	}
}

function price_standard(hihi){
	var get_value_giagoc = $(hihi).val();
	var get_value_giamgia = $('.price_sale').val() ? $('.price_sale').val() : 0;

	if(get_value_giagoc.length > 0){
		$('.price_sale').removeAttr('readonly');
	}else if(get_value_giagoc.length == '0' ){
		$('.price_sale').attr('readonly',true);
		$('.price_sale').val('0');
	}
	var get_value_unit_giamgia = $('.unit_price_sale option:selected').val();
	if(get_value_unit_giamgia == 'VND'){
		$('.price_sell_old').val(get_value_giagoc-get_value_giamgia);
	}else if(get_value_unit_giamgia == '%'){
		$('.price_sell_old').val(get_value_giagoc-(get_value_giagoc/100*get_value_giamgia));
	}
}

/*----------Upload multi Image + Show image browser-----------*/
function isImage(file) {
    file = file.split(".").pop();
    switch (file) {
        case "jpg": case "JPG" : case "JPg" : case "Jpg" : case "jPG" : case "jPg" : case "jpG" : case "JpG" :      
        case "png": case "PNG" : case "PNg" : case "Png" : case "pNG" : case "pNg" : case "pnG" : case "PnG" :
        case "gif": case "GIF" : case "GIf" : case "Gif" : case "gIF" : case "gIf" : case "giF" : case "GiF" :
        case "jpeg": case "JPEG" : case "Jpeg" : case "JPeg" : case "JPEg" : case "jPeg" : case "jPEg" : case "jPEG" : 
        case "jpEg" : case "jpEG" : case "jpeG" :
            return true;
        default:
            return false;
    }
    return false;
}
function file_change(file,id_block){
	if (file.files && file.files[0]) {
		if (isImage(file.files[0].name)) {
		    var reader = new FileReader();
		    reader.onload = function (e) {
		        $('#img_product_'+id_block).attr("src", e.target.result);
		        $(file).parent().find('.remove_file_'+id_block).css({'display':'inline'});
		        $(file).parent().find('.box_value_img').val('');
		    };
		    reader.readAsDataURL(file.files[0]);
		}else{
			file = $(file);
	        file.replaceWith(file.val('').clone(true));
	        file.parent().find('.remove_file_'+id_block).hide();
	        alert("Vui lòng chọn 1 hình ảnh");
		}
	}
}

function file_remove(iloveyou){
	var count_img = $(iloveyou).parents('.full_block_img');
	if(count_img.find('.box_img').length < 2){
		alert('Phải chọn ít nhất 1 hình ảnh');
		return false;
	}else{
    // var file = $(iloveyou).parents('.box_img').find("input[type='file']");
    // file.replaceWith(file.val('').clone(true));
    $(iloveyou).parents('.box_img').remove();
    // $(iloveyou).parents('.box_img').find("img").attr("src", "/uploads/uploadimg.png");
    // $(iloveyou).hide();
    // return false;
    }
};

$('.full_block_img').each(function(index){
	$('.full_block_img').on('click','.uploadimg',function(e) {
		$(this).parents('.box_img').find('input[type=file]').click();
		return false;
	});
});

$('.add-image').click(function(e){
	var get_box = $('.full_block_img').find('.box_img');
	var get_id_box = get_box.eq(-1).attr('id-block-img');
	get_id_box++;
	var html = '';
	html += '<div class="box_img" id-block-img="'+get_id_box+'">';
		html += '<label for="image" class="uploadimg">';
			html += '<img src="/uploads/uploadimg.png" id="img_product_'+get_id_box+'"/>';
			html += '</label>';
		html += '<i class="btn-remove remove_file_'+get_id_box+'" title="Xóa" onclick="file_remove(this)">&times;</i>';
		html += '<input type="file" name="list_image[]" class="hidden input_file_'+get_id_box+'" onchange="file_change(this,'+get_id_box+')" />';
	html += '</div>';
	if(get_box.length == 5){
		alert('Bạn chỉ được chọn tối đa 5 hình');
		return false;
	}
	$('.full_block_img').append(html);
});
    
/*----------END Upload multi Image + Show image browser-----------*/
$('.size-product , .size-product-update').selectpicker({
	liveSearch: true,
	size: 7
});