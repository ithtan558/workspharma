
<div class="box">
    <div class="heading">
      <h1 style="float:left">Thêm khối hỗ trợ trực tuyến</h1>
      <div class="buttons"><a class="button" id="cancel" onclick="javascript:submitbutton('cancel');">Thoát</a></div>
      <div class="buttons"><a class="button" id="save" onclick="javascript:submitbutton('save');">Lưu</a></div>
      <div class="buttons"><a class="button" id="save_close" onclick="javascript:submitbutton('save_close');">Lưu và đóng</a></div>
    </div>
    <div class="content">
      <div class="vtabs">
          <a href="#tab-order" class="selected">Thông tin quảng cáo phải </a>
      </div>
      <div id="tab-order" class="vtabs-content">
      	<form method="post" action="<?php echo URL;?>admin/blocks_support_online/check_add_blocks_support_online" enctype="multipart/form-data" class="origin_setting" name="adminForm" id="adminForm" method="post" accept-charset="utf-8" novalidate="novalidate">
<input type="hidden" name="url" value="<?php echo $this->uri->segment(2);?>" id="url">
                <table class="table_admin">
                    <tbody>
                        <tr>
                            <td><span style="color:#0C9;"><?php if(isset($messages)) echo $messages;?></span></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Tên:</td> 
                            <td><input name="name_support_online" type="text" autofocus="autofocus"  /></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Điện thoại:</td> 
                            <td><input name="phone_support_online" type="text"   /></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Yahoo:</td> 
                            <td><input name="yahoo_support_online" type="text"  /></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Skype:</td> 
                            <td><input name="skype_support_online" type="text" /></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Thứ tự:</td> 
                            <td><input name="ordering_support_online" type="text"  /></td>
                        </tr>
                        <tr>
                        	<td>Bật</td>
                            <td><input name="enable_support_online" type="radio" value="1" class="inputbox"  >&nbsp;Có &nbsp;&nbsp;<input name="enable_support_online" type="radio" value="0" class="inputbox" checked="checked">&nbsp;Không</td>
                        </tr>
                        
                    </tbody>
                </table>
                <input type="hidden" name="t" value="save" id="t">
            </form>
      </div>
    </div>
</div>
