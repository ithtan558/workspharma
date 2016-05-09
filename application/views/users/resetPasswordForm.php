<div class="wrap-intro">
    <div class="container">
        <div class="row">
            <div class="app-signup app-form app-form-login col-lg-12 col-xs-12 col-md-12 col-sm-12">
                <div class="col-md-5 col-sm-5 img-signup">
                    <img class="img-responsive" src="<?php echo IMAGES?>bg_login.png">
                </div>
                <div class="col-md-7 col-sm-7">
                    <?php
                    if(isset($expire) && $expire){
                        echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>".showMessage2(array('type' => 'error', 'message' => $this->lang->line('This link has expired')))."</div>";
                    }else{
                    //Show Flash Message
                    if ($msg = $this->session->flashdata('error_login')) {
                        ?>
                        <div class="alert alert-danger">
                            <button data-dismiss="alert" class="close"></button>
                            <i class="fa fa-times-circle"></i>
                            <ul>
                                <?php
                                echo $msg['msg'];
                                ?>
                            </ul>
                        </div>
                    <?php } ?>
                    <form id="frm-login" method="POST" action="">
                        <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 no-padding">
                            <h2><?php echo $this->lang->line('Forgot Password?');?></h2>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 no-padding">
                                <input type="password" name="password" id="password" value="<?php echo set_value('password')?>" class="form-control"  placeholder='<?php echo $this->lang->line('Password')?>'>
                                <span class="help-block"><?php echo form_error('password')?></span>
                            </div>
                            <div class="col-md-10 col-sm-offset-1 col-sm-10 col-md-offset-1 no-padding form-group col-xs-10 div-captcha">
                                <input type="password" name="confirm-password" id="confirm-password" value="<?php echo set_value('confirm-password')?>" class="form-control" id="exampleInputEmail1" placeholder='<?php echo $this->lang->line('Re-type password'); ?>'>
                                <span class="help-block"><?php echo form_error('confirm-password')?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-1 col-md-10 no-padding col-md-offset-1">
                                <button type="submit" name="resetPassword" value="resetPassword" class="btn btn-create col-sm-12 col-md-12 col-xs-12 btn-lg">
                                    <i class="icon_edit"></i><?php echo $this->lang->line('Save change')?>
                                </button>
                            </div>
                        </div>
                    </form>
                    <?php } ?>
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
                "password" : {
                    required : true,
                    minlength : 8
                },
                "confirm-password" : {
                    equalTo : "#password",
                    required : true,
                    minlength : 8
                }
            },
            messages:{
                "password" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>",
                    minlength : "Vui lòng nhập ít nhất là 8 ký tự."
                },
                "confirm-password" : {
                    equalTo : "<?php echo $this->lang->line('Please enter the same password as above.') ?>",
                    required : "<?php echo $this->lang->line('This field is required') ?>",
                    minlength : "Vui lòng nhập ít nhất là 8 ký tự."
                },
            },
            submitHandler:function(form){
                $('.btn-create').attr('disable');
                $('body').append('<div class="loader"><div class="overlay-loading"></div><div class="loading-2"></div></div>');
                form.submit();
            }
        });
    });
</script>