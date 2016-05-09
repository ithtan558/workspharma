<?php $this->load->view('header_page');?>
<div class="container-fluid">
    <form action="" method="POST" id="frm-invoice" class="smart-wizard">
    <div id="wizard" class="container no-padding container-invoice swMain">
        <!--<div class="process-bar">
            <img src="<?php /*echo image_url('bar-invoice.jpg')*/?>">
        </div>-->
        <ul class="anchor">
            <li>
                <a href="#step-1" class="selected" isdone="1" rel="1">
                    <div class="stepNumber"> 1 </div>
                    <span class="stepDesc"> Post job <br>
                    <!--<small>Step 1 description</small>--> </span>
                </a>
            </li>
            <li>
                <a href="#step-2" class="disabled" isdone="0" rel="2">
                    <div class="stepNumber"> 2 </div>
                    <span class="stepDesc"> Payment <br>
                    <!--<small>Step 2 description</small>--> </span>
                </a>
            </li>
            <li>
                <a href="#step-3" class="disabled" isdone="0" rel="3">
                    <div class="stepNumber"> 3 </div>
                    <span class="stepDesc"> Finish <br>
                    <!--<small>Step 3 description</small>--> </span>
                </a>
            </li>
        </ul>

        <div class="col-sm-12">
            <div class="box-message">
                <?php
                if ($msg = $this->session->flashdata('flash_message')) {
                    showMessage2($msg);
                }
                ?>
            </div>
            <div class="col-sm-9" style="margin: 0 auto; float: none">
                <div id="step-1" class="step-content">
                    <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group">
                        <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group">
                            <label>Email <span class="required">(*)</span></label>
                            <input type="text" name="email" id="email" class="form-control" value="<?php echo set_value('email')?>" placeholder="">
                            <span class="help-block"><?php echo form_error('email')?></span>
                        </div>
                        <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group">
                            <label><?php echo $this->lang->line('Phone')?> <span class="required">(*)</span></label>
                            <input type="text" name="phone" id="phone" class="form-control" value="<?php echo set_value('phone')?>" placeholder="">
                            <span class="help-block"><?php echo form_error('phone')?></span>
                        </div>
                       <!-- <div class="div-package-type">
                            <label><?php /*echo $this->lang->line('Package')*/?> <span class="required">(*)</span></label>
                            <?php
/*                            foreach($default_package_type as $key => $value){
                                echo '<label><input type="radio" name="package_type" class="package-type" value="'.$key.'" '.set_radio('package_type', $key).'> '.$value.'</label>';
                            }
                            */?>
                        </div>
                        <span class="help-block"><?php /*echo form_error('package_type')*/?></span>-->
                    </div>
                    <!--<div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group">
                        <div class="div-package" <?php /*echo (isset($package_id))?'style="display: block"':''*/?>>
                            <?php
