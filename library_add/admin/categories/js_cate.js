$(document).ready(function(e){

});
$('.btn-delete-cate').click(function(e){
	var id = $(this).attr('data-id');
	var mess_confirm = confirm('Bạn có chắc chắn muốn xóa danh mục này');
	if(mess_confirm == true){
		window.location.replace('/admin/admin_categories/delete/'+id);
	}
});

$('.btn-update-status').click(function(e){
	var id = $(this).attr('data-id');
	var element_this = $(this);
	$.ajax({
		url:'/admin/admin_categories/update_status',
		type: 'POST',
		dataType: 'json',
		data:{
			id: id
		},
		success:function(data){
			if(data.status == "true"){
				var check_class = element_this.hasClass('btn-success');
				if(check_class == true){
					element_this.removeClass('btn-success');
					element_this.addClass('btn-danger');
					element_this.text('Ẩn');
					element_this.css({'padding-left':'15.5px','padding-right':'15.5px'});
					element_this.closest('tr').find('.cate_status').text('Hiện');
				}else if(check_class == false){
					element_this.removeClass('btn-danger');
					element_this.addClass('btn-success');
					element_this.removeAttr('style');
					element_this.text('Hiện');
					element_this.closest('tr').find('.cate_status').text('Ẩn');
				}
			}else{
				alert(data.message);
				location.reload();
			}
		}
	});
});