<h1>Thêm block</h1>
<div class="box">
    <div class="heading">
      <h1 style="float:left">Thêm khối</h1>
      <div class="buttons"><a class="button" id="cancel" onclick="javascript:submitbutton('cancel');">Thoát</a></div>
      <div class="buttons"><a class="button" id="save" onclick="javascript:submitbutton('save');">Lưu</a></div>
      <div class="buttons"><a class="button" id="save_close" onclick="javascript:submitbutton('save_close');">Lưu và đóng</a></div>
    </div>
    <div class="contnet">
      <div class="vtabs">
          <a href="#tab-order" class="selected">Thông tin block </a>
      </div>
      <div id="tab-order" class="vtabs-content">
      	<form method="post" action="<?php echo URL;?>admin/block/check_add_blocks" enctype="multipart/form-data" class="origin_setting" name="adminForm" id="adminForm" method="post" accept-charset="utf-8" novalidate="novalidate">
<input type="hidden" name="url" value="<?php echo $this->uri->segment(2);?>" id="url">
                <table class="table_admin">
                    <tbody>
                        <tr>
                            <td><span style="color:#0C9;"><?php if(isset($messages)) echo $messages;?></span></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Tiêu đề khối:</td> 
                            <td><input name="title_blocks" type="text" autofocus    /></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Tên khối:</td> 
                            <td><input name="name_blocks" type="text"   /></td>
                        </tr>
                        <!-- <tr class="alt-row">
                            <td>Vị trí:</td>
                            <td><select name="position_blocks">
                                <option value="left">left</option>
                                <option value="right">right</option>
                                <option value="top">top</option>
                                <option value="bottom">bottom</option>
                                <option value="banner">banner</option>
                            </select></td>
                        </tr> -->
                        <!-- <tr class="alt-row">
                            <td>Thứ tự:</td> 
                            <td><input name="ordering_blocks" type="text"  /></td>
                        </tr> -->
                        <tr>
                        	<td>Bật</td>
                            <td><input name="enable_blocks" type="radio" value="1" class="inputbox"  >&nbsp;Có &nbsp;&nbsp;<input name="enable_blocks" type="radio" value="0" class="inputbox" checked="checked">&nbsp;Không</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Nội dung (*) </span></div></td><td>
                                    <textarea class="form-control" name="html_content_blocks" cols="2" rows="3" id="html_content_blocks" title="Không được bỏ trống" ></textarea>
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
