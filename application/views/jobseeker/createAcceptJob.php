<div class="body_page">
    <div class="container">
        <div class="row">
            <!-- Begin body left -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="page_tao_ho_so">
                    <div class="title_header">
                        <h3><?php echo $this->lang->line('Accept job'); ?></h3>
                    </div>
                    <div class="body_mo">
                        <div class="title_top"><?php echo $this->lang->line('The fields marked'); ?> <span class="note-required">*</span> <?php echo $this->lang->line('is required'); ?></div>
                        <form method="POST" action="" id="form-create-accept-job" enctype="multipart/form-data">
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
                            if($msg = $this->session->flashdata('flash_message')) {
                                echo '<div class="box-message">';
                                showMessage2($msg);
                                echo '</div>';
                            }
                            ?>
                            <div role="tabpanel">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="b1">
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label color-red"><?php echo $this->lang->line('Edit / stop receiving notifications'); ?></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Choose nghanh'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            $('#category').multiselect({
                                                                nonSelectedText: "<?php echo $this->lang->line('Choose nghanh'); ?>"
                                                            });
                                                        });
                                                    </script>
                                                    <select class="form-control"  id="category" name="category[]" multiple="multiple">
                                                        <?php
                                                        foreach ($getCategories->result() as $item) {
                                                            if($item->parent_id==0){
                                                            echo '<optgroup label="'.$item->category_name.'">';
                                                                foreach ($getCategories->result() as $itemChild) {
                                                                    if($item->id==$itemChild->parent_id){
                                                                        if(isset($getUsersAcceptJob)){
                                                                            $arrayCategory=explode(',',$getUsersAcceptJob->category_ids);
                                                                        }
                                                                        else{
                                                                            $arrayCategory=explode(',',$city);
                                                                        }
                                                                        if(in_array($itemChild->id, $arrayCategory)){
                                                                            $class = "selected='selected'";
                                                                        }
                                                                        else{
                                                                            $class='';
                                                                        }
                                                                        echo '<option '.$class.' value="'.$itemChild->id.'">'.$itemChild->category_name.'</option>';
                                                                    }
                                                                }
                                                            }
                                                            echo '</optgroup>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Choose address'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            $('#city').multiselect({
                                                                nonSelectedText: "<?php echo $this->lang->line('Address'); ?>"
                                                            });
                                                        });
                                                    </script>
                                                    <select class="form-control"  id="city" name="city[]" multiple="multiple">
                                                        <?php
                                                            foreach ($getCities->result() as $item) {
                                                                if(isset($getUsersAcceptJob)){
                                                                    $arrayCity=explode(',',$getUsersAcceptJob->city_ids);
                                                                }
                                                                else{
                                                                    $arrayCity=explode(',',$city);
                                                                }
                                                                if(in_array($item->id, $arrayCity)){
                                                                    $class = "selected='selected'";
                                                                }
                                                                else{
                                                                    $class='';
                                                                }
                                                                ?>
                                                                <option <?php echo $class; ?> value="<?php echo $item->id ?>"><?php echo $item->city_name; ?></option>
                                                                <?php
                                                                # code...
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Level'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-7 col-xs-12">
                                                    <select id="level" name="level" class="form-control edit-control">
                                                        <option value=""><?php echo $this->lang->line('Select');?></option>
                                                        <?php
                                                        foreach ($default_currentJobLevel as $key=>$value) {
                                                            if($key==$level || (isset($getUsersAcceptJob) && $getUsersAcceptJob->level_ids == $key)){
                                                                $class = "selected='selected'";
                                                            }
                                                            else{
                                                                $class='';
                                                            }
                                                            ?>
                                                            <option <?php echo $class; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>
                                                            <?php
                                                            # code...
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                         </div>

                                         <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-7 col-md-offset-3 col-sm-offset-3 col-sm-7 col-xs-12">
                                                    <div><?php echo $this->lang->line('If you want to temporarily stop receiving job alerts, please click below'); ?></div>
                                                    <label><input  type="checkbox" value="1" name="is_deleted" <?php if(isset($getUsersAcceptJob) && $getUsersAcceptJob->is_deleted == 1) echo 'checked'; ?>> <?php echo $this->lang->line('stop accpet job'); ?></label>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                         </div>
                                         
                                     </div>
                                    <div class="row">
                                        <div class="col-md-5 col-md-offset-3 col-sm-offset-3 col-sm-5 col-xm-12">
                                            <button class="btn btn-info btn-create-resume" type="submit" name="createAcceptJob" value="createAcceptJob"><?php echo $this->lang->line('Update'); ?></button>
                                        </div>
                                    </div>
                                    <div class="row padding-top">
                                        <div class="form-group">
                                            <div class="col-md-7 col-md-offset-3 col-sm-offset-3 col-sm-7 col-xs-12">
                                                <?php echo $this->lang->line('Explain'); ?>
                                            </div>
                                            <div style="clear:both;"></div>
                                        </div>
                                     </div>
                                </div><!-- end bước 6 -->
                            </div>
                        </form>
                    </div>
                </div><!-- end 9 Nhóm ngành nghề -->
            </div><!-- end body left -->
        </div>
    </div>
</div><!-- end body page -->
<script>
    $(document).ready(function(){
        $("#form-create-accept-job").validate({
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
            submitHandler: function (form) {
                $('.btn-create').attr('disable');
                $('body').append('<div class="loader"><div class="overlay-loading"></div><div class="loading-2"></div></div>');
                form.submit();
            }
        });

    });
</script>