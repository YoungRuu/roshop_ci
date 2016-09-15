<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="col-lg-8">Danh Sách Đơn Đặt Hàng</div> 
				<div class="col-lg-4 text-right"><a href="<?php echo base_url()?>admin/admin_orders/add" class="btn btn-primary btn-xs btn-rect">Thêm Đơn Hàng</a></div>
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
								<th>Tên Đầy Đủ</th>
								<th>Số Điện Thoại</th>
								<th>Email</th>
								<th>Trạng Thái</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data_orders as $k => $v) {?>
								<tr class="odd gradeX">
									<td><?php echo $v['receiver_name'] ;?></td>
									<td><?php echo $v['receiver_phone'] ;?></td>
									<td><?php echo $v['receiver_email'] ;?></td>
									<?php if($v['status'] == '0') {?>
									<td class="status-orders"><span class="label label-danger">Đang chờ</span></td>
									<?php }else if($v['status'] == '1'){?>
									<td class="status-orders"><span class="label label-warning">Đang giao</span></td>
									<?php }else{?>
									<td class="status-orders"><span class="label label-success">Đã giao</span></td>
									<?php } ?>
									<td>
										<a href="javascript:void(0)" class="btn btn-primary btn-sm btn-rect btn-info-orders" data-toggle="modal" data-target="#modal-info-orders" data-id="<?php echo $v['id']?>" >Thông tin</a>
										<div class="dropdown d-i-b">
									    <?php if($v['status'] == 2 ){ ?>
									    <a class="btn btn-warning  btn-sm btn-rect dropdown-toggle" type="button" id="menu1" data-toggle="dropdown" disabled="">Trạng thái <span class="caret"></span></a>
									    
									    <?php }else{ ?>
									    <a class="btn btn-warning  btn-sm btn-rect dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Trạng thái <span class="caret"></span></a>
									    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
									      <?php if($v['status'] == 0){ ?>
									      <li role="presentation" >
									      <a role="menuitem" class="btn-check-status-orders" tabindex="-1" data-id="<?php echo $v['id'] ;?>" data-status="1" href="javascript:void(0)">Đang giao</a></li>
									      <li role="presentation">
									      <a role="menuitem" class="btn-check-status-orders" tabindex="-1" data-id="<?php echo $v['id'] ;?>" data-status="2" href="javascript:void(0)">Đã giao</a></li>
									      <?php }else if($v['status'] == 1){ ?>
									      <li role="presentation">
									      <a role="menuitem" class="btn-check-status-orders" tabindex="-1" data-id="<?php echo $v['id'] ;?>" data-status="2" href="javascript:void(0)">Đã giao</a></li>
									      <?php }?>
									    </ul>
									    <?php } ?>	
									  </div>
										<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rect btn-delete-orders" data-id="<?php echo $v['id']?>">Xóa</a>
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
<div class="box-of-modal">
	<div class="modal fade" id="modal-info-orders" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
	  <div class="modal-dialog custom-modal-dialog-orders" role="document">
	    <div class="modal-content custom-modal-content">
	      <div class="modal-header custom-modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title custom-modal-title" id="myLargeModalLabel">Thông tin đơn đặt hàng</h4>
	      </div>
	      <div class="modal-body custom-modal-body">
	        <form>
	          <div class="row">
		        <div class="col-sm-4">
	          		<div class="form-group">
			            <label for="customer_name" class="control-label">Khách hàng:</label>
			            <input type="text" class="form-control" id="customer_name" name="customer_name" readonly="">
		            </div>
	            </div>
				<div class="col-sm-4">
					<div class="form-group">
			            <label for="admin_name" class="control-label">Quản lý:</label>
			            <input type="text" class="form-control" id="admin_name" name="admin_name" readonly="">
		            </div>
	            </div>
	            <div class="col-sm-4">
					<div class="form-group">
			            <label for="orders_status" class="control-label">Trạng thái:</label>
			            <input type="text" class="form-control" id="orders_status" name="orders_status" readonly="">
		            </div>
	            </div>
	          </div>
	          <div class="row">
		        <div class="col-sm-4">
	          		<div class="form-group">
			            <label for="receiver_name" class="control-label">Tên người nhận:</label>
			            <input type="text" class="form-control" id="receiver_name" name="receiver_name" readonly="">
		            </div>
	            </div>
				<div class="col-sm-4">
					<div class="form-group">
			            <label for="receiver_email" class="control-label">Email người nhận:</label>
			            <input type="text" class="form-control" id="receiver_email" name="receiver_email" readonly="">
		            </div>
	            </div>
	            <div class="col-sm-4">
					<div class="form-group">
			            <label for="receiver_phone" class="control-label">Điện thoại:</label>
			            <input type="text" class="form-control" id="receiver_phone" name="receiver_phone" readonly="">
		            </div>
	            </div>
	          </div>
	          <div class="row">
	          	<div class="col-sm-4">
					<div class="form-group">
			            <label for="receiver_city" class="control-label">Thành phố:</label>
			            <input type="text" class="form-control" id="receiver_city" name="receiver_city" readonly="">
		            </div>
	            </div>
	          	<div class="col-sm-4">
					<div class="form-group">
			            <label for="receiver_district" class="control-label">Quận - Huyện - Xã:</label>
			            <input type="text" class="form-control" id="receiver_district" name="receiver_district" readonly="">
		            </div>
	            </div>
	            <div class="col-sm-4">
					<div class="form-group">
			            <label for="orders_created" class="control-label">Ngày tạo:</label>
			            <input type="text" class="form-control" id="orders_created" name="orders_created" readonly="">
		            </div>
	            </div>
	          </div>
	          <div class="row">
	          	<div class="col-sm-4">
					<div class="form-group">
			            <label for="total_money_product" class="control-label">Tổng tiền sản phẩm:</label>
			            <input type="text" class="form-control" id="total_money_product" name="total_money_product" readonly="">
		            </div>
	            </div>
	            <div class="col-sm-4">
					<div class="form-group">
			            <label for="cash_discount" class="control-label">Giảm giá:</label>
			            <input type="text" class="form-control" id="cash_discount" name="cash_discount" readonly="">
		            </div>
		            <div class="detail-coupon d-n">
		          		Phiếu giảm giá: <span class="value-coupon"></span> - <span class="code-coupon"></span>
		          	</div>
	            </div>
	            <div class="col-sm-4">
					<div class="form-group">
			            <label for="total_money" class="control-label">Thành tiền:</label>
			            <input type="text" class="form-control" id="total_money" name="total_money" readonly="">
		            </div>
	            </div>

	          </div>
	          <div class="row">
	          	<div class="col-sm-6">
					<div class="form-group">
			            <label for="receiver_address" class="control-label">Địa chỉ người nhận:</label>
			            <textarea rows="3" name="receiver_address" id="receiver_address" class="form-control" readonly=""></textarea>
		            </div>
	            </div>
	          	<div class="col-sm-6">
					<div class="form-group">
			            <label for="orders_note" class="control-label">Nội dung:</label>
			            <textarea rows="3" name="orders_note" id="orders_note" class="form-control" readonly=""></textarea>
		            </div>
	            </div>
	          </div>
	          <div class="row">
	          	<div class="col-sm-12">
	          		<a href="javascript:void(0)" class="collapse-list-product" data-toggle="collapse" data-target="#orders_listitem"><i class="icon-align-justify"></i> Danh sách sản phẩm</a> 
	          	</div>
	          	<div class="col-sm-12 collapse" id="orders_listitem">
	          		<div class="table-responsive custom-item-list-orders">
					  <table class="table table-striped">
					    <thead>
					      <tr>
					        <th>Hình ảnh</th>
					        <th>Tên sản phẩm</th>
					        <th>Màu sắc</th>
					        <th>Size</th>
					        <th>Số lượng</th>
					        <th>Giá</th>
					      </tr>
					    </thead>
					    <tbody>
					    </tbody>
					  </table>
				  </div>
	          	</div>
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer custom-modal-footer">
	        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
	        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
	      </div>
	    </div>
	  </div>
	</div>
</div>

<div class="modal fade modal-info-orders in" role="dialog" tabindex="-1" aria-labelledby="myLargeModalLabel" > 
  <div class="modal-dialog modal-lg" role="document"> 
    <div class="modal-content"> 
      <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×
          </span>
        </button> 
        <h4 class="modal-title" id="myLargeModalLabel">Large modal
        </h4> 
      </div> 
      <div class="modal-body">
      	<form>
          <div class="row">
	        <div class="col-sm-6">
          		<div class="form-group">
		            <label for="customer_name" class="control-label">Khách hàng:</label>
		            <input type="text" class="form-control" id="customer_name" name="customer_name">
	            </div>
            </div>
			<div class="col-sm-6">
				<div class="form-group">
		            <label for="admin_name" class="control-label">Quản lý:</label>
		            <input type="text" class="form-control" id="admin_name" name="admin_name">
	            </div>
            </div>
          </div>
          <div class="row">
	        <div class="col-sm-6">
          		<div class="form-group">
		            <label for="receiver_name" class="control-label">Tên người nhận:</label>
		            <input type="text" class="form-control" id="receiver_name" name="receiver_name">
	            </div>
            </div>
			<div class="col-sm-6">
				<div class="form-group">
		            <label for="receiver_email" class="control-label">Email người nhận:</label>
		            <input type="text" class="form-control" id="receiver_email" name="receiver_email">
	            </div>
            </div>
          </div>
        </form>
      </div> 
    </div> 
  </div> 
</div>
