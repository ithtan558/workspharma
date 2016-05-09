    <div class="wrap-intro">
        <div class="container">
            <div class="row">
                <div class="app-signup app-form app-form-login col-lg-12 col-xs-12 col-md-12 col-sm-12">
                    <div class="col-md-5 col-sm-5 img-signup hidden-xs">
                        <img class="img-responsive" src="<?php echo IMAGES?>bg_login.png">
                    </div>
                    <div class="col-md-7 col-sm-7">
                        <?php
                        //Show Flash Message
                        if ($msg = $this->session->flashdata('error_login')) {
                        ?>
                        <div class="alert alert-danger col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 margin-top" style="margin-bottom: 0px;">
                            <button data-dismiss="alert" class="close"></button>
                            <i class="fa fa-times-circle"></i>
                            <ul>
                                <?php
                                echo $msg['msg'];
                                ?>
                            </ul>
                        </div>
                        <?php
                        }
                        if ($msg = $this->session->flashdata('flash_message')) {
                            echo '<div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 no-padding">';
                            showMessage3($msg);
                            echo '</div>';
                        }
                        ?>
                        <form id="frm-login" method="POST" action="">
                            <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 no-padding">
                                <h2><?php echo $this->lang->line('Log into your account');?></h2>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 no-padding">
                                    <input type="text" name="email" class="form-control" id="email" placeholder='<?php echo $this->lang->line('Email')?>'>
                                    <span><?php echo form_error('username')?></span>
                                </div>
                                <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 no-padding">
                                    <input type="password" name="password" class="form-control" id="password" placeholder='<?php echo $this->lang->line('Password')?>'>
                                    <span><?php echo form_error('password')?></span>
                                </div>
                            </div>
                            <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 remember no-padding">
                                <label>
                                    <input type="checkbox" name="remember"> <?php echo $this->lang->line('Remember')?>
                                </label>
                                <label style="margin-left: 20px;"><a href="<?php echo URL.$this->lang->line('l_forgot_password');?>"><?php echo $this->lang->line('Forget password?'); ?></a></label>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-1 col-md-10 no-padding col-md-offset-1">
                                    <button type="submit" name="usersLogin" value="usersLogin" class="btn btn-create btn-info col-sm-12 col-md-12 col-xs-12 btn-lg">
                                        <i class="icon_edit"></i><?php echo $this->lang->line('Login') ?></button></div>
                            </div>
                            <?php
                            $getParams = get_params();
                            if(isset($getParams['next'])){
                                $link = URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_sign_up').'/?next='.$getParams['next'];
                            }
                            else{
                                $link = URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_sign_up');
                            }
                            ?>
                            <p class="margin-top col-lg-11 col-md-10 col-sm-11 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 no-padding"><?php echo $this->lang->line("Don't have account?")?> <span><a class="xanh-13-b" href="<?php echo $link; ?>"><?php echo $this->lang->line("Register_now")?></a></span>
                            </p>
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
                    "email": {
                        required: true,
                        //email: true
                    },
                    "password": {
                        required: true
                    }
                },
                messages: {
                    "email": {
                        required: "<?php echo $this->lang->line('Email')." ".$this->lang->line('required') ?>",
                        //email : "<?php echo $this->lang->line('Please enter a valid email address.') ?>",
                    },
                    "password": {
                        required: "<?php echo $this->lang->line('Password')." ".$this->lang->line('required') ?>"
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