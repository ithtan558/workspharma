<?php $this->load->view('header_page');?>
<div class="container-fluid">
    <div class="container no-padding container-referral">
        <div class="process-bar">

        </div>

        <form action="" method="POST" id="frm-worker">
            <div class="col-sm-6">
                <?php
                if ($msg = $this->session->flashdata('flash_message')) {
                    echo '<div class="box-message col-lg-12 col-md-12 no-padding">';
                    showMessage2($msg);
                    echo '</div>';
                }
                ?>
                <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group">
                    <label>Email <span class="required">(*)</span></label>
                    <input type="text" name="email" id="email" class="form-control" value="<?php echo set_value('email')?>" placeholder="">
                    <span class="help-block"><?php echo form_error('email')?></span>
                </div>
                <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group">
                    <label><?php echo $this->lang->line('Full name');?> <span class="required">(*)</span></label>
                    <input type="text" name="full_name" id="full_name" class="form-control" value="<?php echo set_value('full_name')?>" placeholder="">
                    <span class="help-block"><?php echo form_error('full_name')?></span>
                </div>
                <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group">
                    <label><?php echo $this->lang->line('Location')?> <span class="required">(*)</span></label>
                    <select name="city_id" class="form-control">
                        <option value="">-- <?php echo $this->lang->line('Please select')?> --</option>
                        <?php
                        foreach($cities->result() as $item){
                            $selected = '';
                            if($city_id == $item->id){
                                $selected = 'selected';
                            }
                            echo '<option value="'.$item->id.'" '.$selected.'>'.$item->city_name.'</option>';
                        }
                        ?>
                    </select>
                    <span class="help-block"><?php echo form_error('city_id')?></span>
                </div>
                <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group">
                    <label><?php echo $this->lang->line('Phone');?> <span class="required">(*)</span></label>
                    <input type="text" name="phone" id="phone" class="form-control" value="<?php echo set_value('phone')?>" placeholder="">
                    <span class="help-block"><?php echo form_error('phone')?></span>
                </div>
                <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group">
                    <label>Website <span class="required">(*)</span></label>
                    <input type="text" name="website" id="website" class="form-control" value="<?php echo set_value('website')?>" placeholder="">
                    <span class="help-block"><?php echo form_error('website')?></span>
                </div>
                <?php if(RE_CAPTCHA == 1){?>
                    <div style="margin-bottom: 20px;" class="g-recaptcha col-lg-12 col-md-12 col-sm-12 col-xs-12" data-sitekey="6LeV9v8SAAAAAMna_OdCkSOph3tKlhY2DCBRIlo1"></div>
                    <?php echo form_error('g-recaptcha-response')?>

                <?php }else{ ?>
                    <div class="col-md-12 col-sm-12 no-padding form-group col-xs-12 div-captcha">
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-4 no-padding">
                            <input type="text" name="captcha" maxlength="8" class="form-control" id="captcha" placeholder="Captcha"/>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-8 captcha-content">
                            <span><?php echo $captcha; ?></span>
                        </div>
                        <span class="help-block"><?php echo form_error('captcha')?></span>
                    </div>
                <?php } ?>
                <div class=" col-md-12 col-lg-12 col-sm-12 col-xs-12 no-padding">
                    <button type="submit" name="btn_signup" value="btn_signup" class="btn btn-signup btn-orange btn-lg col-sm-12 col-md-12 col-xs-12">
                        <?php echo $this->lang->line('Signup');?>
                    </button>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                <img class="img-responsive" src="<?php echo image_url('bg-worker.png')?>">
            </div>
        </form>
    </div>
</div>
    <script>
        $(document).ready(function(){

            $("#frm-worker").validate({
                errorElement: "span", // contain the error msg in a span tag
                errorClass: 'help-block',
                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                        error.insertAfter($(element).closest('.form-group').children('.help-block'));
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
                   "full_name" : {
                        required : true
                    },
                    "email": {
                        required : true,
                        email : true,
                        minlength:5
                    },
                    "phone" : {
                        required : true
                    },
                    "city_id" : {
                        required : true
                    },
                    "website" : {
                        required : true
                    },
                    "captcha": {
                        required : true
                        //minlength:6,
                    }
                },
                messages:{

                },
                submitHandler: function (form) {
                    $('.btn-signup').attr('disable');
                    $('body').append('<div class="loader"><div class="overlay-loading"></div><div class="loading-2"></div></div>');
                    form.submit();
                }
            });
        });
    </script>
<?php $this->load->view('footer_page'); ?>