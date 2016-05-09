<div class="body_page">
        <div class="container">
            <div class="row">
                <!-- Begin body left -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="pv_viec_lam">
                        <div class="title_header">
                            <h3><?php echo $getArticlesCategories->name_articles_categories; ?></h3>
                        </div>
                        <div class="body_mo">
                            <div class="row">
                                <div class="col-md-9 col-sm-9 col-xs-12 no-padding-mobile">
                                    <?php
                                    if($articles->num_rows() == 1){
                                        if($articles->row()->alias_articles_categories==$this->lang->line('l_contact')){
                                            ?>
                                            <div class="col-md-7 col-sm-7 col-xs-12 no-padding-left">
                                                <form method="POST" action="<?php echo URL.'contact/addContact' ?>" id="form-create-contact" enctype="multipart/form-data">
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
                                                                <p><?php $array_replace = array('!help'=>URL.$this->lang->line('l_help'));echo strtr($this->lang->line('Text contact'),$array_replace); ?></p>
                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Send to')?> <span class="note-required">*</span></label>
                                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                                            <img src="<?php echo IMAGES.'logo.png'; ?>" alt="<?php echo $title; ?>">
                                                                        </div>
                                                                        <div style="clear:both;"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Subject'); ?> <span class="note-required">*</span></label>
                                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                                            <input type="text" name="subject_contact" id="subject_contact" class="form-control" value="<?php echo set_value('subject_contact')?>">
                                                                            <span><small><?php echo $this->lang->line('Please type max 100'); ?></small></span>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                        <div style="clear:both;"></div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Content contact'); ?> <span class="note-required">*</span></label>
                                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                                            <textarea rows="5" name="content_contact" id="content_contact" class="form-control"><?php echo set_value('content_contact',isset($getResume->summary_experience)?$getResume->summary_experience:'' )?></textarea>
                                                                            <span><small><?php echo $this->lang->line('Please type max 500'); ?></small></span>
                                                                            <span class="help-block"><?php echo form_error('summary_experience')?></span>
                                                                        </div>
                                                                        <div style="clear:both;"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Contact person'); ?> <span class="note-required">*</span></label>
                                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                                            <input type="text" name="preson_contact" id="preson_contact" value="<?php echo set_value('preson_contact')?>" class="form-control">
                                                                            <span class="help-block"><?php //echo form_error('password_register')?></span>
                                                                        </div>
                                                                        <div style="clear:both;"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Phone'); ?> <span class="note-required">*</span></label>
                                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                                            <input type="text" name="phone_contact" id="phone_contact" value="<?php echo set_value('phone_contact')?>" class="form-control">
                                                                            <span class="help-block"><?php //echo form_error('password_register')?></span>
                                                                        </div>
                                                                        <div style="clear:both;"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $this->lang->line('Email'); ?> <span class="note-required">*</span></label>
                                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                                            <input type="text" name="email_contact" id="email_contact" value="<?php echo set_value('email_contact')?>" class="form-control">
                                                                            <span class="help-block"><?php //echo form_error('password_register')?></span>
                                                                        </div>
                                                                        <div style="clear:both;"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="s col-md-5 col-sm-offset-3 col-sm-5 col-xm-12">
                                                                        <button class="btn btn-info btn-create-contact" type="submit" name="save" value="save"><?php echo $this->lang->line('Send'); ?></button>
                                                                        <button class="btn btn-info btn-create-resume" type="reset" name="save" value="send"><?php echo $this->lang->line('Cancel'); ?></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                                <?php echo $articles->row()->fulltext_articles; ?>
                                            </div>
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <?php echo $articles->row()->fulltext_articles; ?>
                                            </div>
                                            <?php
                                        }
                                    }
                                    else{
                                        if(strcasecmp($getArticlesCategories->name_articles_categories,$this->lang->line('Help')) !=0){
                                            foreach($articles->result() as $item){

                                                $link = URL.$this->lang->line('l_career_tool').'/'.$item->alias_articles.'-'.$item->idArticles;
                                                ?>
                                                <div class="row tin_pv">
                                                    <?php 
                                                    if($item->alias_articles_categories == $this->lang->line('l_career_tool')){
                                                        ?>
                                                        <div class="col-md-2 col-sm-3 col-xs-12 fix">
                                                            <div class="img-pv">
                                                                <img src="<?php echo IMAGES.'articles/'.$item->thumb_articles; ?>" class="img-responsive"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-10 col-sm-9 col-xs-12">
                                                            <a href="<?php echo $link; ?>"><h5><?php echo $item->title_articles; ?></h5></a>
                                                            <p><?php echo $item->introtext_articles; ?></p>
                                                        </div>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <div class="col-md-12 col-sm-2 col-xs-12">
                                                            <a href="<?php echo $link; ?>"><h5><?php echo $item->title_articles; ?></h5></a>
                                                            <p><?php echo $item->introtext_articles; ?></p>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    
                                                    
                                                </div>
                                            <?php
                                            }
                                        }
                                        else{
                                            echo '<ul class="articles_ul">';
                                            foreach($articles->result() as $item){
                                                $link = URL.$item->alias_articles_categories.'/'.$item->alias_articles.'-'.$item->idArticles;
                                            ?>
                                                <li>
                                                    <a href="<?php echo $link ?>"><?php echo $item->title_articles; ?></a>
                                                </li>
                                            <?php
                                            }
                                            echo '</ul>';
                                        }
                                    }
                                    ?>
                                    <div class="page_button">
                                        <div class="btn-toolbar" role="toolbar" aria-label="...">
                                          <?php echo $pagination; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12 no-padding-mobile">
                                    <div class="form-right row">
                                        <h4><?php echo $this->lang->line('Accept info job'); ?></h4>
                                        <p><?php echo $this->lang->line('Body accept job'); ?></p>
                                        <?php $this->load->view('rightAcceptJobEmail'); ?>
                                    </div>
                                    <div class="form-right2 row">
                                        <h5><?php echo $this->lang->line('The most view jobs'); ?></h5>
                                        <ul>
                                            <?php
                                            if(isset($jobs)){
                                                foreach ($jobs->result() as $item) {
                                                    $link = URL.$this->lang->line('l_detail').'/'.$item->alias.'-'.$item->id;
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo $link; ?>">
                                                            <i class="fa fa-angle-right"></i>
                                                            <?php echo $item->title; ?>
                                                        </a>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end 9 Nhóm ngành nghề -->
                </div><!-- end body left -->
            </div>
        </div>
    </div><!-- end body page -->
<script type="application/javascript">
    $(document).ready(function () {
        $("#form-create-contact").validate({
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
                "subject_contact" : {
                    required : true
                },
                "content_contact" : {
                    required : true,
                    minlength : 8
                },
                "preson_contact" : {
                    required : true
                },
                "phone_contact": {
                    required: true
                },
                "email_contact": {
                    required: true,
                    email : true
                }
            },
            messages: {

                "subject_contact" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>"
                },
                "content_contact" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>",
                    minlength : 8
                },
                "preson_contact" : {
                    required : "<?php echo $this->lang->line('This field is required') ?>",
                },
                "phone_contact": {
                    required : "<?php echo $this->lang->line('This field is required') ?>",
                },
                "email_contact": {
                    required : "<?php echo $this->lang->line('This field is required') ?>",
                    email : "<?php echo $this->lang->line('Please enter a valid email address.') ?>"
                }
            },
            submitHandler: function (form) {
                $('.btn-create-contact').attr('disable');
                $('body').append('<div class="loader"><div class="overlay-loading"></div><div class="loading-2"></div></div>');
                form.submit();
            }
        });
});
    </script>