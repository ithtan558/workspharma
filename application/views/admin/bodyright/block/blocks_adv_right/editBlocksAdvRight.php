<div class="box">
    <div class="heading">
      <h1 style="float:left">Sữa hình ảnh quảng cáo</h1>
      <div class="buttons"><a class="button" id="cancel" onclick="javascript:submitbutton('cancel');">Thoát</a></div>
      <div class="buttons"><a class="button" id="save" onclick="javascript:submitbutton('save');">Lưu</a></div>
      <div class="buttons"><a class="button" id="save_close" onclick="javascript:submitbutton('save_close');">Lưu và đóng</a></div>
    </div>
    <div class="content">
      <div class="vtabs">
          <a href="#tab-order" class="selected">Thông tin hình ảnh quảng cáo phải </a>
      </div>
      <div id="tab-order" class="vtabs-content">
      	<form method="post" action="<?php echo URL;?>admin/blocks_adv_right/check_edit_blocks_adv_right/<?php echo $getBlocksAdvRight[0]->idAdvRight;?>" enctype="multipart/form-data" class="origin_setting" name="adminForm" id="adminForm" method="post" accept-charset="utf-8" novalidate="novalidate">
        	<input type="hidden" name="url" value="<?php echo $this->uri->segment(2);?>" id="url">
                <table class="table_admin">
                    <tbody>
                        <tr>
                            <td><span style="color:#0C9;"><?php if(isset($messages)) echo $messages;?></span></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Hình ảnh:</td>
                            <td> <?php 
							if($getBlocksAdvRight[0]->image_adv_right!="")
							{
							?>
                            	<img src="<?php echo IMAGES;?>banner/<?php echo $getBlocksAdvRight[0]->image_adv_right;?>" />
                                <?php
                            }
							?>
                            <input name="image_adv_right" type="file"   /></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Param:</td>
                            <td>
                                <select name="paramid">
                                    <option value="1" <?php if($getBlocksAdvRight[0]->paramid==1) echo 'selected="selected"'?> >Left</option>
                                    <option value="2" <?php if($getBlocksAdvRight[0]->paramid==2) echo 'selected="selected"'?>>Liên kết</option>
                                    
                                    
                                </select>
                        </tr>
                        <tr class="alt-row">
                            <td>Thứ tự:</td> 
                            <td><input name="ordering_adv_right" type="text" value="<?php echo $getBlocksAdvRight[0]->ordering_adv_right;?>"  /></td>
                        </tr>
                        
                        <tr class="alt-row">
                            <td>Url:</td> 
                            <td><input name="url_adv_right" type="text" value="<?php echo $getBlocksAdvRight[0]->url_adv_right;?>"  /></td>
                        </tr>
                        <tr>
                        	<td>Bật</td>
                            <td><input <?php if($getBlocksAdvRight[0]->enable_adv_right==1) echo 'checked="checked"'?> name="enable_adv_right" type="radio" value="1" class="inputbox" checked="checked">&nbsp;Có &nbsp;&nbsp;<input name="enable_adv_right" type="radio" value="0" class="inputbox" <?php if($getBlocksAdvRight[0]->enable_adv_right==0) echo 'checked="checked"'?>>&nbsp;Không</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Text </span></div></td><td>
                                    <textarea class="form-control" name="text_adv_right" cols="2" rows="3" id="text_adv_right" title="Không được bỏ trống" ><?php echo $getBlocksAdvRight[0]->text_adv_right;?></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="t" value="save" id="t">
            </form>
      </div>
    </div>
</div>
<script language="javascript" type="text/javascript" src="<?php echo PUBLIC_ADMIN;?>editor/ckeditor.js"></script>
<script>
		CKEDITOR.replace( 'text_adv_right',
		{
			<?php 
			echo $ckFinder;
			?>
		});
</script>
<script type="text/javascript">
$(document).ready(function(e) {
    /*dang ky*/
		$("#adminForm").validate({ 
			rules: {
				name_blocks_adv_right:{
					required: true
				},
				description_blocks_adv_right:{
					required: true
				},
				ordering_blocks_adv_right:{
					required: true
				}
			},
			messages: {
				name_blocks_adv_right:{
					required: "Bắt buộc nhập"
				},
				description_blocks_adv_right:{
					required: "Bắt buộc nhập"
				},
				ordering_blocks_adv_right:{
					required: "Bắt buộc nhập"
				}
			}
		});
	/*end đăng ký*/
});
</script>
