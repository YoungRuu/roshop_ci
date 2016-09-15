<div class="top-title-cate clearfix">
  <div class="breadcrumb">
    <ul class="clearfix">
      <li>
        <a href="http://maza.vn/">Trang chủ
        </a> 
      </li>
      <li>
        Tìm kiếm: ""        
      </li>
    </ul>           
  </div>
  <!-- /breadcrumb -->
  <div class="sub-item">313 Sản phẩm
  </div>
</div>
<div class="arrange-block clearfix filter-block">
  <div class="row">
    <div id="filter-category" class="col col01">
      <h2>Tất cả danh mục
      </h2>
      <ul class="btns-list style3 clearfix">
        <li >
          <a href="javascript:void(0)" data-onchange-href="/search/?ajax=1&category_id=4" class="onChangeAjax">Áo Khoác Nam (6)
          </a>
        </li>
      </ul>
    </div>
    <div id="filter-size" class="col col02">
      <h2>Size
      </h2>
      <ul class="btns-list style2 clearfix">
        <li >
          <a href="javascript:void(0)" data-onchange-href="/search/?ajax=1&size_id=7" class="onChangeAjax">27
          </a>
        </li>
      </ul>
    </div>
    <div id="filter-material" class="col col03">
      <h2>Chất liệu
      </h2>
      <ul class="btns-list style3 clearfix">
        <li >
          <a href="javascript:void(0)" data-onchange-href="/search/?ajax=1&material_id=2" class="onChangeAjax">Cotton (1)
          </a>
        </li>
        <li >
          <a href="javascript:void(0)" data-onchange-href="/search/?ajax=1&material_id=1" class="onChangeAjax">Kaki (1)
          </a>
        </li>
      </ul>
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
        <div id="maza-slider" data-onchange-href="/search/?ajax=1">
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
    <a href="search.html#">Tìm kiếm: ""
    </a>
  </h1>
  <div id="pagination" class="edit-padding">
    <?php echo $pagination ;?>
  </div>
</div>
<div id="content-product" class="item-list">
  <ul class="clearfix lp" data-list='Tìm kiếm: "" 1'>
    <?php if(count($data_products) > 0 ) { ?>
      <?php foreach ($data_products as $key => $value) {?>
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
              <p class="price"><?php if($value['price_sell_new'] != 0){echo number_format($value['price_sell_new']) ;}else{echo number_format($value['price_sell_old']) ;} ;?>đ
              </p>
            </div>
          </div>
        </li>
      <?php }?>
    <?php }else{ ?>
      Không tìm thấy kết quả
    <?php } ?>       
  </ul>

</div>
  <div id="pagination" class="clearfix" style="margin-bottom: 30px;">
    <?php echo $pagination ;?>
  </div>


