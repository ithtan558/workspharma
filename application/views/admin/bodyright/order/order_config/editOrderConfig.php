<div class="box">
    <div class="heading">
    	<h1 style="float:left">Sữa cấu hình đơn hàng</h1>
      	<?php $this->load->view("admin/save");?>
    </div>
    <div class="content">
      <div class="vtabs">
          <a href="#tab-order" class="selected">Thông tin chung</a>
      </div>
      <div id="tab-order" class="vtabs-content">
      	<form method="post" action="<?php echo URL;?>admin/order_config/check_edit_order_config" enctype="multipart/form-data" class="origin_setting" name="adminForm" id="adminForm" method="post" accept-charset="utf-8" novalidate="novalidate">
                <table class="table_admin">
                    <tbody>
                        <tr>
                            <td><span style="color:#0C9;"><?php if(isset($messages)) echo $messages;?></span></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Tên</td> 
                            <td><input name="contact_name" type="text" autofocus
                            value="<?php 
							foreach($getOrderConfig as $OrderConfig)
							{
								if($OrderConfig->name_order_config=='contact_name')
								{
									echo $OrderConfig->value_order_config;
								}
							}
							?>" /></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Điện thoại	</td> 
                            <td><input name="contact_phone" type="text" autofocus
                            value="<?php 
							foreach($getOrderConfig as $OrderConfig)
							{
								if($OrderConfig->name_order_config=='contact_phone')
								{
									echo $OrderConfig->value_order_config;
								}
							}
							?>" /></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Email</td> 
                            <td><input name="success_mail" type="text" autofocus
                            value="<?php 
							foreach($getOrderConfig as $OrderConfig)
							{
								if($OrderConfig->name_order_config=='success_mail')
								{
									echo $OrderConfig->value_order_config;
								}
							}
							?>" /></td>
                        </tr>
                        <!-- <tr class="alt-row">
                            <td>Email (26)	</td> 
                            <td><input name="subsuccess_mail" type="text" autofocus
                            value="<?php 
							foreach($getOrderConfig as $OrderConfig)
							{
								if($OrderConfig->name_order_config=='subsuccess_mail')
								{
									echo $OrderConfig->value_order_config;
								}
							}
							?>" /></td>
                        </tr> -->
                        <tr class="alt-row">
                            <td>Địa chỉ</td> 
                            <td><input name="contact_address" type="text" autofocus
                            value="<?php 
							foreach($getOrderConfig as $OrderConfig)
							{
								if($OrderConfig->name_order_config=='contact_address')
								{
									echo $OrderConfig->value_order_config;
								}
							}
							?>" /></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Email (CC)</td> 
                            <td><input name="contact_cc_email" type="text" autofocus
                            value="<?php 
							foreach($getOrderConfig as $OrderConfig)
							{
								if($OrderConfig->name_order_config=='contact_cc_email')
								{
									echo $OrderConfig->value_order_config;
								}
							}
							?>" /></td>
                        </tr>
                        <tr>
                        	<td>Bật gửi Email</td>
                            <td><input name="send_reg_to_mail" type="radio" value="1" class="inputbox" <?php 
							foreach($getOrderConfig as $OrderConfig)
							{
								if($OrderConfig->name_order_config=='send_reg_to_mail')
								{
									if($OrderConfig->value_order_config==1)
									echo 'checked="checked"';
								}
							}
							?>>&nbsp;Yes &nbsp;&nbsp;<input name="show_price" type="radio" value="0" class="inputbox" 
                            <?php 
							foreach($getOrderConfig as $OrderConfig)
							{
								if($OrderConfig->name_order_config=='send_reg_to_mail')
								{
									if($OrderConfig->value_order_config==0)
									echo 'checked="checked"';
								}
							}
							?>>&nbsp;No</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Nội dung trả lời</span></div></td><td>
                                    <textarea class="form-control" name="fulltext_order" cols="2" rows="3" id="fulltext_order" title="Không được bỏ trống" >
									<?php 
									foreach($getOrderConfig as $OrderConfig)
									{
										if($OrderConfig->name_order_config=='fulltext_order')
										{
											echo $OrderConfig->value_order_config;
										}
									}
									?>
                                    </textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
      </div>
    </div>
</div>
<script language="javascript" type="text/javascript" src="<?php echo PUBLIC_ADMIN;?>editor/ckeditor.js"></script>
<script>
		CKEDITOR.replace( 'fulltext_order',
		{
			<?php 
			echo $ckFinder;
			?>
		});
		$(document).ready(function(e) {
			$('.vtabs a').tabs();
		});
		
</script>
