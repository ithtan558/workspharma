<?php $this->load->view('header'); ?>

<?php
    if(isset($this->loggedInUser->id) == TRUE){
        $class1 = 'wrap-dashboard';
        $class2 = 'container-dashboard';
    }else{
        $class1 = '';
        $class2 = '';
    }
?>

    <div class="wrap-content wrap-project <?php echo $class1?>"" >
        <div class="container <?php echo $class2?>"" >
            <?php
            // if(isset($this->loggedInUser->id) == TRUE) {
            //     $this->load->view('sideBlocks/menuDashboard', $menuActive);
            // }?>
            <div class="row find-job">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 no-padding find-job-title">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 no-padding find-job-title">
                        <div class="f24-m"><?php echo $this->lang->line('Job Search Result');?></div>
                        <div class="f14-m green-2"><?php echo $total_jobs . ' ' .$this->lang->line('were found based on your criteria');?></div>
                    </div>
                    <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 no-padding find-job-title">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 no-padding row-fluid home-search-form-row">
                            <form id="form-search" class="home-search-form search_form" action="<?php echo site_url('search'); ?>" method="post">
                                <div class="span5">
                                    <div class="typeahead-container">
                                        <div class="typeahead-field">
                                            <span class="typeahead-query">
                                                <input id="search-skill" type="text" name="keywords" placeholder="<?php echo $this->lang->line('Skill, position, company...'); ?>" value="<?php if(isset($params['keywords'])){echo urldecode($params['keywords']);} ?>" class="search-skill" autocomplete="off">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="span5">
                                    <select  id="location" name="location" class="form-control edit-control">
                                        <option value=""><?php echo $this->lang->line('Select');?></option>
                                        <?php
                                        foreach ($getCities->result() as $item) {
                                            if(isset($params['location'])){
                                                if($item->id==$params['location'])
                                                {
                                                    $class='selected';
                                                }
                                                else
                                                {
                                                    $class='';
                                                }
                                            }
                                            else
                                            {
                                                $class='';
                                            }
                                            ?>
                                            <option <?php echo $class; ?> value="<?php echo $item->id ?>"><?php echo $item->city_name; ?></option>
                                            <?php
                                            # code...
                                        }?>
                                    </select>
                                </div>
                                <div class="span2">
                                    <button type="submit" class="btn btn-large btn-sh btn-block evti" data-event="home_page_search_jobs"><?php echo $this->lang->line('Search'); ?></button>
                                </div>
                                <div class="clear"></div>
                                <div class="key_words">
                                    <span class="left"><?php echo $this->lang->line('Popular keywords')?>:</span>
                                    <div class="all_keys">
                                        <a href="/search/keywords/Manager" class="keyword-tag <?php if(isset($params['keywords'])){if($params['keywords']=='Manager')echo 'selected';}?>" data-tag="Manager">Manager</a>
                                        <a href="/search/keywords/Java" class="keyword-tag <?php if(isset($params['keywords'])){if($params['keywords']=='Java')echo 'selected';}?>" data-tag="Java">Java</a>
                                        <a href="/search/keywords/.NET" class="keyword-tag <?php if(isset($params['keywords'])){if($params['keywords']=='.NET')echo 'selected';}?> " data-tag=".NET">.NET</a>
                                        <a href="/search/keywords/Android" class="keyword-tag <?php if(isset($params['keywords'])){if($params['keywords']=='Android')echo 'selected';}?>" data-tag="Android">Android</a>
                                        <a href="/search/keywords/iOS" class="keyword-tag <?php if(isset($params['keywords'])){if($params['keywords']=='iOS')echo 'selected';}?>" data-tag="iOS">iOS</a>
                                        <a href="/search/keywords/PHP" class="keyword-tag <?php if(isset($params['keywords'])){if($params['keywords']=='PHP')echo 'selected';}?>" data-tag="PHP">PHP</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 menu-categories-find col-left">
                    
                    
                    <ul class="block-left-fillter">
                        <p class="f18-m green-2"><?php echo $this->lang->line('Skills');?> </p>
                        <?php

                            if($getCategories->num_rows() > 0) {
                                foreach ($getCategories->result() as $item) {
                                    $link_skill = '';
                                    if($params != null && array_key_exists ('keywords', $params)){
                                        $tmp = $params;
                                        $tmp['keywords'] = urlencode($item->category_name);
                                        if($item->category_name == $params['keywords']){
                                            $class = "class='selected'";
                                            $link_skill = "javascript:void();";
                                        }else{
                                            $class = '';
                                            $link_skill = site_url('search/'.build_url($tmp));
                                        }
                                    }elseif($params != null){
                                        $class = '';
                                        $link_skill = build_url($params);
                                    }
                                    else{
                                        $class = '';
                                        $link_skill = site_url('search/keywords/'.$item->category_name);
                                    }
                                    ?>
                                    <li <?php echo (isset($class))?$class:'';?>><a href="<?php echo $link_skill?>"><?php echo $item->category_name?></a></li>
                                    <?php
                                }
                            }
                        ?>
                    </ul>
                    <ul class="block-left-fillter">
                        <p class="f18-m green-2"><?php echo $this->lang->line('Location');?> </p>
                        <?php
                            
                            if($getCities->num_rows() > 0) {
                                //var_dump($params);die;
                                foreach ($getCities->result() as $item) {
                                    $link_location = '';
                                    if($params != null && array_key_exists ('location', $params)){
                                        $tmp = $params;
                                        $tmp['location'] = urlencode($item->city_name);
                                        //echo $item->city_name.'-'.$params['location'];
                                        if($item->id == urldecode($params['location'])){
                                            $class = "class='selected'";
                                            $link_location = "javascript:void();";
                                        }else{
                                            $class = '';
                                            $link_location = site_url('search/'.build_url($tmp));
                                        }
                                    }elseif($params != null){
                                        $class = '';
                                        $link_location = site_url('search/location/'.urlencode($item->city_name).'/'.build_url($params));
                                    }
                                    else{
                                        $class = '';
                                        $link_location = site_url('search/location/'.urlencode($item->city_name));
                                    }
                                    ?>
                                    <li <?php echo (isset($class))?$class:'';?>><a href="<?php echo $link_location?>"><?php echo $item->city_name?></a></li>
                                    <?php
                                }
                            }
                        ?>
                    </ul>
                    <ul class="block-left">
                        <p class="f18-m green-2"><?php echo $this->lang->line('Date posted');?> </p>
                            <?php
                            $link_date = '';
                            if($params != null && array_key_exists ('dp', $params)){
                                $tmp = $params;
                                $link_date = build_url($tmp);
                            }elseif($params != null){
                                $link_date = build_url($params);
                            }
                            ?>
                            <li>
                                <a href="<?php echo site_url('browse-projects/'.$link_date)?>"><?php echo $this->lang->line('Any timeframe');?></a>
                            <li <?php echo (isset($params['dp']) && $params['dp'] == 1)?'class="selected"':''?>>
                                <a href="<?php echo site_url('search/dp/1/'.$link_date)?>"><?php echo $this->lang->line('Last 24 Hourse');?></a>
                            </li>
                            <li <?php echo (isset($params['dp']) && $params['dp'] == 3)?'class="selected"':''?>>
                                <a href="<?php echo site_url('search/dp/3/'.$link_date)?>"><?php echo $this->lang->line('Last 3 Days');?></a>
                            </li>
                            <li <?php echo (isset($params['dp']) && $params['dp'] == 7)?'class="selected"':''?>>
                                <a href="<?php echo site_url('search/dp/7/'.$link_date)?>"><?php echo $this->lang->line('Last 7 Days');?></a>
                            </li>
                            <li <?php echo (isset($params['dp']) && $params['dp'] == 14)?'class="selected"':''?>>
                                <a href="<?php echo site_url('search/dp/14/'.$link_date)?>"><?php echo $this->lang->line('Last 14 Days');?></a>
                            </li>
                            <li <?php echo (isset($params['dp']) && $params['dp'] == 30)?'class="selected"':''?>>
                                <a href="<?php echo site_url('search/dp/30/'.$link_date)?>"><?php echo $this->lang->line('Last 30 Days');?></a>
                            </li>
                    </ul>
                    <ul class="block-left-fillter">
                        <p class="f18-m green-2"><?php echo $this->lang->line('Experience');?> </p>
                        <?php
                            foreach ($default_exp as $key => $val) {
                                $link_experience = '';
                                if($params != null && array_key_exists ('experience', $params)){
                                    $tmp = $params;
                                    $tmp['experience'] = urlencode($val);
                                    //echo $item->city_name.'-'.$params['location'];
                                    if($val == urldecode($params['experience'])){
                                        $class = "class='selected'";
                                        $link_experience = "javascript:void();";
                                    }else{
                                        $class = '';
                                        $link_experience = site_url('search/'.build_url($tmp));
                                    }
                                }elseif($params != null){
                                    $class = '';
                                    $link_experience = site_url('search/experience/'.urlencode($val).'/'.build_url($params));
                                }
                                else{
                                    $class = '';
                                    $link_experience = site_url('search/experience/'.urlencode($val));
                                }
                                ?>
                                <li <?php echo (isset($class))?$class:'';?>><a href="<?php echo $link_experience?>"><?php echo urlencode($val);?></a></li>
                                <?php
                            }
                        ?>
                    </ul>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 no-padding">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding box-jobs">
                        <?php
                        if($jobs == null){
                            echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center; margin-top: 50px">Not found!</div>';
                        }else{
                        foreach($jobs as $item){
                            $link = site_url('detail-jobs/'.$item->alias.'-'.$item->id);
                        ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-jobs">
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8 no-padding title-jobs"><a href="<?php echo $link;?>"><?php echo $item->title?></a></div>
                            <!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 no-padding" style="text-align: right">
                                <a class="btn btn-orange btn-apply-job">Apply</a>
                            </div> -->
                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 no-padding project-des">
                                <?php echo cutString(convertContent($item->description), 200, "... <a data-id='".$item->id."' class='des-readmore'>More</a>")?>
                            </div>
                            <!--
                            <span class="col-md-12 col-lg-12 col-xs-12 col-sm-12 no-padding job-read-more">
                                <a href="#" class="des-readmore">More</a>
                            </span>
                            -->
                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 no-padding">
                                <span class="col-md-3 col-lg-1 col-xs-3 col-sm-3 no-padding">Skills: </span>
                                <div class="col-md-9 col-lg-11 col-xs-9 col-sm-9 no-padding list-skill">
                                    <ul>
                                        <?php echo getCategoryLinks($item->category_ids);?>
                                    </ul>
                                </div>
                            </div>
                            <div class="intro-jobs col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                <span><?php echo $this->lang->line('Salary')?>: <?php echo formatPrice($item->salary_min)?></span>
                                <span><?php echo $this->lang->line('Age')?>: <?php echo $item->age?></span>
                                <span><?php echo $this->lang->line('Experience')?>: <?php echo $item->year_exp?></span>
                                <span><?php echo $this->lang->line('Quantity')?>: <?php echo $item->qty?></span>
                            </div>
                        </div>
                        <?php }} ?>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 affiliate-pagination">
                        <?php echo $pagination; ?>
                    </div>
                </div>

            </div> <!-- end row content -->
        </div>
    </div> <!-- wrap-content -->

<?php $this->load->view('footer'); ?>