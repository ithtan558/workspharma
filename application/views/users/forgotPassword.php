    <div class="wrap-intro">
        <div class="container">
            <div class="row">
                <div class="app-signup app-form app-form-login col-lg-12 col-xs-12 col-md-12 col-sm-12">
                    <div class="col-md-5 col-sm-5 img-signup">
                        <img class="img-responsive" src="<?php echo IMAGES?>bg_login.png">
                    </div>
                    <div class="col-md-7 col-sm-7">
                        <?php
                        if ($msg = $this->session->flashdata('flash_message')) {
                            echo '<div class="margin-top">';
                            showMessage2($msg);
                            echo '</div>';
                        }else{
                        ?>
                        <form id="frm-login" method="POST" action="">
                            
                            <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 no-padding">
                                <h2><?php echo $this->lang->line('Forgot Password?');?></h2>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 no-padding">
                                    <input type="text" name="email" id="email" class="form-control" value="<?php echo set_value('email')?>"  placeholder='Email'>
                                    <span class="help-block"><?php echo form_error('email')?></span>
                                </div>
                                <?php if(RE_CAPTCHA == 1){ ?>
                                    <!-- <div style="margin-bottom: 10px;margin-top: 10px;" class="g-recaptcha col-sm-10 col-sm-offset-1 col-md-10 no-padding col-md-offset-1" data-sitekey="6LfwEQcTAAAAAH6yVhgkQ5Ir4KZRdv3iJ4my27Bt"></div>
                                    <div class="col-sm-10 col-sm-offset-1 col-md-10 no-padding col-md-offset-1"><?php echo form_error('g-recaptcha-response')?></div> -->
                                <?php }else{ ?>
                                    <!-- <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 no-padding div-captcha" style="margin-top: 15px;">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 no-padding">
                                            <input type="text" name="captcha" class="form-control" id="captcha" placeholder="Captcha"/>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-8 captcha-content">
                                            <span><?php echo $captcha; ?></span>
                                        </div>
                                        <?php echo form_error('captcha')?>
                                    </div> -->
                                <?php } ?>
                                <span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 help-block"><?php echo form_error('captcha')?></span>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-1 col-md-10 no-padding col-md-offset-1">
                                    <button type="submit" name="forgotPassword" value="forgotPassword" class="btn btn-create btn-info col-sm-12 col-md-12 col-xs-12 btn-lg">
                                        <i class="icon_edit"></i><?php echo $this->lang->line('Forgot Password?'); ?></button>
                                </div>
                            </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
                <!-- app-form-login -->
            </div>
        </div>
        <!-- /.container -->
    </div> <!-- wrap intro -->
    <script language="javascript" type="text/javascript">
        $(document).ready(function () {
            $("#frm-login").validate({
                errorElement: "span", // contain the error msg in a span tag
                errorClass: 'help-block',
                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                        error.insertAfter($(element).closest('.form-group').children('div').children().last());
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
                    label.addClass('help-block valid');
                    // mark the current input as valid and display OK icon
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
                    $(element).closest('.form-group').find(".glyphicon-remove").remove();
                    $(element).after("<span class='glyphicon glyphicon-ok form-control-feedback'></span>");
                },
                rules: {
                    "email" : {
                        required : true,
                        email : true
                    },
                    // "captcha": {
                    //     required: true
                    // }
                },
                messages: {
                    "email" : {
                        required : "<?php echo $this->lang->line('This field is required') ?>",
                        email : "<?php echo $this->lang->line('Please enter a valid email address.') ?>"
                    },
                    // "captcha": {
                    //     required: "<?php echo $this->lang->line('This field is required')?>"
                    // }
                },
                submitHandler:function(form){
                    $('.btn-create').attr('disable');
                    $('body').append('<div class="loader"><div class="overlay-loading"></div><div class="loading-2"></div></div>');
                    form.submit();
                }
            });
        });
    </script>