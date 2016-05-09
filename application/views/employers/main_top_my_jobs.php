<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <ul class="nav tab-child">
        <li style="margin-right: 17px;" <?php if(isset($menuActiveChild))if($menuActiveChild == $this->lang->line('Jobs are posted')) echo 'class="active"'?>>
            <span>
                <a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_jobs_are_posted'); ?>"><?php echo $this->lang->line('Jobs are posted')?>
                </a>
            </span>
        </li>
        <li style="margin-right: 17px;" <?php if(isset($menuActiveChild))if($menuActiveChild == $this->lang->line('Jobs expired')) echo 'class="active"'?>>
            <span>
                <a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_jobs_expired'); ?>"><?php echo $this->lang->line('Jobs expired')?>
                </a>
            </span>
        </li>
        <li style="margin-right: 17px;" <?php if(isset($menuActiveChild))if($menuActiveChild == $this->lang->line('Jobs deleted')) echo 'class="active"'?>>
            <span>
                <a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_jobs_deleted'); ?>"><?php echo $this->lang->line('Jobs deleted')?>
                </a>
            </span>
        </li>
    </ul>
</div>