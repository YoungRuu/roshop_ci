<div id="top-detail-banner" style="margin-top: 15px;">
  <a href="#" target="_blank">
    <img src="<?php echo base_url() ;?>library_add/home/image/Banner/banner-detail.png">
  </a>
</div>
<div class="top-title-cate clearfix">
  <div class="breadcrumb">
    <ul class="clearfix">
      <?php foreach ($info_item_product['breadcrumb'] as $key => $value) { ?>
        <li>
          <a href="<?php echo $value['link'] ;?>"><?php echo $value['name'] ;?></a> 
        </li>
      <?php }?>
    </ul>           
  </div>
  <!-- /breadcrumb -->
</div>
<input type="hidden" name="product-price" id="product-price" value="<?php if($info_item_product['price_sell_new'] != 0){echo $info_item_product['price_sell_new'];}else{echo $info_item_product['price_sell_old'] ;} ;?>">
<div class="detail-info-block clearfix">
  <div class="left-detail-info ">
    <div class="desc-info clearfix">
      <div class="connected-carousels">
        <div class="stage <?php if($info_item_product['quantity'] == 0){echo 'soldout' ;} ?>">
          <div class="soldout-image">
          </div>
          <div class="carousel carousel-stage" data-jcarousel="true">
            <ul>
              <?php foreach ($info_item_product['list_image'] as $key => $value) { ?>
                <li>
                  <img  class="img mag" src="<?php echo base_url() ;?>uploads/thumb/thumb300x400_<?php echo $value?>" alt="">
                </li>
              <?php }?>
            </ul>
          </div>
        </div>
        <div class="navigation">
          <a href="ao-phoi-ren-thoi-trang-167.html#" class="prev prev-navigation inactive" data-jcarouselcontrol="true">‹
          </a>
          <a href="ao-phoi-ren-thoi-trang-167.html#" class="next next-navigation" data-jcarouselcontrol="true">›
          </a>
          <div class="carousel carousel-navigation" data-jcarousel="true">
            <ul>
              <?php foreach ($info_item_product['list_image'] as $key => $value) { ?>
                <li  data-jcarouselcontrol="true" >
                  <img  class="img mag" src="<?php echo base_url() ;?>uploads/thumb/thumb75x60_<?php echo $value?>" alt="">
                </li>
              <?php }?>
            </ul>
          </div>
        </div>
      </div>
      <div class="info-box"  id="previewzoom">
        <div id="previewzoomDiv">
        </div>
        <div class="title-box">
          <h1 class="title"><?php echo $info_item_product['name']?>
          </h1>
          <span class="sku" id="code-product">Mã SP - <?php echo $info_item_product['code']?>
          </span>
        </div>
        <div class="inner <?php if($info_item_product['quantity'] == 0){echo 'soldout' ;} ?>">
          <div class="price-block">
            <span class="price"><?php if($info_item_product['price_sell_new'] != 0){echo number_format($info_item_product['price_sell_new']) ;}else{echo number_format($info_item_product['price_sell_old']) ;} ;?>đ
            </span>
            <span class="has-order-cart">Bạn đã thêm sản phẩm này vào giỏ hàng
            </span>
          </div>
          <div class="desc">
            <div class="top">
              <div class="material">
                <span>Chất liệu: 
                </span>                             
              </div>
              <div class="location">
                <span>Xuất xứ: 
                </span> <?php echo $info_item_product['origin'] ;?>                          
              </div>
            </div>
            <div class="sapo"><?php echo $info_item_product['material'] ;?> 
            </div>
          </div>
          <div class="properties">
            <form id="add-cart" action="../index.php" method="post" class="update-cart add-to-cart">
              <div class="p-row">
                <h3>
                  Size                                                                    
                </h3>
                <ul class="pp-list size">
                    <?php foreach ($info_item_product['size'] as $key => $value) { ?>
                      <li class="only">
                      <a href="javascript:void(0)" data-size="<?php echo $value ;?>"><?php echo $value ;?> </a>
                      </li>
                    <?php } ?>
                </ul>
              </div>
              <div class="p-row">
                <h3>Màu
                </h3>
                <ul class="pp-list color">
                  <?php foreach ($info_item_product['color'] as $key => $value) { ?>
                      <li class="only">
                        <a href="javascript:void(0)" style="background-color: <?php echo $value ;?>" data-color="<?php echo $value ;?>"></a>
                      </li>
                   <?php } ?>
                </ul>
              </div>
              <div class="p-row">
                <h3>Số lượng
                </h3>
                <div class="add2cart-frm">
                  <span class="qty">
                    <button class="l-btn" type="button">-
                    </button>
                    <input type="text" name="quantity" value="1">
                    <button class="r-btn" type="button">+
                    </button>
                  </span>
                </div>
              </div>
              <input type="hidden" name="size_id">
              <input type="hidden" name="color_id">
              <input type="hidden" name="product_id" value="<?php echo $info_item_product['id'] ;?>">
            </form>
          </div>
          <div class="contact">
            <ul>
              <li>Hàng có tại: 999 Quang Trung, P. 9, Q. Gò Vấp, TP. HCM
              </li>
              <li>Gọi ngay hotline tư vấn  miễn phí :  08 8888 9999
              </li>
            </ul>
          </div>
          <div class="clearfix">
          </div>
          <div class="action-box">
            <div class="btns-block">
              <p class="add-to-cart">
                <a href="javascript:void(0)" onclick="addToCart('#add-cart')">Thêm vào giỏ
                 <!--  -->
                </a>
              </p>
              <p class="buying">
                <a href="javascript:void(0)">Mua nhanh
                </a>
              </p>
            </div>
          </div>
          <div class="soldout-message">Hết hàng
          </div>
        </div>
        <p class="success-cart">Bạn đã thêm vào giỏ thành công!
        </p>
      </div>
    </div>
    <div class="detail-tabs">
      <ul class="tab-menu clearfix" role="tablist">
        <li class="active" role="presentation">
          <a href="ao-phoi-ren-thoi-trang-167.html#if-tabmenu01" aria-controls="if-tabmenu01" role="tab" data-toggle="tab">Thông tin
          </a>
        </li>
        <li>
          <a href="javascript:void(0)" class="scroll-related-product">Sản phẩm tương tự
          </a>
        </li>
      </ul>
      <ul class="tab-content">
        <li class="active" id="if-tabmenu01" role="tabpanel">
          <div class="tc-info">
            <p>
              <?php foreach ($info_item_product['list_image'] as $key => $value) { ?>
                  <img  class="img-responsive mag" src="<?php echo base_url() ;?>uploads/<?php echo $value?>" alt="">
              <?php }?>
              <br>
            </p>                        
            <p>
              <br>
            </p>                        
            <div class="pd-desc-box clearfix <?php if($info_item_product['quantity'] == 0){echo 'soldout' ;} ?>">
              <form id="add-cart2" method="post" class="update-cart add-to-cart">
                <div class="col01">
                  <p class="txt"><?php echo $info_item_product['name'] ;?>
                  </p>
                  <div class="price-block clearfix">
                    <p class="price"><?php if($info_item_product['price_sell_new'] != 0){echo number_format($info_item_product['price_sell_new']) ;}else{echo number_format($info_item_product['price_sell_old']) ;} ;?>đ
                    </p>
                  </div>
                </div>
                <div class="col02">
                  <div class="p-row clearfix">
                    <h3>Size
                    </h3>
                    <ul class="pp-list size">
                      <?php foreach ($info_item_product['size'] as $key => $value) { ?>
                        <li class="only">
                          <a href="javascript:void(0)" data-size="<?php echo $value ;?>"><?php echo $value ;?> </a>
                        </li>
                      <?php } ?>
                    </ul>
                  </div>
                  <div class="p-row clearfix">
                    <h3>Màu
                    </h3>
                    <ul class="pp-list color">
                      <?php foreach ($info_item_product['color'] as $key => $value) { ?>
                      <li class="only">
                        <a href="javascript:void(0)" style="background-color: <?php echo $value ;?>" data-color="<?php echo $value ;?>"></a>
                      </li>
                      <?php } ?>
                    </ul>
                  </div>
                  <div class="p-row clearfix">
                    <h3>Số lượng
                    </h3>
                    <div class="add2cart-frm">
                      <span class="qty">
                        <button class="l-btn" type="button">-
                        </button>
                        <input type="text" name="quantity" value="1">
                        <button class="r-btn" type="button">+
                        </button>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col03">
                  <p class="add-to-cart">
                    <a href="javascript:void(0)" onclick="addToCart('#add-cart2')">Thêm vào giỏ
                    </a>
                  </p>
                  <p class="buying">
                    <a href="javascript:void(0)">Mua nhanh
                    </a>
                  </p>
                </div>
                <input type="hidden" name="size_id">
                <input type="hidden" name="color_id">
                <input type="hidden" name="product_id" value="<?php echo $info_item_product['id'] ;?>">
              </form>
              <div class="soldout-message">Hết hàng
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
    <!-- /detail-tabs -->
  </div>
  <div class="right-detail-info">
    <div class="step-ship-list">
      <div class="title-box">
        <p class="num">6
        </p>
        <div>Tiện ích khi mua
          <br />sắm tại maza
        </div>
      </div>
      <div class="clearfix">
      </div>
      <ul class="list1 clearfix">
        <li>
          <span class="num">1
          </span> 
          <p class="txt">Sản phẩm giống ảnh thực 100%
          </p>
        </li>
        <li>
          <span class="num">2
          </span> 
          <p class="txt">Hàng mới cập nhật liên tục
          </p>
        </li>
        <li>
          <span class="num">3
          </span> 
          <p class="txt">Giao hàng 30phút (
            <10km)
          </p>
        </li>
        <li>
          <span class="num">4
          </span> 
          <p class="txt">Thanh toán khi nhận hàng
          </p>
        </li>
        <li>
          <span class="num">5
          </span> 
          <p class="txt">Đổi trả miển phí (7 ngày)
          </p>
        </li>
        <li>
          <span class="num">6
          </span> 
          <p class="txt">Miễn phí giao hàng từ 499k
          </p>
        </li>
      </ul>

    </div>
    <div id="top-sale" class="r-list-4">
      <h2>Top sale
      </h2>
      <ul>
        <?php foreach ($list_products_sale as $key => $value) { ?>
        <li>
          <p class="pic">
            <a href="<?php echo base_url().$value['categories_namealias'].'/'.$value['products_namealias'].'-'.$value['products_id'] ;?> "">
              <?php foreach ($value['list_image'] as $key1 => $value1) { ?>
                  <img  class="img-responsive" src="<?php echo base_url() ;?>uploads/<?php echo $value1 ?>" alt="">
              <?php break ;?>    
              <?php }?>
            </a>
          </p>
          <div class="detail">
            <h2>
              <a href="<?php echo base_url().$value['categories_namealias'].'/'.$value['products_namealias'].'-'.$value['products_id'] ;?> "><?php echo $value['products_name'] ?>
              </a>
            </h2>
            <div class="price-block clearfix">
              <p class="price"><?php if($info_item_product['price_sell_new'] != 0){echo number_format($info_item_product['price_sell_new']) ;}else{echo number_format($info_item_product['price_sell_old']) ;} ;?>đ
              </p>
            </div>
          </div>
        </li>
        <?php }?>
      </ul>
    </div>
    <div id="current-product" class="r-list-4">
      <ul>
        <li class="current-product">
          <h2>SẢN PHẨM ĐANG XEM
          </h2>
          <p class="pic">
            <a href="javascript::void(0);">
              <?php foreach ($info_item_product['list_image'] as $key => $value) { ?>
                  <img  class="img-responsive mag" src="<?php echo base_url() ;?>uploads/<?php echo $value?>" alt="">
              <?php break ;?>    
              <?php }?>
            </a>
          </p>
          <div class="detail">
            <h2>
              <a href="javascript::void(0);"><?php echo $info_item_product['name']?>
              </a>
            </h2>
            <div class="price-block clearfix">
              <span class="price"><?php if($info_item_product['price_sell_new'] != 0){echo number_format($info_item_product['price_sell_new']) ;}else{echo number_format($info_item_product['price_sell_old']) ;} ;?>đ
              </span>
            </div>
          </div>
          <?php if($info_item_product['quantity'] > 0){ ?>
          <div class="tc-info">
            <div class="pd-desc-box clearfix">
              <div class="col02">
                <div class="p-row clearfix">
                  <h3>Size
                  </h3>
                  <ul class="pp-list size">
                    <li>
                       <?php foreach ($info_item_product['size'] as $key => $value) { ?>
                        <li class="only">
                        <a href="javascript:void(0)" data-size="<?php echo $value ;?>"><?php echo $value ;?> </a>
                        </li>
                      <?php } ?>
                    </li>
                  </ul>
                </div>
                <div class="p-row clearfix">
                  <h3>Màu
                  </h3>
                  <ul class="pp-list color">
                    <li>
                      <?php foreach ($info_item_product['color'] as $key => $value) { ?>
                      <li class="only">
                        <a href="javascript:void(0)" style="background-color: <?php echo $value ;?>" data-color="<?php echo $value ;?>"></a>
                      </li>
                      <?php } ?>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="btn-row clearfix">
            <input class="btn buying" type="button" name="" value="MUA NGAY">
          </div>
          <?php } ?>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="detail-tabs">
  <ul class="tab-menu clearfix" role="tablist">
    <li class="active" role="presentation">
      <a href="ao-phoi-ren-thoi-trang-167.html#if-tabmenu02" aria-controls="if-tabmenu02" role="tab" data-toggle="tab">Sản phẩm tương tự
      </a>
    </li>
  </ul>
  <ul class="tab-content">
    <li id="related-product" class="active" id="if-tabmenu02" role="tabpanel">
      <div class="item-list">
        <ul class="clearfix lp" data-list="Related product">
          <?php foreach ($list_products_lq as $key => $value) { ?>
            <li data-product_id="<?php echo $value['products_id'] ;?>" class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
              <p class="pic">
                <a href="<?php echo base_url().$value['categories_namealias'].'/'.$value['products_namealias'].'-'.$value['products_id']?>">
                  <?php foreach ($value['list_image'] as $key1 => $value1) { ?>
                    <img  class="img-responsive mag" src="<?php echo base_url() ;?>uploads/<?php echo $value1?>" alt="">
                  <?php break ;?>    
                  <?php }?>
                </a>
              </p>
              <div class="desc clearfix">
                <p class="title">
                  <a href="#"><?php echo $value['products_name'] ;?>
                  </a>
                </p>
                <div class="price-block clearfix">
                  <p class="price"><?php if($value['price_sell_new'] != 0){echo number_format($value['price_sell_new']);}else{echo number_format($value['price_sell_old']) ;} ;?>đ
                  </p>
                </div>
              </div>
            </li>
          <?php }?>
        </ul>
      </div>
    </li>
  </ul>
