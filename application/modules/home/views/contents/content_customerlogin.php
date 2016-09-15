<div class="login-page clearfix">
  <div class="col registry">
    <h2>Khách hàng mới
    </h2>
    <div class="desc">
      Đăng kí tài khoản để tận hưởng những tính năng hấp dẫn và độc đáo dành riêng cho khách hàng của 
      <a href="/">ROSHOP.COM
      </a>
    </div>
    <div class="btn-row">
      <a class="btn" href="<?php echo base_url().'khach-hang/dang-ky' ?>">Tiếp tục
      </a>
    </div>
  </div>
  <div class="col login">
    <h2>Đăng nhập
    </h2>
    <div class="desc">
      Đăng nhập để nhận ngay những ưu đãi của 
      <a href="/">ROSHOP.COM
      </a>
    </div>
    <div class="frm-box">
      <?php if($this->session->flashdata('item')) {?>
        <div class="tips">
           <?php $view_message = $this->session->flashdata('item') ;?>
             <?php echo $view_message['message'] ;?>
        </div>
      <?php } ?>
      <form action="<?php echo base_url()?>dang-nhap" method="post"  novalidate id="frm-loginForm" data-name="loginForm">
        <div class="frm-row clearfix">
          <h3>Tài khoản
          </h3>
          <div class="frm">
            <input class="frm-txt" type="text" name="username" value="" placeholder="Tên tài khoản">
          </div>
        </div>
        <div class="frm-row clearfix">
          <h3>Mật khẩu
          </h3>
          <div class="frm">
            <input class="frm-txt" type="password" name="password" value="" placeholder="Mật khẩu">
          </div>
        </div>
        <div class="btn-row clearfix">
          <div class="lnk">
            <a href="<?php echo base_url()?>quen-mat-khau">Quên mật khẩu
            </a>
          </div>
          <input class="btn" type="submit" name="" value="Đăng nhập">
        </div>
      </form>
    </div>
  </div>
</div>                        
<div class="line">
</div>
<ul class="step-shipping clearfix">
  <li class="step1">
    <span class="ico">
    </span>
    <div class="desc">
      <h2>Luôn có hàng mới
      </h2>
      <p>Sản phẩm cực chất
        <br />mẫu mã đa dạng, cập nhật liên tục
      </p>
    </div>
  </li>
  <li class="step2">
    <span class="ico">
    </span>
    <div class="desc">
      <h2>Giao Hàng Cấp Tốc
      </h2>
      <p>Sản phẩm được đóng gói cẩn thận 
        <br />giao đến bạn trong vòng 3h
      </p>
    </div>
  </li>
  <li class="step3">
    <span class="ico">
    </span>
    <div class="desc">
      <h2>Đổi trả miễn phí
      </h2>
      <p>Đổi trả hàng miễn phí trong vòng 14 ngày
      </p>
    </div>
  </li>
</ul>
