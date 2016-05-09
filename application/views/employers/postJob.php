
<script language="javascript" type="text/javascript" src="<?php echo URL;?>public/ckeditor/ckeditor.js"></script>
    <div class="body_page">
        <div class="container">
            <div class="col-md-12 col-xs-12">
                <div class="title_header">
                    <h3><?php echo $this->lang->line('create job'); ?></h3>
                </div>
                <div class="body_mo detail-profile col-md-12 col-xs-12 padding-top padding-bottom">
                    <div class="col-lg-12">
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
                        <form method="POST" id="form-project-post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 x8-15-b margin-top-bottom no-padding">
                                    <div
                                        class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Title') ?></div>
                                </div>

                                <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 no-padding" style="margin-top:5px;">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 form-group">
                                        <input type="text" name="title" id="title" class="form-control"
                                               placeholder=""
                                               value="<?php echo set_value('title', isset($job->title)?$job->title:''); ?>"/>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 x8-15-b margin-top-bottom no-padding">
                                    <div
                                        class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Number job') ?></div>
                                </div>

                                <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 no-padding" style="margin-top:5px;">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 form-group">
                                        <input type="text" name="quantity" id="quantity" class="form-control"
                                               placeholder=""
                                               value="<?php echo set_value('quantity', isset($job->qty)?$job->qty:''); ?>"/>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-xs-3 col-sm-3 col-md-12 x8-15-b no-padding margin-top-bottom">
                                    <div class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Choose nghanh'); ?></div>
                                </div>

                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 no-padding" style="margin-top:5px;">
                                    <div class="col-lg-8 col-sm-12 col-md-6 col-xs-12 list-skill chzn-custom">
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
                                                            if(isset($job)){
                                                                $category = explode(',',$job->category_ids);
                                                            }
                                                            if(in_array($itemChild->id, $category)){
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
                                </div>

                                <div class="col-lg-3 col-xs-3 col-sm-3 col-md-12 x8-15-b no-padding margin-top-bottom">
                                    <div class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Choose address'); ?></div>
                                </div>

                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 no-padding" style="margin-top:5px;">
                                    <div class="col-lg-8 col-sm-12 col-md-6 col-xs-12 list-skill chzn-custom">
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
                                                    if(isset($job)){
                                                        $city = explode(',',$job->city_ids);
                                                    }
                                                    if(in_array($item->id, $city)){
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
                                </div>

                                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 x8-15-b margin-top-bottom no-padding">
                                    <div
                                        class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Type job') ?></div>
                                </div>
                                <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 no-padding" style="margin-top:5px;">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 form-group">
                                        <select class="form-control" id="type_job" name="type_job">
                                            <option value=""><?php echo $this->lang->line('Select');?></option>
                                            <?php
                                            foreach ($default_cbPositionType as $key=>$value) {
                                                if(isset($job)){
                                                    $type_job = $job->type_id;
                                                }
                                                if($type_job == $key){
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
                                </div>

                                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 x8-15-b margin-top-bottom no-padding">
                                    <div
                                        class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Level') ?></div>
                                </div>
                                <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 no-padding" style="margin-top:5px;">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 form-group">
                                        <select class="form-control" id="level" name="level">
                                            <option value=""><?php echo $this->lang->line('Select');?></option>
                                            <?php
                                            foreach ($default_currentJobLevel as $key=>$value) {
                                                if(isset($job)){
                                                    $level = $job->level_id;
                                                }
                                                if($level == $key){
                                                    $class='selected="selected"';
                                                }
                                                else{
                                                    $class='';
                                                }
                                                ?>
                                                <option value="<?php echo $key ?>" <?php echo $class; ?>><?php echo $value; ?></option>
                                                <?php
                                                # code...
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 x8-15-b margin-top-bottom no-padding">
                                    <div
                                        class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Salary') ?></div>
                                </div>
                                <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 no-padding" style="margin-top:5px;">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 form-group">
                                        <select id="salary" name="salary" class="form-control edit-control">
                                            <option value=""><?php echo $this->lang->line('Select');?></option>
                                            <?php
                                            foreach ($default_salary as $key=>$value) {
                                                if(isset($job)){
                                                    $salary = $job->salary;
                                                }
                                                if($salary == $key){
                                                    $class='selected="selected"';
                                                }
                                                else{
                                                    $class='';
                                                }
                                                ?>
                                                <option value="<?php echo $key ?>" <?php echo $class; ?>><?php echo $value; ?></option>
                                                <?php
                                                # code...
                                            }
                                            ?>
                                        </select>
                                        <?php echo $this->lang->line('Million'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 x8-15-b margin-bottom no-padding">
                                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 x8-15-b margin-top-bottom no-padding">
                                        <div
                                            class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('From age') ?></div>
                                    </div>
                                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 no-padding" style="margin-top:5px;">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 form-group">
                                            <select id="fromage" name="fromage" class="form-control edit-control">
                                                <option value=""><?php echo $this->lang->line('Select');?></option>
                                                <?php
                                                for ($i=18; $i<=70; $i++) {
                                                    if(isset($job)){
                                                        $fromage = $job->fromage;
                                                    }
                                                    if($fromage == $i){
                                                        $class='selected="selected"';
                                                    }
                                                    else{
                                                        $class='';
                                                    }
                                                    ?>
                                                    <option value="<?php echo $i ?>" <?php echo $class;?>><?php echo $i; ?></option>
                                                    <?php
                                                    # code...
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 x8-15-b margin-top-bottom no-padding">
                                        <div
                                            class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('To age') ?></div>
                                    </div>
                                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 no-padding" style="margin-top:5px;">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 form-group">
                                            <select id="toage" name="toage" class="form-control edit-control">
                                                <option value=""><?php echo $this->lang->line('Select');?></option>
                                                <?php
                                                for ($i=18; $i<=70; $i++) {
                                                    if(isset($job)){
                                                        $toage = $job->toage;
                                                    }
                                                    if($toage == $i){
                                                        $class='selected="selected"';
                                                    }
                                                    else{
                                                        $class='';
                                                    }
                                                    ?>
                                                    <option value="<?php echo $i ?>" <?php echo $class;?>><?php echo $i; ?></option>
                                                    <?php
                                                    # code...
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 x8-15-b margin-top-bottom no-padding">
                                    <div
                                        class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Sex') ?></div>
                                </div>
                                <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 no-padding" style="margin-top:5px;">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 form-group">
                                        <select id="sex" name="sex" class="form-control edit-control">
                                            <option value=""><?php echo $this->lang->line('Select');?></option>
                                            <?php
                                            foreach ($default_sex as $key=>$value) {
                                                if(isset($job)){
                                                    $sex = $job->gender;
                                                }
                                                if($sex == $key){
                                                    $class='selected="selected"';
                                                }
                                                else{
                                                    $class='';
                                                }
                                                ?>
                                                <option value="<?php echo $key ?>" <?php echo $class; ?>><?php echo $value; ?></option>
                                                <?php
                                                # code...
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 x8-15-b margin-top-bottom no-padding">
                                    <div
                                        class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('quoc gia') ?></div>
                                </div>
                                <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 no-padding" style="margin-top:5px;">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 form-group">
                                        <select id="country" name="country" class="form-control">
                                            <option value=""><?php echo $this->lang->line('Select');?></option>
                                            <?php
                                            foreach ($getCountry->result() as $item) {
                                                if(isset($job)){
                                                    $country = $job->country_id;
                                                }
                                                if($country == $item->id){
                                                    $class='selected="selected"';
                                                }
                                                else{
                                                    $class='';
                                                }
                                                ?>
                                                <option value="<?php echo $item->id ?>" <?php echo $class; ?>><?php echo $item->country_name; ?></option>
                                                <?php
                                                # code...
                                            }?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 x8-15-b margin-top-bottom">
                                    <div class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Describe your job in detail') ?></div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12" style="margin-top:5px;">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 no-padding form-group">
                                        <textarea class="form-control" id="description" name="description"
                                                  placeholder="<?php //echo $this->lang->line("placeholder_detail"); ?>"
                                                  rows="10"><?php echo set_value('description', isset($job->description)?nl2br($job->description):''); ?></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 x8-15-b margin-top-bottom no-padding">
                                    <div
                                        class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Education') ?></div>
                                </div>
                                <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 no-padding" style="margin-top:5px;">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 form-group">
                                        <select id="education" name="education" class="form-control edit-control">
                                            <option value=""><?php echo $this->lang->line('Select');?></option>
                                            <?php
                                            foreach ($getEducation as $key=>$value) {
                                                if(isset($job)){
                                                    $education = $job->education_id;
                                                }
                                                if($education == $key){
                                                    $class='selected="selected"';
                                                }
                                                else{
                                                    $class='';
                                                }
                                                ?>
                                                <option value="<?php echo $key ?>" <?php echo $class; ?>><?php echo $value; ?></option>
                                                <?php
                                                # code...
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 x8-15-b margin-bottom no-padding add-language-button-parent">
                                    <?php
                                    $stt=1;
                                    if(isset($getJobLanguage)){
                                        if($getJobLanguage->num_rows()>0){
                                                foreach ($getJobLanguage->result() as $item) {
                                                # code...
                                                ?>
                                                <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label">
                                                        <?php echo $this->lang->line('Languages') ?> <span class="note-required">*</span>
                                                    </label>
                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                        <select id="language<?php echo $stt;?>" name="language<?php echo $stt;?>" class="form-control">
                                                            <option value=""><?php echo $this->lang->line('Select');?></option>
                                                                <?php
                                                                foreach ($getLanguage->result() as $items) {
                                                                    if($item->language_id==$items->id){
                                                                        $class='selected';
                                                                    }
                                                                    else{
                                                                        $class='';
                                                                    }
                                                                    ?>
                                                                    <option <?php echo $class; ?> value="<?php echo $items->id ?>"><?php echo $items->name_languages; ?></option>
                                                                    <?php
                                                                    # code...
                                                                }
                                                                ?>
                                                        </select>
                                                    </div>
                                                    <label class="col-md-1 col-sm-1 col-xs-12 control-label"><?php echo $this->lang->line('Languages level') ?> <span class="note-required">*</span></label>
                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                        <select id="language-level<?php echo $stt;?>" name="language-level<?php echo $stt;?>" class="form-control">
                                                            <option value=""><?php echo $this->lang->line('Select');?></option>
                                                                <?php
                                                                foreach ($getLanguageLevel->result() as $items) {
                                                                    if($item->language_level_id==$items->id){
                                                                        $class='selected';
                                                                    }
                                                                    else{
                                                                        $class='';
                                                                    }
                                                                    ?>
                                                                    <option <?php echo $class; ?> value="<?php echo $items->id ?>"><?php echo $items->name_language_level; ?></option>
                                                                    <?php
                                                                    # code...
                                                                }
                                                                ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1" style="margin-top:10px;">
                                                        <div class="glyphicon glyphicon-remove text-red remove-language-box showing" style="display: inline-block;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                $stt++;
                                            }
                                        }
                                    }
                                    else{
                                        ?>
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 no-padding language-1">
                                            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 x8-15-b margin-top-bottom no-padding">
                                                <div
                                                    class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Languages') ?></div>
                                            </div>
                                            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 no-padding" style="margin-top:5px;">
                                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 form-group">
                                                    <select id="language1" name="language1" class="form-control">
                                                        <option value=""><?php echo $this->lang->line('Select');?></option>
                                                        <?php
                                                        foreach ($getLanguage->result() as $items) {
                                                            if($language1 == $items->id){
                                                                $class='selected="selected"';
                                                            }
                                                            else{
                                                                $class='';
                                                            }
                                                            ?>
                                                            <option value="<?php echo $items->id ?>" <?php echo $class;?> ><?php echo $items->name_languages; ?></option>
                                                            <?php
                                                            # code...
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2 x8-15-b margin-top-bottom no-padding">
                                                <div
                                                    class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Languages level') ?></div>
                                            </div>
                                            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 no-padding" style="margin-top:5px;">
                                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 form-group">
                                                    <select id="language-level1" name="language-level1" class="form-control">
                                                        <option value=""><?php echo $this->lang->line('Select');?></option>
                                                        <?php
                                                        foreach ($getLanguageLevel->result() as $items) {
                                                            if($language_level1 == $items->id){
                                                                $class='selected="selected"';
                                                            }
                                                            else{
                                                                $class='';
                                                            }
                                                            ?>
                                                            <option value="<?php echo $items->id ?>" <?php echo $class;?> ><?php echo $items->name_language_level; ?></option>
                                                            <?php
                                                            # code...
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                    ?>
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 x8-15-b margin-top-bottom no-padding" id="add-language-button-wrapper">
                                        <div class="col-lg-3 col-xs-3 col-sm-3 col-md-12 x8-15-b no-padding margin-top-bottom">
                                            <a class="add-language-button" id="add-language-button">
                                                <span class="glyphicon glyphicon-plus text-success"></span>
                                                <span>Thêm mới</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3 col-xs-3 col-sm-3 col-md-12 x8-15-b no-padding margin-top-bottom">
                                    <div class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Experience'); ?></div>
                                </div>
                                <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 no-padding" style="margin-top:5px;">
                                    <div class="col-lg-8 col-sm-12 col-md-6 col-xs-12 form-group ">
                                        <select name="year_exp" class="form-control">
                                            <option value="">-- <?php echo $this->lang->line('Experience')?> --</option>
                                            <?php
                                            $default_exp = $this->config->item('default_exp');
                                            foreach($default_exp as $key => $value){
                                                if(isset($job)){
                                                    $year_exp = $job->year_exp;
                                                }
                                                if($year_exp == $key){
                                                    $class='selected="selected"';
                                                }
                                                else{
                                                    $class='';
                                                }
                                                ?>
                                                <option value="<?php echo $key; ?>" <?php echo $class;?>><?php echo $value; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 x8-15-b margin-top-bottom">
                                    <div class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Detail skills') ?></div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12" style="margin-top:5px;">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 no-padding form-group">
                                        <textarea class="form-control" id="detail_skills" name="detail_skills"
                                                  placeholder="<?php //echo $this->lang->line("placeholder_detail"); ?>"
                                                  rows="10"><?php echo set_value('detail_skills', isset($job->experience_skill)?nl2br($job->experience_skill):''); ?></textarea>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 x8-15-b margin-top-bottom no-padding">
                                    <div
                                        class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Type contact') ?></div>
                                </div>
                                <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 no-padding" style="margin-top:5px;">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 form-group">
                                        <select id="type_contact" name="type_contact" class="form-control edit-control">
                                            <option value=""><?php echo $this->lang->line('Select');?></option>
                                            <?php
                                            foreach ($default_type_contact as $key=>$value) {
                                                if(isset($job)){
                                                    $type_contact = $job->type_contact;
                                                }
                                                if($type_contact == $key){
                                                    $class='selected="selected"';
                                                }
                                                else{
                                                    $class='';
                                                }
                                                ?>
                                                <option value="<?php echo $key ?>" <?php echo $class;?>><?php echo $value; ?></option>
                                                <?php
                                                # code...
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 x8-15-b margin-top-bottom no-padding">
                                    <div
                                        class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Type accept resume') ?></div>
                                </div>
                                <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 no-padding" style="margin-top:5px;">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 form-group">
                                        <select id="language_contact" name="language_contact" class="form-control edit-control">
                                            <option value=""><?php echo $this->lang->line('Select');?></option>
                                                <?php
                                                foreach ($getLanguage->result() as $items) {
                                                if(isset($job)){
                                                    $language_contact = $job->language_contact;
                                                }
                                                if($language_contact == $items->id){
                                                    $class='selected="selected"';
                                                }
                                                else{
                                                    $class='';
                                                }
                                                    ?>
                                                    <option <?php echo $class; ?> value="<?php echo $items->id ?>"><?php echo $items->name_languages; ?></option>
                                                    <?php
                                                    # code...
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 x8-15-b margin-top-bottom no-padding">
                                    <div
                                        class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Address contact') ?></div>
                                </div>
                                <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 no-padding" style="margin-top:5px;">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 form-group">
                                        <input type="text" name="address_contact" id="address_contact" class="form-control"
                                               placeholder=""
                                               value="<?php echo set_value('address_contact', isset($job->address_contact)?$job->address_contact:''); ?>"/>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 x8-15-b margin-top-bottom no-padding">
                                    <div
                                        class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Name contact') ?></div>
                                </div>
                                <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 no-padding" style="margin-top:5px;">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 form-group">
                                        <input type="text" name="name_contact" id="name_contact" class="form-control"
                                               placeholder=""
                                               value="<?php echo set_value('name_contact', isset($job->name_contact)?$job->name_contact:''); ?>"/>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 x8-15-b margin-top-bottom no-padding">
                                    <div
                                        class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Email contact') ?></div>
                                </div>
                                <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 no-padding" style="margin-top:5px;">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 form-group">
                                        <input type="text" name="email_contact" id="email_contact" class="form-control"
                                               placeholder=""
                                               value="<?php echo set_value('email_contact', isset($job->email_contact)?$job->email_contact:''); ?>"/>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 x8-15-b margin-top-bottom no-padding">
                                    <div
                                        class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Phone contact') ?></div>
                                </div>
                                <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 no-padding" style="margin-top:5px;">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 form-group">
                                        <input type="text" name="phone_contact" id="phone_contact" class="form-control"
                                               placeholder=""
                                               value="<?php echo set_value('phone_contact', isset($job->phone_contact)?$job->phone_contact:''); ?>"/>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 x8-15-b margin-top-bottom">
                                    <div class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Submission') ?></div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12" style="margin-top:5px;">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 no-padding form-group">
                                        <textarea class="form-control" id="submission" name="submission"
                                                  placeholder="<?php //echo $this->lang->line("placeholder_detail"); ?>"
                                                  rows="10"><?php echo set_value('submission', isset($job->submission)?nl2br($job->submission):''); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-lg-offset-3 col-sm-10 col-sm-offset-2 col-md-10 col-xs-12 margin-top-bottom">
                                    <label><input type="checkbox" <?php if(isset($job))if($job->hide_infomation==1)echo 'checked'; ?> name="hide_infomation" value="">&nbsp;<?php echo $this->lang->line('Hide infomation') ?></label>
                                </div>

                                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 x8-15-b margin-top-bottom no-padding">
                                    <div
                                        class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Created date') ?></div>
                                </div>
                                <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 no-padding" style="margin-top:5px;">
                                    <div class="col-lg-8 col-sm-12 col-md-12 col-xs-12 form-group text-left margin-top-5">
                                        <span class=""><?php echo date('d-m-Y',time()) ?></span>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 x8-15-b margin-top-bottom no-padding">
                                    <div
                                        class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Time') ?></div>
                                </div>
                                <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 no-padding" style="margin-top:5px;">
                                    <div class="col-lg-8 col-sm-12 col-md-12 col-xs-12 form-group text-left margin-top-5">
                                        <span class="">30 <?php echo $this->lang->line('date'); ?></span>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 x8-15-b margin-top-bottom no-padding">
                                    <div
                                        class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line('Date finish') ?></div>
                                </div>
                                <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 no-padding" style="margin-top:5px;">
                                    <div class="col-lg-8 col-sm-12 col-md-12 col-xs-12 form-group text-left margin-top-5">
                                        <span class=""><?php echo date('d-m-Y',time()+(86400*30)) ?></span>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding text-center">
                                        <button type="submit" name="action" value="continue" class="btn btn-info btn-post-job">
                                            <i class="icon_right"></i><?php if(isset($job))echo $this->lang->line('Edit job');else echo $this->lang->line('Post job');?>
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
    CKEDITOR.replace( 'description');
    CKEDITOR.replace( 'detail_skills');
    CKEDITOR.replace( 'submission');
</script>
<script type="application/javascript">
    $(document).ready(function () {
        $("#form-project-post").validate({
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
            rules: {
                "title": {
                    required: true
                },
                "quantity": {
                    required: true
                },
                "category[]": {
                    required: true
                },
                "city[]": {
                    required: true
                },
                "type_job":{
                    required: true
                },
                "level":{
                    required: true
                },
                "salary":{
                    required: true
                },
                "fromage":{
                    required: true
                },
                "toage":{
                    required: true,
                    greaterThan: '#fromage'
                },
                "sex":{
                    required: true
                },
                "country":{
                    required: true
                },
                "description":{
                    required: true
                },
                "education":{
                    required: true
                },
                "language1":{
                    required: true
                },
                "language-level1":{
                    required: true
                },
                "year_exp":{
                    required: true
                },
                "detail_skills":{
                    required: true
                },
                "type_contact":{
                    required: true
                },
                "type_accept_resume":{
                    required: true
                },
                "address_contact":{
                    required: true
                },
                "name_contact":{
                    required: true
                },
                "email_contact":{
                    required: true
                },
                "phone_contact":{
                    required: true
                },
                "language_contact":{
                    required: true
                }
            },
            messages: {
                "title": {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "quantity": {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "category[]": {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "city[]": {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "type_job":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "level":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "salary":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "fromage":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "toage":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "sex":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "country":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "description":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "education":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "language1":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "language-level1":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "year_exp":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "detail_skills":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "type_contact":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "type_accept_resume":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "address_contact":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "name_contact":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "email_contact":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "phone_contact":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "language_contact":{
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                }
            },
            submitHandler: function (form) {
                $('.btn-post-job').attr('disable');
                $('body').append('<div class="loader"><div class="overlay-loading"></div><div class="loading-2"></div></div>');
                form.submit();
            }
        });


        $('body').on("click",".remove-language-box",function(){
            $(this).parent().parent().remove();
            var html='';
            var total_item = $('.add-language-button-parent').children('div').size();
            var step = parseInt(total_item);
            if(step==3){
                html+='<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 x8-15-b margin-top-bottom no-padding" id="add-language-button-wrapper">'+
                    '<div class="col-lg-3 col-xs-3 col-sm-3 col-md-12 x8-15-b no-padding margin-top-bottom">'+
                        '<a class="add-language-button" id="add-language-button">'+
                            '<span class="glyphicon glyphicon-plus text-success"></span>'+
                            '<span>Thêm mới</span>'+
                        '</a>'+
                    '</div>'+
                '</div>'+
            '</div>';
            }
            $('#add-language-button-wrapper').append(html);
            $thisFieldset.find('[autofocus]').focus();
        });


        $('body').on("click",".add-language-button",function(){
            var html = '';
            var total_item = $('.add-language-button-parent').children('div').size();
            var step = parseInt(total_item);
            if(step==3){
                $('.add-language-button').parent().remove();
            }
            //alert(step);
            if(step>1){
                var classLanguage='col-sm-push-2';
            }
            else{
                var classLanguage='';
            }
            html +='<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 no-padding language-1">'+
                '<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 x8-15-b margin-top-bottom no-padding">'+
                    '<div class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line("Languages") ?></div>'+
                '</div>'+
                '<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 no-padding" style="margin-top:5px;">'+
                    '<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 form-group">'+
                        '<select id="language'+step+'" name="language'+step+'" class="form-control">'+
                            '<option value=""><?php echo $this->lang->line('Select');?></option>'+
                            <?php
                            foreach ($getLanguage->result() as $items) {
                                ?>
                                '<option value="<?php echo $items->id ?>"><?php echo $items->name_languages; ?></option>'+
                                <?php
                                # code...
                            }
                            ?>
                        '</select>'+
                    '</div>'+
                '</div>'+
                '<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2 x8-15-b margin-top-bottom no-padding">'+
                    '<div class="widgetText col-xs-12 no-padding"><?php echo $this->lang->line("Languages level") ?></div>'+
                '</div>'+
                '<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 no-padding" style="margin-top:5px;">'+
                    '<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 form-group">'+
                        '<select id="language-level'+step+'" name="language-level'+step+'" class="form-control">'+
                            '<option value=""><?php echo $this->lang->line('Select');?></option>'+
                            <?php
                            foreach ($getLanguageLevel->result() as $items) {
                                ?>
                                '<option value="<?php echo $items->id ?>"><?php echo $items->name_language_level; ?></option>'+
                                <?php
                                # code...
                            }
                            ?>
                        '</select>'+
                    '</div>'+
                '</div>'+
                '<div class="col-lg-1 col-sm-1 col-md-1 col-xs-1" style="margin-top:10px;">'+
                    '<div class="glyphicon glyphicon-remove text-red remove-language-box showing" style="display: inline-block;">'+
                    '</div>'+
                '</div>'+
            '</div>';
            $('#add-language-button-wrapper').before(html);
            var $thisFieldset = $('#add-language-button-wrapper').parents('fieldset');
            $thisFieldset.find('.edit-field').fadeIn('fast');
            $thisFieldset.find('.view-field').fadeOut('fast');
            $thisFieldset.find('[autofocus]').focus();
        });
    });

    

</script>