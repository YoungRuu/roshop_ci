<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
			Thêm Người Dùng
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
			    <form role="form" method="post" action="<?php echo base_url()?>admin/admin_users/add">
					<div class="row">
                    	<div class="col-lg-6">
                            <div class="form-group">
                                <label>Tài Khoản</label>
                                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('data_form')['username'] ?>" name="username">
                            </div>
                            <div class="form-group">
                                <label>Mật Khẩu</label>
                                <input type="password" class="form-control" value="<?php echo $this->session->flashdata('data_form')['password'] ?>" name="password">
                            </div>
                            <div class="form-group">
                                <label>Tên Đầy Đủ</label>
                                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('data_form')['fullname'] ?>" name="fullname">
                            </div>
                            <div class="form-group">
                                <label>Số Điện Thoại</label>
                                <input type="number" class="form-control" value="<?php echo $this->session->flashdata('data_form')['phone'] ?>" name="phone">
                            </div>
                           <div class="form-group">
                                <label>Giới tính</label>
                                <select class="form-control" name="gender">
                                    <option value="male" <?php if($this->session->flashdata('data_form')['gender'] == 'male'){echo ' selected ';} ?> >Nam</option>
                                    <option value="female" <?php if($this->session->flashdata('data_form')['gender'] == 'female'){echo ' selected ';} ?> >Nữ</option>
                                </select>
                            </div>
                    	</div>
                    	<div class="col-lg-6">
                            <div class="form-group">
                                <label>Ngày sinh</label>
                                <?php if(empty($this->session->flashdata('data_form')['birthday'])){ ?> 
                                    <input type="text" class="form-control input-birthday" value="" name="birthday" data-date="01-01-2016" data-date-format="dd-mm-yyyy" readonly>                                 
                                <?php }else{ ?>
                                    <input type="text" class="form-control input-birthday" value="<?php echo date('d-m-Y',$this->session->flashdata('data_form')['birthday']) ?>" name="birthday" data-date="01-01-2016" data-date-format="dd-mm-yyyy" readonly>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('data_form')['email'] ?>" name="email">
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <textarea rows="2" class="form-control" name="address"><?php echo $this->session->flashdata('data_form')['address'] ?></textarea>
                            </div>
                    	</div>
                	</div>
                	<div class="row">
                    	<div class="col-lg-8">
                    		<button type="submit" class="btn btn-primary">Thêm</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                    	</div>
                        <div class="col-lg-4 text-right">
                            <a href="<?php echo base_url() ?>admin_users" class="btn btn-primary">Quay lại</a>
                        </div>
                	</div>
                </form>
			</div>
		</div>
	</div>
</div>