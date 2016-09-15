<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="col-lg-7">Danh Sách Phiếu Mua Hàng</div> 
				<div class="col-lg-5 text-right">
				<a href="javascript:void(0)" class="btn btn-primary btn-xs btn-rect" data-toggle="modal" data-target="#create-coupon">Thêm Phiếu Mua Hàng</a> 
				<a href="javascript:void(0)" class="btn btn-warning btn-xs btn-rect" id="del-coupon-end">Xóa phiếu hết hạn hoặc đã sử dụng</a></div>
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
			    		<div class="col-sm-3">
					    	<div class="form-group">
								<select name="status" class="form-control">
									<option value="">Tất cả</option>
									<option value="0">Chưa sử dụng</option>
									<option value="1">Đã sử dụng</option>
								</select>
					    	</div>
				    	</div>
			    		<div class="col-sm-3">
					    	<div class="form-group">
								<input class="form-control " id="date-start" type="text" name="datestart" placeholder="VD: Ngày bắt đầu" value="">
					    	</div>
				    	</div>
			    		<div class="col-sm-3">
					    	<div class="form-group">
								<input class="form-control " id="date-start" type="text" name="dateend" placeholder="VD: Ngày kết thúc" value="">
					    	</div>
				    	</div>
				    	<div class="col-sm-1t">
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
								<th>Mã</th>
								<th>Giá trị(%)</th>
								<th>Nội dung</th>
								<th>Kết thúc</th>
								<th>Trạng Thái</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data_coupon as $k => $v) {?>
								<tr class="odd gradeX">
									<td><?php echo $v['coupon_code'];?></td>
									<td><?php echo $v['coupon_value'].'%';?></td>
									<td><?php echo $v['coupon_content'];?></td>
									<td><?php echo date('d-m-Y',strtotime($v['date_end']));?></td>
									<td class="status-coupon">
										<?php if($v['status'] == '0') { ?>
											<span class="label label-success">Chưa sử dụng</span>
										<?php }else{?>
											<span class="label label-warning">Đã sử dụng</span>
										<?php }?>
										<?php if(strtotime($v['date_end']) < time()) { ?>
											<span class="label label-default">Hết hạn</span>
										<?php }else{?>
											<span class="label label-info">Còn hạn</span>
										<?php }?>
									</td>
									<td>
										<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rect btn-delete-coupon" data-id="<?php echo $v['id']?>">Xóa</a>
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
<div class="full-box-modal">
	<div class="modal fade" id="create-coupon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Thêm phiếu mua hàng</h4>
				</div>
				<div class="modal-body">
					<form action="<?php echo base_url()?>admin/admin_coupon/add" method="POST">
			          <div class="row">
				        <div class="col-sm-4">
			          		<div class="form-group">
					            <label for="quantity_coupon" class="control-label">Số lượng:</label>
					            <input type="text" class="form-control" id="quantity_coupon" name="quantity_coupon" placeholder="Số lượng tạo">
				            </div>
			            </div>
			            <div class="col-sm-4">
			          		<div class="form-group">
					            <label for="value_coupon" class="control-label">Giá trị(%):</label>
					            <input type="text" class="form-control" id="value_coupon" name="value_coupon" placeholder="Giá trị giảm giá">
				            </div>
			            </div>
			            <div class="col-sm-4">
			          		<div class="form-group">
					            <label for="dateend_coupon" class="control-label">Ngày hết hạn:</label>
					            <input type="text" class="form-control" id="dateend_coupon" name="dateend_coupon" placeholder="Thời gian hết hạn">
				            </div>
			            </div>
			          </div>
			          <div class="row">
						<div class="col-sm-12">
							<div class="form-group">
					            <label for="content_coupon" class="control-label">Nội dung</label>
					            <textarea rows="3" class="form-control" id="content_coupon" name="content_coupon" placeholder="Nội dung giảm giá"></textarea>
				            </div>
			            </div>
			          </div>
			            <button type="submit" class="btn btn-primary">Tạo</button>
						<button type="submit" class="btn btn-default" data-dismiss="modal">Hủy</button>
			        </form>
				</div>
				<div class="modal-footer">
					
				</div>
			</div>
		</div>
	</div>
</div>	