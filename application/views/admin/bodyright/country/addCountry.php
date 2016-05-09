
<div class="box">
    <div class="heading">
      <h1 style="float:left">Thêm country</h1>
      <div class="buttons"><a class="button" id="cancel" onclick="javascript:submitbutton('cancel');">Thoát</a></div>
      <div class="buttons"><a class="button" id="save" onclick="javascript:submitbutton('save');">Lưu</a></div>
      <div class="buttons"><a class="button" id="save_close" onclick="javascript:submitbutton('save_close');">Lưu và đóng</a></div>
    </div>
    <div class="content">
      <div class="vtabs">
          <a href="#tab-order" class="selected">Thông tin country</a>
      </div>
      <div id="tab-order" class="vtabs-content">
          <form id="adminForm" action="<?php echo URL;?>admin/country/check_add_country" method="post" enctype="multipart/form-data">
          <input type="hidden" name="url" value="<?php echo $this->uri->segment(2);?>" id="url">
              <table class="table_admin">  
                  <tbody>
                        <tr>
                            <td colspan="2"><span style="color:#0C9;"><?php if(isset($messages)) echo $messages;?></span></td>
                        </tr>
                        <tr class="alt-row">
                        	<td>Tên country:</td>
                        	<td><input name="country_name" type="text" autofocus="autofocus"   /></td></tr>
                  </tbody>
               </table>
        </div>
        <input type="hidden" name="t" value="save" id="t">
      </form>
      </div>
    </div>
</div>