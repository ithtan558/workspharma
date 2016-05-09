<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <ul class="nav tab-child">
        <li style="margin-right: 17px;" <?php if(isset($menuActiveChild))if($menuActiveChild == 'viewMyResumesSave') echo 'class="active"'?>>
            <span>
                <a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_resumes_save'); ?>"><?php echo $this->lang->line('Resume save')?>
                </a>
            </span>
        </li>
        <li style="margin-right: 17px;" <?php if(isset($menuActiveChild))if($menuActiveChild == 'viewMyResumeAlerts') echo 'class="active"'?>>
            <span>
                <a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_my_resume_alerts'); ?>"><?php echo $this->lang->line('Manage message apply')?>
                </a>
            </span>
        </li>
        <li style="margin-right: 17px;" <?php if(isset($menuActiveChild))if($menuActiveChild == 'viewMessages') echo 'class="active"'?>>
            <span>
                <a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_messages'); ?>"><?php echo $this->lang->line('Manage default message')?>
                </a>
            </span>
        </li>
    </ul>
</div>