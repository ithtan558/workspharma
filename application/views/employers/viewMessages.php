<div class="body_page">
        <div class="container">
            <div class="row">
                <!-- Begin body left -->
                <?php $this->load->view('employers/main_top_manage_resume'); ?>
                <div class="col-md-12 col-sm-12 col-xs-12 padding-top">
                    <div class="my_job">
                        <div class="title_header">
                            <h3><?php echo $this->lang->line('Manage default message');?></h3>
                        </div>
                        <div class="body_mo">
                            <div class="row">
                                <?php
                                if ($msg = $this->session->flashdata('flash_message')) {
                                    showMessage2($msg);
                                }
                                ?>
                                <div class="col-md-9 col-sm-9 col-xs-12 ho-so">
                                    <div class="ho-so-xin-viec row">
                                        <div class="col-sm-12">
                                            <div class="row app-panel" id="my-jobs">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="table-projects row" id="reload-status-project">
                                                        <form id="frmMyMessage" name="frm" action="<?php echo URL.'employers/deleteMessage';?>" method="post" onsubmit="return checkedMessagetrackers()" style="margin:0px">
                                                            <table class="table col-lg-12 table col-md-12 col-sm-12 col-xs-12 no-padding table-dashboard">
                                                                <thead>
                                                                <tr class="x8-16-b">
                                                                    <td class="col-lg-4"><?php echo $this->lang->line("Name") ?></td>
                                                                    <td class="col-lg-3" align="center"><?php echo $this->lang->line("Title") ?></td>
                                                                    <td class="col-lg-2" align="center"><?php echo $this->lang->line("Content") ?></td>
                                                                    <td class="text-right">Chọn  <input type="checkbox" onclick="toggleMessage(this)"></td>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                if(isset($getUserMessagesDefault)){
                                                                    if ($getUserMessagesDefault->num_rows() > 0) {
                                                                        foreach ($getUserMessagesDefault->result() as $item) {
                                                                            ?>
                                                                            <tr>
                                                                                <td>
                                                                                    <a class="" href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_messages').'/'.$this->lang->line('l_edit_message').'/'.$item->mid; ?>">
                                                                                        <?php echo $item->name ?>
                                                                                    </a>
                                                                                </td>
                                                                                <td align="center"><?php echo $item->title; ?></td>
                                                                                <td align="center"><?php echo $item->content; ?></td>
                                                                                <td align="right">
                                                                                    <a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_messages').'/'.$this->lang->line('l_edit_message').'/'.$item->mid; ?>" title=""><?php echo $this->lang->line('Edit'); ?></a>
                                                                                    <input type="checkbox" id="message" name="message[]" value="<?php echo $this->encrypt->encode($item->mid);?>" />
                                                                                </td>
                                                                            </tr>
                                                                        <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                                </tbody>
                                                            </table>
                                                            <div class="col-md-offset-6 col-md-6 text-right pad-no">
                                                                <a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_messages').'/'.$this->lang->line('l_create_message'); ?>" class="btn btn-info">Tạo mẫu thư mới</a>
                                                                <a href="#"  onclick="onDelMyMessage();" class="btn btn-info">Xóa</a>
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