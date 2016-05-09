<div class="body_page">
    <div class="container">
        <div class="row">
            <!-- Begin body left -->
            <?php $this->load->view('jobseeker/main_top_my_career'); ?>
            <div class="col-md-12 col-sm-12 col-xs-12 padding-top">
                <div class="my_job">
                    <div class="title_header">
                        <h3><?php echo $this->lang->line('View resume employee'); ?></h3>
                    </div>
                    <div class="body_mo">
                        <div class="row">
                            <div class="col-md-9 col-sm-9 col-xs-12 ho-so">
                                <div class="cac-cong-viec row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                        <?php
                                            if($msg = $this->session->userdata('success_message')) {
                                            echo '<div class="box-message col-lg-12 col-md-12 no-padding">';
                                            showMessage2($msg);
                                            echo '</div>';
                                            $this->session->unset_userdata('success_message');
                                        }
                                        ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 border-bot">
                                        <div class="table">
                                            <form id="frmMyJob" name="frm" action="<?php echo URL.'jobseeker/deleteJobsSaved';?>" method="post" onsubmit="return checkedJobtrackers()" style="margin:0px">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-lg-3"><?php echo $this->lang->line('Employers'); ?></th>
                                                            <th class="col-lg-3 text-center"><?php echo $this->lang->line('Views'); ?></th>
                                                            <th class="text-right"><?php echo $this->lang->line('Action'); ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if(isset($myViewEmployer)){
                                                            if ($myViewEmployer->num_rows() > 0) {
                                                                foreach ($myViewEmployer->result() as $employee) {
                                                                    $display_name=displayUserName($employee->user_name,$employee->company);
                                                                    ?>
                                                                    <tr>
                                                                        <td class="xanh-14">
                                                                            <?php echo $display_name; ?>
                                                                        </td>
                                                                        <td align="center"><?php echo $employee->views; ?></td>
                                                                        <?php $display_name=urlencode(trim($display_name)); ?>
                                                                        <td align="right"><a href="<?php echo URL.$this->lang->line('l_job').'/employer/'.$employee->user_id;?>"><?php echo $this->lang->line('View jobs from the company'); ?></a></td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                            }
                                                        }
                                                        else{
                                                            echo '<tr><td> - </td>
                                                            <td align="center"> - </td>
                                                            <td align="right"> - </td></tr>';
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12 side-right">
                                <div class="info-user row">
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                    <?php
                                        if(is_file_exists($userInfo->logo,'logo') == TRUE)
                                        {
                                            $url_image = thumb_uimage_url($userInfo->logo);
                                        }elseif(is_file_exists($userInfo->logo) == TRUE){
                                            $url_image = uimage_url($userInfo->logo);
                                        }
                                        else{
                                            $url_image = image_default();
                                        }
                                    ?>
                                        <img src="<?php echo $url_image; ?>" alt="User" class="img-responsive">
                                    </div>
                                    <div class="col-xs-8 col-sm-8 col-md-8">
                                        <h4><?php echo displayUserName($userInfo->user_name,$userInfo->fullname) ?></h4>
                                        <p>
                                            <?php echo $this->lang->line('Date register');?>: </br>
                                            <?php echo date('d-m-Y',$userInfo->created); ?>
                                        </p>
                                    </div>
                                    <div style="clear: both"></div>
                                    <ul class="list-unstyled">
                                        <li><a href="<?php echo URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_account').'/'.$this->lang->line('l_edit'); ?>">Thay đổi thông tin tài khoản</a></li>
                                        <li><a href="<?php echo URL.'users/'.$this->lang->line('l_sign_out') ?>"><?php echo $this->lang->line('Logout');?></a></li>
                                    </ul>
                                </div> <!--info-user-->
                                <h4><?php echo $this->lang->line('Manual work'); ?></h4>
                                <?php
                                foreach ($listArticles->result() as $item) {
                                    ?>
                                    <div class="row">
                                        <div class="border-bottom">
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <img width="83" height="58" src="<?php echo IMAGES.'articles/'.$item->thumb_articles; ?>" alt="Images" class="img-responsive">
                                            </div>
                                            <div class="col-xs-8 col-sm-8 col-md-8">
                                                <a href="#">
                                                    <?php echo $item->title_articles; ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div> <!-- end row-1 -->
                                    <?php
                                    }
                                    ?>
                                    <h4><?php echo $this->lang->line('My jobs apply'); ?></h4>
                                    <?php
                                    if(isset($getJobsApply)){
                                        foreach ($getJobsApply->result() as $item) {
                                        ?>
                                        <div class="row">
                                            <div class="border-bottom">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <a href="<?php echo  URL.$this->lang->line('l_detail').'/'.$item->alias.'-'.$item->id; ?>">
                                                        <?php echo $item->title; ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div> <!-- end row-1 -->
                                        <?php
                                        }
                                        ?>
                                        <a style="float: right; margin-top: 10px;" href="<?php echo URL.$this->lang->line('l_jobseeker'); ?>" title=""><?php echo $this->lang->line('View all jobs save'); ?></a>
                                        <?php
                                    }
                                    ?>
                            </div>
                        </div> <!--row-->
                    </div>
                </div><!-- end 9 Nhóm ngành nghề -->
            </div><!-- end body left -->
        </div>
    </div>
</div><!-- end body page -->

