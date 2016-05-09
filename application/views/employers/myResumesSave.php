<div class="body_page">
        <div class="container">
            <div class="row">
                <!-- Begin body left -->
                <?php $this->load->view('employers/main_top_manage_resume'); ?>
                <div class="col-md-12 col-sm-12 col-xs-12 padding-top">
                    <div class="my_job">
                        <div class="title_header">
                            <h3><?php echo $this->lang->line('Resume save');?></h3>
                        </div>
                        <div class="body_mo">
                            <div class="row">
                                <?php
                                if($msg = $this->session->flashdata('flash_message')) {
                                    echo '<div class="box-message">';
                                    showMessage2($msg);
                                    echo '</div>';
                                }
                                ?>
                                <div class="col-md-9 col-sm-9 col-xs-12 ho-so">
                                    <div class="ho-so-xin-viec row">
                                        <div class="col-sm-12">
                                            <div class="row app-panel" id="my-jobs">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="table-projects row" id="reload-status-project">
                                                        <form id="frmMyResume" name="frm" action="<?php echo URL.'employers/deleteResumesSaved';?>" method="post" onsubmit="return checkedResumetrackers()" style="margin:0px">
                                                            <table class="table col-lg-12 table col-md-12 col-sm-12 col-xs-12 no-padding table-dashboard">
                                                                <thead>
                                                                <tr class="x8-16-b">
                                                                    <td class="col-lg-4"><?php echo $this->lang->line("Applicants") ?></td>
                                                                    <td class="col-lg-2" align="center"><?php echo $this->lang->line("Education1") ?></td>
                                                                    <td class="col-lg-2" align="center"><?php echo $this->lang->line("Experience") ?></td>
                                                                    <td class="col-lg-1" align="center"><?php echo $this->lang->line("Salary") ?></td>
                                                                    <td class="col-lg-1" align="center"><?php echo $this->lang->line("Address") ?></td>
                                                                    <td class="col-lg-1" align="center"><?php echo $this->lang->line("Date save") ?></td>
                                                                    <td class="text-right">Chọn  <input type="checkbox" onclick="toggleResume(this)"></td>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                if(isset($getResumeFavourites)){
                                                                    if ($getResumeFavourites->num_rows() > 0) {
                                                                        foreach ($getResumeFavourites->result() as $item) {
                                                                            ?>
                                                                            <tr>
                                                                                <td>
                                                                                    <a class="title" href="<?php echo URL.$this->lang->line('l_view_resume').'/?idResume='.$this->encrypt->encode($item->rid); ?>">
                                                                                        <?php echo $item->title ?>
                                                                                    </a>
                                                                                </td>
                                                                                <td align="center"><?php echo get_education($item->education); ?></td>
                                                                                <td align="center"><?php echo get_exp($item->yearOfExperience); ?></td>
                                                                                <td align="center"><?php echo get_salary($item->expected_salary); ?></td>
                                                                                <td align="center"><?php echo get_city($item->city); ?></td>
                                                                                <td align="center"><?php echo date('d-m-Y', $item->update_at); ?></td>
                                                                                <td align="right"><input type="checkbox" id="resume" name="resume[]" value="<?php echo $this->encrypt->encode($item->id);?>" /></td>
                                                                            </tr>
                                                                        <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                                </tbody>
                                                            </table>
                                                            <div class="col-md-offset-6 col-md-6 text-right pad-no">
                                                                <a href="#"  onclick="onDelMyResume();" class="btn btn-info">Xóa</a>
                                                            </div>
                                                            <input type="hidden" name="btnDelete" value="1">
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