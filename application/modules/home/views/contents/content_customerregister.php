<div class="registry-page clearfix">
  <div class="registry">
    <form method="POST" action="">
      <h2 class="g-title">Đăng kí tài khoản
      </h2>
      <div class="m-b-10">
        <?php if($this->session->flashdata('item')) {?>
           <?php $view_message = $this->session->flashdata('item') ;?>
           <div class="<?php echo $view_message['class'] ;?> message-flash">
              <strong><?php echo $view_message['message'] ;?></strong>
           </div>
        <?php } ?>
      </div>
      <div class="frm-box">
        <div class="frm-row clearfix">
          <h3>Tài khoản
          </h3>                          
          <div class="frm ">
            <input class="frm-txt" type="text" name="username" value="<?php echo $this->session->flashdata('data_form_regis')['username'] ?>" placeholder="Tài khoản">
          </div>
        </div>
        <div class="frm-row clearfix">
          <h3>Tạo mới mật khẩu
          </h3>                          
          <div class="frm ">
            <p class="col2">
              <input type="password" class="frm-txt" type="text" name="password" value="<?php echo $this->session->flashdata('data_form_regis')['password'] ?>" placeholder="Tạo mới mật khẩu">
            </p>
            <p class="col2">
              <input type="password" class="frm-txt" type="text" name="confirm" value="<?php echo $this->session->flashdata('data_form_regis')['confirm'] ?>" placeholder="Nhập lại mật khẩu">
            </p>
            <div class="clearfix">
            </div>
          </div>
        </div>
        <div class="frm-row edit-col clearfix">
          <div class="edit-col">    
            <div class="frm col-50">
              <h3>Tên đầy đủ</h3>            
              <input class="frm-txt" type="text" name="fullname" value="<?php echo $this->session->flashdata('data_form_regis')['fullname'] ?>" placeholder="Tên đầy đủ">
            </div>
            <div class="frm col-50">
              <h3>Ngày sinh</h3>  
              <input class="frm-txt" type="text" name="birthday" value="<?php echo $this->session->flashdata('data_form_regis')['birthday'] ?>" placeholder="Ngày sinh" id="birthday_register">
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        <div class="frm-row edit-col clearfix">
          <div class="edit-col">    
            <div class="frm col-50">
              <h3>Nhập số điện thoại</h3>            
              <input class="frm-txt" type="text" name="phone" value="<?php echo $this->session->flashdata('data_form_regis')['phone'] ?>" placeholder="Số điện thoại">
            </div>
            <div class="frm col-50">
              <h3>Email</h3>  
              <input class="frm-txt" type="text" name="email" value="<?php echo $this->session->flashdata('data_form_regis')['email'] ?>" placeholder="Email">
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        <div class="frm-row clearfix">
          <h3>Địa chỉ
          </h3>                          
          <div class="frm ">
            <input class="frm-txt" type="text" name="address" value="<?php echo $this->session->flashdata('data_form_regis')['address'] ?>" placeholder="Địa chỉ">
          </div>
        </div>
        <div class="btn-row clearfix">
          <input class="btn" type="submit" name="" value="Đăng ký">
        </div>
      </div>
    </form>
  </div>
  <?php /* ?>
  <div class="quick-registry">
    <h2 class="g-title">Đăng ký nhanh
    </h2>
    <div class="desc">
      Đăng ký nhanh tài khoản tại 
      <a href="http://maza.vn/customer/register.htm#">MAZA.vn
      </a> bằng                
    </div>
    <div class="btn-row">
      <a class="s-btn gm-btn" href="http://maza.vn/index.php?route=hauth/login&amp;provider=Google">
        <span class="ico">
        </span> Đăng nhập bằng Gmail
      </a>
    </div>
    <div class="btn-row">
      <a class="s-btn fb-btn" href="http://maza.vn/index.php?route=hauth/login&amp;provider=Facebook">
        <span class="ico">
        </span> Đăng nhập bằng Facebook
      </a>
    </div>
    <div class="lnk">
      Đã có tài khoản? 
      <a href="http://maza.vn/customer/login.htm">Đăng nhập
      </a>
    </div>
    <div class="call">
      <img src="../image/tel_num.png">
    </div>
  </div>
  <?php */ ?>
</div>
