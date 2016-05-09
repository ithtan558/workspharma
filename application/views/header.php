<header>
    <div class="top_header"></div>
    <div class="body_header">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12 logo">
                  <?php
                    if($this->session->userdata('user_id')){
                      if($this->session->userdata('role_id')==1){
                        $link_index=URL.'';
                      }
                      else{
                        $link_index=URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_index');
                      }
                    }
                    else{
                      $link_index=URL;
                    }
                  ?>
                    <a title="<?php echo $this->lang->line('Free Job Search Recruitment & Pharmacy - Biology - Chemistry'); ?>" href="<?php echo $link_index; ?>"><img alt="<?php echo $this->lang->line('Free Job Search Recruitment & Pharmacy - Biology - Chemistry'); ?>" title="<?php echo $this->lang->line('Free Job Search Recruitment & Pharmacy - Biology - Chemistry'); ?>" src="<?php echo IMAGES;?>logo.png" class="img-responsive"/></a>
                    <p><?php echo $this->lang->line('Free Job Search Recruitment & Pharmacy - Biology - Chemistry'); ?></p>
                </div><!-- end logo-->
                <div class="col-md-6 col-md-offset-2 col-sm-6 col-sm-offset-2 col-xs-12">
                    <div class="row right">
                        <div class="col-md-3 col-sm-3 col-xs-6 nn">
                            <a href="<?php echo URL.'languages/index/vietnamese' ?>"><img src="<?php echo IMAGES;?>vn.png"/>  Tiếng Việt</a>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6 nn">
                            <a href="<?php echo URL.'languages/index/english' ?>"><img src="<?php echo IMAGES;?>gb.png"/>  English</a>
                        </div>
                        <?php
                          $flag=$this->uri->segment(1);
                          if($flag){
                            $url_change_employer_or_jobseeker=URL;
                            $change_employer_or_jobseeker=$this->lang->line("Jobseeker");
                          }
                          else{
                            $change_employer_or_jobseeker=$this->lang->line("Employers");
                            $url_change_employer_or_jobseeker=URL.$this->lang->line("l_employers");
                          }
                          ?>
                        <?php
                        if(!$this->session->userdata('user_id')){
                        ?>
                        <div class="col-md-6 col-sm-6 col-xs-12 dk text-right">
                          <?php
                          $flag=$this->uri->segment(1);
                          if($flag=='nha-tuyen-dung' || $flag == 'employer'){
                            $url_signup=URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_sign_up');
                            $url_change_employer_or_jobseeker=URL;
                            $change_employer_or_jobseeker=$this->lang->line("Jobseeker");
                          }
                          else{
                            $url_signup=URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_sign_up');
                            $change_employer_or_jobseeker=$this->lang->line("Employers");
                            $url_change_employer_or_jobseeker=URL.$this->lang->line("l_employers");
                          }
                          ?>
                            <a href="<?php echo $url_signup?>"><?php echo $this->lang->line('Sign up') ?></a>  |   <a href="<?php echo URL.$this->lang->line('l_sign_in') ?>"><?php echo $this->lang->line('Sign in') ?></a>
                        </div>
                        <?php }else{
                          $userInfo = getUserInfo($this->session->userdata('user_id'));
                          $arrayEmail = explode('@',$userInfo->email);
                          $email_first=$arrayEmail[0];
                          $name=displayUserName($email_first,'');
                        ?>
                        <div class="col-md-6 col-sm-6 col-xs-12 dk text-right">
                            <?php echo $this->lang->line('Hi'); ?> : <span><?php echo $name;?></span>  |   <a href="<?php echo URL.'users/'.$this->lang->line('l_sign_out') ?>"><?php echo $this->lang->line('Sign out') ?></a>
                        </div>
                        <?php } ?>
                        <?php if(!$this->session->userdata('user_id')){ ?>
                        <div class="col-md-6 col-md-offset-6 col-sm-6 col-sm-offset-6 col-xs-12 dk ntd text-right">
                            <a href="<?php echo $url_change_employer_or_jobseeker ?>"><?php echo $change_employer_or_jobseeker?></a>
                        </div>
                        <?php } ?>
                    </div>
                </div> <!-- end ngon ngu, DK , NP-->
                <div class=" col-md-12 col-xs-12 col-sm-12 menu-desktop">
                    <ul class="menu">
                      <?php
                      if($this->session->userdata('user_id')){
                        // Jobseeker
                        if($this->session->userdata('role_id')==1){
                          // Account
                          $id ='';
                          if(isset($menuActive)){
                            if($menuActive == 'Career tool'){
                              $id='id="active"';
                            }
                            else{
                              $id='';
                            }
                          }
                          ?>
                          <li <?php echo $id; ?>><a href="<?php echo URL.$this->lang->line('l_career_tool'); ?>"><?php echo $this->lang->line('Carrer tool'); ?></a></li>
                          <?php
                          // Account
                          $id ='';
                          if(isset($menuActive)){
                            if($menuActive == 'Account'){
                              $id='id="active"';
                            }
                            else{
                              $id='';
                            }
                          }
                          ?>
                          <li <?php echo $id; ?>><a href="<?php echo URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_account').'/'.$this->lang->line('l_edit'); ?>"><?php echo $this->lang->line('Account'); ?></a></li>
                          <?php
                          //My career
                          $id='';
                          if(isset($menuActive)){
                              if($menuActive=='My resume'){
                                $id='id="active"';
                              }
                              else{
                                $id='';
                              }
                            }
                          ?>
                          <li <?php echo $id; ?>><a  href="<?php echo URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_my_resume'); ?>"><?php echo $this->lang->line('My resume'); ?></a></li>
                          <?php
                          //My career
                          $id='';
                          if(isset($menuActive)){
                              if($menuActive=='My career'){
                                $id='id="active"';
                              }
                              else{
                                $id='';
                              }
                            }
                          ?>
                          <li <?php echo $id; ?>><a href="<?php echo URL.$this->lang->line('l_jobseeker'); ?>"><?php echo $this->lang->line('My career'); ?></a></li>
                          <?php
                          //Search fast
                          $id='';
                          if(isset($menuActive)){
                              if($menuActive=='searchFast'){
                                $id='id="active"';
                              }
                              else{
                                $id='';
                              }
                            }
                          ?>
                          <li <?php echo $id; ?>><a href="<?php echo URL.$this->lang->line('l_job'); ?>"><?php echo $this->lang->line('find job fast'); ?></a></li>
                          
                        <?php
                        }
                        //employer
                        else{
                          // manger resume
                          $id ='';
                          if(isset($menuActive)){
                            if($menuActive == 'Manage resume'){
                              $id='id="active"';
                            }
                            else{
                              $id='';
                            }
                          }
                          ?>
                          <li <?php echo $id; ?>><a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_resumes_save'); ?>"><?php echo $this->lang->line('Manage resume'); ?></a></li>
                          <?php
                          // manger job
                          $id ='';
                          if(isset($menuActive)){
                            if($menuActive == 'Manage job'){
                              $id='id="active"';
                            }
                            else{
                              $id='';
                            }
                          }
                          ?>
                          <li <?php echo $id; ?>><a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_jobs_are_posted'); ?>"><?php echo $this->lang->line('Manage jobs'); ?></a></li>
                          <?php
                          // Account
                          $id ='';
                          if(isset($menuActive)){
                            if($menuActive == 'Account'){
                              $id='id="active"';
                            }
                            else{
                              $id='';
                            }
                          }
                          ?>
                          <li <?php echo $id; ?>><a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_account').'/'.$this->lang->line('l_edit'); ?>"><?php echo $this->lang->line('Account'); ?></a></li>
                          <?php
                          // Find resume
                          $id ='';
                          if(isset($menuActive)){
                            if($menuActive == 'findResume'){
                              $id='id="active"';
                            }
                            else{
                              $id='';
                            }
                          }
                          ?>
                          <li <?php echo $id; ?>><a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_find_resume'); ?>"><?php echo $this->lang->line('find resume'); ?></a></li>
                          <?php
                          // Post job
                          $id ='';
                          if(isset($menuActive)){
                            if($menuActive == 'createJob'){
                              $id='id="active"';
                            }
                            else{
                              $id='';
                            }
                          }
                          ?>
                          <li <?php echo $id; ?>><a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_job').'/'.$this->lang->line('l_post_job'); ?>"><?php echo $this->lang->line('create job'); ?></a></li>
                          <?php
                        }
                      }
                      //Not login
                      else{
                        $id='';
                        if(isset($menuActive)){
                            if($menuActive=='site map'){
                              $id='id="active"';
                            }
                            else{
                              $id='';
                            }
                          }
                        ?>
                        <li <?php echo $id; ?>> <a href="<?php echo URL.$this->lang->line('l_site_map'); ?>"><?php echo $this->lang->line('site map'); ?></a></li>
                        
                        <?php
                        $id='';
                        if(isset($menuActive)){
                            if($menuActive=='Carrer tool'){
                              $id='id="active"';
                            }
                            else{
                              $id='';
                            }
                          }
                        ?>
                        <li <?php echo $id; ?>><a href="<?php echo URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_my_resume'); ?>"><?php echo $this->lang->line('jobseeker create resume'); ?></a></li>
                        <?php
                        $id='';
                        if(isset($menuActive)){
                            if($menuActive=='createJob'){
                              $id='id="active"';
                            }
                            else{
                              $id='';
                            }
                          }
                        ?>
                        <li <?php echo $id; ?>><a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_job').'/'.$this->lang->line('l_post_job'); ?>"><?php echo $this->lang->line('create job'); ?></a></li>
                        <?php
                        $id='';
                        if(isset($menuActive)){
                            if($menuActive=='searchFast'){
                              $id='id="active"';
                            }
                            else{
                              $id='';
                            }
                          }
                        ?>
                        <li><a href="<?php echo URL.$this->lang->line('l_job'); ?>"><?php echo $this->lang->line('find job fast'); ?></a></li>
                        <?php
                      }
                      if(isset($menuActive)){
                        if($menuActive=='Index'){
                          $id='id="active"';
                        }
                        else{
                          $id='';
                        }
                      }
                      else{
                        $id='';
                      }
                      ?>
                      <li <?php echo $id; ?>><a href="<?php echo URL; ?>"><?php echo $this->lang->line('Index'); ?></a></li>
                    </ul>
                </div><!-- end menu -->
                <!-- menu -mobi-->
                <div class=" col-md-12 col-xs-12 col-sm-12 menu-mobi">
                  <div class="navbar navbar-inverse" role="navigation">
                    <div class="container-fluid">
                      <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                        </button>
                      </div>
                      <div class="navbar-collapse collapse" style="height: 1px;">
                        <ul class="nav navbar-nav">
                          
                        <?php
                          if(isset($menuActive)){
                            if($menuActive=='Manage job'){
                              $id='id="active"';
                            }
                            else{
                              $id='';
                            }
                          }
                          else{
                            $id='';
                          }
                          if($this->session->userdata('user_id')){
                            if($this->session->userdata('role_id')==1){
                            ?>
                              <li <?php echo $id; ?>><a href="<?php echo URL; ?>"><?php echo $this->lang->line('Index'); ?></a></li>
                            <?php
                            }
                            else{
                              ?>
                              <li <?php echo $id; ?>><a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_jobs_are_posted'); ?>"><?php echo $this->lang->line('Manage jobs'); ?></a></li>
                              <?php
                            }
                          }
                          else{
                            ?>
                            <li <?php echo $id; ?>><a href="<?php echo URL; ?>"><?php echo $this->lang->line('Index'); ?></a></li>
                            <?php
                          }
                        ?>
                        
                        <?php
                          if(isset($menuActive)){
                            if($menuActive=='searchFast'){
                              $id='id="active"';
                            }
                            else{
                              $id='';
                            }
                          }
                          else{
                            $id='';
                          }
                          if($this->session->userdata('user_id')){
                            if($this->session->userdata('role_id')==1){
                            ?>
                              <li <?php echo $id; ?>><a href="<?php echo URL.$this->lang->line('l_job'); ?>"><?php echo $this->lang->line('find job fast'); ?></a></li>
                            <?php
                            }
                            else{
                              ?>
                              <!-- <a href="#"><li><?php echo $this->lang->line('find job fast'); ?></li></a> -->
                              <?php
                            }
                          }
                          else{
                            ?>
                            <li><a href="<?php echo URL.$this->lang->line('l_job'); ?>"><?php echo $this->lang->line('find job fast'); ?></a></li>
                            <?php
                          }
                        ?>
                        
                        <?php
                          if(isset($menuActive)){
                            if($menuActive=='site map'){
                              $id='id="active"';
                            }
                            else{
                              $id='';
                            }
                          }
                          else{
                            $id='';
                          }
                        ?>
                        <?php
                          if(isset($menuActive)){
                            if($menuActive=='viewMyJobsApply' || $menuActive =='Manage resume'){
                              $id='id="active"';
                            }
                            else{
                              $id='';
                            }
                          }
                          else{
                            $id='';
                          }
                          if($this->session->userdata('user_id')){
                            if($this->session->userdata('role_id')==1){
                            ?>
                              <li <?php echo $id; ?>><a href="<?php echo URL.$this->lang->line('l_jobseeker'); ?>"><?php echo $this->lang->line('My career'); ?></a></li>
                            <?php
                            }
                            else{
                              ?>
                              <li <?php echo $id; ?>><a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_find_resume'); ?>"><?php echo $this->lang->line('Manage resume'); ?></a></li>
                              <?php
                            }
                          }
                          else{
                            ?>
                            <?php
                          }
                        ?>
                        <?php
                          if(isset($menuActive)){
                            if($menuActive=='createResume' || $menuActive == 'createJob'){
                              $id='id="active"';
                            }
                            else{
                              $id='';
                            }
                          }
                          else{
                            $id='';
                          }
                          if($this->session->userdata('user_id')){
                            if($this->session->userdata('role_id')==1){
                            ?>
                              <li <?php echo $id; ?>><a  href="<?php echo URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_my_resume'); ?>"><?php echo $this->lang->line('My resume'); ?></a></li>
                            <?php
                            }
                            else{
                              ?>
                              <li <?php echo $id; ?>><a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_job').'/'.$this->lang->line('l_post_job'); ?>"><?php echo $this->lang->line('create job'); ?></a></li>
                              <?php
                            }
                          }
                          else{
                            ?>
                            <li><a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_job').'/'.$this->lang->line('l_post_job'); ?>"><?php echo $this->lang->line('create job'); ?></a></li>
                            <?php
                          }
                        ?>
                        
                        <?php
                          if(isset($menuActive)){
                            if($menuActive=='menuActive' || $menuActive=='Carrer tool'){
                              $id='id="active"';
                            }
                            else{
                              $id='';
                            }
                          }
                          else{
                            $id='';
                          }
                          if($this->session->userdata('user_id')){
                            if($this->session->userdata('role_id')==1){
                            ?>
                            <li <?php echo $id; ?>><a href="<?php echo URL.$this->lang->line('l_career_tool'); ?>"><?php echo $this->lang->line('Carrer tool'); ?></a></li>
                            <?php
                            }
                            else{
                              ?>
                              <li <?php echo $id; ?>><a href="<?php echo URL.$this->lang->line('l_career_tool'); ?>"><?php echo $this->lang->line('Carrer tool'); ?></a></li>
                              <?php
                            }
                          }
                          else{
                            ?>
                            <li <?php echo $id; ?>><a href="<?php echo URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_my_resume'); ?>"><?php echo $this->lang->line('jobseeker create resume'); ?></a></li>
                            <?php
                          }
                        ?>
                        <li <?php echo $id; ?>> <a href="<?php echo URL.$this->lang->line('l_site_map'); ?>"><?php echo $this->lang->line('site map'); ?></a></li>
                        </ul>
                      </div><!--/.nav-collapse -->
                    </div><!--/.container-fluid -->
                  </div>
                </div><!-- end menu mobi -->
            </div>
        </div>
    </div>
</header> <!-- End header -->