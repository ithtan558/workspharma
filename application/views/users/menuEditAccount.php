<?php
if($this->session->userdata('role_id') == 2){
    $l_account =  $this->lang->line('l_employers');
}
else{
    $l_account = $this->lang->line('l_jobseeker');
}
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <ul class="nav tab-child">
        <li style="margin-right: 17px;" <?php if(isset($menuActiveChild))if($menuActiveChild == 'editAccount') echo 'class="active"'?>>
            <span>
                <a href="<?php echo URL.$l_account.'/'.$this->lang->line('l_account').'/'.$this->lang->line('l_edit'); ?>"><?php echo $this->lang->line('Edit account person')?>
                </a>
            </span>
        </li>
        <li style="margin-right: 17px;" <?php if(isset($menuActiveChild))if($menuActiveChild == 'editAccountPassword') echo 'class="active"'?>>
            <span>
                <a href="<?php echo URL.$l_account.'/'.$this->lang->line('l_account').'/'.$this->lang->line('l_edit_password'); ?>"><?php echo $this->lang->line('Edit account password')?>
                </a>
            </span>
        </li>

    </ul>
</div>