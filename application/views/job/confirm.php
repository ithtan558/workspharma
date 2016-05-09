<?php $this->load->view('header_page');?>
<div class="container-fluid">
    <div class="container no-padding container-referral">
        <div class="process-bar">

        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 box-message2">
            <div class="row-centered">
                <?php
                if ($msg = $this->session->flashdata('flash_message')) {
                    showMessage3($msg);
                }else{
                    redirect();
                }
                ?>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer_page'); ?>