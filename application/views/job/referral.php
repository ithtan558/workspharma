<?php $this->load->view('header_page');?>
<div class="container-fluid">
    <div class="container no-padding container-referral">

            <?php
            if ($msg = $this->session->flashdata('flash_message')) {
                echo '<div class="box-message col-lg-12 col-md-12">';
                showMessage2($msg);
                echo '</div>';
            }else{
            ?>


        <form action="" method="POST" id="frm-worker">
            <div class="col-sm-6">

                <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group">
                    <label><?php echo $this->lang->line('Full name')?><span class="required">(*)</span></label>
                    <input type="text" name="fullname" id="fullname" class="form-control" value="<?php echo set_value('fullname')?>" placeholder="">
                    <span class="help-block"><?php echo form_error('fullname')?></span>
                </div>
                <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group">
                    <label>Email <span class="required">(*)</span></label>
                    <input type="text" name="email" id="email" class="form-control" value="<?php echo set_value('email')?>" placeholder="">
                    <span class="help-block"><?php echo form_error('email')?></span>
                </div>
                <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group">
                    <label><?php echo $this->lang->line('Phone')?> <span class="required">(*)</span></label>
                    <input type="text" name="phone" id="phone" class="form-control" value="<?php echo set_value('phone')?>" placeholder="">
                    <span class="help-block"><?php echo form_error('phone')?></span>
                </div>
                <div class="box-referral">
                    <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group">
                        <label><?php echo $this->lang->line("Referee's full name")?> <span class="required">(*)</span></label>
                        <input type="text" name="fullname_referral" id="fullname_referral" class="form-control" value="<?php echo set_value('fullname_referral')?>" placeholder="">
                        <span class="help-block"><?php echo form_error('fullname_referral')?></span>
                    </div>
                    <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group">
                        <label><?php echo $this->lang->line("Referee's email")?> <span class="required">(*)</span></label>
                        <input type="text" name="email_referral" id="email_referral" class="form-control" value="<?php echo set_value('email_referral')?>" placeholder="">
                        <span class="help-block"><?php echo form_error('email_referral')?></span>
                    </div>
                    <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group">
                        <label><?php echo $this->lang->line("Referee's phone number")?> <span class="required">(*)</span></label>
                        <input type="text" name="phone_referral" id="phone_referral" class="form-control" value="<?php echo set_value('phone_referral')?>" placeholder="">
                        <span class="help-block"><?php echo form_error('phone_referral')?></span>
                    </div>
                    <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group">
                        <label><?php echo $this->lang->line("Year(s) of experience")?></label>
                        <select name="year_exp" class="form-control year_exp">
                            <option value="">-- <?php echo $this->lang->line("Please select")?> --</option>
                            <option value="0.5" <?php echo ($year_exp == 0.5)?'selected':''?>><?php echo $this->lang->line("Fresh graduate")?></option>
                            <?php
                            for($i=1; $i <= 5; $i++){
                                $selected = '';
                                if($year_exp == $i){
                                    $selected = 'selected';
                                }
                                if($i == 5){
                                    echo '<option value="'.$i.'" '.$selected.'>'.$i.'+ year</option>';
                                }else{
                                    echo '<option value="'.$i.'" '.$selected.'>'.$i.' year</option>';
                                }
                            }
                            ?>
                        </select>
                        <span class="help-block"><?php echo form_error('year_exp'); ?></span>
                    </div>

                    <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group">
                        <label><?php echo $this->lang->line("Skill")?> <span class="required">(*)</span></label>
                        <div class="div-sector">
                            <label><input type="checkbox" name="sector[]" value="1" <?php echo ($sector != '' && in_array(1, $sector))?'checked':''?>> iOS</label>
                            <label><input type="checkbox" name="sector[]" value="2" <?php echo ($sector != '' && in_array(2, $sector))?'checked':''?>> Android</label>
                            <label><input type="checkbox" name="sector[]" value="3" <?php echo ($sector != '' && in_array(3, $sector))?'checked':''?>> Windows Phone</label>
                            <label><input type="checkbox" name="sector[]" value="4" <?php echo ($sector != '' && in_array(4, $sector))?'checked':''?>> UX/UI Design</label>
                            <label><input type="checkbox" name="sector[]" value="5" <?php echo ($sector != '' && in_array(5, $sector))?'checked':''?>> Game</label>
                            <label><input type="checkbox" name="sector[]" value="6" <?php echo ($sector != '' && in_array(6, $sector))?'checked':''?>> Game Artist</label>
                            <label><input type="checkbox" name="sector[]" value="8" <?php echo ($sector != '' && in_array(8, $sector))?'checked':''?>> Designer</label>
                            <label><input type="checkbox" name="sector[]" value="9" <?php echo ($sector != '' && in_array(9, $sector))?'checked':'checked'?>> <?php echo $this->lang->line("i don't know (to be confirmed)")?></label>
                        </div>
                        <span class="help-block"><?php echo form_error('sector')?></span>
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
                </div>
                <div class=" col-md-12 col-lg-12 col-sm-12 col-xs-12 no-padding">
                    <button type="submit" name="workerConfirm" value="workerConfirm" class="btn btn-worker btn-orange btn-lg col-sm-12 col-md-12 col-xs-12">
                        Lưu
                    </button>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                <img class="img-responsive" src="<?php echo image_url('bg-worker.png')?>">
            </div>
        </form>
        <?php } ?>
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
                   "fullname" : {
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
                    "fullname_referral" : {
                        required : true
                    },
                    "year_exp" : {
                        required : true
                    },
                    "email_referral": {
                        required : true,
                        email : true,
                        minlength:5
                    },
                    "phone_referral" : {
                        required : true
                    },
                    "sector[]": {
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
                    $('.btn-worker').attr('disable');
                    $('body').append('<div class="loader"><div class="overlay-loading"></div><div class="loading-2"></div></div>');
                    form.submit();
                }
            });
        });
    </script>
<?php $this->load->view('footer_page'); ?>