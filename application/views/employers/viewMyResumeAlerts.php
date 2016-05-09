
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
                        	<?php
                            if ($msg = $this->session->flashdata('flash_message')) {
                                showMessage2($msg);
                            }
                            ?>
                        	<div class="col-md-12 col-sm-12 col-xs-12 margin-bottom no-padding">
	                        	<form id="form-my-resume-alert" class="" action="" method="post">
	                                <input type="hidden" name="tab" class="form-control" value="2" />
	                                <div class="row">
	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
	                                        <?php echo $this->lang->line('Level resume find'); ?> 
	                                    </div>
	                                    <div class="col-md-5 col-sm-5 col-xs-12 form-group">
	                                        <input type="text" name="level_resume_find" class="form-control" placeholder="<?php echo $this->lang->line('Level resume find')?>" value="<?php if(isset($getResumeAlert))echo urldecode($getResumeAlert->level_resume_find);?>" />
	                                    </div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
	                                        <?php echo $this->lang->line('Keywords'); ?> 
	                                    </div>
	                                    <div class="col-md-5 col-sm-5 col-xs-12 form-group">
	                                        <input type="text" name="keywords" class="form-control" placeholder="<?php echo $this->lang->line('Keywords')?>" value="<?php if(isset($getResumeAlert))echo urldecode($getResumeAlert->keywords);?>" />
	                                    </div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
	                                        <?php echo $this->lang->line('find resume nghanh nghe'); ?> 
	                                    </div>
	                                    <div class="col-md-5 col-sm-5 col-xs-12 form-group">
	                                        <script type="text/javascript">
	                                            $(document).ready(function() {
	                                                $('#category').multiselect({
	                                                    nonSelectedText: "<?php echo $this->lang->line('All Category')?>"
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
	                                                            if(isset($getResumeAlert)){
	                                                            $arrayCategory=explode(',',$getResumeAlert->category_ids);
	                                                                if(in_array($itemChild->id, $arrayCategory)){
	                                                                    $class = "selected='selected'";
	                                                                }
	                                                                else{
	                                                                    $class='';
	                                                                }
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
	                                </div>
	                                <div class="row">
	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
	                                        <?php echo $this->lang->line('find resume address'); ?> 
	                                    </div>
	                                    <div class="col-md-5 col-sm-5 col-xs-12 form-group">
	                                        <script type="text/javascript">
	                                            $(document).ready(function() {
	                                                $('#city').multiselect({
	                                                    nonSelectedText: "<?php echo $this->lang->line('All City')?>"
	                                                });
	                                            });
	                                        </script>
	                                        <select class="form-control"  id="city" name="city[]" multiple="multiple">
	                                            <?php
	                                                foreach ($getCities->result() as $item) {
	                                                    if(isset($getResumeAlert)){
	                                                        $arrayCity=explode(',',$getResumeAlert->city_ids);
	                                                        if(in_array($item->id, $arrayCity)){
	                                                            $class = "selected='selected'";
	                                                        }
	                                                        else{
	                                                            $class='';
	                                                        }
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
	                                </div>
	                                <div class="row">
	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
	                                        <?php echo $this->lang->line('Sex'); ?> 
	                                    </div>
	                                    <div class="col-md-5 col-sm-5 col-xs-12 form-group">
	                                        <select class="form-control" name="gender">
	                                           <option value="" selected="selected">Vui lòng chọn...</option>
	                                            <?php
	                                            foreach ($default_sex as $key=>$value) {
	                                                if(isset($getResumeAlert)){
	                                                    if($key==$getResumeAlert->sex){
	                                                        $class = "selected='selected'";
	                                                    }
	                                                    else{
	                                                        $class='';
	                                                    }
	                                                }
	                                                else{
	                                                    $class = '';
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
	                                <div class="row">
	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
	                                        <?php echo $this->lang->line('Marital Status'); ?> 
	                                    </div>
	                                    <div class="col-md-5 col-sm-5 col-xs-12 form-group">
	                                        <label class="radio-inline" for="marital-độc thân">
	                                            <input <?php if(isset($getResumeAlert))if($getResumeAlert->marital==1) echo 'checked'; ?> class="edit-control" type="radio" name="marital" id="marital-độc thân" value="1" data-text-value="Độc thân"> Độc thân
	                                        </label>
	                                        <label class="radio-inline" for="marital-đã kết hôn">
	                                            <input <?php if(isset($getResumeAlert))if($getResumeAlert->marital==2) echo 'checked'; ?> class="edit-control" type="radio" name="marital" id="marital-đã kết hôn" value="2" data-text-value="Đã kết hôn"> Đã kết hôn
	                                        </label>
	                                    </div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
	                                        <?php echo $this->lang->line('Country'); ?> 
	                                    </div>
	                                    <div class="col-md-5 col-sm-5 col-xs-12 form-group">
	                                        <select class="form-control" name="country">
	                                            <?php
	                                            foreach ($getCountry->result() as $item) {
	                                                if(isset($getResumeAlert)){
	                                                    if($item->id==$getResumeAlert->country){
	                                                        $class = "selected='selected'";
	                                                    }
	                                                    else{
	                                                        $class='';
	                                                    }
	                                                }
	                                                else{
	                                                    $class = '';
	                                                }
	                                                ?>
	                                                <option <?php echo $class; ?> value="<?php echo $item->id ?>"><?php echo $item->country_name; ?></option>
	                                                <?php
	                                                # code...
	                                            }?>
	                                        </select>
	                                    </div>
	                                </div>
	                                <div class="row">
	                                    <label class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
	                                        <?php echo $this->lang->line('Languages') ?>
	                                    </label>
	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b form-group">
	                                        <select id="language" name="language" class="form-control">
	                                            <option value=""><?php echo $this->lang->line('Select');?></option>
	                                            <?php
	                                            foreach ($getLanguage->result() as $items) {
	                                                if(isset($getResumeAlert)){
	                                                    if($items->id==$getResumeAlert->language){
	                                                        $class = "selected='selected'";
	                                                    }
	                                                    else{
	                                                        $class='';
	                                                    }
	                                                }
	                                                else{
	                                                    $class = '';
	                                                }
	                                                ?>
	                                                <option <?php echo $class; ?> value="<?php echo $items->id ?>"><?php echo $items->name_languages; ?></option>
	                                                <?php
	                                                # code...
	                                            }
	                                            ?>
	                                        </select>
	                                    </div>
	                                    <label class="col-md-1 col-sm-1 col-xs-12"><?php echo $this->lang->line('Languages level') ?></label>
	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b form-group">
	                                        <select id="language-level" name="language-level" class="form-control">
	                                            <option value=""><?php echo $this->lang->line('Select');?></option>
	                                            <?php
	                                            foreach ($getLanguageLevel->result() as $items) {
	                                                if(isset($getResumeAlert)){
	                                                    if($items->id==$getResumeAlert->language_level){
	                                                        $class = "selected='selected'";
	                                                    }
	                                                    else{
	                                                        $class='';
	                                                    }
	                                                }
	                                                else{
	                                                    $class = '';
	                                                }
	                                                ?>
	                                                <option <?php echo $class; ?> value="<?php echo $items->id ?>"><?php echo $items->name_language_level; ?></option>
	                                                <?php
	                                                # code...
	                                            }
	                                            ?>
	                                        </select>
	                                    </div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
	                                        <?php echo $this->lang->line('Education'); ?> 
	                                    </div>
	                                    <div class="col-md-5 col-sm-5 col-xs-12 form-group">
	                                        <select id="education" name="education" class="form-control edit-control">
	                                            <option value=""><?php echo $this->lang->line('Select');?></option>
	                                            <?php
	                                            foreach ($getEducation as $key=>$value) {
	                                                if(isset($getResumeAlert)){
	                                                    if($key==$getResumeAlert->education){
	                                                        $class = "selected='selected'";
	                                                    }
	                                                    else{
	                                                        $class='';
	                                                    }
	                                                }
	                                                else{
	                                                    $class = '';
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
	                                <div class="row">
	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
	                                        <?php echo $this->lang->line('Type job'); ?> 
	                                    </div>
	                                    <div class="col-md-5 col-sm-5 col-xs-12 form-group">
	                                        <select id="type" name="type" class="form-control edit-control">
	                                            <option value=""><?php echo $this->lang->line('Select');?></option>
	                                            <?php
	                                            foreach ($default_cbPositionType as $key=>$value) {
	                                                if(isset($getResumeAlert)){
	                                                    if($key==$getResumeAlert->type){
	                                                        $class = "selected='selected'";
	                                                    }
	                                                    else{
	                                                        $class='';
	                                                    }
	                                                }
	                                                else{
	                                                    $class = '';
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
	                                <div class="row">
	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
	                                        <?php echo $this->lang->line('Level'); ?> 
	                                    </div>
	                                    <div class="col-md-5 col-sm-5 col-xs-12 form-group">
	                                        <select id="level" name="level" class="form-control edit-control">
	                                            <option value=""><?php echo $this->lang->line('Select');?></option>
	                                            <?php
	                                            foreach ($default_currentJobLevel as $key=>$value) {
	                                                if(isset($getResumeAlert)){
	                                                    if($key==$getResumeAlert->level){
	                                                        $class = "selected='selected'";
	                                                    }
	                                                    else{
	                                                        $class='';
	                                                    }
	                                                }
	                                                else{
	                                                    $class = '';
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
	                                <div class="row">
	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
	                                        <?php echo $this->lang->line('Experience'); ?> 
	                                    </div>
	                                    <div class="col-md-5 col-sm-5 col-xs-12 form-group">
	                                        <select id="year_exp" name="year_exp" class="form-control edit-control">
	                                            <option value=""><?php echo $this->lang->line('Select');?></option>
	                                            <?php
	                                            foreach ($default_exp as $key=>$value) {
	                                                if(isset($getResumeAlert)){
	                                                    if($key==$getResumeAlert->year_exp){
	                                                        $class = "selected='selected'";
	                                                    }
	                                                    else{
	                                                        $class='';
	                                                    }
	                                                }
	                                                else{
	                                                    $class = '';
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
	                                <div class="row">
	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
	                                        <?php echo $this->lang->line('Salary'); ?> 
	                                    </div>
	                                    <div class="col-md-5 col-sm-5 col-xs-12 form-group">
	                                        <select id="salary" name="salary" class="form-control edit-control">
	                                            <option value=""><?php echo $this->lang->line('Select');?></option>
	                                            <?php
	                                            foreach ($default_salary as $key=>$value) {
	                                                if(isset($getResumeAlert)){
	                                                    if($key==$getResumeAlert->salary){
	                                                        $class = "selected='selected'";
	                                                    }
	                                                    else{
	                                                        $class='';
	                                                    }
	                                                }
	                                                else{
	                                                    $class = '';
	                                                }
	                                                ?>
	                                                <option <?php echo $class; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>
	                                                <?php
	                                                # code...
	                                            }
	                                            ?>
	                                        </select>
										<?php echo $this->lang->line('Million'); ?>
	                                    </div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
	                                        <?php echo $this->lang->line('My resume alerts'); ?> 
	                                    </div>
	                                    <div class="col-md-5 col-sm-5 col-xs-12 form-group">
	                                        <select id="my_resume_alerts" name="my_resume_alerts" class="form-control edit-control">
	                                            <option value=""><?php echo $this->lang->line('Select');?></option>
	                                            <?php
	                                            foreach ($default_my_resume_alerts as $key=>$value) {
	                                                if(isset($getResumeAlert)){
	                                                    if($key==$getResumeAlert->my_resume_alerts){
	                                                        $class = "selected='selected'";
	                                                    }
	                                                    else{
	                                                        $class='';
	                                                    }
	                                                }
	                                                else{
	                                                    $class = '';
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
	                                <div class="row">
	                                    <div class="col-md-3 col-sm-3 col-xs-12 x8-15-b">
	                                        <?php echo $this->lang->line('Email of you'); ?> 
	                                    </div>
	                                    <div class="col-md-5 col-sm-5 col-xs-12 form-group">
	                                        <input type="text" name="email" class="form-control" placeholder="<?php echo $this->lang->line('Email of you')?>" value="<?php if(isset($getResumeAlert))echo urldecode($getResumeAlert->email);?>" />
	                                    </div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-md-2 col-md-offset-3 col-sm-3 col-offset-sm-3 col-xs-12">
	                                        <button type="submit" name="submitResumeAlert" value="submitResumeAlert" class="btn btn-info"><?php echo $this->lang->line('Agree create notifications'); ?></button>
	                                    </div>
	                                    <div class="col-md-1 col-sm-3 col-xs-12">
	                                        <button type="reset" name="submitResumeAlert" class="btn btn-info"><?php echo $this->lang->line('Cancel'); ?></button>
	                                    </div>
	                                    <div class="col-md-4 col-sm-3 col-xs-12">
	                                        <a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_my_resume_alerts').'/'.$this->lang->line('l_find_resume'); ?>" class="btn btn-info viewResumeAlert"><?php echo $this->lang->line('Test results record'); ?></a>
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
        $("#form-my-resume-alert").validate({
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
                "level_resume_find" : {
                    required : true
                }
            },
            messages:{
                "level_resume_find":{
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
