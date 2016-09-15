<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo $info_default['title']?></title>
    <meta name="description" content="MAZA">
    <meta name="keywords" content="MAZA"/>
    <!-- Block CSS Page -->
    <?php $this->load->view($info_default['css_subview']) ;?>
    
  </head>
  <body>
    <div id="fb-root">
    </div>
    <?php $this->load->view('contents/header_layout') ;?>
    <section class="wrapper">
      <div class="container">
        <?php $this->load->view($info_default['contents_subview']) ;?>
      </div>
      <!--Popup Cart-->
      <div id="cart-empty-modal" class="_modal">
        <div class="_header">
          <a href="#" class="btn-close" onclick="$('#cart-empty-modal').dialog('close');">
            <i class="fa fa-close"></i>
          </a>
        </div>
        <div class="_content clearfix">
          <div class="cart"></div>
          <h1>Giỏ hàng hiện tại của bạn đang trống</h1>
          <p>Hãy nhanh tay sở hữu những sản phẩm thời trang và phụ kiện mới cập nhật nào !</p>
          <div class="link">
            <ul>
              <li><a href="#">Thời trang nam</a></li>
              <li><a href="#">Thời trang nữ</a></li>
              <li><a href="#">Hàng hot</a></li>
              <li><a href="#">Hàng khuyến mãi</a></li>
            </ul>
          </div>
        </div>
        <div class="_footer">
          <a href="#">Về trang chủ</a>
        </div>
      </div>
      <!--END Popup Cart-->
    </section>
    <?php $this->load->view('contents/footer_layout') ;?>
    <div id="inline-error"></div>
    <div id="temp"></div>
    <!-- Block JS Page -->
    <?php $this->load->view($info_default['js_subview']) ;?>
  </body>
</html>
