<div class="top-title-cate clearfix">
  <div class="breadcrumb">
    <ul class="clearfix">
      <?php foreach ($info_cate_product['breadcrumb'] as $key => $value) { ?>
        <li>
          <a href="<?php echo $value['link'] ;?>"><?php echo $value['name'] ;?></a> 
        </li>
      <?php }?>
    </ul>           
  </div>
  <!-- /breadcrumb -->
  <!-- /breadcrumb -->
  <div class="sub-item">
  </div>
</div>
<div class="arrange-block clearfix filter-block">
  <div class="row">
    <div id="sort-product" class="col col01">
      <h2>Sắp xếp theo:
      </h2>
      <ul class="btns-list style1 clearfix">
        <li class="active">
          <a href="javascript:void(0)" class="onChangeAjax" data-onchange-href="/ao-khoac-nam/?ajax=1">Tên A-Z
          </a>
        </li>
        <li >
          <a href="javascript:void(0)" class="onChangeAjax" data-onchange-href="/ao-khoac-nam/?ajax=1&sort=price&order=desc">Giá 
            <span class="arrow">
            </span>
          </a>
        </li>
        <li >
          <a href="javascript:void(0)" class="onChangeAjax" data-onchange-href="/ao-khoac-nam/?ajax=1&sort=ordered_weekly&order=desc">Bán chạy
          </a>
        </li>
      </ul>    
    </div>
    <div id="filter-size" class="col col02">
      <h2>Size
      </h2>
      <ul class="btns-list style2 clearfix">
        <li >
          <a href="javascript:void(0)" data-onchange-href="/ao-khoac-nam/?ajax=1&size_id=5" class="onChangeAjax">Free 
          </a>
        </li>
        <li >
          <a href="javascript:void(0)" data-onchange-href="/ao-khoac-nam/?ajax=1&size_id=3" class="onChangeAjax">L
          </a>
        </li>
        <li >
          <a href="javascript:void(0)" data-onchange-href="/ao-khoac-nam/?ajax=1&size_id=2" class="onChangeAjax">M
          </a>
        </li>
      </ul>
    </div>
    <div id="filter-material" class="col col03">
      <h2>Chất liệu
      </h2>
    </div>
    <div id="filter-style" class="col col04">
      <h2>Kiểu dáng
      </h2>
    </div>
    <div class="col col05">
      <h2>Giá 
        <span>(K = 1,000
          <sup>vnđ
          </sup>)
        </span>
      </h2>
      <div class="price-choose">
        <div id="maza-slider" data-onchange-href="/ao-khoac-nam/?ajax=1">
        </div>
        <div class="price-view">
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /arrange-block -->
<div class="cate-title-block clearfix">
  <h1 class="title">
    <a href="/<?php echo $type_data_products_alias ;?>"><?php echo $type_data_products ;?>
    </a>
  </h1>
  <div id="pagination" class="clearfix">
    <?php echo $pagination ;?>
  </div>
</div>
<!-- /cate-introduce -->
<div id="content-product" class="item-list">
  <ul class="clearfix lp" data-list='Áo Khoác Nam 1'>
    <?php if(count($data_products) > 0) {?>
      <?php foreach ($data_products as $key => $value) { ?>
      <li data-product_id="<?php echo $value['products_id'] ?>" class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
        <p class="pic">
          <a href="/<?php echo $value['categories_namealias'];?>/<?php echo $value['products_namealias'];?>-<?php echo $value['products_id'] ;?> ">
            <?php foreach ($value['list_image'] as $key1 => $value1) {?>
              <img src="<?php echo base_url() ;?>uploads/thumb/thumb300x400_<?php echo $value1 ;?>">
            <?php break ;?>
            <?php } ?>
          </a>
        </p>
        <div class="desc clearfix">
          <p class="title">
            <a href="/<?php echo $value['categories_namealias'];?>/<?php echo $value['products_namealias'];?>-<?php echo $value['products_id'] ;?> "><?php echo $value['products_name'] ?>
            </a>
          </p>
          <div class="price-block clearfix">
            <p class="price"><?php if($value['price_sell_new'] != 0){echo number_format($value['price_sell_new']) ;}else{echo number_format($value['price_sell_old']) ;} ;?>đ
            </p>
          </div>
        </div>
      </li>  
      <?php } ?>          
    <?php }else{ ?> 
      Không có sản phẩm nào
    <?php } ?>          
  </ul>
</div>
<div id="pagination" class="clearfix">
  <?php echo $pagination ;?>
</div>
<!-- /item-list -->
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
