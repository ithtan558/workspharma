<div class="wrap-intro">
    <div class="container">
        <div class="row">
            <div class="app-form app-signup col-lg-12 col-xs-12 col-sm-12">
                <?php $this->load->view('users/menuEditAccount'); ?>
                <div class="col-md-12 col-sm-12 no-padding">
                	<form id="form-editAccount" method="POST" role="form" enctype="multipart/form-data">
                    	<div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                            <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
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
                                <h5 class="block-h"><?php echo $this->lang->line('Info login'); ?></h5>
                            </div>
                            <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                <label for=""><?php echo $this->lang->line('Email'); ?></label>
                            </div>
	                        <div class="no-padding-right col-md-9 col-sm-9 col-xs-12 form-group margin-top-7">
	                            <?php echo $jobseeker->email; ?>
	                        </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h5 class="block-h"><?php echo $this->lang->line('Info person'); ?></h5>
                            </div>
                            <div class="no-padding col-md-3 col-sm-3 col-xs-3 form-group text-right">
                                <label for=""><?php echo $this->lang->line('ho va ten'); ?> <span class="note-required">*</span> </label>
                            </div>
                            <div class="no-padding-right col-md-9 col-sm-9 col-xs-9 form-group">
                                <input type="text" name="fullname" id="fullname" class="form-control" value="<?php echo set_value('fullname', $jobseeker->fullname)?>" >
                            </div>
                            <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                <label for=""><?php echo $this->lang->line('Logo'); ?></label>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12 no-padding-right form-group">
                                <?php
                                if(is_file_exists($jobseeker->logo) == TRUE){
                                    $url_image = uimage_url($jobseeker->logo);
                                }
                                if(isset($url_image)){
                                    echo '<img src="'.$url_image.'" alt="" width="50" height="50">';
                                }
                                ?>
                                <input type="file" name="logo" id="logo" value="" class="form-control">
                            </div>
                            <div class="no-padding col-md-3 col-sm-3 col-xs-3 form-group text-right">
                                <label for=""><?php echo $this->lang->line('Birthday'); ?> <span class="note-required">*</span> </label>
                            </div>
                            <div class="no-padding-right col-md-9 col-sm-9 col-xs-9 form-group">
                                
                                <input type="text" name="birthday" id="birthday" value="<?php echo date('d/m/Y',$jobseeker->birthday);?>" class="form-control">
                                <span class="help-block"><?php echo form_error('birthday')?></span>
                                <script type="text/javascript">
                                    $(function () {
                                        $('#birthday').datetimepicker({
                                            viewMode: 'years',
                                            format: 'DD/MM/YYYY'
                                        });
                                    });
                                </script>
                            </div>

                            <div class="no-padding col-md-3 col-sm-3 col-xs-3 form-group text-right">
                                <label for=""><?php echo $this->lang->line('Sex'); ?> <span class="note-required">*</span> </label>
                            </div>
                            <div class="no-padding-right col-md-9 col-sm-9 col-xs-9 form-group">
                                <select id="sex" name="sex" class="form-control edit-control">
                                    <option value=""><?php echo $this->lang->line('Select');?></option>
                                    <?php
                                    foreach ($default_sex as $key=>$value) {
                                        if($jobseeker->sex == $key){
                                            $class='selected="selected"';
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

                            <div class="no-padding col-md-3 col-sm-3 col-xs-3 form-group text-right">
                                <label for=""><?php echo $this->lang->line('Address'); ?></label>
                            </div>
                            <div class="no-padding-right col-md-9 col-sm-9 col-xs-9 form-group">
                                <input type="text" name="address" id="address" class="form-control" value="<?php echo set_value('address', $jobseeker->address)?>">
                            </div>

                            <div class="no-padding col-md-3 col-sm-3 col-xs-3 form-group text-right">
                                <label for=""><?php echo $this->lang->line('Phone'); ?> <span class="note-required">*</span> </label>
                            </div>
                            <div class="no-padding-right col-md-9 col-sm-9 col-xs-9 form-group">
                                <input type="text" name="phone" id="phone" class="form-control" value="<?php echo set_value('phone', $jobseeker->phone)?>">
                            </div>
                            <div class="no-padding col-md-3 col-sm-3 col-xs-3 form-group text-right">
                                <label for=""><?php echo $this->lang->line('Choose nghanh'); ?></label>
                            </div>
                            <div class="no-padding-right col-md-9 col-sm-9 col-xs-9 form-group">
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
                                                    $arrayCategory=explode(',',$jobseeker->category_ids);
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

                            <div class="no-padding col-md-3 col-sm-3 col-xs-3 form-group text-right">
                                <label for=""><?php echo $this->lang->line('Choose address'); ?></label>
                            </div>
                            <div class="no-padding-right col-md-9 col-sm-9 col-xs-9 form-group">
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
                                            $arrayCity=explode(',',$jobseeker->city_ids);
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

                            <div class="no-padding col-md-3 col-sm-3 col-xs-3 form-group text-right">
                                <label for=""><?php echo $this->lang->line('Level'); ?></label>
                            </div>
                            <div class="no-padding-right col-md-9 col-sm-9 col-xs-9 form-group">
                                <select id="level" name="level" class="form-control edit-control">
                                    <option value=""><?php echo $this->lang->line('Select');?></option>
                                    <?php
                                    foreach ($default_currentJobLevel as $key=>$value) {
                                        if($key==$jobseeker->level_ids){
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
                "fullname" : {
                    required : true
                },
                "birthday" : {
                    required : true
                },
                "address" : {
                    required : true
                },
                "sex" : {
                    required : true
                },
                "phone" : {
                    required : true
                }
            },
            messages:{
                
                "fullname" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "address" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "birthday" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "sex" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "phone" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
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