<div class="body_page">
    <div class="container">
        <div class="row">
            <div class="page_tao_ho_so app-form app-signup col-lg-12 col-xs-12 col-sm-12">
                <div class="title_header">
                    <h3><?php echo $this->lang->line('Sign up jobseeker')?></h3>
                </div>
                <div class="body_mo col-md-12 col-sm-12">
                    <div class="title_top"><?php echo $this->lang->line('The fields marked'); ?> <span class="note-required">*</span> <?php echo $this->lang->line('is required'); ?></div>
                    <form id="form-signup" method="POST" role="form" enctype="multipart/form-data">
                        <div class="">
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
                                <h5 class="block-h"><?php echo $this->lang->line('Info login'); ?></h5>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                        <label for=""><?php echo $this->lang->line('Email'); ?> <span class="note-required">*</span> </label>
                                    </div>
                                    <div class="no-padding-right col-md-5 col-sm-7 col-xs-12 form-group">
                                        <input type="text" name="email" id="email" class="form-control" value="<?php echo set_value('email')?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                        <label for=""><?php echo $this->lang->line('Password'); ?> <span class="note-required">*</span> </label>
                                    </div>
                                    <div class="no-padding-right col-md-5 col-sm-7 col-xs-12 form-group">
                                        <input type="password" name="password" id="password" value="<?php echo set_value('password')?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                        <label for=""><?php echo $this->lang->line('Re-type password'); ?> <span class="note-required">*</span> </label>
                                    </div>
                                    <div class="no-padding-right col-md-5 col-sm-7 col-xs-12 form-group">
                                        <input type="password" name="confirm-password" id="confirm-password" value="<?php echo set_value('confirm-password')?>" class="form-control" id="exampleInputEmail1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                                <h5 class="block-h"><?php echo $this->lang->line('Info person'); ?></h5>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                        <label for=""><?php echo $this->lang->line('ho va ten'); ?> <span class="note-required">*</span> </label>
                                    </div>
                                    <div class="no-padding-right col-md-5 col-sm-7 col-xs-12 form-group">
                                        <input type="text" name="fullname" id="fullname" class="form-control" value="<?php echo set_value('fullname')?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                        <label for=""><?php echo $this->lang->line('Logo'); ?> <span class="note-required">*</span></label>
                                    </div>
                                    <div class="no-padding-right col-md-5 col-sm-7 col-xs-12 form-group">
                                        <input type="file" name="logo" id="logo" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                        <label for=""><?php echo $this->lang->line('Birthday'); ?> <span class="note-required">*</span> </label>
                                    </div>
                                    <div class="no-padding-right col-md-5 col-sm-7 col-xs-12 form-group">
                                        <input type="text" name="birthday" id="birthday" value="<?php echo set_value('birthday')?>" class="form-control">
                                        <script type="text/javascript">
                                            $(function () {
                                                $('#birthday').datetimepicker({
                                                    viewMode: 'years',
                                                    format: 'DD/MM/YYYY'
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                        <label for=""><?php echo $this->lang->line('Sex'); ?> <span class="note-required">*</span> </label>
                                    </div>
                                    <div class="no-padding-right col-md-5 col-sm-7 col-xs-12 form-group">
                                        <select id="sex" name="sex" class="form-control edit-control">
                                            <option value=""><?php echo $this->lang->line('Select');?></option>
                                            <?php
                                            foreach ($default_sex as $key=>$value) {
                                                if($key==$sex){
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
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                        <label for=""><?php echo $this->lang->line('Address'); ?> <span class="note-required">*</span> </label>
                                    </div>
                                    <div class="no-padding-right col-md-5 col-sm-7 col-xs-12 form-group">
                                        <input type="text" name="address" id="address" class="form-control" value="<?php echo set_value('address')?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                        <label for=""><?php echo $this->lang->line('Phone'); ?> <span class="note-required">*</span> </label>
                                    </div>
                                    <div class="no-padding-right col-md-5 col-sm-7 col-xs-12 form-group">
                                        <input type="text" name="phone" id="phone" class="form-control" value="<?php echo set_value('phone')?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                        <label for=""><?php echo $this->lang->line('Email'); ?></label>
                                    </div>
                                    <div class="no-padding-right col-md-5 col-sm-7 col-xs-12 form-group">
                                        <input type="text" name="email_accept_job" id="email_accept_job" class="form-control" value="<?php echo set_value('phone')?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                        <label for=""><?php echo $this->lang->line('Choose nghanh'); ?></label>
                                    </div>
                                    <div class="no-padding-right col-md-5 col-sm-7 col-xs-12 form-group">
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
                                                            echo '<option value="'.$itemChild->id.'">'.$itemChild->category_name.'</option>';
                                                        }
                                                    }
                                                }
                                                echo '</optgroup>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                        <label for=""><?php echo $this->lang->line('Choose address'); ?></label>
                                    </div>
                                    <div class="no-padding-right col-md-5 col-sm-7 col-xs-12 form-group">
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
                                                    ?>
                                                    <option value="<?php echo $item->id ?>"><?php echo $item->city_name; ?></option>
                                                    <?php
                                                    # code...
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="no-padding col-md-3 col-sm-3 col-xs-12 form-group text-right">
                                        <label for=""><?php echo $this->lang->line('Level'); ?></label>
                                    </div>
                                    <div class="no-padding-right col-md-5 col-sm-7 col-xs-12 form-group">
                                        <select id="level" name="level" class="form-control edit-control">
                                            <option value=""><?php echo $this->lang->line('Select');?></option>
                                            <?php
                                            foreach ($default_currentJobLevel as $key=>$value) {
                                                if($key==$level){
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
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class=" col-md-12 col-lg-12 col-sm-12 col-xs-12 no-padding">
                                <div class="col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3 form-group col-xs-12">
                                    <button type="submit" name="usersConfirm" value="usersConfirm" class="btn btn-create btn-info">
                                        <i class="icon_edit"></i>
                                            <?php echo $this->lang->line('Sign up');?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->
</div> <!-- wrap intro -->
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
                "email" : {
                    required : true,
                    email : true,
                    minlength:5,
                    remote:{
                        url: "<?php echo URL.'users/checkUserEmailInfo';?>",
                        type : "POST"
                    }
                },
                "password" : {
                    required : true,
                    minlength : 8
                },
                "confirm-password" : {
                    equalTo : "#password",
                    required : true,
                    minlength : 8
                },
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
                "email":{
                    required : "<?php echo $this->lang->line('This field is required') ?>",
                    email : "<?php echo $this->lang->line('Please enter a valid email address.') ?>",
                    minlength : "<?php echo $this->lang->line('Email')." ".$this->lang->line('min_length'); ?>",
                    remote :  "<?php echo $this->lang->line('This email is already in use.') ?> <a href='<?php echo URL.$this->lang->line('l_sign_in'); ?>' class='login'>Bạn muốn đăng nhập?</a>"
                },
                "password" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>",
                    minlength : "Vui lòng nhập ít nhất là 8 ký tự."
                },
                "confirm-password" : {
                    equalTo : "<?php echo $this->lang->line('Please enter the same password as above.') ?>",
                    required : "<?php echo $this->lang->line('This field is required') ?>",
                    minlength : "Vui lòng nhập ít nhất là 8 ký tự."
                },
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