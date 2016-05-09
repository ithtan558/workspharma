<div class="body_page">
    <div class="container">
        <div class="row">
            <!-- Begin body left -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="page_tao_ho_so view-resume">
                    <div class="title_header">
                        <h3><?php echo $this->lang->line('Resume').' : '.$getResume->title; ?></h3>
                    </div>
                    <div class="body_mo">
                        <form method="POST" action="" id="form-create-resume" enctype="multipart/form-data">
                            <div role="tabpanel">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="b1">
                                        <?php
                                        if($msg = $this->session->flashdata('flash_message')) {
                                            echo '<div class="box-message">';
                                            showMessage2($msg);
                                            echo '</div>';
                                        }
                                        ?>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <h5><?php echo $this->lang->line('Person info');?></h5>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('ho va ten'); ?></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <span><?php echo $getResume->fullname; ?></span>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Sex'); ?></label>
                                                    <div class="col-md-5 col-sm-7 col-xs-12">
                                                        <span><?php echo get_gender($getResume->gender); ?></span>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                             </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Birthday'); ?></label>
                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                        <div class="col-md-4 col-sm-4 col-xs-12 no-padding-left">
                                                            <span><?php echo $getResume->birthday; ?></span>
                                                        </div>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                             </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Marital Status'); ?></label>
                                                    <div class="col-md-5 col-sm-7 col-xs-12">
                                                        <span><?php echo get_marital($getResume->marital); ?></span>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                             </div>
                                            <h5><?php echo $this->lang->line('Contact info');?></h5>
                                            <?php
                                             if($getResume->option == 1){
                                                ?>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Email'); ?></label>
                                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                                            <span><?php echo $getResume->email; ?></span>
                                                        </div>
                                                        <div style="clear:both;"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Address'); ?></label>
                                                        <div class="col-md-5 col-sm-7 col-xs-12">
                                                            <span><?php echo $getResume->address; ?></span>
                                                        </div>
                                                        <div style="clear:both;"></div>
                                                    </div>
                                                 </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Phone'); ?></label>
                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                            <div class="col-md-4 col-sm-4 col-xs-12 no-padding-left">
                                                                <span><?php echo $getResume->cellPhone; ?></span>
                                                            </div>
                                                        </div>
                                                        <div style="clear:both;"></div>
                                                    </div>
                                                 </div>
                                                <?php 
                                            }
                                             if($getResume->option == 2){
                                                ?>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <a class="col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3 col-xs-12 color-red" href="<?php echo URL; ?>"><?php echo $this->lang->line('Request view detail resume'); ?></label></a>
                                                    </div>
                                                 </div>
                                                 <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Email'); ?></label>
                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                            <div class="col-md-4 col-sm-4 col-xs-12 no-padding-left">
                                                                <span>contact@workspharma.com</span>
                                                            </div>
                                                        </div>
                                                        <div style="clear:both;"></div>
                                                    </div>
                                                 </div>
                                                 <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Phone'); ?></label>
                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                            <div class="col-md-4 col-sm-4 col-xs-12 no-padding-left">
                                                                <span>0916.624.099</span>
                                                            </div>
                                                        </div>
                                                        <div style="clear:both;"></div>
                                                    </div>
                                                 </div>
                                                <?php
                                             }
                                             ?>
                                             
                                            <h5><?php echo $this->lang->line('Info job');?></h5>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Address work'); ?></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <span><?php echo get_city($getResume->city); ?></span>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Industry desired'); ?></label>
                                                    <div class="col-md-5 col-sm-7 col-xs-12">
                                                        <span><?php echo get_category($getResume->expectedPosition); ?></span>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                             </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Experience'); ?></label>
                                                    <div class="col-md-5 col-sm-7 col-xs-12">
                                                        <span><?php echo get_exp($getResume->yearOfExperience); ?></span>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                             </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Summary of work experience'); ?></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <?php echo $getResume->summary_experience; ?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Type job'); ?></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <span><?php echo get_type_job($getResume->type); ?></span>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Level'); ?></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <span><?php echo get_level($getResume->expectedJobLevel); ?></span>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Expected Salary'); ?></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <span><?php echo get_salary($getResume->expected_salary); ?></span>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Education'); ?></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <span><?php echo get_education($getResume->education); ?></span>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('My major'); ?></label>
                                                    <div class="col-md-5 col-sm-7 col-xs-12">
                                                        <span><?php echo $getResume->major; ?></span>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Skills'); ?></label>
                                                    <div class="col-md-5 col-sm-7 col-xs-12">
                                                        <span><?php echo get_category($getResume->job); ?></span>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                             </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Skills other'); ?></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <span><?php echo $getResume->job_other; ?></span>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Cover letter'); ?></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <span><?php echo $getResume->cover_letter; ?></span>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Name referencer'); ?></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <span><?php echo $getResume->name_referencer; ?></span>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                             </div>
                                         </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12 no-padding-right form-group margin-top">
                                            <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                                                <?php
                                                if(is_file_exists1($getResume->logo,'') == TRUE){
                                                    $url_image = file_url($getResume->logo);
                                                }
                                                else{
                                                    $url_image = image_default();
                                                }
                                                if(isset($url_image)){
                                                    echo '<img width="100%" src="'.$url_image.'" alt="">';
                                                }
                                                ?>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 no-padding padding-top text-right">
                                                <?php
                                                if (isset($resume_favourites)) {
                                                   ?>
                                                   <span class="color-blue applied"><?php echo $this->lang->line('Saved resume'); ?></span>
                                                   <?php
                                                }
                                                else{
                                                    ?>
                                                    <form action="" method="post" accept-charset="utf-8">
                                                        <button type="submit" name="saveResume" value="saveResume" class="btn btn-info btn-save-resume"><?php echo $this->lang->line('Save resume'); ?></button>
                                                    </form>
                                                    <?php
                                                }
                                                ?>
                                                
                                            </div>
                                        </div>
                                        <div style="clear:both"></div>
                                    </div><!-- end bước 3 -->
                                </div><!-- end bước 6 -->
                            </div>
                        </form>
                    </div>
                </div><!-- end 9 Nhóm ngành nghề -->
            </div><!-- end body left -->
        </div>
    </div>
</div><!-- end body page -->