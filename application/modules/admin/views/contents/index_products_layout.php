<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="col-lg-8">Danh Sách Sản Phẩm</div> 
				<div class="col-lg-4 text-right"><a href="<?php echo base_url()?>admin/admin_products/add" class="btn btn-primary btn-xs btn-rect">Thêm Sản Phẩm</a></div>
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
								<input class="form-control" type="text" name="namesearch" placeholder="VD: Nhập tên sản phẩm">
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
								<th></th>
								<th>Tên Sản Phẩm</th>
								<th>Giá</th>
								<th>Danh mục</th>
								<th>Giới Tính</th>
								<th>Trạng Thái</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data_products as $k => $v) {?>
								<tr class="odd gradeX">
									<td class="text-center">
									<?php foreach ($v['list_image'] as $key => $value) { ?>
										<img src="<?php echo base_url() ;?>uploads/thumb/thumb75x60_<?php echo $value ;?>" alt> 
										<?php break ;?>
									<?php }?>
									</td>
									<td><?php echo $v['name'] ;?></td>
									<td><?php if($v['price_sell_new'] == 0){echo $v['price_sell_old'] ;}else{echo $v['price_sell_new']; } ;?></td>
									<td><?php if($v['categories_id'] == '0'){echo 'Không có' ;}else{echo $v['categories_name']; } ;?></td>
									<td><?php if($v['type_gender'] == 'male'){echo 'Nam' ;}
										 else if($v['type_gender'] == 'female'){echo 'Nữ' ;}
										 else if($v['type_gender'] == 'unknown'){echo 'Không xác định' ;} ?>
									</td>
									<td class="status-products"><?php if($v['status'] == '0'){echo 'Hết hàng';}else{echo 'Còn hàng';};?></td>
									<td>
										<a href="<?php echo base_url() ;?>admin/admin_products/update/<?php echo $v['id']; ?>" class="btn btn-primary btn-sm btn-rect">Cập nhật</a>
										<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rect btn-delete-products" data-id="<?php echo $v['id']?>">Xóa</a>
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