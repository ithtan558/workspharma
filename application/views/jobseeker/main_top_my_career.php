<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <ul class="nav tab-child">
        <li style="margin-right: 17px;" <?php if(isset($menuActiveChild))if($menuActiveChild == 'viewMyJobsApply') echo 'class="active"'?>>
            <span>
                <a href="<?php echo URL.$this->lang->line('l_jobseeker'); ?>"><?php echo $this->lang->line('My jobs apply')?>
                </a>
            </span>
        </li>
        <li style="margin-right: 17px;" <?php if(isset($menuActiveChild))if($menuActiveChild == 'viewMyJobsSave') echo 'class="active"'?>>
            <span>
                <a href="<?php echo URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_jobs_save'); ?>"><?php echo $this->lang->line('Jobs save')?>
                </a>
            </span>
        </li>
        <li style="margin-right: 17px;" <?php if(isset($menuActiveChild))if($menuActiveChild == 'viewResumeOfEmployee') echo 'class="active"'?>>
            <span>
                <a href="<?php echo URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_view_resume_employee'); ?>"><?php echo $this->lang->line('View resume employee')?>
                </a>
            </span>
        </li>
    </ul>
</div>