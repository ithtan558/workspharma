
<div class="body_page">
    <div class="container">
        <div class="row">
            <!-- Begin body left -->
            <?php $this->load->view('employers/main_top_manage_resume'); ?>
            <div class="col-md-12 col-sm-12 col-xs-12 padding-top">
                <div class="my_job">
                    <div class="title_header">
                        <h3><?php echo $this->lang->line('Send resume alerts');?></h3>
                    </div>
                    <div class="body_mo">
                        <div class="row">
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
                        	<?php
                            if ($msg = $this->session->flashdata('flash_message')) {
                                showMessage2($msg);
                            }
                            ?>
                        	<div class="col-md-12 col-sm-12 col-xs-12 margin-bottom no-padding">
	                        	<form id="form-send-resume-alert" class="" action="" method="post">
	                                <input type="hidden" name="tab" class="form-control" value="2" />
	                                <div class="row">
	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
	                                        <?php echo $this->lang->line('Sampling letter'); ?>
	                                    </div>
	                                    <div class="col-md-5 col-sm-5 col-xs-12 form-group">
	                                        <select class="form-control" name="resume_alert_id">
	                                           <option value="" selected="selected">Vui lòng chọn...</option>
	                                            <?php
	                                            foreach ($getUserMessagesDefault->result() as $item) {
	                                                ?>
	                                                <option value="<?php echo $item->id ?>"><?php echo $item->name; ?></option>
	                                                <?php
	                                                # code...
	                                            }
	                                            ?>
	                                        </select>
	                                    </div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
	                                        <?php echo $this->lang->line('Send'); ?> 
	                                    </div>
	                                    <div class="col-md-5 col-sm-5 col-xs-12 form-group margin-top-7">
	                                    	<span><?php echo $getUserWorker->email; ?></span>
	                                    </div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
	                                        <?php echo $this->lang->line('Subject line'); ?> 
	                                    </div>
	                                    <div class="col-md-5 col-sm-5 col-xs-12 form-group">
	                                        <input type="text" name="title_send_resume_alert" class="form-control" placeholder="" />
	                                    </div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
	                                        <?php echo $this->lang->line('Hello'); ?> 
	                                    </div>
	                                    <div class="col-md-5 col-sm-5 col-xs-12 form-group margin-top-7">
	                                    	<span><?php echo $getUserWorker->fullname; ?></span>
	                                    </div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
	                                        <?php echo $this->lang->line('Contents of letter'); ?> 
	                                    </div>
	                                    <div class="col-md-5 col-sm-5 col-xs-12 form-group">
	                                        <textarea class="form-control" id="content_send_resume_alert" name="content_send_resume_alert"
                                                  rows="10"></textarea>
	                                    </div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-md-9 col-md-offset-3 col-sm-9 col-offset-sm-3 col-xs-12">
	                                        <button type="submit" name="submitSendResumeAlert" value="submitSendResumeAlert" class="btn btn-info"><?php echo $this->lang->line('Send mail'); ?></button>
	                                        <button type="reset" name="submitSendResumeAlert" value="submitSendResumeAlert" class="btn btn-info"><?php echo $this->lang->line('Reset'); ?></button>
	                                        <a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_view_resume').'/job_id/'.$getUserApplies->job_id; ?>" class="btn btn-info"><?php echo $this->lang->line('Close'); ?></a>
	                                    </div>
	                                </div>
	                            </form>
	                        </div>
                        </div> <!--row-->
                    </div>
                </div><!-- end 9 Nhóm ngành nghề -->
            </div><!-- end body left -->
        </div>
    </div>
</div><!-- end body page -->
<script>
    $(document).ready(function(){
        $("#form-send-resume-alert").validate({
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
                "resume_alert_id" : {
                    required : true
                },
                "title_send_resume_alert" : {
                    required : true
                },
                "content_send_resume_alert" : {
                    required : true
                }
            },
            messages:{
                "resume_alert_id":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "title_send_resume_alert":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "content_send_resume_alert":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                }
            },
            submitHandler: function (form) {
                $('body').append('<div class="loader"><div class="overlay-loading"></div><div class="loading-2"></div></div>');
                form.submit();
            }
        });
    });
</script>
