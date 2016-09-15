<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
			Thêm Đơn Đặt Hàng
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
			    <form role="form" method="post" action="<?php echo base_url()?>admin/admin_orders/add" enctype="multipart/form-data">
					<div class="row">
                    	<div class="col-lg-6">
                    		<div class="full-form-search">
	                            <div class="form-group">
	                                <label>Tên Hoặc Mã Sản Phẩm</label>
	                                <input type="text" class="form-control keysearch_products" autocomplete="false">
	                            </div>
	                            <div class="parent-full-box-search">
		                            <div class="full-box-product-search">
		                            	 
		                            </div>
	                            </div>
	                            <div class="full-box-product-select">
	                            	
	                            </div>
                            </div>
                    	</div>
                    	<div class="col-lg-6">
                    		<div class="form-group">
                                <label>Khách hàng</label>
                                <select name="customer_id" class="form-control selectpicker customer_id" data-live-search="true">
                                	<option value="0" data-tokens="Khách lẻ">Khách lẻ</option>	
                                	<?php foreach ($data_users as $key => $value) {?>
                                		<option value="<?php echo $value['id']?>" data-tokens="<?php echo $value['fullname'].' - '.$value['phone'] ?>"><?php echo $value['fullname']?></option>
                                	<?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên người nhận</label>
                                <input type="text" class="form-control receiver_name" value="" name="receiver_name">
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại người nhận</label>
                                <input type="text" class="form-control receiver_phone" value="" name="receiver_phone">
                            </div>
                            <div class="form-group">
                                <label>Email người nhận</label>
                                <input type="text" class="form-control receiver_email" value="" name="receiver_email">
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ người nhận</label>
                                <textarea class="form-control receiver_address" rows="3" name="receiver_address"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="box-city-district">
                                    <label>Thành Phố</label>
                                    <select name="receiver_city" class="form-control receiver_city selectpicker">
                                        <?php foreach ($data_acreages as $key => $value) { ?>
                                            <option value="<?php echo $value['id'] ;?>" <?php if($value['name'] == 'TP.HCM'){echo 'selected' ;} ?> ><?php echo $value['name'] ;?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="box-city-district">
                                    <label>Quận - Huyện</label>
                                    <select name="receiver_district" class="form-control selectpicker receiver_district" title="--Vui lòng chọn--">
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="form-control receiver_note" rows="3" name="note"></textarea>
                            </div>
                             <div class="form-group">
                                <label>Mã giảm giá</label>
                                 <input type="text" class="form-control receiver_coupon" value="" name="coupon">
                            </div>
                    	</div>
                	</div>
                	<div class="row">
                    	<div class="col-lg-8">
                    		<a href="javascript:void(0)" class="btn btn-primary btn-add-orders">Thêm</a>
                            <button type="reset" class="btn btn-default">Reset</button>
                    	</div>
                        <div class="col-lg-4 text-right">
                            <a href="<?php echo base_url() ?>admin_products" class="btn btn-primary">Quay lại</a>
                        </div>
                	</div>
                </form>
			</div>
		</div>
	</div>
</div>