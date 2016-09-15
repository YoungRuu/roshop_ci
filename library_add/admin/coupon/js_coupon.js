$(document).ready(function(e){
	$('#date-start , #date-end , #dateend_coupon').datepicker({
	    format: 'dd-mm-yyyy',
	    setDate:  new Date(),
	});
});

$('.btn-delete-coupon').click(function(e){
	var id = $(this).attr('data-id');
	var mess_confirm = confirm('Bạn có chắc chắn muốn xóa danh mục này');
    if(mess_confirm == true){
    	 $.ajax({
            url: '/admin/admin_coupon/delete',
            type: 'post',
            dataType: 'json',
            data: {
                id : id,
            },
            success: function(data){
            	location.reload();
            }
        });
    }
});

$('#del-coupon-end').click(function(e){
    var mess_confirm = confirm('Bạn có chắc chắn muốn xóa tất cả phiếu hết hạn');
    if(mess_confirm == true){
         $.ajax({
            url: '/admin/admin_coupon/deletecoupon_end',
            type: 'post',
            dataType: 'json',
            success: function(data){
                location.reload();
            }
        });
    }
});
