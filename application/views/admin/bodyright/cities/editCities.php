
<div class="box">
    <div class="heading">
      <h1 style="float:left">Sữa city</h1>
      <div class="buttons"><a class="button" id="cancel" onclick="javascript:submitbutton('cancel');">Thoát</a></div>
      <div class="buttons"><a class="button" id="save" onclick="javascript:submitbutton('save');">Lưu</a></div>
      <div class="buttons"><a class="button" id="save_close" onclick="javascript:submitbutton('save_close');">Lưu và đóng</a></div>
    </div>
    <div class="content">
      <div class="vtabs">
          <a href="#tab-order" class="selected">Thông tin city</a>
      </div>
      <div id="tab-order" class="vtabs-content">
          <form id="adminForm" action="<?php echo URL;?>admin/cities/check_edit_cities/<?php echo $getCities[0]->id;?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="url" value="<?php echo $this->uri->segment(2);?>" id="url">
              <table class="table_admin">  
                  <tbody>
                  	<tr>
                        <td><span style="color:#0C9;"><?php if(isset($messages)) echo $messages;?></span></td>
                    </tr>
                    <tr class="alt-row">
                        <td>Tên city:</td>
                        <td><input name="city_name" type="text" autofocus="autofocus"  value="<?php echo $getCities[0]->city_name;?>"  /></td></tr>
                    </tr>
                  </tbody>
               </table>
        </div>
      <input type="hidden" name="t" value="save" id="t">
      </form>
      
      </div>
    </div>
</div>