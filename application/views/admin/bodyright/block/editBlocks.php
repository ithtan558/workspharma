
<div class="box">
    <div class="heading">
      <h1 style="float:left">Sữa khối</h1>
      <div class="buttons"><a class="button" id="cancel" onclick="javascript:submitbutton('cancel');">Thoát</a></div>
      <div class="buttons"><a class="button" id="save" onclick="javascript:submitbutton('save');">Lưu</a></div>
      <div class="buttons"><a class="button" id="save_close" onclick="javascript:submitbutton('save_close');">Lưu và đóng</a></div>
    </div>
    <div class="content">
      <div class="vtabs">
          <a href="#tab-order" class="selected">Thông tin block </a>
      </div>
      <div id="tab-order" class="vtabs-content">
      	<form method="post" action="<?php echo URL;?>admin/block/check_edit_blocks/<?php echo $getBlocks[0]->idBlocks;?>" enctype="multipart/form-data" class="origin_setting" name="adminForm" id="adminForm" method="post" accept-charset="utf-8" novalidate="novalidate">
<input type="hidden" name="url" value="<?php echo $this->uri->segment(2);?>" id="url">
                <table class="table_admin">
                    <tbody>
                        <tr>
                            <td><span style="color:#0C9;"><?php if(isset($messages)) echo $messages;?></span></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Tiêu đề khối:</td> 
                            <td><input name="name_blocks" type="text" autofocus value="<?php echo $getBlocks[0]->name_blocks;?>"    /></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Tên khối:</td> 
                            <td><input name="title_blocks" type="text" value="<?php echo $getBlocks[0]->title_blocks;?>"    /></td>
                        </tr>
                        <!-- <tr class="alt-row">
                            <td>Vị trí:</td>
                            <td><select name="position_blocks">
                                <option value="left" <?php if($getBlocks[0]->position_blocks=='left') echo 'selected="selected"';?>>left</option>
                                <option value="right" <?php if($getBlocks[0]->position_blocks=='right') echo 'selected="selected"';?>>right</option>
                                <option value="top" <?php if($getBlocks[0]->position_blocks=='top') echo 'selected="selected"';?>>top</option>
                                <option value="bottom" <?php if($getBlocks[0]->position_blocks=='bottom') echo 'selected="selected"';?>>bottom</option>
                                <option value="banner" <?php if($getBlocks[0]->position_blocks=='banner') echo 'selected="selected"';?>>banner</option>
                            </select></td>
                        </tr> -->
                        <tr class="alt-row">
                            <td>Số record hiển thị:</td> 
                            <td><input name="limit_show" type="text" value="<?php echo $getBlocks[0]->limit_show;?>"    /></td>
                        </tr>
                        <tr>
                        	<td>Bật</td>
                            <td><input name="enable_blocks" type="radio" value="1" class="inputbox"  <?php if($getBlocks[0]->enable_blocks==1) echo 'checked="checked"'?>>&nbsp;Có &nbsp;&nbsp;<input name="enable_blocks" type="radio" value="0" class="inputbox" <?php if($getBlocks[0]->enable_blocks==0) echo 'checked="checked"'?>>&nbsp;Không</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Nội dung (*) </span></div></td><td>
                                    <textarea class="form-control" name="html_content_blocks" cols="2" rows="3" id="html_content_blocks" title="Không được bỏ trống" ><?php echo $getBlocks[0]->html_content_blocks;?></textarea>
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
		CKEDITOR.replace( 'html_content_blocks',
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
				name_blocks:{
					required: true
				},
				description_blocks:{
					required: true
				},
				ordering_blocks:{
					required: true
				}
			},
			messages: {
				name_blocks:{
					required: "Bắt buộc nhập"
				},
				description_blocks:{
					required: "Bắt buộc nhập"
				},
				ordering_blocks:{
					required: "Bắt buộc nhập"
				}
			}
		});
	/*end đăng ký*/
});
</script>
