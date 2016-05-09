<div class="body_page">
    <div class="container">
        <div class="row">
            <!-- Begin body left -->
            <div class="col-md-10 col-sm-10 col-xs-12">
                <div class="page_nop_don page_tao_ho_so apply-resume">
                    <div class="title_header">
                        <h3>Nộp hồ sơ ứng tuyển : <?php echo $jobs->title; ?></h3>
                    </div>
                    <div class="body_mo">
                        <div class="row">
                            <form method="POST" id="form-apply-job" action="" enctype="multipart/form-data">
                                <div role="tabpanel">
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="b1">
                                            <h5><?php echo $this->lang->line('Contact info for you');?></h5>
                                            <div class=" margin-top-30">
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <div class="">
                                                        <div class="form-group">
                                                            <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('ho va ten'); ?></label>
                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                <span><?php echo $getResume->fullname; ?></span>
                                                            </div>
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <div class="form-group">
                                                            <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Email'); ?></label>
                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                               <span><?php echo $getResume->email; ?></span>
                                                            </div>
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <div class="form-group">
                                                            <label for="app-resume" class="col-sm-3 col-xs-12 control-label">
                                                                <?php echo $this->lang->line('Resume attachment'); ?>
                                                            </label>
                                                            <div class="col-sm-9 col-xs-12">
                                                                <?php
                                                                if($getResume->job!='') {
                                                                    ?>
                                                                    <div>
                                                                        <input style="top:10px;" checked="checked" type="radio" name="resumeApply" id="optionsRadios1" value="1">
                                                                        <?php echo $getResume->title; ?>
                                                                        <input type="hidden" name="onlineResumeId" id="appDefaultResume" value="<?php echo $this->encrypt->encode($getResume->id); ?>">
                                                                    </div>
                                                                <?php
                                                                }
                                                                else{
                                                                    ?>
                                                                    <a class="font-size-13 color-blue" href="<?php echo site_url('jobseeker/resume')?>"><?php echo $this->lang->line('Update resume');?></a>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <div>
                                                                    <input <?php if($getResume->job=='')echo 'checked';?> style="margin-top:10px;" class="choose-resume" type="radio" name="resumeApply" id="optionsRadios2" value="2">
                                                                    <span class="upload-button">
                                                                        <input type="file" name="resumeFile">
                                                                        <span class="help-block"><?php echo form_error('resumeFile')?></span>
                                                                    </span>
                                                                </div>
                                                                <span class="small gray-light pull-left">Hỗ trợ định dạng .doc, .docx, .pdf, nhỏ hơn 1024KB</span>
                                                            </div>
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <div class="form-group">
                                                            <label class="col-md-3 col-sm-3 col-xs-12 control-label"></label>
                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                            <span><?php echo $this->lang->line('You have resume'); ?>&nbsp;<a class="color-blue" target="_blank" href="<?php echo URL.'public/CV/'.$this->lang->line('file_download_default_cv'); ?>"><?php echo $this->lang->line('Download default CV'); ?></a></span>
                                                            </div>
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <div class="form-group">
                                                            <label class="col-md-3 col-sm-3 col-xs-12 control-label"></label>
                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                <span><?php echo $this->lang->line('Using main yourself'); ?><a class="color-blue" target="_blank" href="<?php echo URL.'public/CV/'.$this->lang->line('file_download_default_mail'); ?>"> <?php echo $this->lang->line('Download default mail'); ?></a></span>
                                                            </div>
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <div class="form-group">
                                                            <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Option'); ?> </label>
                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                <textarea rows="5" name="coverLetter" id="coverLetter" class="form-control"></textarea>
                                                                <span><?php echo $this->lang->line('Please not type more 5000 character'); ?></span>
                                                            </div>
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <div class="col-md-12 col-sm-12 col-xs-12 border">
                                                        <div class="CareerInfomation">
                                                            <div class="title">Thông tin việc làm</div>
                                                            <ul>
                                                                <li><strong>Vị trí / Chức danh:</strong> <?php echo get_level($jobs->level_id); ?></li>
                                                                <li class="bg"><strong>Công ty ứng tuyển:</strong> <?php echo $jobs->company; ?></li>
                                                                <li><strong>Địa chỉ:</strong> <?php echo get_city($jobs->city_ids); ?></li>
                                                                <li class="bg"><strong>Người liên hệ:</strong> <?php echo $jobs->name_contact; ?></li>
                                                                <li><strong>Hết hạn nộp:</strong> <?php echo date('d-m-Y',strtotime($jobs->j_date_created)+(86400*30)) ?></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end bước 3 -->
                                    </div><!-- end bước 6 -->
                                </div>
                                <div class="col-md-8 col-md-offset-3 col-sm-8 col-sm-offset-3 col-xs-12">
                                    <button type="submit" value="submitApply" name="submitApply" class="btn btn-info btn-submitApply"><?php echo $this->lang->line('Accept apply'); ?></button> <button type="reset" class="btn btn-default"><?php echo $this->lang->line('Cancel'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Begin body right -->
            <?php $this->load->view('right'); ?>
            <!-- end body right -->
        </div><!-- end body left -->
    </div>
</div><!-- end body page -->
<script type="application/javascript">
$(document).ready(function () {
    $("#form-apply-job").validate({
        errorElement: "span", // contain the error msg in a span tag
        errorClass: 'help-block',
        errorPlacement: function (error, element) { // render error placement for each input type
            if (element.attr("type") == "radio" ) { // for chosen elements, need to insert the error after the chosen container
                error.insertAfter($(element).closest('.form-group').children('div').children().last());
            } else if (element.attr("name") == "dd" || element.attr("name") == "mm" || element.attr("name") == "yyyy") {
                error.insertAfter($(element).closest('.form-group').children('div'));
            } else if (element.attr("type") == "file" ) {
                error.insertAfter($(element).closest('.form-group').children('div').last());
            } else if (element.attr("type") == "checkbox" ) {
                error.appendTo($(element).closest('.form-group'));
            } else {
                error.insertAfter(element);
                // for other inputs, just perform default behavior
            }
        },
        highlight: function (element) {
            $(element).closest('.help-block').removeClass('valid');
            // display OK icon
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
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
        },
        submitHandler: function (form) {
            $('.btn-submitApply').attr('disable');
            $('body').append('<div class="loader"><div class="overlay-loading"></div><div class="loading-2"></div></div>');
            form.submit();
        }
    });
});
</script>
