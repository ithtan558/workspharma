
<div class="box">
    <div class="heading">
      <h1 style="float:left">Cấu hình liên hệ</h1>
      <div class="buttons"><a class="button" id="cancel" onclick="javascript:submitbutton('cancel');">Thoát</a></div>
      <div class="buttons"><a class="button" id="save" onclick="javascript:submitbutton('save');">Lưu</a></div>
      <div class="buttons"><a class="button" id="save_close" onclick="javascript:submitbutton('save_close');">Lưu và đóng</a></div>
    </div>
    <div class="content">
      <div class="vtabs">
          <a href="#tab-order" class="selected">Thông tin liên hệ</a>
      </div>
      <div id="tab-order" class="vtabs-content">
      	<form method="post" action="<?php echo URL;?>admin/contact_config/check_edit_contact_config" enctype="multipart/form-data" class="origin_setting" name="adminForm" id="adminForm" method="post" accept-charset="utf-8" novalidate="novalidate">
      <input type="hidden" name="url" value="<?php echo $this->uri->segment(2);?>" id="url">
                <table class="table_admin">
                    <tbody>
                        <tr>
                            <td><span style="color:#0C9;"><?php if(isset($messages)) echo $messages;?></span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Thông tin thêm</span></div></td><td>
                                    <textarea class="form-control" name="infotext_contact_config" cols="40" rows="5" id="infotext_contact_config" title="Không được bỏ trống" ><?php echo $getContactConfig[0]->infotext_contact_config;?></textarea>
                            </td>
                        </tr>
                        <tr class="alt-row">
                            <td>Hình ảnh nhỏ:</td>
                            <td><?php
							if($getContactConfig[0]->image_contact_config=="");
							else
							{
								?>
                                <img src="<?php echo IMAGES;?>$getContactConfig[0]->image_contact_config" />
                                <?php
							}
                            ?><input name="image_contact_config" type="file"   /></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Google map code</span></div></td><td>
                                    <textarea class="form-control" name="gmapcode_contact_config" cols="40" rows="5" id="gmapcode_contact_config" title="Không được bỏ trống" ><?php echo $getContactConfig[0]->gmapcode_contact_config;?></textarea>
                            </td>
                        </tr>
                        <tr class="alt-row">
                            <td>Sent mail to</td>
                            <td><input name="sendto_contact_config" type="text"  value="<?php echo $getContactConfig[0]->sendto_contact_config;?>"   /></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Nội dung trả lời</td>
                            <td><input name="replycontent_contact_config" type="text"  value="<?php echo $getContactConfig[0]->replycontent_contact_config;?>"   /></td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="t" value="save" id="t">
            </form>
      </div>
    </div>
</div>
