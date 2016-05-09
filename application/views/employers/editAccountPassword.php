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
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h5 class="block-h"><?php echo $this->lang->line('Password info'); ?></h5>
                            </div>
                            <div class="no-padding col-md-3 col-sm-3 col-xs-3 form-group text-right">
                                <label for=""><?php echo $this->lang->line('Password'); ?> <span class="note-required">*</span> </label>
                            </div>
                            <div class="no-padding-right col-md-9 col-sm-9 col-xs-9 form-group">
                                <input type="password" name="password" id="password" value="<?php echo set_value('password')?>" class="form-control">
                            </div>

                            <div class="no-padding col-md-3 col-sm-3 col-xs-3 form-group text-right">
                                <label for=""><?php echo $this->lang->line('Re-type password'); ?> <span class="note-required">*</span> </label>
                            </div>
                            <div class="no-padding-right col-md-9 col-sm-9 col-xs-9 form-group">
                                <input type="password" name="confirm-password" id="confirm-password" value="<?php echo set_value('confirm-password')?>" class="form-control" id="exampleInputEmail1">
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
        $("#form-signup").validate({
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