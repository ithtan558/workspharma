<?php $this->load->view("header");?>
    <div class="row-bids">
        <div class="container no-padding wrap_unregister_job">
            <?php
            if ((isset($getUsers) == TRUE) && (count($getUsers) > 0)){
            $dem = 0;
            ?>
            <div class="">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 f18-m">
                    <div id="load-list-dev-recommened">
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 f18-m no-padding">
                            <h3><?php echo $this->lang->line('The top 10 recommended worker'); ?></h3>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-dev-recommended no-padding">
                            <?php
                            foreach ($getUsers->result() as $item) {
                            $dem++;
                            //echo $item->num_reviews;
                            if (is_file_exists($item->logo, 'thumbs_logos') == TRUE) {
                                $url_image = thumb_uimage_url($item->logo);
                                //$url_image =  base_url() . 'files/thumbs_logos/' .$item->logo;
                            } elseif (is_file_exists($item->logo) == TRUE) {
                                $url_image = uimage_url($item->logo);
                            } else {
                                $url_image = image_default();
                            }

                            ?>
                            <div data-id="<?php echo $item->id ?>" data-placement='above'
                                 class="col-lg-3 col-md-3 col-sm-3 col-xs-12 item-dev-recommend">
                                <div style="position: relative" class="col-lg-5 col-md-4 col-sm-4 col-xs-12 no-padding">
                                    <a href="<?php echo site_url('employers/resumeDetail/' . $item->id) ?>"/>
                                    <img class="img-responsive" src="<?php echo $url_image ?>"/>
                                    </a>
                                    <?php
                                    echo check_verify_studio($item->is_verify_studio,2);?>
                                </div>
                                <div class="col-lg-7 col-md-8 col-sm-8 col-xs-12 no-padding-right body-info-worker">
                                    <span><a class="green-2" href="<?php echo site_url('employers/resumeDetail/' . $item->id) ?>"/><?php $d_name = displayUserName($item->user_name,$item->display_name); echo cutString($d_name, 12, '..'); ?></a></span>
                                    <span><?php if($getResume->num_rows()>0)echo $getResume->first_row()->recentPosition;else echo $this->lang->line('No resume'); ?></span>
                                </div>
                            </div> <!--            item-dev-recommend-->
                            <?php if ($dem % 4 == 0) echo "<div class='clear'></div>";?>
                        </div>
                    </div>
                </div>
                <?php
                }
                }
                ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 no-padding info-job">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title_name_job no-padding">
                                <h1><?php echo stripslashes($jobs->title);?></h1>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 no-padding">
                                <a class="color-blue"><?php echo $jobs->company?></a>
                                - <span><?php echo get_city($jobs->city_ids);?></span>
                            </div>
                            <div class="intro-jobs col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding margin-top-5 margin-bottom-5">
                            <span><?php echo $this->lang->line('Salary')?>:
                                <?php
                                if($jobs->salary_min == 0 && $jobs->salary_max == 0){
                                    echo $this->lang->line('Negtiable');
                                }else{
                                    echo ($jobs->salary_min != 0) ? formatPrice($jobs->salary_min) : '';
                                    echo ($jobs->salary_min != 0) ? ' - ' : ' > ';
                                    echo ($jobs->salary_max != 0) ? formatPrice($jobs->salary_max) : '';
                                }
                                ?></span>
                                <span><?php echo $this->lang->line('Experience')?>: <?php echo $jobs->year_exp?> <?php echo $this->lang->line('year');?></span>
                                <span><?php echo $this->lang->line('Quantity')?>: <?php echo $jobs->qty?></span>
                                <!-- <span><?php echo $this->lang->line('Location')?> : <?php echo get_city($jobs->city_ids); ?></span> -->

                            </div>
                            <?php
                            $array_favourites = getJobFavourites();
                            if($array_favourites && (in_array($jobs->id,$array_favourites))){
                                $favourites = "glyphicon-heart loved";
                            }else{
                                $favourites = "glyphicon-heart-empty";
                            }
                            ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding share-send"><!-- <i class="glyphicon glyphicon-floppy-save glyphicon-orange"></i> -->
                                <a class="color-gray f12-m favourites" id="favourites" data-id=<?php echo $this->encrypt->encode($jobs->id); ?> alt="Save job">
                                <span class="glyphicon <?php echo $favourites; ?>" data-id="<?php echo  $this->encrypt->encode($jobs->id);?>" data-url="<?php echo current_url(); ?>"></span>
                                <i><?php echo $this->lang->line('Save job');?></i>
                                </a>
                                |
                                <a class="popover-refer color-gray f12-m" data-id=<?php echo $this->encrypt->encode($jobs->id); ?> data-original-title="" title="">
                                    <i class="glyphicon glyphicon-send"></i>
                                    <i><?php echo $this->lang->line('Refer to a friend');?></i>
                                </a>
                            </div>
                        </div>
                        <?php
                        if($this->session->userdata('user_id')){
                            if($this->session->userdata('role_id')==1){
                                $class="col-md-12 col-sm-12 col-md-12 col-xs-12";
                                $display=1;
                            }
                            else{
                                $class="col-md-12 col-sm-12 col-md-12 col-xs-12";
                                $display=1;
                            }
                        }
                        else{
                            $class="col-md-12 col-sm-12 col-md-12 col-xs-12";
                            $display=1;
                        }
                        ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="<?php echo $class; ?> no-padding" style="min-height:195px;overflow: hidden;">
                                <div class="divide f14-m col-md-12 col-lg-12 col-sm-12 col-xs-1 no-padding">
                                    <div class="pr_title pr_name f18-m" style="font-weight:bold;"><?php echo $this->lang->line('job Description') ?></div>
                                    <div id="desc_job" class="text-justify job-des">
                                        <?php
                                        echo convertContent($jobs->description);
                                        ?>
                                    </div>
                                </div>
                                <div class="divide f14-m distance_top col-md-12 col-lg-12 col-sm-12 col-xs-1 no-padding">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 no-padding">
                                        <div class="pr_title f18-m" style="font-weight:bold;"><?php echo $this->lang->line('Skills')?></div>
                                    </div>
                                    <div class="col-md-9 col-lg-9 col-sm-9 col-xs-12  list-skill">
                                        <ul>
                                            <?php
                                            $array_job_categories = explode(",",$jobs->category_ids);
                                            foreach($getCategories->result() as $item){
                                                if(in_array($item->id,$array_job_categories)){
                                                    ?>
                                                    <li data-id='<?php echo $item->id?>'>
                                                        <a style="margin-bottom:3px;" href="<?php echo site_url('skills/keywords/'.$item->category_name);?>"><?php echo $item->category_name?></a>
                                                    </li>
                                                <?php }
                                            }

                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="border-top"></div>
                                <div class="row-centered">
                                    <a href="<?php echo site_url('employers/post-job')?>" style="margin-right: 5px" class="btn btn-lg btn-topdev dang_du_an" >
                                        <i class="icon_left"></i><?php echo $this->lang->line('Edit') ?>
                                    </a>
                                    <a href="<?php echo site_url('employers/postJobContinue/'.$jobs->id)?>" class="btn btn-lg dang_du_an btn-topdev">
                                        <i class="icon_right"></i><?php echo 'Tiếp tục'; //$this->lang->line('Continue') ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 no-padding right-view-job-unregister">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 distance_top no-padding">

                            <?php if($display==1){?>
                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                    <div class="about_employer f18-m padding-top padding-bottom">
                                        <?php echo displayUserName($creatorInfo->user_name,$creatorInfo->company);?>
                                    </div>
                                    <?php
                                    if(isset($creatorInfo)){
                                        ?>
                                        <div class="col-lg-12 no-padding">
                                            <div class="col-lg-12 text-center padding-bottom">
                                                <div style="margin:0 auto;" class="avatar-user">
                                                    <a>
                                                        <img src="<?php if ((is_file_exists($creatorInfo->elogo, 'logos') == TRUE) && ($creatorInfo->elogo != "")) echo base_url() . 'files/logos/' . $creatorInfo->elogo; else echo image_default(); ?>"
                                                             alt="Add Thumbnail">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 no-padding"><?php echo $creatorInfo->profile_desc;?></div>
                                        <div class="col-lg-12 no-padding"><?php echo $this->lang->line('More jobs from').' '.displayUserName($creatorInfo->user_name,$creatorInfo->company);?></div>
                                        <div class="col-lg-12 no-padding list-job-employer">
                                            <?php
                                            if($sameToJobs->num_rows()>0){
                                                echo '<ul class="col-lg-12 no-padding">';
                                                foreach ($sameToJobs->result() as $item) {
                                                    # code...
                                                    $link = site_url('detail-jobs/'.$item->alias.'-'.$item->id);
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo $link;?>"><?php echo $item->title; ?></a>
                                                    </li>
                                                <?php
                                                }
                                                echo '</ul>';
                                            }
                                            ?>
                                        </div>
                                        <div class="col-lg-12 no-padding"><a href="<?php echo site_url('skills/employer/'.urlencode(displayUserName($creatorInfo->user_name, standardURL($creatorInfo->company))).'+'.$this->session->userdata('user_id').''); ?>"><?php echo $this->lang->line('View all jobs by').' '.displayUserName($creatorInfo->user_name,$creatorInfo->company)?></a></div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div><!-- end row -->
        </div>
    </div>

<?php $this->load->view("footer");?>