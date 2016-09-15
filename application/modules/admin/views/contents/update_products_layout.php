<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            Cập Nhật Sản Phẩm
            </div>
            <div class="panel-body">
                <div class="row">
                  <div class="col-sm-12">
                    <?php if($this->session->flashdata('item')) {?>
                       <?php $view_message = $this->session->flashdata('item') ;?>
                       <div class="<?php echo $view_message['class'] ;?> ">
                          <strong><?php echo $view_message['message'] ;?></strong>
                       </div>
                    <?php } ?>
                  </div>
                </div>
                <form role="form" method="post" action="<?php echo base_url()?>admin/admin_products/update/<?php echo $info_item_products['id']; ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tên Sản Phẩm</label>
                                <input type="text" class="form-control" value="<?php echo $info_item_products['name'] ?>" name="name">
                            </div>
                            <div class="form-group">
                                <label>Xuất Xứ</label>
                                <input type="text" class="form-control" value="<?php echo $info_item_products['origin'] ?>" name="origin">
                            </div>
                            <div class="form-group">
                                <label>Chất Liệu</label>
                                <input type="text" class="form-control" value="<?php echo $info_item_products['material'] ?>" name="material">
                            </div>
                            <div class="form-group">
                                <label>Số Lượng</label>
                                <input type="number" class="form-control" value="<?php echo $info_item_products['quantity'] ?>" name="quantity">
                            </div>
                            <div class="form-group">
                                <label>Danh Mục</label>
                                <select class="form-control selectpicker" name="categories_id">
                                    <?php foreach ($categories as $k => $v) {?>
                                        <?php if($v['parent_id'] == 0) {?>
                                        <option value="<?php echo $v['id'] ;?>" <?php if($info_item_products['categories_id'] == $v['id']){echo ' selected ';} ?> disabled><?php echo $v['name'] ;?></option>
                                            <?php foreach ($categories as $k1 => $v1) {?>
                                                <?php if($v1['parent_id'] != 0 && $v1['parent_id'] == $v['id']) {?>
                                                <option value="<?php echo $v1['id'] ;?>" <?php if($info_item_products['categories_id'] == $v1['id']){echo ' selected ';} ?> >---<?php echo $v1['name'] ;?></option>
                                                    <?php foreach ($categories as $k1 => $v1) {?>
                                                        <?php if($v2['parent_id'] != 0 && $v2['parent_id'] == $v1['id']) {?>
                                                        <option value="<?php echo $v2['id'] ;?>" <?php if($info_item_products['categories_id'] == $v2['id']){echo ' selected ';} ?> >------<?php echo $v2['name'] ;?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                       <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Size</label>
                                <select class="form-control selectpicker size-product-update" name="size[]" multiple >
                                    <?php $arr_size = json_decode($info_item_products['size'],true) ;?>
                                    <optgroup label="Size Số">
                                        <option value="26" 
                                        <?php if(!empty($arr_size)){  ?>
                                            <?php foreach ($arr_size as $key => $value) {
                                                if($value == '26'){echo 'selected' ;}
                                            } ?>
                                        <?php }?>
                                        >Size 26</option>
                                        <option value="27" 
                                        <?php if(!empty($arr_size)){  ?>
                                            <?php foreach ($arr_size as $key => $value) {
                                                if($value == '27'){echo 'selected' ;}
                                            } ?>
                                        <?php }?>
                                        >Size 27</option>
                                        <option value="28" 
                                        <?php if(!empty($arr_size)){  ?>
                                            <?php foreach ($arr_size as $key => $value) {
                                                if($value == '28'){echo 'selected' ;}
                                            } ?>
                                        <?php }?>
                                        >Size 28</option>
                                        <option value="29" 
                                        <?php if(!empty($arr_size)){  ?>
                                            <?php foreach ($arr_size as $key => $value) {
                                                if($value == '29'){echo 'selected' ;}
                                            } ?>
                                        <?php }?>
                                        >Size 29</option>
                                        <option value="30" 
                                        <?php if(!empty($arr_size)){  ?>
                                            <?php foreach ($arr_size as $key => $value) {
                                                if($value == '30'){echo 'selected' ;}
                                            } ?>
                                        <?php }?>
                                        >Size 30</option>
                                        <option value="31" 
                                        <?php if(!empty($arr_size)){  ?>
                                            <?php foreach ($arr_size as $key => $value) {
                                                if($value == '31'){echo 'selected' ;}
                                            } ?>
                                        <?php }?>
                                        >Size 31</option>
                                        <option value="32"
                                        <?php if(!empty($arr_size)){  ?>
                                            <?php foreach ($arr_size as $key => $value) {
                                                if($value == '32'){echo 'selected' ;}
                                            } ?>
                                        <?php }?>
                                        >Size 32</option>
                                        <option value="33"
                                        <?php if(!empty($arr_size)){  ?>
                                            <?php foreach ($arr_size as $key => $value) {
                                                if($value == '33'){echo 'selected' ;}
                                            } ?>
                                        <?php }?>
                                        >Size 33</option>
                                        <option value="34"
                                        <?php if(!empty($arr_size)){  ?>
                                            <?php foreach ($arr_size as $key => $value) {
                                                if($value == '34'){echo 'selected' ;}
                                            } ?>
                                        <?php }?>
                                        >Size 34</option>
                                        <option value="35"
                                        <?php if(!empty($arr_size)){  ?>
                                            <?php foreach ($arr_size as $key => $value) {
                                                if($value == '35'){echo 'selected' ;}
                                            } ?>
                                        <?php }?>
                                        >Size 35</option>
                                        <option value="36"
                                        <?php if(!empty($arr_size)){  ?>
                                            <?php foreach ($arr_size as $key => $value) {
                                                if($value == '36'){echo 'selected' ;}
                                            } ?>
                                        <?php }?>
                                        >Size 36</option>
                                        <option value="37"
                                        <?php if(!empty($arr_size)){  ?>
                                            <?php foreach ($arr_size as $key => $value) {
                                                if($value == '37'){echo 'selected' ;}
                                            } ?>
                                        <?php }?>
                                        >Size 37</option>
                                        <option value="38"
                                        <?php if(!empty($arr_size)){  ?>
                                            <?php foreach ($arr_size as $key => $value) {
                                                if($value == '38'){echo 'selected' ;}
                                            } ?>
                                        <?php }?>
                                        >Size 38</option>
                                    </optgroup>
                                    <optgroup label="Size Chữ">
                                        <option value="FREE" 
                                        <?php if(!empty($arr_size)){  ?>
                                            <?php foreach ($arr_size as $key => $value) {
                                                if($value == 'FREE'){echo 'selected' ;}
                                            } ?>
                                        <?php }?>
                                        >FREE</option>
                                        <option value="XS"
                                        <?php if(!empty($arr_size)){  ?>
                                            <?php foreach ($arr_size as $key => $value) {
                                                if($value == 'XS'){echo 'selected' ;}
                                            } ?>
                                        <?php }?>
                                        >Size XS</option>
                                        <option value="S"
                                        <?php if(!empty($arr_size)){  ?>
                                            <?php foreach ($arr_size as $key => $value) {
                                                if($value == 'S'){echo 'selected' ;}
                                            } ?>
                                        <?php }?>
                                        >Size S</option>
                                        <option value="M" 
                                        <?php if(!empty($arr_size)){  ?>
                                            <?php foreach ($arr_size as $key => $value) {
                                                if($value == 'M'){echo 'selected' ;}
                                            } ?>
                                        <?php }?>
                                        >Size M</option>
                                        <option value="L"
                                        <?php if(!empty($arr_size)){  ?>
                                            <?php foreach ($arr_size as $key => $value) {
                                                if($value == 'L'){echo 'selected' ;}
                                            } ?>
                                        <?php }?>
                                        >Size L</option>
                                        <option value="XL"
                                        <?php if(!empty($arr_size)){  ?>
                                            <?php foreach ($arr_size as $key => $value) {
                                                if($value == 'XL'){echo 'selected' ;}
                                            } ?>
                                        <?php }?>
                                        >Size XL</option>
                                        <option value="XXL"
                                        <?php if(!empty($arr_size)){  ?>
                                            <?php foreach ($arr_size as $key => $value) {
                                                if($value == 'XXL'){echo 'selected' ;}
                                            } ?>
                                        <?php }?>
                                        >Size XXL</option>
                                        <option value="XXXL"
                                        <?php if(!empty($arr_size)){  ?>
                                            <?php foreach ($arr_size as $key => $value) {
                                                if($value == 'XXXL'){echo 'selected' ;}
                                            } ?>
                                        <?php }?>
                                        >Size XXXL</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Giá</label>
                                <input type="number" class="form-control price_standard" value="<?php echo $info_item_products['price_standard'] ?>" name="price_standard" >
                            </div>
                            <label>Giảm Giá</label>
                            <div class="form-group"> 
                                <div class="div-input-price-add">
                                    <input type="number" class="form-control price_sale" name="price_sale" value="<?php echo $info_item_products['price_sale'] ?>" placeholder="" readonly> 
                                </div>
                                <div class="div-select-price-add">
                                    <select class="form-control selectpicker unit_price_sale" name="unit_price_sale">
                                        <option value="VND" <?php if($info_item_products['unit_price_sale'] == 'VND'){echo ' selected ' ;} ?> >VND</option>
                                        <option value="%" <?php if($info_item_products['unit_price_sale'] == '%'){echo ' selected ' ;} ?> >%</option>
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <label>Giá Bán</label>
                                <input type="number" class="form-control price_sell_old" value="<?php if($info_item_products['price_sell_new'] == 0){echo $info_item_products['price_sell_old'] ;}else{echo $info_item_products['price_sell_new'] ;} ; ?>" name="price_sell_new" placeholder="Giá bán sẽ phụ thuộc vào : Giá sản phẩm và giảm giá" readonly>
                            </div>
                            <div class="form-group">
                                <div class="div-select-hot">
                                    <label>Hình Thức</label>
                                    <select class="form-control selectpicker hot-product" name="hot">
                                        <option value="0" <?php if($info_item_products['hot'] == 0){echo ' selected ' ;} ?> >Bình thường</option>
                                        <option value="1" <?php if($info_item_products['hot'] == 1){echo ' selected ' ;} ?> >Hot</option>
                                    </select>
                                </div>
                                <div class="div-select-type-gender">
                                    <label>Loại Sản Phẩm</label>
                                    <select class="form-control selectpicker gender-product" name="type_gender">
                                        <option value="male" <?php if($info_item_products['type_gender'] == 'male'){echo ' selected ' ;} ?> >Nam</option>
                                        <option value="female" <?php if($info_item_products['type_gender'] == 'female'){echo ' selected ' ;} ?> >Nữ</option>
                                        <option value="unknown" <?php if($info_item_products['type_gender'] == 'unknown'){echo ' selected ' ;} ?> >Không xác định</option>
                                    </select>
                                </div>
                                <div class="div-select-status">
                                    <label>Tình Trạng</label>
                                    <select class="form-control selectpicker status-product" name="status">
                                        <option value="1" <?php if($info_item_products['status'] == 1){echo ' selected ' ;} ?> >Còn Hàng</option>
                                        <option value="0" <?php if($info_item_products['status'] == 0){echo ' selected ' ;} ?> >Hết Hàng</option>
                                    </select>
                                </div>
                                <div class="div-select-old-new">
                                    <label>Cũ - Mới</label>
                                    <select class="form-control selectpicker" name="new">
                                        <option value="1" <?php if($info_item_products['new'] == '1'){echo ' selected ' ;} ?> >Mới</option>
                                        <option value="0" <?php if($info_item_products['new'] == '0'){echo ' selected ' ;} ?> >Cũ</option>
                                    </select>
                                </div>
                            <div class="clearfix"></div>
                            </div>
                            <div class="form-group full-block-color">
                                <label>Màu sắc <span class="add-color">+</span></label>
                                <?php $arr_color = json_decode($info_item_products['color'],true) ;?>
                                <?php if(!empty($arr_color)){  ?>
                                    <div class="div-color">
                                    <?php foreach ($arr_color as $key => $value) { ?>
                                        <div class="box-color"> 
                                            <input class="input-block-color block-color-<?php echo $key ;?>" value="<?php echo $value ;?>" id-block="<?php echo $key ;?>" name="color[]" readonly="" style="background: <?php echo $value ;?>" ></input>
                                            <i class="btn-remove-color" title="Xóa" id-color="<?php echo $key ;?>">&times;</i>
                                        </div>
                                    <?php } ?>
                                    </div>
                                <?php }else{ ?>
                                    <div class="div-color">
                                        <div class="box-color"> 
                                            <input class="input-block-color block-color-0" value="#000000"  id-block="0" name="color[]" readonly="" style="background: #000;"></input>
                                            <i class="btn-remove-color" title="Xóa" id-color="0">&times;</i>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <!--Upload multi Image + Show image browser-->
                            <div class="form-group">
                                <label>Hình ảnh <span class="add-image">+</span></label>
                                <div class="full_block_img">
                                    <?php $arr_img = json_decode($info_item_products['list_image'],true) ;?>
                                    <?php if(!empty($arr_img)){  ?>
                                        <?php foreach ($arr_img as $key => $value) { ?>
                                        <?php if(empty($value)){ continue;}?>
                                        <div class="box_img" id-block-img="<?php echo $key; ?>">
                                            <label for="image" class="uploadimg">
                                               <img src="<?php echo base_url()?>uploads/thumb/thumb75x60_<?php echo $value ;?>" id="img_product_<?php echo $key; ?>"/>
                                            </label>
                                            <input type="hidden" name="get_value_img[]" class="form-control box_value_img" value="<?php echo $value ;?> ">
                                            <i class="btn-remove block remove_file_<?php echo $key; ?>" title="Xóa" onclick="file_remove(this)">&times;</i>
                                            <input type="file" name="list_image[]" value="<?php echo $value ;?>" class="hidden input_file_<?php echo $key; ?>" onchange="file_change(this,<?php echo $key; ?>)" />
                                        </div>
                                        <?php } ?>   
                                    <?php }else{ ?>
                                    <div class="box_img" id-block-img="0">
                                        <label for="image" class="uploadimg">
                                           <img src="<? echo base_url()?>uploads/uploadimg.png" id="img_product_0"/>
                                        </label>
                                        <i class="btn-remove remove_file_0" title="Xóa" onclick="file_remove(this)">&times;</i>
                                        <input type="file" name="list_image[]" class="hidden input_file_0" onchange="file_change(this,0)" />
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <!--END Upload multi Image + Show image browser-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                        <div class="col-lg-4 text-right">
                            <a href="<?php echo base_url() ?>admin/admin_products" class="btn btn-primary">Quay lại</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>