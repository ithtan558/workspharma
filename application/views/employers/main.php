<div class="body_page">
    <div class="container">
        <div class="row">
            <!-- Begin body left -->
            <?php $this->load->view('employers/main_top_my_jobs'); ?>
            <div class="col-md-12 col-sm-12 col-xs-12 padding-top">
                <div class="my_job">
                    <div class="title_header">
                        <h3><?php echo $title_job;?></h3>
                    </div>
                    <div class="body_mo">
                        <div class="row">
                            <div class="col-md-9 col-sm-9 col-xs-12 ho-so">
                                <div class="ho-so-xin-viec row">
                                    <div class="col-sm-12">
                                        <div class="row app-panel" id="my-jobs">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="table-projects row" id="reload-status-project">
                                                    <?php
                                                        if($menuActiveChild != $this->lang->line('Jobs deleted')){
                                                            $action = 'deleteJobs';
                                                        }
                                                        else{
                                                            $action = 'restoreJobs';
                                                        }
                                                    ?>
                                                    <form id="frmMyJob" name="frm" action="<?php echo URL.'employers/'.$action;?>" method="post" onsubmit="return checkedJobtrackers()" style="margin:0px">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                                            <?php
                                                            if($msg = $this->session->flashdata('flash_message')) {
                                                                echo '<div class="box-message">';
                                                                showMessage2($msg);
                                                                echo '</div>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <table class="table col-lg-12 table col-md-12 col-sm-12 col-xs-12 no-padding table-dashboard">
                                                            <thead>
                                                            <tr class="x8-16-b">

                                                                <td class="col-lg-1"><input type="checkbox" onclick="toggle(this)"></td>
                                                                <td class="col-lg-5"><?php echo $this->lang->line("Title") ?></td>
                                                                <td class="col-lg-2" align="center"><?php echo $this->lang->line("Created date") ?><br><?php echo $this->lang->line("Expiration date") ?></td>
                                                                <td class="col-lg-1" align="center"><?php echo $this->lang->line("Count view") ?></td>
                                                                <td class="col-lg-1" align="center"><?php echo $this->lang->line("Count apply") ?></td>
                                                                <td class="col-lg-3" align="right"><?php echo $this->lang->line("Action") ?></td>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            if ($jobs->num_rows() > 0) {
                                                                foreach ($jobs->result() as $item) {
                                                                    $link = URL.$this->lang->line('l_detail').'/'.$item->alias.'-'.$item->id;
                                                                    ?>
                                                                    <tr>
                                                                        <td align="left"><input type="checkbox" id="job" name="job[]" value="<?php echo $this->encrypt->encode($item->id);?>" /></td>
                                                                        <td>
                                                                            <a class="title" href="<?php echo $link;?>">
                                                                                <?php echo $item->title ?>
                                                                            </a>
                                                                            <br>
                                                                            <div>
                                                                                <span class="span-cell tooltips"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo $this->lang->line('Salary')?>"><span class="glyphicon glyphicon-usd"></span>:
                                                                                    <?php echo get_salary($item->salary).' '.$this->lang->line('milion'); ?>
                                                                                </span>
                                                                                <!-- <span class="span-cell tooltips" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo $this->lang->line('Experience')?>"><span class="glyphicon glyphicon-time" aria-hidden="true"></span>: <?php echo $default_exp[$item->year_exp]?></span> -->
                                                                                <span class="span-cell tooltips" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo $this->lang->line('Location')?>"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>: <?php echo get_city($item->city_ids)?></span>
                                                                            </div>
                                                                        </td>
                                                                        <td align="center"><?php echo date('d-m-Y', strtotime($item->update_at)); ?> <br><?php echo date('d-m-Y', strtotime($item->date_expiration)); ?></td>
                                                                        <td align="center"><?php echo $item->views?></td>
                                                                        <td align="center"><?php echo $item->cid; ?></td>
                                                                        <td align="right">
                                                                            <?php
                                                                            if($menuActiveChild != $this->lang->line('Jobs deleted')){
                                                                                ?>
                                                                                <a data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line('View resume'); ?>" href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_view_resume').'/job_id/'.$item->id; ?>"><span class="btn btn-small glyphicon glyphicon-fullscreen"></span></a>
                                                                                <?php
                                                                            }
                                                                            else{
                                                                                ?>
                                                                                <a data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line('View resume'); ?>" href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_restore_job').'/job_id/'.$item->id; ?>"><span class="btn btn-small glyphicon glyphicon-fullscreen"></span></a>
                                                                                <?php
                                                                            }
                                                                            //Sửa tin, Bỏ kích hoạt
                                                                            ?>
                                                                            <a data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line('Edit job'); ?>" href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_job').'/'.$this->lang->line('l_edit_job').'/job_id/'.$item->id; ?>"><span class="btn btn-small glyphicon glyphicon-edit"></span></a>
                                                                            <a data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line('Deactivate'); ?>" href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_job').'/'.$this->lang->line('l_deactivate').'/job_id/'.$item->id; ?>"><span class="btn btn-small glyphicon glyphicon-ok"></span></a>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                            }
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                        <?php
                                                        if($menuActiveChild != $this->lang->line('Jobs deleted')){
                                                        ?>
                                                            <div class="col-md-offset-6 col-md-6 text-right pad-no">
                                                                <a href="#"  onclick="onDelMyJob();" class="btn btn-info"><?php echo $this->lang->line('Delete');?></a>
                                                            </div>
                                                            <input type="hidden" name="btnDelete" value="1">
                                                            <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <div class="col-md-offset-6 col-md-6 text-right pad-no">
                                                                <a href="#" onclick="onDelMyJob();" class="btn btn-info"><?php echo $this->lang->line('Restore');?></a>
                                                            </div>
                                                            <input type="hidden" name="btnRestore" value="1">
                                                            <?php
                                                        }
                                                        ?>
                                                    </form>
                                                    <div class="dashboard-pagination text-right col-lg-12 col-md-12 col-sm-12 no-padding">
                                                        <?php if (isset($pagination)) echo $pagination; ?>
                                                    </div>
                                                    <!-- freelancer pagination -->
                                                </div>
                                                <!-- table-list-project -->
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- ho-so-xin-viec-->
                            </div>
                            <?php $this->load->view('employers/right'); ?>
                        </div> <!--row-->
                    </div>
                </div><!-- end 9 Nhóm ngành nghề -->
            </div><!-- end body left -->
        </div>
    </div>
</div><!-- end body page -->