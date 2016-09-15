<div class="mainhead">
  <div class="container">
    <ul class="topmenu active-topmenu">
      <li>
        <a href="<?php echo base_url() ?>" class="">Trang chủ</a>
      </li>
      <?php foreach ($info_default['get_menu'] as $key => $value) {?>
        <?php if($value['parent_id'] == 0) { ?>
        <li>
          <a href="<?php echo base_url().$value['name_alias'] ?>" class=""><?php echo $value['name'] ?></a>
          <div class="menu-dropdown">
            <div class="mdd-box">
              <div class="sub-menu">
                <ul class="sub-menu-2">
                  <?foreach ($info_default['get_menu'] as $key1 => $value1) {?>
                    <?php if($value1['parent_id'] != 0 && $value1['parent_id'] == $value['id']) { ?>
                    <li >
                      <a href="<?php echo base_url().$value1['name_alias'] ;?>"> <?php echo $value1['name'] ;?>
                      </a>
                    </li>
                    <?php } ?>
                  <?php } ?>
                </ul>
              </div>
              <div class="product-list-menu">
                <div class="pl-row clearfix">
                  <h2>Bán Chạy
                  </h2>
                  <a href="thoi-trang-nam/thoi-trang-nam.html">Xem tất cả
                  </a>
                </div>
                <ul class="clearfix">
                  <?php if(!empty($value['products_bestsell'])) { ?>
                  <?php foreach ($value['products_bestsell'] as $k_best => $v_nest) { ?>
                    <li>
                      <p class="pic">
                        <a href="<?php echo base_url().$v_nest['categories_namealias'].'/'.$v_nest['products_namealias'].'-'.$v_nest['products_id'] ;?> ">
                          <?php foreach ($v_nest['list_image'] as $k_img => $v_img) {?>
                            <img src="<?php echo base_url() ;?>uploads/thumb/thumb300x400_<?php echo $v_img ;?>">
                            <?php break ;?>
                          <?php }?>
                        </a>
                      </p>
                      <div class="detail">
                        <h2>
                          <a href="<?php echo base_url().$v_nest['categories_namealias'].'/'.$v_nest['products_namealias'].'-'.$v_nest['products_id'] ;?> "><?php echo $v_nest['products_name'] ;?>
                          </a>
                        </h2>
                        <div class="price-block clearfix">
                          <p class="price"><?php if($v_nest['price_sell_new'] != 0){echo number_format($v_nest['price_sell_new']) ;}else{echo number_format($v_nest['price_sell_old']) ;} ;?>đ
                          </p>
                        </div>
                      </div>
                    </li>
                    <?php } ?>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
        </li>
        <?php } ?>
      <?php }?>
       <!-- <li>
        <a href="thoi-trang-nu/thoi-trang-nu.html" class="">Nữ</a>
        <div class="menu-dropdown">
          <div class="mdd-box">
            <div class="sub-menu">
              <ul class="sub-menu-2">
                <li >
                  <a href="/ao-khoac-nu/">Áo Khoác Nữ
                  </a>
                </li>
                <li >
                  <a href="/ao-kieu-nu/">Áo Kiểu Nữ
                  </a>
                </ul>
              </div>
              <div class="product-list-menu">
                <div class="pl-row clearfix">
                  <h2>Bán Chạy
                  </h2>
                  <a href="thoi-trang-nu/thoi-trang-nu.html">Xem tất cả
                  </a>
                </div>
                <ul class="clearfix">
                  <li>
                    <p class="pic">
                      <a href="/vay-dam/dam-xoe-cup-nguc-phoi-soc-thoi-trang-25.html">
                        <img src="<?php echo base_url() ;?>/library_add/home/image/img_product/product_1.jpg">
                      </a>
                    </p>
                    <div class="detail">
                      <h2>
                        <a href="/vay-dam/dam-xoe-cup-nguc-phoi-soc-thoi-trang-25.html">Đầm Xòe Cúp Ngực Phối Sọc Thời Trang
                        </a>
                      </h2>
                      <div class="price-block clearfix">
                        <p class="price">369,000đ
                        </p>
                        <p class="old-price">269.000<sup>đ</sup></p>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
      </li> -->
      <li>
        <a href="<?php echo base_url().'san-pham-moi'?>" class="new">Hàng mới</a>
      </li>
      <li>
        <a href="<?php echo base_url().'khuyen-mai'?>" class="safe-off">Khuyến mãi</a>
      </li>
    </ul>
    <div class="search-box">
      <form action="/tim-kiem-san-pham" method="get">
        <input type="text" name="key" value="" placeholder="Tìm kiếm">
      </form>
    </div>
  </div>
</div>
<!-- /mainhead