/*                            foreach($packages->result() as $item){
                                echo '<label><input type="radio" name="package_id" value="'.$item->id.'" '.set_radio('package_id', $item->id).'> '.$item->package_name.'</label>';
                            }
                            */?>
                        </div>
                        <span class="help-block"><?php /*echo form_error('package_id')*/?></span>
                    </div>-->
                    <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group">
                        <label><?php echo $this->lang->line('Title')?> <span class="required">(*)</span></label>
                        <input type="text" name="title" id="title" class="form-control" value="<?php echo set_value('title')?>" placeholder="">
                        <span class="help-block"><?php echo form_error('title')?></span>
                    </div>
                    <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group">
                        <div class="div-skill">
                            <?php
                            $default_skill = $this->config->item('default_skill_invoice');
                            foreach($default_skill as $key => $value){
                                echo '<label><input type="radio" name="skill" value="'.$key.'" '.set_radio('skill', $key).'> '.$value.'</label>';
                            }
                            ?>
                        </div>
                        <span class="help-block"><?php echo form_error('skill')?></span>
                    </div>
                    <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group exp">
                        <select name="year_exp" class="form-control">
                            <option value="">-- <?php echo $this->lang->line('Experience')?> --</option>
                            <?php
                            $default_exp = $this->config->item('default_exp_en');
                            foreach($default_exp as $key => $value){
                                if($year_exp == $key){
                                    echo '<option value="'.$key.'" selected> '.$value.'</option>';
                                }else{
                                    echo '<option value="'.$key.'"> '.$value.'</option>';
                                }
                            }
                            ?>
                        </select>
                        <span class="help-block"><?php echo form_error('year_exp'); ?></span>
                    </div>
                    <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group qty">
                        <input type="text" name="qty" id="qty" class="form-control" value="<?php echo set_value('qty')?>" placeholder="<?php echo $this->lang->line('Quantity')?>">
                        <span class="help-block"><?php echo form_error('qty')?></span>
                    </div>
                    <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group salary input-group budget">
                        <span class="input-group-addon" style="padding: 6px 15px;background: #ebebeb; border: none">$</span>
                        <input style="border-radius: 0 7px 7px 0" type="text" name="salary" id="salary" class="form-control" value="<?php echo set_value('salary')?>" placeholder="<?php echo $this->lang->line('Salary')?>">
                        <span class="help-block"><?php echo form_error('salary')?></span>
                    </div>
                    <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group">
                        <div class="div-gender">
                            <label><input type="radio" name="gender" checked value="<?php echo set_radio('gender',0)?>"> <?php echo $this->lang->line('male')?></label>
                            <label><input type="radio" name="gender" value="<?php echo set_radio('gender',1)?>"> <?php echo $this->lang->line('female')?></label>
                        </div>
                        <span class="help-block"><?php echo form_error('gender')?></span>
                    </div>

                    <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group city">
                        <select name="city_id" class="form-control">
                            <option value="">-- <?php echo $this->lang->line('Location')?> --</option>
                            <?php
                            foreach($cities->result() as $key => $value){
                                if($city_id == $value->id){
                                    echo '<option value="'.$value->id.'" selected> '.$value->city_name.'</option>';
                                }else{
                                    echo '<option value="'.$value->id.'"> '.$value->city_name.'</option>';
                                }
                            }
                            ?>
                        </select>
                        <span class="help-block"><?php echo form_error('city_id'); ?></span>
                    </div>
                    <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group age">
                        <select name="age" class="form-control">
                            <option value="">-- <?php echo $this->lang->line('Age')?> --</option>
                            <?php
                            $default_age = $this->config->item('default_age_en');
                            foreach($default_age as $key => $value){
                                if($age == $key){
                                    echo '<option value="'.$key.'" selected> '.$value.'</option>';
                                }else{
                                    echo '<option value="'.$key.'"> '.$value.'</option>';
                                }
                            }
                            ?>
                        </select>
                        <span class="help-block"><?php echo form_error('age'); ?></span>
                    </div>
                    <div class="no-padding col-md-12 col-sm-12 col-xs-12 form-group">
                        <textarea name="note" class="form-control" rows="7" placeholder="<?php echo $this->lang->line('Description job')?>"><?php echo set_value('note')?></textarea>
                        <span class="help-block"><?php echo form_error('note'); ?></span>
                    </div>
                    <div class=" col-md-12 col-lg-12 col-sm-12 col-xs-12 no-padding">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 no-padding">
                            <button type="submit" name="workerConfirm" value="workerConfirm" class="btn btn-worker btn-green btn-lg col-sm-12 col-md-12 col-xs-12">
                                <?php echo $this->lang->line('Continue')?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
    <script>
        $(document).ready(function(){

            $("#frm-invoice").validate({
                errorElement: "span", // contain the error msg in a span tag
                errorClass: 'help-block',
                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                        error.insertAfter($(element).closest('.form-group').children('.help-block'));
                        //error.appendTo($(element).closest('.form-group').children('.help-block'));
                        //error.appendTo($(element).closest('.form-group').children('div').last());
                    } else {
                        error.insertAfter(element);
                        // for other inputs, just perform default behavior
                    }
                },
                highlight: function (element) {
                    $(element).closest('.help-block').removeClass('valid');
                    // display OK icon
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                    $(element).after("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
                    // add the Bootstrap error class to the control group
                    if ($(element).attr("type") != "radio" || $(element).attr("type") != "checkbox") {
                        $(element).closest('.form-group').find(".glyphicon-ok").remove();
                    }

                },
                unhighlight: function (element) { // revert the change done by hightlight
                    $(element).closest('.form-group').removeClass('has-error');

                    // set error class to the control group
                },
                success: function (label, element) {
                    label.addClass('help-block');
                    // mark the current input as valid and display OK icon
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
                    $(element).after("<span class='glyphicon glyphicon-ok form-control-feedback'></span>");
                    if ($(element).attr("type") != "radio" || $(element).attr("type") != "checkbox") {
                        $(element).closest('.form-group').find(".glyphicon-ok").remove();
                    }
                },
                rules:{
                    "email": {
                        required : true,
                        email : true,
                        minlength:5
                    },
                    "phone": {
                        required : true
                    },
                    "title": {
                        required : true
                    },
                    "skill": {
                        required : true
                    },
                    "year_exp": {
                        required : true
                    },
                    "qty": {
                        required : true,
                        number: true
                    },
                    "salary": {
                        required : true,
                        number: true
                    },
                    "gender": {
                        required : true
                    },
                    "city_id": {
                        required : true
                    },
                    "age": {
                        required : true
                    },
                    "description": {
                        required : true
                    },
                    "captcha": {
                        required : true
                        //minlength:6,
                    }
                },
                messages:{

                },
                submitHandler: function (form) {
                    $('.btn-worker').attr('disable');
                    $('body').append('<div class="loader"><div class="overlay-loading"></div><div class="loading-2"></div></div>');
                    form.submit();
                }
            });

        });
    </script>
<?php $this->load->view('footer_page'); ?>