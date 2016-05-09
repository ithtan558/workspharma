
<div class="body_page">
    <div class="container">
        <div class="row">
            <!-- Begin body left -->
            <?php $this->load->view('employers/main_top_manage_resume'); ?>
            <div class="col-md-12 col-sm-12 col-xs-12 padding-top">
                <div class="my_job">
                    <div class="title_header">
                        <h3><?php echo $this->lang->line('My resume alerts');?></h3>
                    </div>
                    <div class="body_mo">
                        <div class="row">
                            <div class="col-md-9 col-sm-9 col-xs-12 ho-so">
                            	<div class="col-md-12 col-sm-12 col-xs-12 margin-bottom no-padding">
    	                        	<form id="form-create-message" class="" action="" method="post">
    	                                <input type="hidden" name="tab" class="form-control" value="2" />
    	                                <div class="row">
    	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
    	                                        <?php echo $this->lang->line('Name'); ?> 
    	                                    </div>
    	                                    <div class="col-md-9 col-sm-9 col-xs-12 form-group">
    	                                        <input type="text" name="name" class="form-control" placeholder="<?php echo $this->lang->line('Name')?>" value="<?php if(isset($getResumeAlert))echo urldecode($getResumeAlert->level_resume_find);?>" />
    	                                    </div>
    	                                </div>
    	                                <div class="row">
    	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
    	                                        <?php echo $this->lang->line('Title'); ?> 
    	                                    </div>
    	                                    <div class="col-md-9 col-sm-9 col-xs-12 form-group">
    	                                        <input type="text" name="title" class="form-control" placeholder="<?php echo $this->lang->line('Title')?>" value="<?php if(isset($getResumeAlert))echo urldecode($getResumeAlert->keywords);?>" />
    	                                    </div>
    	                                </div>
    	                                <div class="row">
    	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
    	                                        <?php echo $this->lang->line('Content'); ?> 
    	                                    </div>
    	                                    <div class="col-md-9 col-sm-9 col-xs-12 form-group">
    	                                        <textarea class="form-control" id="content" name="content"
                                                      placeholder=""
                                                      rows="10"><?php echo set_value('content', isset($job->content)?nl2br($job->content):''); ?></textarea>
                                            <?php echo form_error('content') ?>
    	                                    </div>
    	                                </div>
    	                                
    	                                <div class="row">
    	                                    <div class="col-md-2 col-md-offset-3 col-sm-3 col-offset-sm-3 col-xs-12">
    	                                        <button type="submit" name="submitCreateMessage" value="submitCreateMessage" class="btn btn-info"><?php echo $this->lang->line('Agree create notifications'); ?></button>
    	                                    </div>
    	                                </div>
    	                            </form>
    	                        </div>
                            </div>
                            <?php $this->load->view('employers/right'); ?>
                        </div> <!--row-->
                    </div>
                </div><!-- end 9 Nhóm ngành nghề -->
            </div><!-- end body left -->
        </div>
    </div>
</div><!-- end body page -->
<script>
    $(document).ready(function(){
        $("#form-create-message").validate({
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
                "name" : {
                    required : true
                },
                "title" : {
                    required : true
                },
                "content" : {
                    required : true
                }
            },
            messages:{
                "name":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "title":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "content":{
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
