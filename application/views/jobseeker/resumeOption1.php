<script language="javascript" type="text/javascript" src="<?php echo URL."public/ckeditor/ckeditor.js"?>"></script>
<div class="body_page">
    <div class="container">
        <div class="row">
            <!-- Begin body left -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="page_tao_ho_so">
                    <?php $this->load->view('jobseeker/main_top_resume'); ?>
                    <div class="body_mo">
                        <div class="title_top"><?php echo $this->lang->line('The fields marked'); ?> <span class="note-required">*</span> <?php echo $this->lang->line('is required'); ?></div>
                        <form method="POST" action="" id="form-create-resume" enctype="multipart/form-data">
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
                                        <h5><?php echo $this->lang->line('Change type resume'); ?></h5>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Current type resume'); ?></label>
                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <select class="form-control change-type-resume" name="option">
                                                        <option value="1" <?php if($option == 1) echo 'selected'; ?>><?php echo $this->lang->line('Option 1'); ?></option>
                                                        <option value="2" <?php if($option == 2) echo 'selected'; ?>><?php echo $this->lang->line('Option 2'); ?></option>
                                                    </select>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                        </div>
                                        <?php if(!$this->session->userdata('user_id')) { ?>
                                        <h5><?php echo $this->lang->line('Info login');?></h5>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Email'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <input type="text" name="email_register" id="email_register" class="form-control" value="<?php echo set_value('email_register')?>">
                                                    <span class="help-block"><?php //echo form_error('email_register')?></span>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Password'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-7 col-xs-12">
                                                    <input type="password" name="password_register" id="password_register" value="<?php echo set_value('password_register')?>" class="form-control">
                                                    <span class="help-block"><?php //echo form_error('password_register')?></span>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                         </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Re-type password'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-7 col-xs-12">
                                                    <input type="password" name="confirm-password-register" id="confirm-password-register" value="<?php echo set_value('confirm-password-register')?>" class="form-control" id="exampleInputEmail1">
                                                    <span class="help-block"><?php //echo form_error('confirm-password-register')?></span>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                         </div>
                                         <div class="row">
                                            <div class="col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3 col-xm-12">
                                            <span class="error"><?php echo $this->lang->line('Candidate save this information to make an account login to Workspharma.com'); ?></span>
                                            </div>
                                        </div>
                                         <?php } ?>
                                        <h5><?php echo $this->lang->line('Person info');?></h5>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Title resume'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <input type="text" class="form-control" placeholder="Trình dược viên OTC, Kế toán thuế..." name="title" required value="<?php echo set_value('title', isset($getResume->title)?$getResume->title:''); ?>"/><?php echo form_error('title') ?>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('ho va ten'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <input type="text" class="form-control" name="fullname" required  value="<?php echo set_value('fullname', isset($getResume->fullname)?$getResume->fullname:''); ?>"/><?php echo form_error('fullname') ?>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Sex'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-7 col-xs-12">
                                                    <select class="form-control" name="gender">
                                                       <option value="" selected="selected">Vui lòng chọn...</option>
                                                        <?php
                                                        foreach ($default_sex as $key=>$value) {
                                                            if($gender == $key || (isset($getResume->gender) && $getResume->gender == $key)){
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
                                                <div style="clear:both;"></div>
                                            </div>
                                         </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Birthday'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <div class="col-md-4 col-sm-4 col-xs-12 no-padding-left">
                                                        <div class='input-group date' id='datetimepicker_birthday'>
                                                            <input type='text' value="<?php if($birthday != ''){echo $birthday;} elseif(isset($getResume))if($getResume->birthday!=0) echo date('d/m/Y',$getResume->birthday); ?>" class="form-control" name="birthday" />
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-calendar">
                                                                </span>
                                                            </span>
                                                        </div>
                                                        <script type="text/javascript">
                                                            $(function () {
                                                                $('#datetimepicker_birthday').datetimepicker({
                                                                    viewMode: 'years',
                                                                    format: 'DD/MM/YYYY'
                                                                });
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                         </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Marital Status'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-7 col-xs-12">
                                                    <label class="radio-inline" for="marital-độc thân">
                                                        <input <?php if($marital !=''){if($marital==1)echo 'checked';} elseif(isset($getResume))if($getResume->marital==1) echo 'checked'; ?> class="edit-control" type="radio" name="marital" id="marital-độc thân" value="1" data-text-value="Độc thân"> Độc thân
                                                    </label>
                                                    <label class="radio-inline" for="marital-đã kết hôn">
                                                        <input <?php if($marital !=''){if($marital==2)echo 'checked';} elseif(isset($getResume))if($getResume->marital==2) echo 'checked'; ?> class="edit-control" type="radio" name="marital" id="marital-đã kết hôn" value="2" data-text-value="Đã kết hôn"> Đã kết hôn
                                                    </label>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                         </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Country'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-7 col-xs-12">
                                                    <select class="form-control" name="country">
                                                        <option value="">Vui lòng chọn...</option>
                                                        <?php
                                                        foreach ($getCountry->result() as $item) {
                                                            if($country == $item->id || (isset($getResume->country) && $getResume->country == $item->id)){
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
                                                <div style="clear:both;"></div>
                                            </div>
                                         </div>
                                         <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Dia chi'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <input type="text" class="form-control" name="address" required  value="<?php echo set_value('address', isset($getResume->address)?$getResume->address:''); ?>"/><?php echo form_error('address') ?>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Phone'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <input type="text" class="form-control" name="cellPhone" required  value="<?php echo set_value('cellPhone', isset($getResume->cellPhone)?$getResume->cellPhone:''); ?>"/><?php echo form_error('cellPhone') ?>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Email'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <input type="text" class="form-control" name="email" required  value="<?php echo set_value('email', isset($getResume->email)?$getResume->email:''); ?>"/><?php echo form_error('email') ?>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                        </div>
                                        <h5><?php echo $this->lang->line('Info job');?></h5>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Address work'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            $('#city').multiselect({
                                                                nonSelectedText: "<?php echo $this->lang->line('All City')?>"
                                                            });
                                                        });
                                                    </script>
                                                    <select class="form-control" id="city" name="city[]" multiple="multiple">
                                                        <?php
                                                            foreach ($getCities->result() as $item) {
                                                                $arrayCity=explode(',',$getResume->city);
                                                                if($city!=''){
                                                                    $arrayCity=$city;
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
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Industry desired'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-7 col-xs-12">
                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            $('#expectedPosition').multiselect({
                                                                nonSelectedText: "<?php echo $this->lang->line('Choose nghanh'); ?>"
                                                            });
                                                        });
                                                    </script>
                                                    <select class="form-control" id="expectedPosition" name="expectedPosition[]" multiple="multiple">
                                                        <?php
                                                        foreach ($getCategories->result() as $item) {
                                                            if($item->parent_id==0){
                                                            echo '<optgroup label="'.$item->category_name.'">';
                                                                foreach ($getCategories->result() as $itemChild) {
                                                                    if($item->id==$itemChild->parent_id){
                                                                        $arrayCategory=explode(',',$getResume->expectedPosition);
                                                                        if($expectedPosition != ''){
                                                                            $arrayCategory=$expectedPosition;
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
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Experience'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-7 col-xs-12">
                                                    <select id="yearOfExperience" name="yearOfExperience" class="form-control edit-control">
                                                        <option value=""><?php echo $this->lang->line('Select');?></option>
                                                        <?php
                                                        foreach ($default_exp as $key=>$value) {
                                                            if($yearOfExperience == $key || (isset($getResume->yearOfExperience) && $getResume->yearOfExperience == $key)){
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
                                                <div style="clear:both;"></div>
                                            </div>
                                         </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Summary of work experience'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <textarea rows="5" name="summary_experience" id="summary_experience" class="form-control"><?php echo set_value('summary_experience',isset($getResume->summary_experience)?$getResume->summary_experience:'' )?></textarea>
                                                    <span class="help-block"><?php echo form_error('summary_experience')?></span>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                         </div>
                                         <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Skills'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-7 col-xs-12">
                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            $('#job').multiselect({
                                                                nonSelectedText: "<?php echo $this->lang->line('Choose skills'); ?>"
                                                            });
                                                        });
                                                    </script>
                                                    <select class="form-control"  id="job" name="job[]" multiple="multiple">
                                                        <?php
                                                        foreach ($default_skills as $key=>$value) {
                                                            $arraySkills=explode(',',$getResume->job);
                                                            if($job != ''){
                                                                $arraySkills = $job;
                                                            }
                                                            if(in_array($key, $arraySkills)){
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
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Skills other'); ?></label>
                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <input type="text" class="form-control" name="job_other"  value="<?php echo set_value('job_other', isset($getResume->job_other)?$getResume->job_other:''); ?>"/>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                         </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Type job'); ?></label>
                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <select id="type" name="type" class="form-control edit-control">
                                                        <option value=""><?php echo $this->lang->line('Select');?></option>
                                                        <?php
                                                        foreach ($default_cbPositionType as $key=>$value) {
                                                            if($type == $key || (isset($getResume->type) && $getResume->type == $key)){
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
                                                <div style="clear:both;"></div>
                                            </div>
                                         </div>
                                         <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Level'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <select id="expectedJobLevel" name="expectedJobLevel" class="form-control edit-control">
                                                        <option value=""><?php echo $this->lang->line('Select');?></option>
                                                        <?php
                                                        foreach ($default_currentJobLevel as $key=>$value) {
                                                            if($expectedJobLevel == $key || (isset($getResume->expectedJobLevel) && $getResume->expectedJobLevel == $key)){
                                                                $class='selected="selected"';
                                                            }
                                                            else{
                                                                $class='';
                                                            }
                                                            ?>
                                                            <option <?php echo $class; ?> value="<?php echo $key ?>" <?php echo $class; ?>><?php echo $value; ?></option>
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
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Expected Salary'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <select id="expected_salary" name="expected_salary" class="form-control edit-control">
                                                        <option value=""><?php echo $this->lang->line('Select');?></option>
                                                        <?php
                                                        foreach ($default_salary as $key=>$value) {
                                                            if($expected_salary == $key || (isset($getResume->expected_salary) && $getResume->expected_salary == $key)){
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
                                                <div class="col-md-2 col-sm-2 col-xs-12 no-padding">
                                                    <span class="span_millon"><?php echo $this->lang->line('Million'); ?></span>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                        </div>
                                         <!-- end THÔNG TIN LIÊN HỆ -->
                                        <h5>HỌC VẤN</h5>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Education'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <select id="education" name="education" class="form-control edit-control">
                                                        <option value=""><?php echo $this->lang->line('Select');?></option>
                                                        <?php
                                                        foreach ($getEducation as $key=>$value) {
                                                            if($education == $key || (isset($getResume->education) && $getResume->education == $key)){
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
                                                <div style="clear:both;"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('My major'); ?> <span class="note-required">*</span></label>
                                                <div class="col-md-5 col-sm-7 col-xs-12">
                                                    <input type="text" class="form-control" name="major"  value="<?php echo set_value('major', isset($getResume->major)?$getResume->major:''); ?>"/><?php echo form_error('major') ?>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                         </div>
                                        <div class="row add-language-button-parent">
                                            <?php
                                                $stt=1;
                                                if(isset($getResumeLanguage)){
                                                    if($getResumeLanguage->num_rows()>0){
                                                            foreach ($getResumeLanguage->result() as $item) {
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
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">
                                                            <?php echo $this->lang->line('Languages') ?> <span class="note-required">*</span>
                                                        </label>
                                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                                            <select id="language1" name="language1" class="form-control">
                                                                <option value=""><?php echo $this->lang->line('Select');?></option>
                                                                <?php
                                                                foreach ($getLanguage->result() as $items) {
                                                                    if($language1==$items->id){
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
                                                            <select id="language-level1" name="language-level1" class="form-control">
                                                                <option value=""><?php echo $this->lang->line('Select');?></option>
                                                                <?php
                                                                foreach ($getLanguageLevel->result() as $items) {
                                                                    if($language_level1==$items->id){
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
                                                    </div>
                                                    <?php
                                                }
                                            ?>
                                            <div class="form-group col-md-3 col-sm-3 col-xs-12 text-right" id="add-language-button-wrapper">
                                            <?php if($stt<3){ ?>
                                                <a class="add-language-button" id="add-language-button">
                                                    <span class="glyphicon glyphicon-plus text-success"></span>
                                                    <span>Thêm mới</span>
                                                </a>
                                            <?php } ?>
                                            </div>
                                         </div>
                                         <h5><?php echo $this->lang->line('Detail resume'); ?><span class="error">&nbsp;&nbsp;<?php echo $this->lang->line('Not required');?></span></h5>
                                        <div id="b31">
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Browse'); ?></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        
                                                        <input type="file" name="cv_hard">
                                                        <?php
                                                        if(isset($getResume)){
                                                            if($getResume->title!=""){
                                                                if(is_file_exists1($getResume->cv,'') == TRUE){
                                                                    $url_image = file_url($getResume->cv);
                                                                }
                                                                echo '<div style="margin-top:10px;"><a target="_blank" class="color-blue" href="'.URL.$getResume->cv.'">'.$this->lang->line('Download file').'</a></div>';
                                                            }
                                                        }
                                                        ?>
                                                        <span class="small"><?php echo $this->lang->line('Only supported file formats: * .doc, * .docx, * .pdf and size < 512 KB'); ?></span>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('My logo'); ?></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        
                                                        <input type="file" name="logo">
                                                        <?php
                                                        if(isset($getResume)){
                                                            if($getResume->title!=""){
                                                                if(is_file_exists1($getResume->logo) == TRUE){
                                                                    $url_image = file_url($getResume->logo);
                                                                }
                                                                if(isset($url_image)){
                                                                    echo '<div style="margin-top:10px;"><img width="100" src="'.$url_image.'" alt=""></div>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Cover letter'); ?></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <textarea rows="7" style="width:100%;" name="cover_letter" id="cover_letter"><?php echo set_value('cover_letter', isset($getResume->cover_letter)?nl2br($getResume->cover_letter):''); ?>
                                                        </textarea>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <h5><?php echo $this->lang->line('Referencer'); ?></h5>
                                        <div id="b32">
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('ho va ten'); ?></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <input type="text" class="form-control" name="name_referencer" value="<?php echo set_value('name_referencer', isset($getResume->name_referencer)?$getResume->name_referencer:''); ?>" /><?php echo form_error('name_referencer') ?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Position'); ?></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <input type="text" class="form-control" name="position_referencer"  value="<?php echo set_value('position_referencer', isset($getResume->position_referencer)?$getResume->position_referencer:''); ?>"/><?php echo form_error('position_referencer') ?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Phone'); ?></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <input type="text" class="form-control" name="phone_referencer"  value="<?php echo set_value('phone_referencer', isset($getResume->phone_referencer)?$getResume->phone_referencer:''); ?>"/><?php echo form_error('phone_referencer') ?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Email'); ?></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <input type="text" class="form-control" name="email_referencer"  value="<?php echo set_value('email_referencer', isset($getResume->email_referencer)?$getResume->email_referencer:''); ?>"/><?php echo form_error('email_referencer') ?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Related Information'); ?></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <textarea rows="7" style="width:100%;" name="info_relationship_referencer"><?php echo set_value('info_relationship_referencer', isset($getResume->info_relationship_referencer)?$getResume->info_relationship_referencer:''); ?></textarea>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end bước 3 -->
                                    <div class="row">
                                        <div class="s col-md-5 col-sm-offset-3 col-sm-5 col-xm-12">
                                            <button class="btn btn-info btn-create-resume" type="submit" name="save" value="save"><?php echo $this->lang->line('Save and review resume'); ?></button>
                                            <!-- <button class="btn btn-info btn-create-resume" type="submit" name="save" value="send"><?php echo $this->lang->line('Send'); ?></button> -->
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

<script type="text/javascript">
    CKEDITOR.replace('cover_letter');
    CKEDITOR.replace('summary_experience');
</script>
<script type="application/javascript">
    $(document).ready(function () {
        $("#form-create-resume").validate({
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
                "email_register" : {
                    required : true,
                    email : true,
                    minlength:5,
                    remote:{
                        url: "<?php echo URL.'users/checkUserEmailInfo';?>",
                        type : "POST"
                    }
                },
                "password_register" : {
                    required : true
                },
                "confirm-password-register" : {
                    equalTo : "#password_register",
                    required : true
                },
                "title": {
                    required: true
                },
                "fullname": {
                    required: true
                },
                "gender": {
                    required: true
                },
                "birthday": {
                    required: true
                },
                "marital":{
                    required: true
                },
                "country":{
                    required: true
                },
                "address":{
                    required: true
                },
                "cellPhone":{
                    required: true
                },
                "email":{
                    required: true
                },
                "city":{
                    required: true
                },
                "expectedJobLevel":{
                    required: true
                },
                "yearOfExperience":{
                    required: true
                },
                "summary_experience":{
                    required: true
                },
                "job":{
                    required: true
                },
                "expected_salary":{
                    required: true
                },
                "level":{
                    required: true
                },
                "education":{
                    required: true
                },
                "major":{
                    required: true
                },
                "language1":{
                    required: true
                },
                "language-level1":{
                    required: true
                },
            },
            messages: {
                "email_register":{
                    required : "<?php echo $this->lang->line('This field is required') ?>",
                    email : "<?php echo $this->lang->line('Please enter a valid email address.') ?>",
                    minlength : "<?php echo $this->lang->line('Email')." ".$this->lang->line('min_length'); ?>",
                    remote :  "<?php echo $this->lang->line('This email is already in use.') ?> <a href='<?php echo URL.$this->lang->line('l_sign_in'); ?>' class='login'>Bạn muốn đăng nhập?</a>"
                },
                "password_register" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "confirm-password-register" : {
                    equalTo : "<?php echo $this->lang->line('Please enter the same password as above.') ?>",
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "title": {
                    required: "<?php echo $this->lang->line('This field is required') ?>"
                },
                "fullname": {
                    required: "<?php echo $this->lang->line('This field is required') ?>"
                },
                "gender": {
                    required: "<?php echo $this->lang->line('This field is required') ?>"
                },
                "birthday": {
                    required: "<?php echo $this->lang->line('This field is required') ?>"
                },
                "marital":{
                    required: "<?php echo $this->lang->line('This field is required') ?>"
                },
                "country":{
                    required: "<?php echo $this->lang->line('This field is required') ?>"
                },
                "address":{
                    required: "<?php echo $this->lang->line('This field is required') ?>"
                },
                "cellPhone":{
                    required: "<?php echo $this->lang->line('This field is required') ?>"
                },
                "email":{
                    required: "<?php echo $this->lang->line('This field is required') ?>"
                },
                "city":{
                    required: "<?php echo $this->lang->line('This field is required') ?>"
                },
                "expectedJobLevel":{
                    required: "<?php echo $this->lang->line('This field is required') ?>"
                },
                "yearOfExperience":{
                    required: "<?php echo $this->lang->line('This field is required') ?>"
                },
                "summary_experience":{
                    required: "<?php echo $this->lang->line('This field is required') ?>"
                },
                "job":{
                    required: "<?php echo $this->lang->line('This field is required') ?>"
                },
                "expected_salary":{
                    required: "<?php echo $this->lang->line('This field is required') ?>"
                },
                "level":{
                    required: "<?php echo $this->lang->line('This field is required') ?>"
                },
                "education":{
                    required: "<?php echo $this->lang->line('This field is required') ?>"
                },
                "major":{
                    required: "<?php echo $this->lang->line('This field is required') ?>"
                },
                "language1":{
                    required: "<?php echo $this->lang->line('This field is required') ?>"
                },
                "language-level1":{
                    required: "<?php echo $this->lang->line('This field is required') ?>"
                }
            },
            submitHandler: function (form) {
                $('.btn-create-resume').attr('disable');
                $('body').append('<div class="loader"><div class="overlay-loading"></div><div class="loading-2"></div></div>');
                form.submit();
            }
        });
        $('body').on("change",".change-type-resume",function(){
            var id = $(this).val();
            var URL = BASE_URL + "<?php echo $this->lang->line('l_jobseeker').'/'.$this->lang->line('l_my_resume'); ?>/?option=" + id;
            window.open(URL,'_self');
        });
        //
        $('body').on("click",".remove-language-box",function(){
            $(this).parent().parent().remove();
            var html='';
            var total_item = $('.add-language-button-parent').children('div').size();
            var step = parseInt(total_item);
            if(step<=3){
                html+='<a class="add-language-button" id="add-language-button">'+
                            '<span class="glyphicon glyphicon-plus text-success"></span>'+
                            '<span>Thêm mới</span>'+
                        '</a>';
            }
            $('#add-language-button-wrapper').append(html);
        });


        $('body').on("click",".add-language-button",function(){
            var html = '';
            var total_item = $('.add-language-button-parent').children('div').size();
            var step = parseInt(total_item);
            if(step==3){
                $('#add-language-button').remove();
            }
            //alert(step);
            if(step>1){
                var classLanguage='col-sm-push-2';
            }
            else{
                var classLanguage='';
            }
            html +='<div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">'+
                '<label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line("Languages") ?></label>'+
                '<div class="col-md-3 col-sm-3 col-xs-12">'+
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
                '<label class="col-md-1 col-sm-1 col-xs-12 control-label"><?php echo $this->lang->line("Languages level") ?></label>'+
                '<div class="col-md-3 col-sm-3 col-xs-12">'+
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
                '<div class="col-lg-1 col-sm-1 col-md-1 col-xs-1" style="margin-top:10px;">'+
                    '<div class="glyphicon glyphicon-remove text-red remove-language-box showing" style="display: inline-block;">'+
                    '</div>'+
                '</div>'+
            '</div>';
            $('#add-language-button-wrapper').before(html);
        });
    });
    </script>