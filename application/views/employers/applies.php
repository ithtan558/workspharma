<div class="body_page">
    <div class="container">
        <div class="row">
            <!-- Begin body left -->
            <?php $this->load->view('employers/main_top_my_jobs'); ?>
            <div class="col-md-12 col-sm-12 col-xs-12 padding-top">
                <div class="my_job">
                    <div class="title_header">
                        <h3><?php echo $this->lang->line('The CV applied for job') .' "'.$getJob->title.'"';?></h3>
                    </div>
                    <div class="body_mo">
                        <div class="row">
                            <div class="col-md-9 col-sm-9 col-xs-12 ho-so">
                                <div class="ho-so-xin-viec row">
                                    <div class="col-sm-12">
                                        <div class="row app-panel" id="my-jobs">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="table-projects row" id="reload-status-project">
                                                    <form id="frmMyResume" name="frm" action="<?php echo URL.'employers/deleteResumesSaved';?>" method="post" onsubmit="return checkedJobtrackers()" style="margin:0px">
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
                                                                <td class="col-lg-3"><?php echo $this->lang->line("Applicants") ?></td>
                                                                <td class="col-lg-1" align="center"><?php echo $this->lang->line("Education1") ?></td>
                                                                <td class="col-lg-2" align="center"><?php echo $this->lang->line("Experience") ?></td>
                                                                <!-- <td class="col-lg-1" align="center"><?php echo $this->lang->line("Salary") ?></td> -->
                                                                <td class="col-lg-1" align="center"><?php echo $this->lang->line("Address") ?></td>
                                                                <td class="col-lg-2" align="center"><?php echo $this->lang->line("Date applied") ?></td>
                                                                <td class="col-lg-2" align="center"><?php echo $this->lang->line("HS status") ?></td>
                                                                <td class="col-lg-1" align="right"><?php echo $this->lang->line("Messages") ?></td>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            if ($resumeApply->num_rows() > 0) {
                                                                foreach ($resumeApply->result() as $item) {
                                                                    ?>
                                                                    <tr>
                                                                        <td>
                                                                            <a class="title" href="<?php echo URL.$this->lang->line('l_view_resume').'/?idResume='.$this->encrypt->encode($item->rid); ?>">
                                                                                <?php echo $item->title ?>
                                                                            </a>
                                                                        </td>
                                                                        <td align="center"><?php echo get_education($item->education); ?></td>
                                                                        <td align="center"><?php echo get_exp($item->yearOfExperience); ?></td>
                                                                        <!-- <td align="center"><?php echo get_salary($item->expected_salary); ?></td> -->
                                                                        <td align="center"><?php echo get_city($item->city); ?></td>
                                                                        <td align="center"><?php echo date('d-m-Y', $item->update_at); ?></td>
                                                                        <td align="center">
                                                                            <select data-id="<?php echo $this->encrypt->encode($item->jaid) ?>"  name="change-type-resume-apply" class="change-type-resume-apply form-control">
                                                                                <?php
                                                                                foreach ($default_status_resume_applied as $key => $value){
                                                                                    if($item->jstatus == $key){
                                                                                        $class='selected="selected"';
                                                                                    }
                                                                                    else{
                                                                                        $class='';
                                                                                    }
                                                                                    ?>
                                                                                    <option <?php echo $class; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </td>
                                                                        <td align="right"><a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_send_resume_alert').'/'.$item->jaid; ?>"><?php echo $this->lang->line("Send") ?></a></td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                            }
                                                            ?>
                                                            </tbody>
                                                        </table>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('body').on("change",".change-type-resume-apply",function(){
            var $this = $(this);
            BootstrapDialog.confirm('<?php echo $this->lang->line("Do you really want to perform the operation?"); ?>', function(result){
                if(result === true) {
                    var id = $this.val();
                    var idApply = $this.attr('data-id');
                    var URL = BASE_URL + "<?php echo $this->lang->line('l_employers').'/'.$this->lang->line('l_change_status_apply'); ?>/?idApply=" + idApply + '&status=' + id;
                    //alert(URL);
                    window.open(URL,'_self');
                }
            });
        });
    });
</script>