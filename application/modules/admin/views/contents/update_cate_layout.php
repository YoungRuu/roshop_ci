<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
			Cập nhật Danh Mục
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
				<div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <form role="form" method="post" action="<?php echo base_url()?>admin/admin_categories/update/<?php echo $info_item_categories['id']?>">
                            <div class="form-group">
                                <label>Tên Danh Mục</label>
                                <input type="text" class="form-control" value="<?php echo $info_item_categories['name']?>" name="name">
                            </div>
                            <div class="form-group">
                                <label>Danh Mục Cha</label>
                                <select class="form-control selectpicker" name="parent_id">
                                	<option value="0">Không có</option>
                                    <?php foreach ($list_parent_categories as $k => $v) {?>
                                        <?php if($v['parent_id'] == 0) {?>
                                        <option value="<?php echo $v['id'] ;?>" <?php if($info_item_categories['parent_id'] == $v['id']){echo ' selected ' ;} ?> ><?php echo $v['name'] ;?></option>
                                            <?php foreach ($list_parent_categories as $k1 => $v1) {?>
                                                <?php if($v1['parent_id'] != 0 && $v1['parent_id'] == $v['id']) {?>
                                                <option value="<?php echo $v1['id'] ;?>" <?php if($info_item_categories['parent_id'] == $v1['id']){echo ' selected ' ;} ?> >---<?php echo $v1['name'] ;?></option>
                                                    <?php foreach ($list_parent_categories as $k2 => $v2) {?>
                                                        <?php if($v2['parent_id'] != 0 && $v2['parent_id'] == $v1['id']) {?>
                                                        <option value="<?php echo $v2['id'] ;?>" <?php if($info_item_categories['parent_id'] == $v2['id']){echo ' selected ' ;} ?> >------<?php echo $v2['name'] ;?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                       <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Trạng Thái</label>
                                <select class="form-control selectpicker" name="status">
                                    <option value="0" 
                                    <?php if($info_item_categories['status'] == 0){echo 'selected' ;}  ?> >Ẩn</option>
                                    <option value="1"
                                    <?php if($info_item_categories['status'] == 1){echo 'selected' ;}  ?> >Hiện</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <a href="<?php echo base_url() ?>admin/admin_categories" class="btn btn-primary">Quay lại</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>