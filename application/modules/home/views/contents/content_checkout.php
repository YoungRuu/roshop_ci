<div class="container">
  <div class="top-title-cate clearfix">
    <div class="breadcrumb">
      <ul class="clearfix">
        <li>
          <a href="/">Trang chủ
          </a> 
        </li>
        <li>
          Thông tin giỏ hàng        
        </li>
      </ul>           
    </div>
    <!-- /breadcrumb -->
  </div>
  <div class="shopping-cart-page">
    <h2 class="sc-title">Thông tin giao hàng
    </h2>
    <div class="sc-content clearfix">
      <div class="l-col">
        <div class="col-md-12 border">
          <div class="col-md-12 nopadding">
            <div class="checkout-address">
              <div class="frm-box">
                <form id="form_checkout" action="" method="post" class="validate form-checkout" data-call-back="cartPurchase" data-call-loading="callLoadingCheckout">
                  <div class="detail-tabs">
                    <h2 class="headertext">Địa chỉ giao hàng
                    </h2>
                    
                    <div class="sc-new-address active" id="sc-tabmenu02">
                      <div class="frm-row clearfix">
                        <div class="frm">
                          <input class="frm-txt receiver_name" type="text" name="receiver_name" placeholder="Họ tên người nhận" value="<?php if($this->auth){echo $this->auth['fullname'] ;}?>">
                          <em class="message">
                          </em>
                        </div>
                      </div>
                      <div class="col2 frm-row clearfix">
                        <div class="col2 frm">
                          <input class="frm-txt receiver_phone" type="text" name="receiver_phone" placeholder="Số điện thoại" value="<?php if($this->auth){echo $this->auth['phone'] ;}?>">
                          <em class="message">
                          </em>
                        </div>
                        <div class="col2 frm">
                          <input class="frm-txt receiver_email" type="text" name="receiver_email" placeholder="Email (nếu có)" value="<?php if($this->auth){echo $this->auth['email'] ;}?>">
                          <em class="message">
                          </em>
                        </div>
                      </div>
                      <div class="frm-row clearfix">
                        <div class="frm">
                          <input class="frm-txt receiver_address" type="text" name="receiver_address" placeholder="Địa chỉ nhận hàng" value="<?php if($this->auth){echo $this->auth['address'] ;}?>">
                          <em class="message">
                          </em>
                        </div>
                      </div>
                      <div class="frm-row clearfix">
                        <div class="col2 frm">
                         <select class="frm-txt receiver_city" name="receiver_city">
                          <?php foreach ($data_acreages as $key => $value) {?>
                            <option value="<?php echo $value['id'] ?>" <?php if($value['name'] == 'TP.HCM'){echo 'selected' ;}?> ><?php echo $value['name'] ?></option>  
                          <?php }?>
                         </select>
                          <em class="message">
                          </em>
                        </div>
                        <div class="col2 frm">
                          <select class="frm-txt receiver_district" name="receiver_district">
                          </select>
                          <em class="message">
                          </em>
                        </div>
                      </div>
                       <div class="frm-row clearfix">
                          <div class="frm">
                            <textarea class="frm-txt receiver_note"  name="receiver_note" placeholder="Nội dung ghi chú" value="<?php if($this->auth){echo $this->auth['address'] ;}?>"></textarea>
                          </div>
                        </div>
                      <?php if($this->auth){ ?>
                        <div class="error">
                          <em class="message"> Những thông tin bên trên được lấy dựa theo tài khoản của bạn</em> 
                          <em class="message"> Nếu có thay đổi vui lòng nhập mới</em> 
                        </div>
                        <?php } ?>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <?php /* ?>
          <div class="col-md-5">
            <div class="sc-login">
              <h2 class="headertext">Đăng nhập
              </h2>
              <div class="">
                <div class="frm-box">
                  <form action="http://maza.vn/customer/login" method="post">
                    <div class="frm-row">
                      <input class="frm-txt" type="text" name="email" placeholder="Email">
                    </div>
                    <div class="frm-row">
                      <input class="frm-txt" type="password" name="password" placeholder="Mật khẩu">
                    </div>
                    <div class="btn-row clearfix">
                      <div class="btn">
                        <input class="black-btn" type="submit" value="Đăng nhập">
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col-md-12">
                  <a href="http://maza.vn/customer/forgotten" class="pull-right fogottenpass-text">Quên tài khoản ?
                  </a>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <span style="line-height: 18px;">Đăng nhập nhanh bằng tài khoản
                    </span>
                  </div>
                  <div class="col-md-6">
                    <div class="pull-right padding3">
                      <a class="s-btn gm-btn social-btn-small" href="#">
                        <span class="ico ico-noborder">
                        </span>                             
                      </a>
                    </div>
                    <div class="pull-right padding3">
                      <a class="s-btn fb-btn social-btn-small" href="#">
                        <span class="ico ico-noborder">
                        </span>                             
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php */ ?>
        </div>                        
        <div class="clearfix">
        </div>
        <div class="promotion">
          <div class="promotion-content">
            <h3>Thời gian giao hàng:
            </h3>
            <p>▪ Trong vòng 24h tại TP.HCM &amp; 3-5 ngày với các tỉnh/thành phố khác
            </p>
            <p style="font-style: italic;">▪ Miễn phí giao hàng với đơn hàng trên 500.000đ (TP
              .HCM)
            </p>
          </div>
          <div class="clearfix">
          </div>
        </div>
        <h2 class="sc-title">Thông tin giỏ hàng 
          <span style="color:#39B54A;">(CÓ 
            <span id="product_amout"><?php echo count($this->cart->contents()) ;?>
            </span> SẢN PHẨM)
          </span>
        </h2>
        <ul class="sc-item-list cart-product  box-item-giohang" data-total="" data-free-delivery="0">
          <?php foreach ($this->data_cart as $key => $value) { ?>
            <li class="clearfix" data-rowid="<?php echo $value['rowid'] ;?>">
            <a href="javascript:void(0)" class="remove-item-btn">
            </a>
            <p class="pic">
              <a href="<?php echo $value['options']['op_link'] ;?>">
                <img src="<?php echo $value['options']['op_img'] ;?>">
              </a>
            </p>
            <div class="detail">
              <div class="col-md-12 nopadding">
                <div class="col-md-8 width-60-pt nopadding">
                  <div class="title-box">
                    <h2>
                      <a href="<?php echo $value['options']['op_link'] ;?>"><?php echo $value['name'] ;?>
                      </a>
                    </h2>
                  </div>
                </div>
                <div class="col-md-4 width-40-pt nopadding">
                  <span class="sku"><?php echo $value['options']['op_code'] ;?>
                  </span>
                </div>
                <div class="clearfix">
                </div>
              </div>
              <div class="col-md-12 nopadding">
                <div class="col-md-9 nopadding">
                  <div class="desc clearfix border-top">
                    <form action="#" method="post" class="update-cart update-cart-id-526">
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
                              <span class="size" style="width: auto;min-width: 22px;"><?php echo $value['options']['op_size'] ;?>
                              </span>
                            </td>
                            <td>
                              <span class="color" style="background-color:<?php echo $value['options']['op_color'] ;?>">
                              </span>
                            </td>
                            <td>
                              <div class="add2cart-frm">
                                <span class="qty-giohang">
                                  <button class="l-btn" type="button">-
                                  </button>
                                  <input type="text" name="quantity" value="<?php echo $value['qty'] ;?>" data-price="<?php echo $value['price'] ;?>" data-cartid="<?php echo $value['id'] ;?>" data-rowid="<?php echo $value['rowid'] ;?>" readonly="">
                                  <button class="r-btn" type="button">+
                                  </button>
                                </span>
                              </div>
                            </td>
                            <td style="text-align: left;">
                              <span class="text-price"><?php echo number_format($value['price']) ;?>đ
                              </span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <input type="hidden" name="product_id" value="<?php echo $value['id'] ;?>">
                      <input type="hidden" name="size_id" value="<?php echo $value['options']['op_size'] ;?>">
                      <input type="hidden" name="color_id" value="<?php echo $value['options']['op_color'] ;?>">
                    </form>
                  </div>
                </div>
                <div class="col-md-3 nopadding">
                  <div class="desc clearfix">
                    <table class="cart">
                      <thead>
                        <tr>
                          <th style="text-align: right;">Thành tiền
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td style="text-align: right;">
                            <span class="text-price product-price-total"><?php echo number_format($value['subtotal']) ;?>đ
                            </span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <?php }?>
        </ul>
      </div>
      <div class="r-col" id="checkout_right_col">
        <div class="frm-box">
          <div class="frm-row sum price-block clearfix">
            <div class="frm-row inner-addon right-addon">
              <input class="frm-txt go-background" type="text" name="coupon" placeholder="Mã Khuyến Mãi">
              <i class="pointer-ico-right">
              </i>
            </div>
          </div>
          <div class="frm-row sum price-block clearfix">
            <ul class="ul-checkout ul-checkout-right">
              <?php foreach ($this->data_cart as $key => $value) { ?>
              <li class="checkout-cart-id" data-rowid="<?php echo $value['rowid'] ;?>">
                <span class="checkout-left-row">
                  <?php echo $value['name'] ;?> x 
                  <span class="quantity"><?php echo $value['qty'] ;?>
                  </span>
                </span>
                <span class="checkout-right-row">
                  <?php echo number_format($value['price']) ;?>đ                           
                </span>
                <div class="clearfix"></div>
              </li>
              <?php } ?>
            </ul>
            <div class="clearfix">
            </div>
          </div>
          <div class="frm-row sum price-block clearfix bordertop">
            <h2>Phí vận chuyển
            </h2>
            <h2 class="pull-right shipping_fee">
            </h2>
          </div>
          <div class="frm-row sum price-block clearfix bordertop">
            <div class="clearfix">
            </div>
            <h2>Tạm Tính
            </h2>
            <p class="total total-money-page"><?php echo number_format($this->cart->total())?>đ
            </p>
          </div>
          <div class="btn-row clearfix" style="margin-top: 10px;">
            <button class="black-btn btn-order-product-multi" type="button">Đặt hàng
            </button>
          </div>
          <div class="btn-row clearfix">
            <a class="btn" href="/">Tiếp tục mua sắm
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix">
    </div>
  </div>
  <div class="modal fade confirm-pop" id="del-item-confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <p>Bạn có chắc chắn muốn xóa sản phẩm này trong giỏ hàng không?
          </p>
          <div class="btn-row">
            <ul>
              <li class="item_id" data-rowid="">
                <a href="javascript:void(0)" class="btn btn-access-remove" onclick="cartRemoveitem_page(this);">Có</a>
                <a href="javascript:void(0)" class="btn" data-dismiss="modal" aria-label="Close">Không</a>
              </li>
            </ul>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- cart-empty-poup modal -->
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
</div>
