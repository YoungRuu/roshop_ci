<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
			Cập Nhật Người Dùng
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
			    <form role="form" method="post" action="<?php echo base_url()?>admin/admin_users/update/<?php echo $info_item_users['id']?>">
					<div class="row">
                    	<div class="col-lg-6">
                            <div class="form-group">
                                <label>Tài Khoản</label>
                                <input type="text" class="form-control" value="<?php echo $info_item_users['username']?>" name="username" readonly>
                            </div>
                            <label>Mật khẩu</label>
                            <div class="form-group">
                                <div class="input-group"> 
                                    <input type="password" class="form-control input-password" name="password" readonly=""> 
                                    <div class="input-group-btn"> 
                                        <button type="button" class="btn btn-default edit-password">Sửa</button> 
                                   </div> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tên Đầy Đủ</label>
                                <input type="text" class="form-control" value="<?php echo $info_item_users['fullname']?>" name="fullname">
                            </div>
                            <div class="form-group">
                                <label>Số Điện Thoại</label>
                                <input type="number" class="form-control" value="<?php echo $info_item_users['phone']?>" name="phone">
                            </div>
                            <div class="form-group">
                                <label>Giới tính</label>
                                <select class="form-control" name="gender">
                                    <option value="male" 
                                    <?php if($info_item_users['gender'] == 'male'){echo ' selected ' ;} ?> >Nam</option>
                                    <option value="female" 
                                    <?php if($info_item_users['gender'] == 'female'){echo ' selected ' ;} ?> >Nữ</option>
                                </select>
                            </div>
                    	</div>
                    	<div class="col-lg-6">
                            <div class="form-group">
                                <label>Ngày sinh</label>
                                <input type="text" class="form-control input-birthday" value="<?php echo date('d-m-Y',$info_item_users['birthday']) ?>" name="birthday" data-date="12-02-2012" data-date-format="dd-mm-yyyy" readonly>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" value="<?php echo $info_item_users['email']?>" name="email">
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <textarea rows="3" name="address" class="form-control"><?php echo $info_item_users['address']?></textarea>
                            </div>
                    	</div>
                	</div>
                	<div class="row">
                    	<div class="col-lg-8">
                    		<button type="submit" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                    	</div>
                        <div class="col-lg-4 text-right">
                            <a href="<?php echo base_url() ?>admin/admin_users" class="btn btn-primary">Quay lại</a>
                        </div>
                	</div>
                </form>
			</div>
		</div>
	</div>
</div>