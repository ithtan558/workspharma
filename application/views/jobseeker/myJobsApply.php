<div class="body_page">
    <div class="container">
        <div class="row">
            <!-- Begin body left -->
            <?php $this->load->view('jobseeker/main_top_my_career'); ?>
            <div class="col-md-12 col-sm-12 col-xs-12 padding-top">
                <div class="my_job">
                    <div class="title_header">
                        <h3><?php echo $this->lang->line('My career'); ?></h3>
                    </div>
                    <div class="body_mo">
                        <div class="row">
                            <div class="col-md-9 col-sm-9 col-xs-12 ho-so">
                                <div class="cac-cong-viec row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <?php
                                            if($msg = $this->session->userdata('success_message')) {
                                            echo '<div class="box-message col-lg-12 col-md-12 no-padding">';
                                            showMessage2($msg);
                                            echo '</div>';
                                            $this->session->unset_userdata('success_message');
                                        }
                                        ?>
                                        <?php
                                        if($msg = $this->session->flashdata('success_message')) {
                                            echo '<div class="box-message">';
                                            showMessage2($msg);
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 border-bot">
                                        <div class="table">
                                            <form id="frmMyJob" name="frm" action="<?php echo URL.'jobseeker/deleteJobsApply';?>" method="post" onsubmit="return checkedJobtrackers()" style="margin:0px">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-lg-3"><?php echo $this->lang->line('Work'); ?></th>
                                                            <th class="col-lg-3 text-center"><?php echo $this->lang->line('Employers'); ?></th>
                                                            <th class="col-lg-3 text-center"><?php echo $this->lang->line('Date apply'); ?></th>
                                                            <th class="text-right">Chọn  <input type="checkbox" onclick="toggle(this)"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if ($getJobsApply->num_rows() > 0) {
                                                            foreach ($getJobsApply->result() as $job) {
                                                                ?>
                                                                <tr>
                                                                    <td class="xanh-14">
                                                                        <?php
                                                                            $link = URL.$this->lang->line('l_detail').'/'.$job->alias.'-'.$job->id;
                                                                        ?>
                                                                        <a href="<?php echo $link;?>"><?php echo stripslashes($job->title); ?></a>
                                                                    </td>
                                                                    <td align="center"><?php echo displayUserName($job->user_name,$job->company); ?></td>
                                                                    <td align="center"><?php echo date('d-m-Y',strtotime($job->date_created)); ?></td>
                                                                    <td align="right"><input type="checkbox" id="job" name="job[]" value="<?php echo $this->encrypt->encode($job->id);?>" /></td>
                                                                </tr>
                                                            <?php
                                                            }
                                                        }else{
                                                            echo '<tr><td> - </td>
                                                            <td> - </td>
                                                            <td align="center"> - </td>
                                                            <td align="right"> - </td></tr>';
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                <div class="col-md-offset-6 col-md-6 text-right pad-no">
                                                    <a href="#"  onclick="onDelMyJob();" class="btn btn-info">Xóa</a>
                                                </div>
                                                <input type="hidden" name="btnDelete" value="1">
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
                                <?php $this->load->view('jobseeker/manual_accept_job'); ?>
                                <h4><?php echo $this->lang->line('Jobs save'); ?></h4>
                                <?php
                                if(isset($listJobsSave)){
                                    foreach ($listJobsSave->result() as $item) {
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
                                    <a style="float: right; margin-top: 10px;" href="<?php echo URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_jobs_save'); ?>" title=""><?php echo $this->lang->line('View all jobs save'); ?></a>
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