</div>
<!-- /detail-tabs -->
<!-- quick buy modal -->
<div class="nine_background">
  <div id="quick-buy" class="nine_modal">
    <div class="_header">
      <h1>Mua hàng nhanh
      </h1>
      <a href="javascript:void(0)" class="btn-close ruu-close-modal" >
        <i class="fa fa-close">
        </i>
      </a>
      <div class="clear"></div>
    </div>
    <div class="_content">
      <form id="form-quick-buy" action="#" class="validate form-checkout" method="post" data-call-back="cartPurchase" data-call-success="successQuickBuy" data-call-loading="loadingQuickBuy">
        <div class="_left">
          <?php foreach ($info_item_product['list_image'] as $key => $value) { ?>
              <img  class="img-responsive mag" src="<?php echo base_url() ;?>uploads/<?php echo $value?>" alt="">
          <?php break ;?>    
          <?php }?>
        </div>
        <div class="_right">
          <div class="_inner">
            <div class="title-box">
              <h2><?php echo $info_item_product['name']?>
              </h2>
              <span class="sku" id="code-product">Mã SP - <?php echo $info_item_product['code']?>
              </span>
            </div>
            <div class="checkout-info">
              <table class="cart">
                <thead>
                  <tr>
                    <th>Size
                    </th>
                    <th>Màu
                    </th>
                    <th>Số lượng
                    </th>
                    <th style="text-align: left;">Giá sản phẩm
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <span class="size">
                      </span>
                    </td>
                    <td>
                      <span class="color">
                      </span>
                    </td>
                    <td>
                      <div class="add2cart-frm">
                        <span class="qty">
                          <button class="l-btn" type="button">-
                          </button>
                          <input type="text" name="quantity" value="1">
                          <button class="r-btn" type="button">+
                          </button>
                        </span>
                      </div>
                    </td>
                    <td>
                      <div class="price-block">
                        <span class="price"><?php if($info_item_product['price_sell_new'] != 0){echo number_format($info_item_product['price_sell_new']) ;}else{echo number_format($info_item_product['price_sell_old']) ;} ;?>
                          <sup>đ
                          </sup>
                        </span>
                        <input type="hidden" class="form-control price-product" value="<?php if($info_item_product['price_sell_new'] != 0){echo $info_item_product['price_sell_new'];}else{echo $info_item_product['price_sell_old'] ;} ;?>">
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="address">
                <div class="frm-row">
                  <input type="text" name="receiver_name" class="frm-txt receiver_name" placeholder="Họ tên người nhận hàng"/>
                  <em class="message">
                  </em>
                </div>
                <div class="frm-row">
                  <div class="col2">
                    <input type="text" name="receiver_phone" class="frm-txt receiver_phone" placeholder="Số điện thoại"/>
                    <em class="message">
                    </em>
                  </div>
                  <div class="col2">
                    <input type="text" name="receiver_email" class="frm-txt receiver_email" placeholder="Email (nếu có)"/>
                    <em class="message">
                    </em>
                  </div>
                </div>
                <div class="frm-row">
                  <input type="text" name="receiver_address" class="frm-txt receiver_address" placeholder="Địa chỉ nhận hàng"/>
                  <em class="message">
                  </em>
                </div>
                <div class="frm-row">
                  <div class="col2">
                    <div class="frm-select">
                      <select class="frm-txt required receiver_city" name="receiver_city">
                        <?php foreach ($data_acreages as $key => $value) { ?>
                          <option value="<?php echo $value['id'] ;?>" <?php if($value['name'] == 'TP.HCM'){echo 'selected' ;} ?> > <?php echo $value['name'] ;?></option>
                        <?php }?>
                      </select>
                      <input type="hidden" name="zone" value="Thành Phố Hồ Chí Minh">
                      <em class="message">
                      </em>
                    </div>
                  </div>
                  <div class="col2">
                    <div class="frm-select">
                      <select class="frm-txt required receiver_district" name="receiver_district">
                      </select>
                      <input type="hidden" name="district">
                      <em class="message">
                      </em>
                    </div>
                  </div>
                </div>
                <div class="frm-row">
                  <input type="text" name="coupon" class="frm-txt" placeholder="Phiếu mua hàng"/>
                </div>
                <div class="frm-row total-buy">
                  Thành tiền: 
                  <span>
                  </span>
                </div>
              </div>
            </div>
            <div class="clearfix">
            </div>
          </div>
        </div>
        <input type="hidden" name="size_id">
        <input type="hidden" name="color_id">
        <input type="hidden" name="product_id" value="<?php echo $info_item_product['id'] ;?>">
      </form>
    </div>
    <div class="clearfix">
    </div>
    <div class="_footer">
      <button type="button" class="btn btn-order-product">Đặt hàng
      </button>
    </div>
    <div class="promotion">
      <div class="promotion-content">
        <h3>Thời gian giao hàng:
        </h3>
        <p>&squarf; Trong vòng 24h tại TP.HCM & 3-5 ngày với các tỉnh/thành phố khác
        </p>
        <p style="font-style: italic;">&squarf; Miễn phí giao hàng với đơn hàng trên 500.000đ (TP. HCM)
        </p>
      </div>
      <div class="clearfix">
      </div>
    </div>
  </div>
</div>
<style>
  #previewzoomDiv {
    height: 400px;
    width : 300px;
    position: absolute;
  }
</style>
<?php /*?>
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
            <a href="#">Áo Thun Nam Tay Dài Phối Túi Thời Trang
            </a>
          </p>
          <div class="price-block clearfix">
            <p class="price">185,000đ
            </p>
          </div>
        </div>
      </li>
      <li>
        <p class="pic">
          <a href="#">
            <img src="<?php echo base_url() ;?>/library_add/home/image/img_product/product_1.jpg">
          </a>
        </p>
        <div class="desc clearfix">
          <p class="title">
            <a href="#">Áo Thun Nam Xanh Dương Phối Vai
            </a>
          </p>
          <div class="price-block clearfix">
            <p class="price">180,000đ
            </p>
          </div>
        </div>
      </li>
    </ul>
  </div>
  <a href="ao-phoi-ren-thoi-trang-167.html#" class="jcarousel-control-prev" data-jcarouselcontrol="true">‹
  </a>
  <a href="ao-phoi-ren-thoi-trang-167.html#" class="jcarousel-control-next" data-jcarouselcontrol="true">›
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
