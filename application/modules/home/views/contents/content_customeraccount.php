
<h2 class="g-title">Thông tin tài khoản
</h2>
<div class="">
  <?php if($this->session->flashdata('item')) {?>
     <?php $view_message = $this->session->flashdata('item') ;?>
     <div class="<?php echo $view_message['class'] ;?> message-flash">
        <strong><?php echo $view_message['message'] ;?></strong>
     </div>
  <?php } ?>
</div>
<div class="account-page">
  <div class="ac-info-row">
    <div class="ac-info-box">
      <div class="ac-box">
        <div class="title">
          <div class="r-btn">
            <!-- <a href="javascript:void(0)" class="t-btn change-pass-btn">Đổi mật khẩu</a> -->
            <div class="frm-box change-pass-frm">
              <form action="<?php echo base_url()?>khach-hang/cap-nhat-mat-khau" id="change_pw" class="ajax validate" method="post">
                <div class="frm clearfix">
                  <div class="col col2">
                    <h3>Mật khẩu mới
                    </h3>
                    <input id="e_pw_new" class="frm-txt required" type="password" name="password">
                    <em class="message">
                    </em>
                  </div>
                  <div class="col col2">
                    <h3>Xác nhận mật khẩu
                    </h3>
                    <input id="e_pw_new_c" class="frm-txt required" type="password" name="confirm">
                    <em class="message">
                    </em>
                  </div>
                </div>
                <div class="frm clearfix">
                  <div class="col col2">
                    <h3>Mật khẩu cũ
                    </h3>
                    <input id="e_pw_old" class="frm-txt required" type="password" name="password_old">
                    <em class="message">
                    </em>
                  </div>
                  <div class="col col2 btns-row">
                    <input class="btns" type="submit" name="" value="Đổi mật khẩu">
                    <input class="btns cancel" type="button" value="Hủy">
                  </div>
                </div>
              </form>
            </div>
            <div class="frm-box edit-info-frm">
              <form id="edit_info" class="ajax validate" method="post" action="<?php echo base_url()?>khach-hang/cap-nhat-thong-tin-tai-khoan">
                <div class="frm clearfix">
                  <div class="col col2">
                    <h3>Tên đầy đủ
                    </h3>
                    <input class="frm-txt required" type="text" name="fullname" value="<?php echo $info_user['fullname'] ?>">
                    <em class="message">
                    </em>
                  </div>
                  <div class="col col2">
                    <h3>Điện thoại
                    </h3>
                    <input class="frm-txt required" type="text" name="phone" value="<?php echo $info_user['phone'] ?>">
                    <em class="message">
                    </em>
                  </div>
                </div>
                <div class="frm clearfix">
                  <div class="col col2">
                    <h3>Ngày sinh
                    </h3>
                    <fieldset class="birthday-picker">
                      <div class="frm-child birthdaypicker">
                         <input class="frm-txt required " id="birthday_account" type="text" name="birthday" value="<?php echo date('d-m-Y',$info_user['birthday']) ?>" >
                      </div>
                    </fieldset>
                  </div>
                  <div class="col col2">
                    <h3>Email
                    </h3>
                    <input class="frm-txt" type="text" name="email" value="<?php echo $info_user['email'] ?>" >
                  </div>
                </div>
                <div class="frm clearfix">
                  <div class="col-max">
                    <h3>Địa chỉ
                    </h3>
                    <fieldset class="">
                      <div class="frm-child">
                         <input class="frm-txt required" type="text" name="address" value="<?php echo $info_user['address'] ?>" >
                      </div>
                    </fieldset>
                  </div>
                </div>
                <div class="btns-row clearfix">
                  <input class="btns" type="submit" value="Lưu">
                  <input class="btns cancel" type="button" value="Hủy">
                </div>
              </form>
            </div>
          </div>
          <h6>Thông tin cá nhân
          </h6>
        </div>
        <div class="info">
          <table>
            <tbody>
              <tr>
                <td>Tên đầy đủ
                </td>
                <td><?php echo $info_user['fullname'] ?>
                </td>
                <td>
                  <a href="javascript:void(0)" onclick="$('.edit-info-frm').addClass('open');">Sửa
                  </a>
                </td>
              </tr>
              <tr>
                <td>Điện thoại
                </td>
                <td colspan="2"><?php echo $info_user['phone'] ?>
                </td>
              </tr>
              <tr>
                <td>Ngày sinh
                </td>
                <td colspan="2"><?php echo date('d-m-Y',$info_user['birthday']) ?>
                </td>
              </tr>
              <tr>
                <td>Email
                </td>
                <td><?php echo $info_user['email'] ?>
                </td>
                <td>
                  <a href="javascript:void(0)" onclick="$('.change-pass-frm').addClass('open');">Đổi mật khẩu
                  </a>
                </td>
              </tr>
              <tr>
                <td>Địa chỉ
                </td>
                <td colspan="2"><?php echo $info_user['address'] ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php /* ?>
  <div class="ac-info-row address">
    <div class="ac-info-box">
      <div class="ac-box">
        <div class="title">
          <h6>Địa chỉ giao hàng
          </h6>
        </div>
        <div class="addr-page">
          <table class="addr-list" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
              <tr id="address-default-55" class="addr-curr">
                <td class="check">
                  <a onclick="defaultAddress(55)" class="check-btn">
                  </a>
                </td>
                <td>4324324, Quận 6, Thành Phố Hồ Chí Minh
                </td>
                <td>
                  <div class="func">
                    <a href="javascript:void(0)" onclick="toggleAddress(55)" class="btn-edit">Sửa
                    </a>
                    <a href="javascript:void(0)" onclick="deleteAddress(55)">Xóa
                    </a>
                  </div>
                </td>
              </tr>
              <tr id="address-form-55" class="edit-addr-frm">
                <td colspan="3">
                  <div class="addr-frm">
                    <form action="#" method="post" id="address-55">
                      <div class="frm-row">
                        <p class="lb">Địa chỉ
                        </p>
                        <div class="frm">
                          <input class="frm-txt" type="text" name="address" value="4324324" placeholder="Địa chỉ">
                        </div>
                      </div>
                      <div class="frm-row">
                        <div class="col col2">
                          <p class="lb">Tỉnh/Thành phố
                          </p>
                          <div class="frm">
                            <select class="frm-txt" name="zone_id">
                              <option value="7">An Giang
                              </option>
                            </select>
                            <input type="hidden" name="zone" value="Thành Phố Hồ Chí Minh">
                          </div>
                        </div>
                        <div class="col col2">
                          <p class="lb">Quận/Huyện
                          </p>
                          <div class="frm">
                            <select class="frm-txt" name="district_id">
                              <option value="53">Huyện Bình Chánh
                              </option>
                            </select>
                            <input type="hidden" name="district" value="Quận 6">
                          </div>
                        </div>
                      </div>
                      <div class="btns-row">
                        <a class="btn cancel" onclick="toggleAddress(55)">Hủy
                        </a>
                        <a class="btn" onclick="saveAddress('form#address-55')">Lưu
                        </a>
                      </div>
                    </form>
                  </div>
                </td>
              </tr>
              <tr id="address-space-55" class="space">
                <td colspan="3">
                </td>
              </tr>
            </tbody>
          </table>
          <div class="addr-frm add-new-addr-box">
            <h2>Thêm địa chỉ mới
            </h2>
            <form action="#" method="post" id="address-add">
              <div class="frm-row">
                <p class="lb">Địa chỉ
                </p>
                <div class="frm">
                  <input class="frm-txt" type="text" name="address" placeholder="Địa chỉ">
                </div>
              </div>
              <div class="frm-row">
                <div class="col col2">
                  <p class="lb">Tỉnh/Thành phố
                  </p>
                  <div class="frm">
                    <select class="frm-txt" name="zone_id">
                      <option value="7">An Giang
                      </option>
                    </select>
                    <input type="hidden" name="zone" value="An Giang">
                  </div>
                </div>
                <div class="col col2">
                  <p class="lb">Quận/Huyện
                  </p>
                  <div class="frm">
                    <select class="frm-txt" name="district_id">
                      <option value="159">Huyện An Phú
                      </option>
                    </select>
                    <input type="hidden" name="district" value="Huyện An Phú">
                  </div>
                </div>
              </div>
              <div class="frm-row check">
                <input type="checkbox" id="check0" name="default">
                <label for="check0">
                  <span class="checkbox">
                  </span> Chọn làm địa chỉ mặc định?                                  
                </label>
              </div>
              <div class="btns-row">
                <a class="btn cancel" onclick="$('.add-new-addr-box').removeClass('open');">Hủy
                </a>
                <a class="btn" onclick="saveAddress('#address-add')">Lưu
                </a>
              </div>
            </form>
          </div>  
          <div class="new-address" onclick="$('.add-new-addr-box').addClass('open');">
            Thêm địa chỉ mới                          
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php */ ?>
</div>
