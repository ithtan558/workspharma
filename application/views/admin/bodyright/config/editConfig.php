
<div class="box">
    <div class="heading">
      <h1 style="float:left">Sửa cấu hình</h1>
	
    
      <div class="buttons"><a class="button" id="cancel" onclick="javascript:submitbutton('cancel');">Thoát</a></div>
      <div class="buttons"><a class="button" id="save" onclick="javascript:submitbutton('save');">Lưu</a></div>
      <div class="buttons"><a class="button" id="save_close" onclick="javascript:submitbutton('save_close');">Lưu và đóng</a></div>
      
    </div>
    <div class="content">
      <div class="vtabs">
          <a href="#tab-order" class="selected">Thông tin cấu hình</a>
      </div>
      <div id="tab-order" class="vtabs-content">
      <form method="post" action="<?php echo URL;?>admin/config/check_sua_config/<?php echo $getConfig[0]->idConfig?>" id="adminForm">
      <input type="hidden" name="url" value="<?php echo $this->uri->segment(2);?>" id="url">
        <table class="table_admin">
          <tbody>
          	  <tr>
              	<td><span style="color:#0C9;"><?php if(isset($messages)) echo $messages;?></span></td>
              </tr>
                <tr class="alt-row">
                
                
                    <td>Tên</td>
                    
                    
                    <td><?php echo $getConfig[0]->name;?></td>
                    
                
                </tr>
              <tr class="alt-row">
                <td>Value</td>
                <td><textarea rows="5" cols="100" name="value"><?php echo $getConfig[0]->value;?></textarea></td>
              </tr>
              
           </tbody></table>
		<input type="hidden" name="t" value="save" id="t">
        </form>
      </div>
    </div>
</div>