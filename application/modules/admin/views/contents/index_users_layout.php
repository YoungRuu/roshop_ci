<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="col-lg-8">Danh Sách Người Dùng</div> 
				<div class="col-lg-4 text-right"><a href="<?php echo base_url()?>admin/admin_users/add" class="btn btn-primary btn-xs btn-rect">Thêm Người Dùng</a></div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<div class="row">
			      <div class="col-sm-12">
			        <?php if($this->session->flashdata('item')) {?>
			           <?php $view_message = $this->session->flashdata('item') ;?>
			           <div class="<?php echo $view_message['class'] ;?> ">
			              <strong><?php echo $view_message['message'] ;?></strong>
			           </div>
			        <?php } ?>
			      </div>
			    </div>
			    <div class="row">
			    	<form action="" method="GET"> 
				    	<div class="col-sm-3 pull-right">
					    	<div class="form-group">
								<input class="form-control" type="text" name="namesearch" placeholder="VD: Tên hoặc Số điện thoại">
					    	</div> 
				    	</div>
				    	<div class="col-sm-1  pull-right">
				    		<div class="form-group">
								<button type="submit" class="btn btn-primary">Tìm kiếm</button>
					    	</div>
				    	</div>
				    	<div class="clearfix"></div>
			    	</form>
			    </div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Tài Khoản</th>
								<th>Tên Đầy Đủ</th>
								<th>Số Điện Thoại</th>
								<th>Giới Tính</th>
								<th>Email</th>
								<th>Trạng Thái</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data_users as $k => $v) {?>
								<tr class="odd gradeX">
									<td><?php echo $v['username'] ;?></td>
									<td><?php echo $v['fullname'] ;?></td>
									<td><?php echo $v['phone'] ;?></td>
									<td><?php if($v['gender'] == 'male'){echo 'Nam' ;}else{echo 'Nữ' ;} ?></td>
									<td><?php echo $v['email'] ;?></td>
									<td class="status-users"><?php if($v['status'] == '0'){echo 'Khóa';}else{echo 'Hoạt động';};?></td>
									<td>
										<a href="<?php echo base_url() ;?>admin/admin_users/update/<?php echo $v['id']; ?>" class="btn btn-primary btn-sm btn-rect">Cập nhật</a>
										<?php if($v['status'] == 1) {?>
										<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rect btn-update-status" data-id="<?php echo $v['id']?>">&nbsp;&nbsp;&nbsp;Khoá&nbsp;&nbsp;&nbsp;</a>
										<?php }else{ ?>
										<a href="javascript:void(0)" class="btn btn-success btn-sm btn-rect btn-update-status" data-id="<?php echo $v['id']?>">Mở khoá</a>
										<?php }?>
										<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rect btn-delete-users" data-id="<?php echo $v['id']?>">Xóa</a>
									</td> 
								</tr>
							<?php } ?> <!--End for1-->
						</tbody>
					</table>
					<div class="row">
						<div class="col-sm-12">
						<?php echo $pagination ;?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>