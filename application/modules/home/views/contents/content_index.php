<ul class="step-buying clearfix">
  <li class="step1">Chọn hàng online
  </li>
  <li class="step2">Giao hàng trong 24h
  </li>
  <li class="step3">Thanh toán tiện lợi
  </li>
  <li class="step4">Đổi trả 7 ngày
  </li>
</ul>
<!-- /step-buying -->
<div class="banner-group clearfix">
  <div class="box1">
    <a href="/opening">
      <img src="<?php echo base_url() ;?>library_add/home/image/Banner/635x360_v3png.png">
    </a>
  </div>
  <div class="box2">
    <div class="box01">
      <a href="<?php echo base_url() ;?>thoi-trang-nam">
        <img src="<?php echo base_url() ;?>library_add/home/image/Banner/315x175_v2.png">
      </a>
    </div>
    <div class="box02">
      <a href="<?php echo base_url() ;?>thoi-trang-nu">
        <img src="<?php echo base_url() ;?>library_add/home/image/Banner/315x175%20new.png">
      </a>
    </div>
  </div>
</div>
<!-- /banner-group -->
<h2 class="title-block red">
  <a href="www_maza_default.html#">Sản phẩm hot
  </a>
</h2>
<div class="item-list">
  <ul class="clearfix lp" data-list="Hot Product">
    <?php foreach ($data_products_hot as $key => $value) { ?>
      <li data-product_id="<?php echo $value['products_id'] ;?>" class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
        <p class="pic">
          <a href="<?php echo base_url().$value['categories_namealias'].'/'.$value['products_namealias'].'-'.$value['products_id'] ;?> ">
            <?php foreach ($value['list_image'] as $key1 => $value1) {?>
              <img src="<?php echo base_url() ;?>uploads/thumb/thumb300x400_<?php echo $value1 ;?>">
              <?php break ;?>
            <?php }?>
          </a>
        </p>
        <div class="desc clearfix">
          <p class="title">
            <a href="<?php echo base_url().$value['categories_namealias'].'/'.$value['products_namealias'].'-'.$value['products_id'] ;?> "><?php echo $value['products_name'] ;?>
            </a>
          </p>
          <div class="price-block clearfix">
            <p class="price">
            <?php if($value['price_sell_new'] != 0){echo number_format($value['price_sell_new']) ;}else{echo number_format($value['price_sell_old']) ;} ;?>đ
            </p) >
          </div>
        </div>
      </li>
    <?php } ?>
  </ul>
</div>
<!-- /item-list -->
<h2 class="title-block blue">
  <a href="#">Thời Trang Nam
  </a>
</h2>
<div class="item-list">
  <ul class="clearfix lp" data-list="home category 1">
    <?php foreach ($data_products_male as $key => $value) { ?>
    <li data-product_id="<?php echo $value['products_id'] ;?>" class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
      <p class="pic">
        <?php foreach ($value['list_image'] as $key1 => $value1) { ?>
          <a href="/<?php echo $value['categories_namealias'];?>/<?php echo $value['products_namealias'];?>-<?php echo $value['products_id'] ;?> ">
            <img src="<?php echo base_url() ;?>uploads/thumb/thumb300x400_<?php echo $value1 ;?>">
          </a>
          <?php break ;?>
        <?php } ?>
      </p>
      <div class="desc clearfix">
        <p class="title">
          <a href="/<?php echo $value['categories_namealias'];?>/<?php echo $value['products_namealias'];?>-<?php echo $value['products_id'] ;?> "><?php echo $value['products_name'] ;?>
          </a>
        </p>
        <div class="price-block clearfix">
          <p class="price"><?php if($value['price_sell_new'] != 0){echo number_format($value['price_sell_new']) ;}else{echo number_format($value['price_sell_old']) ;} ;?>đ
          </p>
        </div>
      </div>
    </li>
    <?php } ?>
  </ul>
</div>
<!-- /item-list -->
<h2 class="title-block pink">
  <a href="#">Thời Trang Nữ
  </a>
</h2>
<div class="item-list">
  <ul class="clearfix lp" data-list="home category 2">
    <?php foreach ($data_products_female as $key => $value) { ?>
    <li data-product_id="<?php echo $value['products_id']?>" class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
      <p class="pic">
        <?php foreach ($value['list_image'] as $key1 => $value1) { ?>
          <a href="/<?php echo $value['categories_namealias'];?>/<?php echo $value['products_namealias'];?>-<?php echo $value['products_id'] ;?> ">
            <img src="<?php echo base_url() ;?>uploads/thumb/thumb300x400_<?php echo $value1?>">
          </a>
          <?php break ?>
        <?php } ?>
      </p>
      <div class="desc clearfix">
        <p class="title">
          <a href="/<?php echo $value['categories_namealias'];?>/<?php echo $value['products_namealias'];?>-<?php echo $value['products_id'] ;?> "><?php echo $value['products_name']?>
          </a>
        </p>
        <div class="price-block clearfix">
          <p class="price"><?php if($value['price_sell_new'] != 0){echo number_format($value['price_sell_new']) ;}else{echo number_format($value['price_sell_old']) ;} ;?>đ
          </p>
        </div>
      </div>
    </li>
    <?php } ?>
  </ul>
</div>
<!-- /item-list -->
<?php /* ?>
<h2 class="title-block mtb">
  <span>Bạn vừa xem
  </span>
</h2>
<div class="item-slider">
  <div class="jcarousel" data-jcarousel="true">
    <ul>
      <li>
        <p class="pic">
          <a href="#">
            <img src="<?php echo base_url() ;?>/library_add/home/image/img_product/product_1.jpg">
          </a>
        </p>
        <div class="desc clearfix">
          <p class="title">
            <a href="#">Chân Váy Jean Thời Trang
            </a>
          </p>
          <div class="price-block clearfix">
            <p class="price">279,000đ
            </p>
          </div>
        </div>
      </li>
    </ul>
  </div>
  <a href="#" class="jcarousel-control-prev" data-jcarouselcontrol="true">‹
  </a>
  <a href="#" class="jcarousel-control-next" data-jcarouselcontrol="true">›
  </a>
</div>
<?php */ ?>
<!-- /item-slider -->
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
