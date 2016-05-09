<div class="wrap-intro">
    <div class="container">
        <div class="row">
            <div class="app-form app-signup col-lg-12 col-xs-12 col-sm-12">
                <?php $this->load->view('users/menuEditAccount'); ?>
                <div class="col-md-12 col-sm-12 no-padding">
                	<form id="form-editAccount" method="POST" role="form" enctype="multipart/form-data">
                        <?php if(validation_errors() != null) { ?>
                            <div class="alert alert-danger">
                                <button data-dismiss="alert" class="close"></button>
                                <i class="fa fa-times-circle"></i>
                                <strong><?php echo $this->lang->line('Message') ?></strong>
                                <ul>
                                    <?php echo validation_errors('<li>', '</li>'); ?>
                                </ul>
                            </div>
                        <?php
                        }
                        ?>
                    	<div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <?php
                            if ($msg = $this->session->flashdata('flash_message')) {
                                showMessage2($msg);
                            }
                            ?>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h5 class="block-h"><?php echo $this->lang->line('Info login'); ?></h5>
                            </div>
                            <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                <label for=""><?php echo $this->lang->line('Email'); ?></label>
                            </div>
	                        <div class="no-padding-right col-md-9 col-sm-9 col-xs-12 form-group margin-top-7">
	                            <?php echo $employer->email; ?>
	                        </div>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h5 class="block-h"><?php echo $this->lang->line('Info company'); ?></h5>
                            </div>
                            <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                <label for=""><?php echo $this->lang->line('ten cong ty'); ?></label>
                            </div>
                            <div class="no-padding-right col-md-9 col-sm-9 col-xs-12 form-group">
                                <input type="text" name="company" id="company" class="form-control" value="<?php echo set_value('company',$employer->company)?>" >
                            </div>

                            <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                <label for=""><?php echo $this->lang->line('logo cong ty'); ?></label>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12 no-padding-right form-group">
                                <?php
                                if(is_file_exists($employer->logo) == TRUE){
                                    $url_image = uimage_url($employer->logo);
                                }
                                if(isset($url_image)){
                                    echo '<img src="'.$url_image.'" alt="">';
                                }
                                ?>
                                <input type="file" name="logo" id="logo" value="" class="form-control">
                            </div>

                            <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                <label for=""><?php echo $this->lang->line('gioi thieu so luoc'); ?></label>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12 no-padding-right form-group">
                                <textarea rows="5" name="description" id="description" class="form-control"><?php echo set_value('description',$employer->description)?></textarea>
                            </div>

                            <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                <label for=""><?php echo $this->lang->line('linh vuc hoat dong'); ?></label>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12 no-padding-right form-group">
                                <input type="text" name="linhvuchoatdong" id="linhvuchoatdong" class="form-control" value="<?php echo set_value('linhvuchoatdong',$employer->linhvuchoatdong)?>">
                            </div>

                            <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                <label for=""><?php echo $this->lang->line('cac chi nhanh'); ?></label>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12 no-padding-right form-group">
                                <input type="text" name="chinhanh" id="chinhanh" class="form-control" value="<?php echo set_value('chinhanh',$employer->chinhanh)?>">
                            </div>

                            <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                <label for=""><?php echo $this->lang->line('tong so nhan vien'); ?></label>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12 no-padding-right form-group">
                                <select name="num_of_staff" class="form-control">
                                    <?php
                                    foreach ($default_number_staff as $key => $value){
                                        if($employer->num_of_staff == $key){
                                            $class='selected="selected"';
                                        }
                                        else{
                                            $class='';
                                        }
                                        ?>
                                        <option <?php echo $class; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                <label for=""><?php echo $this->lang->line('website cong ty'); ?></label>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12 no-padding-right form-group">
                                <input type="text" name="website" id="website" class="form-control" value="<?php echo set_value('website',$employer->website)?>">
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h5 class="block-h"><?php echo $this->lang->line('Info contact'); ?></h5>
                            </div>
                            <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                <label for=""><?php echo $this->lang->line('ho va ten'); ?></label>
                            </div>
                            <div class="no-padding-right col-md-9 col-sm-9 col-xs-12 form-group">
                                <input type="text" name="name" id="name" class="form-control" value="<?php echo set_value('name',$employer->name)?>">
                            </div>

                            <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                <label for=""><?php echo $this->lang->line('chuc vu'); ?></label>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12 no-padding-right form-group">
                                <input type="text" name="chucvu" id="chucvu" class="form-control"  value='<?php echo set_value('chucvu',$employer->chucvu)?>'>
                            </div>
                            <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                <label for=""><?php echo $this->lang->line('email lien he'); ?></label>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12 no-padding-right form-group">
                                <input type="text" name="email_contact" id="email_contact" value="<?php echo set_value('email_contact',$employer->email_contact)?>" class="form-control" id="exampleInputEmail1" placeholder='<?php echo $this->lang->line('chucvu')?>'>
                            </div>
                            <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                <label for=""><?php echo $this->lang->line('dien thoai cty'); ?></label>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12 no-padding-right form-group">
                                <input type="text" name="phone_contact" id="phone_contact" class="form-control" value="<?php echo set_value('phone_contact',$employer->phone_contact)?>">
                            </div>
                            <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                <label for=""><?php echo $this->lang->line('dien thoai di dong'); ?></label>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12 no-padding-right form-group">
                                <input type="text" name="mobile_contact" id="mobile_contact" class="form-control" value="<?php echo set_value('mobile_contact',$employer->mobile_contact)?>">
                            </div>
                            <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                <label for=""><?php echo $this->lang->line('dia chi lien he'); ?></label>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12 no-padding-right form-group">
                                <input type="text" name="address_contact" id="address_contact" class="form-control" value="<?php echo set_value('address_contact',$employer->address)?>">
                            </div>
                            <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                <label for=""><?php echo $this->lang->line('quoc gia'); ?></label>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12 no-padding-right form-group">
                                <select id="country" name="country" class="form-control">
                                    <?php
                                    foreach ($getCountry->result() as $item) {
                                        if($item->id == $employer->city){
                                            $class='selected="selected"';
                                        }
                                        else{
                                            $class='';
                                        }
                                        ?>
                                        <option <?php echo $class; ?> value="<?php echo $item->id ?>"><?php echo $item->country_name; ?></option>
                                        <?php
                                        # code...
                                    }?>
                                </select>
                            </div>
                            <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                <label for=""><?php echo $this->lang->line('tinh thanh'); ?></label>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12 no-padding-right form-group">
                                <select id="city" name="city" class="form-control">
                                    <?php
                                    foreach ($getCities->result() as $item) {
                                        if($item->id == $employer->city){
                                            $class='selected="selected"';
                                        }
                                        else{
                                            $class='';
                                        }
                                        ?>
                                        <option <?php echo $class; ?> value="<?php echo $item->id ?>"><?php echo $item->city_name; ?></option>
                                        <?php
                                        # code...
                                    }?>
                                </select>
                                
                            </div>
                            <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                <label for=""><?php echo $this->lang->line('nhan ban tin'); ?></label>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12 no-padding-right form-group">
                                <select id="accept_new" name="accept_new" class="form-control">
                                    <?php
                                    foreach ($default_accept_new as $key=>$value) {
                                        if($key == $employer->accept_new){
                                            $class='selected="selected"';
                                        }
                                        else{
                                            $class='';
                                        }
                                        ?>
                                        <option <?php echo $class; ?> value="<?php echo $key;?>"><?php echo $value; ?></option>
                                        <?php
                                        # code...
                                    }?>
                                </select>
                            </div>
                        </div>
                        </div>
	                    <div class="form-group">
	                        <div class=" col-md-12 col-lg-12 col-sm-12 col-xs-12 no-padding">
                                <div class="col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3 form-group col-xs-12">
    	                            <button type="submit" name="usersConfirm" value="usersConfirm" class="btn btn-create btn-info">
    		                            <i class="icon_edit"></i>
    		                                <?php echo $this->lang->line('Update');?>
    	                            </button>
                                </div>
                            </div>
                        </div>
                	</form>
            	</div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#form-editAccount").validate({
        	errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                    error.appendTo($(element).closest('.form-group').children('.box-error'));
                    //error.appendTo($(element).closest('.form-group').children('div').last());
                } else if (element.attr("name") == "dd" || element.attr("name") == "mm" || element.attr("name") == "yyyy") {
                    error.insertAfter($(element).closest('.form-group').children('div'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
            highlight: function (element) {
                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                $(element).closest('.form-group').find(".glyphicon-ok").remove();
                $(element).after("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
                // add the Bootstrap error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error');
                
                // set error class to the control group
            },
            success: function (label, element) {
                label.addClass('help-block');
                // mark the current input as valid and display OK icon
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
                $(element).closest('.form-group').find(".glyphicon-remove").remove();
                $(element).after("<span class='glyphicon glyphicon-ok form-control-feedback'></span>");
            },
            rules:{
                "company" : {
                    required : true
                },
                // "logo" : {
                //     required : true
                // },
                "description" : {
                    required : true
                },
                "linhvuchoatdong" : {
                    required : true
                },
                "chinhanh" : {
                    required : true
                },
                "num_of_staff" : {
                    required : true
                },
                "website" : {
                    required : true
                },
                "name" : {
                    required : true
                },
                "chucvu" : {
                    required : true
                },
                "email_contact" : {
                    required : true
                },
                "phone_contact" : {
                    required : true
                },
                "address_contact" : {
                    required : true
                },
                "country" : {
                    required : true
                },
                "city" : {
                    required : true
                }
            },
            messages:{
                "company" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                // "logo" : {
                //     required : "<?php echo $this->lang->line('This field is required') ?>"
                // },
                "description" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "linhvuchoatdong" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "chinhanh" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "num_of_staff" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "website" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "name" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "chucvu" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "email_contact" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "phone_contact" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "address_contact" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "country" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "city" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                }
            },
            submitHandler: function (form) {
                $('.btn-create').attr('disable');
                $('body').append('<div class="loader"><div class="overlay-loading"></div><div class="loading-2"></div></div>');
                form.submit();
            }
        });
    });
</script>