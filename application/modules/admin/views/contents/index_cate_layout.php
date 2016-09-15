<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="col-lg-8">Danh Sách Danh Mục</div> 
				<div class="col-lg-4 text-right"><a href="<?php echo base_url()?>admin/admin_categories/add" class="btn btn-primary btn-xs btn-rect">Thêm danh mục</a></div>
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
								<input class="form-control" type="text" name="namesearch" placeholder="VD: Nhập tên danh mục">
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
								<th>Tên Danh Mục</th>
								<th>Alias</th>
								<th>Danh Mục Cha</th>
								<th>Trạng Thái</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data_cate as $k => $v) {?>
								<tr class="odd gradeX">
									<td><?php echo $v['name'] ;?></td>
									<td><?php echo $v['name_alias'] ;?></td>
									<td><?php if(isset($v['parent_name'])){echo $v['parent_name'] ;}else{echo 'Không có' ;} ;?></td>
									<td class="center cate_status"><?php if($v['status'] == 0){ echo 'Ẩn' ;}else{ echo 'Hiện' ;}?></td>
									<td class="center">
										<a href="<?php echo base_url() ;?>admin/admin_categories/update/<?php echo $v['id']; ?>" class="btn btn-primary btn-sm btn-rect">Cập nhật</a>
										<?php if($v['status'] == 1) {?>
										<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rect btn-update-status" data-id="<?php echo $v['id']?>">&nbsp;&nbsp;Ẩn&nbsp;&nbsp;</a>
										<?php }else{ ?>
										<a href="javascript:void(0)" class="btn btn-success btn-sm btn-rect btn-update-status" data-id="<?php echo $v['id']?>">Hiện</a>
										<?php }?>
										<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rect btn-delete-cate" data-id="<?php echo $v['id']?>">Xóa</a>
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


<?php /* ?>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Tên Danh Mục</th>
								<th>Alias</th>
								<th>Danh Mục Cha</th>
								<th>Trạng Thái</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data_cate as $k => $v) {?>
								<?php if($v['parent_id'] == 0) { ?>
									<tr class="odd gradeX">
										<td><?php echo $v['name'] ;?></td>
										<td><?php echo $v['name_alias'] ;?></td>
										<td>Không có</td>
										<td class="center cate_status"><?php if($v['status'] == 0){ echo 'Ẩn' ;}else{ echo 'Hiện' ;}?></td>
										<td class="center">
											<a href="<?php echo base_url() ;?>admin/admin_categories/update/<?php echo $v['id']; ?>" class="btn btn-primary btn-sm btn-rect">Cập nhật</a>
											<?php if($v['status'] == 1) {?>
											<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rect btn-update-status" data-id="<?php echo $v['id']?>">&nbsp;&nbsp;Ẩn&nbsp;&nbsp;</a>
											<?php }else{ ?>
											<a href="javascript:void(0)" class="btn btn-success btn-sm btn-rect btn-update-status" data-id="<?php echo $v['id']?>">Hiện</a>
											<?php }?>
											<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rect btn-delete-cate" data-id="<?php echo $v['id']?>">Xóa</a>
										</td>
									</tr>
									<?php foreach($data_cate as $k1 => $v1) {?>
										<?php if($v1['parent_id'] != 0 && $v1['parent_id'] == $v['id']) { ?>
										<tr class="odd gradeX">
											<td> 
												<span class="icon-minus f-si-7"></span> 
												<?php echo $v1['name'] ;?>
											</td>
											<td> 
												<span class="icon-minus f-si-7"></span> 
												<?php echo $v1['name_alias'] ;?>
											</td>
											<td>
												<?php echo $v1['parent_name'] ;?>
											</td>
											<td class="center cate_status"><?php if($v1['status'] == 0){ echo 'Ẩn' ;}else{ echo 'Hiện' ;}?></td>
											<td class="center">
												<a href="<?php echo base_url() ;?>admin/admin_categories/update/<?php echo $v1['id']; ?>" class="btn btn-primary btn-sm btn-rect">Cập nhật</a>
												<?php if($v1['status'] == 1) {?>
												<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rect btn-update-status" data-id="<?php echo $v1['id']?>">&nbsp;&nbsp;Ẩn&nbsp;&nbsp;</a>
												<?php }else{ ?>
												<a href="javascript:void(0)" class="btn btn-success btn-sm btn-rect btn-update-status" data-id="<?php echo $v1['id']?>">Hiện</a>
												<?php }?>
												<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rect btn-delete-cate" data-id="<?php echo $v1['id']?>">Xóa</a>
											</td>
										</tr>
											<?php foreach($data_cate as $k2 => $v2) {?>
												<?php if($v2['parent_id'] != 0 && $v2['parent_id'] == $v1['id']) { ?>
												<tr class="odd gradeX">
													<td> 
														<span class="icon-minus f-si-7"></span> <span class="icon-minus f-si-7"></span> 
														<?php echo $v2['name'] ;?>
													</td>
													<td> 
														<span class="icon-minus f-si-7"></span> <span class="icon-minus f-si-7"></span> 
														<?php echo $v2['name_alias'] ;?>
													</td>
													<td>
														<?php echo $v2['parent_name'] ;?>
													</td>
													<td class="center cate_status"><?php if($v2['status'] == 0){ echo 'Ẩn' ;}else{ echo 'Hiện' ;}?></td>
													<td class="center">
														<a href="<?php echo base_url() ;?>admin/admin_categories/update/<?php echo $v2['id']; ?>" class="btn btn-primary btn-sm btn-rect">Cập nhật</a>
														<?php if($v2['status'] == 1) {?>
														<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rect btn-update-status" data-id="<?php echo $v2['id']?>">&nbsp;&nbsp;Ẩn&nbsp;&nbsp;</a>
														<?php }else{ ?>
														<a href="javascript:void(0)" class="btn btn-success btn-sm btn-rect btn-update-status" data-id="<?php echo $v2['id']?>">Hiện</a>
														<?php }?>
														<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rect btn-delete-cate" data-id="<?php echo $v2['id']?>">Xóa</a>
													</td>
												</tr>
												<?php } ?> <!--End if2-->
											<?php } ?> <!--End for2-->
										<?php } ?> <!--End if2-->
									<?php } ?> <!--End for2-->
								<?php } ?> <!--End if1-->
							<?php } ?> <!--End for1-->
						</tbody>
					</table>
<?php */ ?>