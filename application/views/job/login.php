<?php $this->load->view('header_page');?>
<div class="container-fluid">
    <div class="container no-padding container-referral">
        <div class="process-bar">

        </div>
        <form action="" method="POST" id="frm-login">
            <div class="col-sm-6">
                <?php
                if ($msg = $this->session->flashdata('flash_message')) {
                    echo '<div class="box-message col-lg-12 col-md-12">';
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
                    <label>Password <span class="required">(*)</span></label>
                    <input type="password" name="password" id="password" class="form-control" value="" placeholder="">
                    <span class="help-block"><?php echo form_error('password')?></span>
                </div>
                <div class=" col-md-12 col-lg-12 col-sm-12 col-xs-12 no-padding">
                    <button type="submit" name="userLogin" value="userLogin" class="btn btn-login btn-orange btn-lg col-sm-12 col-md-12 col-xs-12">
                        <?php echo $this->lang->line('Login');?>
                    </button>
                </div>
                <a href="<?php echo site_url('affiliate/signUp')?>"><?php echo $this->lang->line('Signup');?></a>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                <img class="img-responsive" src="<?php echo image_url('bg-worker.png')?>">
            </div>
        </form>
    </div>
</div>
    <script>
        $(document).ready(function(){

            $("#frm-login").validate({
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
                    "email": {
                        required : true,
                        email : true,
                        minlength:5
                    },
                    "password" : {
                        required : true,
                        minlength : 6
                    },
                },
                messages:{

                },
                submitHandler: function (form) {
                    $('.btn-login').attr('disable');
                    $('body').append('<div class="loader"><div class="overlay-loading"></div><div class="loading-2"></div></div>');
                    form.submit();
                }
            });
        });
    </script>
<?php $this->load->view('footer_page'); ?>