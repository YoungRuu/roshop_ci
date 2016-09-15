$(document).ready(function(e){
	$('.input-birthday').datepicker();
});

$('.edit-password').click(function(e){
	$('.input-password').removeAttr('readonly');
});

$('.btn-delete-users').click(function(e){
	var id = $(this).attr('data-id');
	var status_confirm = confirm('Bạn có chắc chắn muốn xóa người dùng này');
	if(status_confirm === true){
		window.location.replace('/admin/admin_users/delete/'+id);
	}
});

$('.btn-update-status').click(function(e){
	var id = $(this).attr('data-id');
	var element_this = $(this);
	$.ajax({
		url:'/admin/admin_users/active_user',
		type:'POST',
		dataType:'json',
		data:{
			id:id
		},
		success:function(data){
			if(data.status == 'true'){
				if(element_this.hasClass('btn-success') == true){
					element_this.css({'padding-left':'19px','padding-right':'20px'});
					element_this.removeClass('btn-success');
					element_this.addClass('btn-danger');
					element_this.text('Khoá');
					element_this.closest('tr').find('.status-users').text('Hoạt động');
				}else{
					element_this.removeAttr('style');
					element_this.removeClass('btn-danger');
					element_this.addClass('btn-success');
					element_this.text('Mở khoá');
					element_this.closest('tr').find('.status-users').text('Khoá');
				}
			}
		}
	})
});