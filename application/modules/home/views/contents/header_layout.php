<header id="header" class="header">
  <div class="line-block">
  </div>
  <div class="tophead">
    <div class="container">
      <h1 class="logo">
        <a href="/">
          <img src="<?php echo base_url() ;?>library_add/home/static/images/logo/logo.png">
        </a>
      </h1>
      <div class="rb">
        <ul>
          <li class="shopping-cart-menu shopping-cart <?php if($this->cart->total_items() > 0){echo 'has-item' ;}?>">
            <a class="cart-shopping-box" href="<?php echo base_url()?>thong-tin-gio-hang">
              <div class="shoppingcart-btn">
                <span class="num num-item"><?php echo count($this->data_cart); ?>
                </span>
              </div>
              Giỏ hàng                      
            </a>
            <div class="cart-shopping-dropdown">
              <div class="item-list-s2">
                <div class="description-scroll">
                    <div class="scrollbar disable" style="height: 422px;">
                      <div class="track" style="height: 422px;">
                        <div class="thumb" style="top: 0px; height: 422px;">
                          <div class="end">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="viewport">
                      <div class="overview" style="top: 0px;">
                        <ul class="cart-item-list clearfix cart-product on-header">  
                          <?php foreach ($this->data_cart as $key => $value) { ?>
                          <li class="item_id" data-rowid="<?php echo $value['rowid'] ?>">
                            <a class="close-btn-new remove" href="javascript:void(0)" title="<?php echo $value['name'] ?>">
                              <i class="fa fa-remove">
                              </i>
                            </a>
                            <p class="pic">
                              <a href="<?php echo $value['options']['op_link'] ?>">
                                <img src="<?php echo $value['options']['op_img'] ?>">
                              </a>
                            </p>
                            <div class="desc">
                              <p class="title">
                                <a href="<?php echo $value['options']['op_link'] ?>">
                                <?php echo $value['name'] ?>
                                </a>
                              </p>
                              <div class="p-row size">
                                <h3>Size
                                </h3>
                                <span class="money"><?php echo $value['options']['op_size'] ?>
                                </span>
                              </div>
                              <div class="p-row color">
                                <h3>Màu
                                </h3>
                                <span class="color" style="background-color: <?php echo $value['options']['op_color'] ?>">
                                </span>
                              </div>
                              <div class="p-row price">
                                <h3>Giá
                                </h3>
                                <span class="money"><?php echo number_format($value['price']) ?>đ
                                </span>
                              </div>
                              <div class="p-row amount">
                                <h3>Số lượng
                                </h3>
                                <form action="#" method="post" class="update-cart">
                                  <div class="add2cart-frm">
                                    <span class="qty-giohang">
                                      <button class="l-btn" type="button">-
                                      </button>
                                      <input type="text" name="quantity" value="<?php echo $value['qty'] ;?>" data-price="<?php echo $value['price'] ;?>" data-cartid="<?php echo $value['id'] ;?>" data-rowid="<?php echo $value['rowid'] ;?>" readonly="">
                                      <button class="r-btn" type="button">+
                                      </button>
                                    </span>
                                  </div>
                                  <input type="hidden" name="size_id" value="<?php echo $value['options']['op_size'];?>">
                                  <input type="hidden" name="color_id" value="<?php echo $value['options']['op_color'];?>">
                                </form>
                              </div>
                            </div>
                          </li>
                          <?php }?>
                        </ul>
                      </div>
                    </div>
                  </div>

              </div>
              <div class="sum-price-box">
                <p class="lb">Tổng
                </p>
                <p class="price"><?php echo number_format($this->cart->total())?>đ
                </p>
              </div>
              <div class="clearfix">
              </div>
              <div class="btn-row btn-row-full">
                <!-- <p><a class="btn" href="/checkout">Giỏ hàng</a></p> -->
                <p>
                  <a class="btn s2" href="<?php echo base_url()?>thong-tin-gio-hang">Đặt hàng
                  </a>
                </p>
              </div>
            </div>
          </li>
          <li class="login">
            <?php if($this->auth != '') { ?>
              <a href="#" class="login-lnk"><?php echo $this->auth['username'] ;?></a>
              <div class="login-box-dropdown logged">
              <ul class="lnks-list">
                <li><a rel="nofollow" href="/khach-hang/tai-khoan">Thông tin tài khoản</a></li>
                <li><a rel="nofollow" href="/khach-hang/don-dat-hang">Theo dõi đơn hàng</a></li>
                <li><a rel="nofollow" href="<?php echo base_url().'dang-xuat'?>">Đăng xuất</a></li>
              </ul>
            <?php }else{ ?>
              <a href="#" class="login-lnk">Đăng nhập</a>
              <div class="login-box-dropdown">
               <div class="welcome"> Chào mừng đến với Roshop.vn</div>
                  <div class="frm-box">
                    <form action="<?php echo base_url().'dang-nhap'?>" method="post">
                      <div class="frm-row">
                        <input class="frm-txt" type="text" name="username" placeholder="Tài khoản">
                      </div>
                      <div class="frm-row">
                        <input class="frm-txt" type="password" name="password" placeholder="Mật khẩu">
                      </div>
                      <div class="btn-row clearfix">
                        <div class="lnk">
                          <a href="/quen-mat-khau">Quên mật khẩu
                          </a>
                        </div>
                        <div class="btn">
                          <input class="login-btn" type="submit" value="Đăng nhập">
                        </div>
                      </div>
                    </form>
                  </div> 
                  <div class="lnk-row">
                    <span>Chưa có tài khoản?
                    </span>
                    <a href="/khach-hang/dang-ky">Đăng kí
                    </a>
                  </div>
                </div>
            <?php } ?>
          </li>
        </ul>
        <div class="phone">
          <p class="txt1">08 6254 9999
          </p>
          <p class="txt2">t2-t7 / 8:00 - 18:00
          </p>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('menu_layout') ;?>
</header>
<!-- /header --> 
