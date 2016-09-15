<div class="top-title-cate clearfix">
  <div class="breadcrumb">
    <ul class="clearfix">
      <li>
        <a href="/">Trang chủ
        </a> 
      </li>
      <li>
        <?php echo $info_default['title']?>     
      </li>
    </ul>           
  </div>
  <!-- /breadcrumb -->
</div>
<div class="guide-page clearfix">
  <div class="g-left">
    <?php if($info_default['is_page'] == 'account' || $info_default['is_page'] == 'orders') {?>
      <h2 class="gm-title">Thông tin tài khoản
      </h2>
      <ul class="g-menu">
        <?php foreach($menu_static['menu_account'] as $key => $value) { ?>
        <li class="<?php if($_SERVER['REDIRECT_URL'] == '/'.$value['link']){echo 'active' ;} ?>">
          <a href="<?php echo base_url()?><?php echo $value['link'] ?>"><?php echo $value['name'] ?>
          </a>
        </li>
        <?php } ?>
      </ul> 
      <div class="mt20">
      </div>
    <?php } ?>
    <h2 class="gm-title">Thông tin hữu ích
    </h2>
    <ul class="g-menu">
      <?php foreach($menu_static['menu_statispage'] as $key => $value) { ?>
      <li class="<?php if($_SERVER['REDIRECT_URL'] == '/'.$value['link']){echo 'active' ;} ?>">
        <a href="<?php echo base_url()?><?php echo $value['link'] ?>"><?php echo $value['name'] ?>
        </a>
      </li>
      <?php } ?>
    </ul>    
  </div>
  <div class="g-right">
    <?php $this->load->view($info_default['contents_subview_customer']) ?>
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
        <br>mẫu mã đa dạng, cập nhật liên tục
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
        <br>giao đến bạn trong vòng 3h
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
