<div id="main-content" class="container">
    <div class="content">
    	<table>
            <tbody>
                <tr>
                    <td>
                        <?php
						$stt='';
						foreach($listContact as $contact)
						{
							?>
							<h3 class="name"><?php echo $contact->name_contact;?></h3>
							<div class="body-contact">
								<table class="siteForm">
									<tbody>
										<?php
										if($contact->address_contact!="")
										{
											?>
												<tr>
													<td class="label"><img src="<?php echo IMAGES;?>contact/address.png" boder="0"></td>
													<td><address><?php echo $contact->address_contact;?></address></td>
												</tr>
											<?php
										}
										if($contact->website_contact!="")
										{
											?>
												<tr>
													<td class="label"><img src="<?php echo IMAGES;?>contact/website.png" boder="0"></td>
													<td><?php echo $contact->website_contact;?></td>
												</tr>
											<?php
										}
										if($contact->email_contact!="")
										{
											?>
												<tr>
													<td class="label"><img src="<?php echo IMAGES;?>contact/email.png" boder="0"> </td>
													<td><?php echo $contact->email_contact;?></td>
												</tr>
											<?php
										}
										if($contact->telephone_contact!="")
										{
											?>
												<tr>
													<td class="label"><img src="<?php echo IMAGES;?>contact/tel.png" boder="0"></td>
													<td><?php echo $contact->telephone_contact;?></td>
												</tr>
											<?php
										}
										if($contact->mobilephone_contact!="")
										{
											?>
												<tr>
													<td class="label"><img src="<?php echo IMAGES;?>contact/mobile.png" boder="0"></td>
													<td><?php echo $contact->mobilephone_contact;?></td>
												</tr>
											<?php
										}
										if($contact->fax_contact!="")
										{
											?>
												<tr>
													<td class="label"><img src="<?php echo IMAGES;?>contact/fax.png" boder="0"></td>
													<td><?php echo $contact->fax_contact;?></td>
												</tr>
											<?php
										}
										if($contact->yahoo_contact!="")
										{
											?>
												<tr>
													<td class="label"><img src="<?php echo IMAGES;?>contact/yahoo1.png" boder="0"></td>
													<td><?php echo $contact->yahoo_contact;?></td>
												</tr>
											<?php
										}
										if($contact->skype_contact!="")
										{
											?>
												<tr>
													<td class="label"><img src="<?php echo IMAGES;?>contact/skype.gif" boder="0"></td>
													<td><?php echo $contact->skype_contact;?></td>
												</tr>
											<?php
										}
										?>
										
									 </tbody>
								</table>
							</div>
							<?php
							$stt=1;
						}
						?>
						</div>
					</div>
						<div class="clear"></div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="form-contact">
			<h3>Để liên hệ với chúng tôi, vui lòng nhập đầy đủ thông tin bên dưới.</h3>
			<p class="messages"><?php if(isset($messages)) echo $messages;?></p>
			
			<p class="note"><i>Những trường có dấu (*) là bắt buộc phải nhập dữ liệu.</i></p>
			<form action="<?php echo URL.'contact/check_sentmail'?>" class="validateform" method="post" name="" id="form-contact">
			
			<table>
			  <tbody><tr>
				<td class="label" nowrap="nowrap">Tên của bạn (*)</td>
				<td><input type="text" name="name" required="required" class="inputbox required" value="" size="35" maxlength="100"></td>
			  </tr>
			  <tr>
				<td class="label">Địa chỉ (*)</td>
				<td><input type="text" name="address" required="required" class="inputbox" value="" size="35" maxlength="150" minlength="10"></td>
			  </tr>
			  <tr>
				<td class="label" nowrap="nowrap">Địa chỉ email (*)</td>
				<td><input type="text" name="email" required="required" class="inputbox required email" value="" size="35"></td>
			  </tr>
			  <tr>
				<td class="label">Điện thoại (*)</td>
				<td><input type="text" name="phone" required="required" class="inputbox" value="" size="35" maxlength="100" minlength="8"></td>
			  </tr>
			  <tr>
				<td class="label" nowrap="nowrap">Tiêu đề tin nhắn (*)</td>
				<td><input type="text" name="subject" required="required" class="inputbox required" value="" size="35" maxlength="100" minlength="5"></td>
			  </tr>
			  <tr>
				<td class="label" nowrap="nowrap">Nội dung (*)</td>
				<td><textarea class="inputbox required" required="required" cols="35" rows="7" name="message" minlength="20"></textarea></td>
			  </tr>
			  
			  <tr>
				<td class="label"></td>
				<td><button type="submit" class="btnsubmit">Gửi đi</button> <button type="reset" value=" Làm lại " class="btnsubmit">Làm lại</button></td>
			  </tr>
			</tbody></table>
			</form>
		</div>
		<div class="body-map-google">
        <?php
			$gmapcode_contact_config='gmapcode_contact_config';
            echo $getConfigContact[0]->$gmapcode_contact_config;
        ?>
        </div>
    </div>
    <!-- .content /-->
    <?php $this->load->view('body/right'); ?>
    <div class="clear"></div>
</div>
<script type="text/javascript">
$(document).ready(function(e) {
	/*$(".map-google h3").click(function(e){
		$(".body-map-google").toggle(500);
	})*/
    /*dang ky*/

		$("#form-contact").validate({ 

			rules: {

				name:{

					required: true

				},

				address:{

					required: true,
					minlength:10

				},

				email:{

					required: true,
					email:true

				},

				phone:{

					required: true,
					number:true,
					minlength:10

				},
				subject:{

					required: true

				},
				message:{

					required: true

				}
				

			},

			messages: {

				name:{

					required: "Bắt buộc nhập"

				},

				address:{

					required: "Bắt buộc nhập",
					minlength: "Ít nhất là 10 kí tự"

				},

				email:{

					required: "Bắt buộc nhập",
					email: "Email chưa đúng định dạng"

				},

				phone:{

					required: "Bắt buộc nhập",
					number: "Phải là số",
					minlength: "Ít nhất là 10 kí tự"

				},
				subject:{

					required: "Bắt buộc nhập"

				},
				message:{

					required: "Bắt buộc nhập"

				}

			}

		});

	/*end đăng ký*/

});

</script>

