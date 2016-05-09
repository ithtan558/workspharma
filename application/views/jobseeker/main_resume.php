<div class="body_page">

        <div class="container">

            <div class="row">

                <!-- Begin body left -->

                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="page_tao_ho_so">

                        <div class="title_header">

                            <h3><?php echo $this->lang->line('Post your CV now to receive thousands of job opportunities'); ?></h3>

                        </div>

                        <div class="body_mo">


                            <div class="body-main-resume">
                                <ul class="has-list-style">
                                <?php if(!isset($getUser)){ ?>
                                    <li><a class="font-size-16" href="<?php echo URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_my_resume').'/?option=1'; ?>"><?php echo $this->lang->line('Facebook profile immediately without Registration'); ?></a></li>
                                <?php }else{ ?>
                                    <li><a class="font-size-16" href="<?php echo URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_my_resume').'/?option=1'; ?>"><?php echo $this->lang->line('Facebook profile immediately'); ?></a></li>
                                <?php } ?>
                                    <li><a class="font-size-16" href="<?php echo URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_my_resume').'/?option=2'; ?>"><?php echo $this->lang->line('Want privacy of personal information, log records here'); ?></a></li>
                                </ul>
                            </div>


                        </div>

                    </div><!-- end 9 Nhóm ngành nghề -->

                </div><!-- end body left -->

            </div>

        </div>

    </div><!-- end body page -->