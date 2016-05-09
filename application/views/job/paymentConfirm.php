<?php $this->load->view('header_page');?>
<div class="container-fluid">
    <div class="container no-padding container-referral">
    <div class="container no-padding container-invoice swMain">
        <!--<div class="process-bar">
            <img src="<?php /*echo image_url('bar-invoice.jpg')*/?>">
        </div>-->
        <ul class="anchor">
            <li>
                <a href="#step-1" class="done" isdone="1" rel="1">
                    <div class="stepNumber"> 1 </div>
                    <span class="stepDesc"> Post job <br>
                    <!--<small>Step 1 description</small>--> </span>
                </a>
            </li>
            <li>
                <a href="#step-2" class="done" isdone="0" rel="2">
                    <div class="stepNumber"> 2 </div>
                    <span class="stepDesc"> Payment <br>
                    <!--<small>Step 2 description</small>--> </span>
                </a>
            </li>
            <li>
                <a href="#step-3" class="selected" isdone="0" rel="3">
                    <div class="stepNumber"> 3 </div>
                    <span class="stepDesc"> Finish <br>
                    <!--<small>Step 3 description</small>--> </span>
                </a>
            </li>
        </ul>

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