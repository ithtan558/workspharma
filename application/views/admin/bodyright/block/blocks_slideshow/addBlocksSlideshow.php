
<div class="box">
    <div class="heading">
      <h1 style="float:left">Thêm hình ảnh slideshow</h1>
      <div class="buttons"><a class="button" id="cancel" onclick="javascript:submitbutton('cancel');">Thoát</a></div>
      <div class="buttons"><a class="button" id="save" onclick="javascript:submitbutton('save');">Lưu</a></div>
      <div class="buttons"><a class="button" id="save_close" onclick="javascript:submitbutton('save_close');">Lưu và đóng</a></div>
    </div>
    <div class="content">
      <div class="vtabs">
          <a href="#tab-order" class="selected">Thông tin blocks_slideshow </a>
      </div>
      <div id="tab-order" class="vtabs-content">
      	<form method="post" action="<?php echo URL;?>admin/blocks_slideshow/check_add_blocks_slideshow" enctype="multipart/form-data" class="origin_setting" name="adminForm" id="adminForm" method="post" accept-charset="utf-8" novalidate="novalidate">
<input type="hidden" name="url" value="<?php echo $this->uri->segment(2);?>" id="url">
                <table class="table_admin">
                    <tbody>
                        <tr>
                            <td><span style="color:#0C9;"><?php if(isset($messages)) echo $messages;?></span></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Hình ảnh:</td>
                            <td><input name="image_slide_show" type="file"   /></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Thứ tự:</td> 
                            <td><input name="ordering_slide_show" type="text"  /></td>
                        </tr>
                        
                        <tr class="alt-row">
                            <td>URL:</td> 
                            <td><input name="url_slide_show" type="text"  /></td>
                        </tr>
                        <tr>
                        	<td>Bật</td>
                            <td><input name="enable_slide_show" type="radio" value="1" class="inputbox"  >&nbsp;Có &nbsp;&nbsp;<input name="enable_slide_show" type="radio" value="0" class="inputbox" checked="checked">&nbsp;Không</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Text </span></div></td><td>
                                    <textarea class="form-control" name="text_slide_show" cols="90" rows="10" id="text_slide_show" title="Không được bỏ trống" ></textarea>
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
		// CKEDITOR.replace( 'text_slide_show',
		// {
		// 	<?php 
		// 	echo $ckFinder;
		// 	?>
		// });
		
</script>
<script type="text/javascript">
$(document).ready(function(e) {
    /*dang ky*/
		$("#adminForm").validate({ 
			rules: {
				name_blocks_slideshow:{
					required: true
				},
				description_blocks_slideshow:{
					required: true
				},
				ordering_blocks_slideshow:{
					required: true
				}
			},
			messages: {
				name_blocks_slideshow:{
					required: "Bắt buộc nhập"
				},
				description_blocks_slideshow:{
					required: "Bắt buộc nhập"
				},
				ordering_blocks_slideshow:{
					required: "Bắt buộc nhập"
				}
			}
		});
	/*end đăng ký*/
});
</script>
