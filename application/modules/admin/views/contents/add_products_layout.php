<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
			Thêm Sản Phẩm
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
			    <form role="form" method="post" action="<?php echo base_url()?>admin/admin_products/add" enctype="multipart/form-data">
					<div class="row">
                    	<div class="col-lg-6">
                            <div class="form-group">
                                <label>Tên Sản Phẩm</label>
                                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('data_form_pr')['name'] ?>" name="name">
                            </div>
                            <div class="form-group">
                                <label>Xuất Xứ</label>
                                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('data_form_pr')['origin'] ?>" name="origin">
                            </div>
                            <div class="form-group">
                                <label>Chất Liệu</label>
                                <input type="text" class="form-control" value="<?php echo $this->session->flashdata('data_form_pr')['material'] ?>" name="material">
                            </div>
                            <div class="form-group">
                                <label>Số Lượng</label>
                                <input type="number" class="form-control" value="<?php echo $this->session->flashdata('data_form_pr')['quantity'] ?>" name="quantity">
                            </div>
                            <div class="form-group">
                                <label>Danh Mục</label>
                                <select class="form-control selectpicker"  name="categories_id">
                                    <?php foreach ($categories as $k => $v) {?>
                                        <?php if($v['parent_id'] == 0) {?>
                                        <option value="<?php echo $v['id'] ;?>" <?php if($this->session->flashdata('data_form_pr')['categories_id'] == $v['id']){echo ' selected ';} ?> disabled ><?php echo $v['name'] ;?></option>
                                            <?php foreach ($categories as $k1 => $v1) {?>
                                                <?php if($v1['parent_id'] != 0 && $v1['parent_id'] == $v['id']) {?>
                                                <option value="<?php echo $v1['id'] ;?>" >---<?php echo $v1['name'] ;?></option>
                                                    <?php foreach ($categories as $k2 => $v2) {?>
                                                        <?php if($v2['parent_id'] != 0 && $v2['parent_id'] == $v1['id']) {?>
                                                        <option value="<?php echo $v2['id'] ;?>" >------<?php echo $v2['name'] ;?></option>
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
                                <select class="form-control selectpicker size-product" name="size[]" multiple >
                                    <?php $arr_size = $this->session->flashdata('data_form_pr')['size'] ;?>
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
                                <input type="number" class="form-control price_standard" value="<?php echo $this->session->flashdata('data_form_pr')['price_standard'] ?>" name="price_standard">
                            </div>
                            <label>Giảm Giá</label>
                            <div class="form-group"> 
                            	<div class="div-input-price-add">
                               		<input type="number" class="form-control price_sale" name="price_sale" value="<?php echo $this->session->flashdata('data_form_pr')['price_sale'] ; ?>" placeholder=" " readonly> 
                                </div>
                                <div class="div-select-price-add">
									<select class="form-control selectpicker unit_price_sale" name="unit_price_sale">
	                                    <option value="VND" <?php if($this->session->flashdata('data_form_pr')['unit_price_sale'] == 'VND'){echo ' selected ' ;} ?> >VND</option>
	                                    <option value="%" <?php if($this->session->flashdata('data_form_pr')['unit_price_sale'] == '%'){echo ' selected ' ;} ?> >%</option>
	                                </select>
                                </div>
                            	<div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <label>Giá Bán</label>
                                <input type="number" class="form-control price_sell_old" value="<?php echo $this->session->flashdata('data_form_pr')['price_sell_old'] ?>" name="price_sell_old" placeholder="Giá bán sẽ phụ thuộc vào : Giá sản phẩm và giảm giá" readonly>
                            </div>
                            <div class="form-group">
                            	<div class="div-select-hot">
                            		<label>Hình Thức</label>
                            		<select class="form-control selectpicker" name="hot">
	                                    <option value="0" <?php if($this->session->flashdata('data_form_pr')['hot'] == 0){echo ' selected ' ;} ?> >Bình thường</option>
	                                    <option value="1" <?php if($this->session->flashdata('data_form_pr')['hot'] == 1){echo ' selected ' ;} ?> >Hot</option>
	                                </select>
                            	</div>
                            	<div class="div-select-type-gender">
                            		<label>Loại Sản Phẩm</label>
                            		<select class="form-control selectpicker" name="type_gender">
	                                    <option value="male" <?php if($this->session->flashdata('data_form_pr')['type_gender'] == 'male'){echo ' selected ' ;} ?> >Nam</option>
	                                    <option value="female" <?php if($this->session->flashdata('data_form_pr')['type_gender'] == 'female'){echo ' selected ' ;} ?> >Nữ</option>
	                                    <option value="unknown" <?php if($this->session->flashdata('data_form_pr')['type_gender'] == 'unknown'){echo ' selected ' ;} ?> >Không xác định</option>
	                                </select>
                            	</div>
                            	<div class="div-select-status">
                            		<label>Tình Trạng</label>
                            		<select class="form-control selectpicker" name="status">
	                                    <option value="1" <?php if($this->session->flashdata('data_form_pr')['status'] == 1){echo ' selected ' ;} ?> >Còn Hàng</option>
                                        <option value="0" <?php if($this->session->flashdata('data_form_pr')['status'] == 0){echo ' selected ' ;} ?> >Hết Hàng</option>
	                                </select>
                            	</div>
                                <div class="div-select-old-new">
                                    <label>Cũ - Mới</label>
                                    <select class="form-control selectpicker" name="new">
                                        <option value="0" <?php if($this->session->flashdata('data_form_pr')['new'] == 0){echo ' selected ' ;} ?> >Cũ</option>
                                        <option value="1" <?php if($this->session->flashdata('data_form_pr')['new'] == 1){echo ' selected ' ;} ?> >Mới</option>
                                    </select>
                                </div>
                            <div class="clearfix"></div>
                            </div>
                            <div class="form-group full-block-color">
                                <label>Màu sắc <span class="add-color">+</span></label>
                                <?php $arr_color = $this->session->flashdata('data_form_pr')['color'] ;?>
                                <?php if(!empty($arr_color)){  ?>
                                    <div class="div-color">
                                    <?php foreach ($arr_color as $key => $value) { ?>
                                        <div class="box-color">  
                                            <input class="input-block-color block-color-<?php echo $key ;?>" value="<?php echo $value ;?>" id-block="<?php echo $key ;?>" name="color[]" readonly="" style="background: <?php echo $value ;?>"></input>
                                             <i class="btn-remove-color" title="Xóa" id-color="<?php echo $key ;?>">&times;</i>
                                         </div>
                                    <?php } ?>
                                    </div>
                                <?php }else{ ?>
                                    <div class="div-color">
                                        <div class="box-color">        
                                            <input class="input-block-color block-color-0" value="#000000"  id-block="0" name="color[]" readonly=""  style="background: #000;"></input>
                                            <i class="btn-remove-color" title="Xóa" id-color="0">&times;</i>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <!--Upload multi Image + Show image browser-->
                            <div class="form-group">
                                <label>Hình ảnh <span class="add-image">+</span></label>
                                <div class="full_block_img">
                                    <div class="box_img" id-block-img="0">
                                        <label for="image" class="uploadimg">
                                           <img src="<? echo base_url()?>uploads/uploadimg.png" id="img_product_0"/>
                                        </label>
                                        <i class="btn-remove remove_file_0" title="Xóa" onclick="file_remove(this)">&times;</i>
                                        <input type="file" name="list_image[]" class="hidden input_file_0" onchange="file_change(this,0)" />
                                    </div>
                                </div>
                            </div>
                            <!--END Upload multi Image + Show image browser-->
                    	</div>
                	</div>
                	<div class="row">
                    	<div class="col-lg-8">
                    		<button type="submit" class="btn btn-primary">Thêm</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                    	</div>
                        <div class="col-lg-4 text-right">
                            <a href="<?php echo base_url() ?>admin_products" class="btn btn-primary">Quay lại</a>
                        </div>
                	</div>
                </form>
			</div>
		</div>
	</div>
</div>