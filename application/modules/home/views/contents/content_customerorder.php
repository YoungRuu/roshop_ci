<?php /* ?>
<div class="orders-filter">
  <form action="#" id="order-filter">
    <div class="f-box">
      <div class="f-row">
        <div class="frm-col">
          <p class="lb">Trạng thái
          </p>
          <div class="frm">
            <div class="frm-select">
              <select name="status">
                <option value="">Tất cả
                </option>
                <option value="1">Chưa xác nhận
                </option>
                <option value="2">Đang chuẩn bị
                </option>
                <option value="3">Đã tính tiền xong
                </option>
                <option value="5">Đã giao
                </option>
                <option value="7">Đã hủy
                </option>
                <option value="8">Sẽ đặt thêm
                </option>
                <option value="10">Chưa liên lạc được
                </option>
                <option value="13">Đã chuẩn bị xong
                </option>
                <option value="15">Chưa chuẩn bị
                </option>
                <option value="16">Exported
                </option>
              </select>
            </div>
          </div>
        </div>
        <div class="frm-col">
          <p class="lb">Ngày
          </p>
          <div class="frm">
            <div class="frm-select">
              <select name="date_type">
                <option value="">Tất cả
                </option>
                <option value="1">Ngày đặt
                </option>
                <option value="2">Ngày giao
                </option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="choose-date">
        <input class="raw choose-btn" id="e5" name="date" style="display: none;">
        <button type="button" class="comiseo-daterangepicker-triggerbutton ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-secondary comiseo-daterangepicker-bottom" id="drp_autogen0" role="button" aria-disabled="false">
          <span class="ui-button-text">Chọn ngày...
          </span>
          <span class="ui-button-icon-secondary ui-icon ui-icon-triangle-1-s">
          </span>
        </button>
      </div>
    </div>
  </form>
</div>
<?php */ ?>
<h2 class="g-title">Đơn hàng của tôi
</h2>
<div class="addr-page orders-page">
  <table id="order-content" width="100%" border="0" cellspacing="0" cellpadding="0">
    <thead>
      <tr>
        <th>
          <span>Trạng thái
          </span>
        </th>
        <th>
          <span>Mã đặt hàng
          </span>
        </th>
        <th>
          <span>Ngày đặt
          </span>
        </th>
        <th>
          <span>Địa chỉ
          </span>
        </th>
      </tr>
    </thead>
    <tbody> 
      <?php $sum_price = 0 ;?>
      <?php foreach($info_orders_customer['data_orders'] as $key => $value) {?>           
      <tr class="pending">
        <td>
          <?php if($value['orders_status'] == '0'){echo 'Chờ xử lý' ;}
           else if($value['orders_status'] == '1'){echo 'Đang giao hàng' ;}
              else{echo 'Hoàn tất' ;}?>     
        </td>
        <td>#<?php echo $value['orders_code'] ;?>
        </td>
        <td><?php echo date('d-m-Y',$value['orders_created']) ;?>
        </td>
        <td>
          <div class="address">
            <?php echo $value['orders_receiveraddress'] ;?>
            </br>
            <hr/>
             <?php echo $value['acreages_cityname'] ;?> - <?php echo $value['acreages_districtname'] ;?>
          </div>
          <div class="func">
            <!-- <a onclick="toggleProduct(this)" class="btn order-item-view">Hiện</a> -->
            <a href="javascript:void(0)" class="btn order-item-view btn-hide-show-collap" data-collapse-id="<?php echo $value['orders_id']?>">Hiện</a>
          </div>
        </td>
      </tr>
        <?php foreach($info_orders_customer['list_item_orders'] as $key1 => $value1) {?>
          <?php if($value['orders_id'] == $value1['ordersitem_ordersid']) {?>
          <tr class="order-items-detail item_list_<?php echo $value1['ordersitem_ordersid']?>" >
            <td colspan="5">
              <table>
                <tbody>
                  <tr>
                    <td class="thumb">
                      <p class="picture">
                        <a href="<?php echo base_url().'danh-muc/'.$value1['products_namealias'].'-'.$value1['products_id']?>" title="Quần Short Nam Phối Màu " target="_blank">
                          <img src="<?php echo base_url().$value1['list_image'][0]?>" alt="<?php echo $value1['products_name']?>">
                        </a>
                      </p>
                    </td>
                    <td colspan="2" class="title">
                      <a href="<?php echo base_url().'danh-muc/'.$value1['products_namealias'].'-'.$value1['products_id']?>" title="<?php echo $value1['products_name']?>" target="_blank">
                        <?php echo $value1['products_name']?>
                       </a>
                      <div class="size-color">
                        <span class="size"><?php echo $value1['ordersitem_size'] ;?>
                        </span>
                        <span class="color" style="background-color: <?php echo $value1['ordersitem_color'] ;?>">
                        </span>
                      </div>
                    </td>
                    <td class="price"><?php echo number_format($value1['ordersitem_price']).'đ' ;?> × <?php echo $value1['ordersitem_products_quantity']?>
                    </td>
                    <td class="sum-price"><?php echo number_format($value1['ordersitem_price']*$value1['ordersitem_products_quantity']).'đ' ;?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
          <?php } ?>
        <?php } ?>
      <?php } ?>
    </tbody>
  </table>
  <div id="order-pagination" class="btn-row">
  </div>
</div>
