<div class="body_page">
        <div class="container">
            <div class="row">
                <!-- Begin body left -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="page_kq_tim_kiem">
                        <div class="title_header">
                            <h3>
                            <?php
                                if(isset($params['employer'])){
                                    $title = $this->lang->line('result find job of company').' "'.$company.'"';
                                }
                                else{
                                    $title = $this->lang->line('result find job');
                                }
                                echo $title;
                            ?>
                            </h3>
                        </div>
                        <div class="body_mo">
                            <div class="row">
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12 margin-bottom-10">
                                        <?php if(isset($keywords_search)) { ?>
                                            <?php echo $this->lang->line('find_have_before').' '.$total_jobs.' '.$this->lang->line('find_have_after').' <br><strong>"'.urldecode($keywords_search).'"</strong>';?>
                                            <?php }else{ ?>
                                            <?php echo $this->lang->line('find_have_before').' '.$total_jobs.' '.$this->lang->line('find_have_after');?>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 sort">
                                            <div class="page_button">
                                                <div class="btn-toolbar" role="toolbar" aria-label="...">
                                                  <?php echo $pagination; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                if($jobs == null){
                                    echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center; margin-bottom: 20px">'.$this->lang->line('Not found!').'</div>';
                                }else{
                                    echo '<ul>';
                                foreach($jobs as $item){
                                    $link = URL.$this->lang->line('l_detail').'/'.$item->alias.'-'.$item->id;
                                ?>
                                        <li>
                                            <a href="<?php echo $link;?>"><h4><img class="hidden-xs" src="<?php echo IMAGES;?>Star.png"/><?php echo $item->title ?></h4></a>
                                            <a href="<?php echo $link;?>"><span><?php echo displayUserName($item->user_name,$item->company) ;?></span></a> - <a href="#"><i><?php echo get_city($item->city_ids);?></i></a>
                                            <p><?php echo $this->lang->line('Salary')?>:
                                    <?php
                                    if($item->salary_min == 0 && $item->salary_max == 0){
                                        echo $this->lang->line('Negtiable');
                                    }else{
                                        echo ($item->salary_min != 0) ? formatPrice($item->salary_min) : '';
                                        echo ($item->salary_min != 0) ? ' - ' : ' > ';
                                        echo ($item->salary_max != 0) ? formatPrice($item->salary_max) : '';
                                    }
                                    ?> | <?php echo get_level($item->level_id); ?> <span><?php echo date('m-d-Y',strtotime($item->j_date_created)); ?></span></p>
                                        </li>
                                    <?php } echo '</ul>';}?>
                                    <div class="page_button">
                                        <div class="btn-toolbar" role="toolbar" aria-label="...">
                                          <?php echo $pagination; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="tim_viec_right">
                                        <h5><?php echo $this->lang->line('edit request find job'); ?></h5>
                                        <div class="body_right">
                                            <form id="form-search" class="" action="<?php echo URL.$this->lang->line('l_job'); ?>" method="post">
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line('Keywords'); ?></label>
                                                    <input name="keywords" type="text" value="<?php if(isset($keywords_search))echo ($keywords_search); ?>" class="form-control"/>
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line('Choose nghanh'); ?></label>
                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            $('#category').multiselect({
                                                                nonSelectedText: "<?php echo $this->lang->line('All Category')?>"
                                                            });
                                                        });
                                                    </script>
                                                    <select class="form-control"  id="category" name="category[]" multiple="multiple">
                                                        <?php
                                                        foreach ($getCategories->result() as $item) {
                                                            if($item->parent_id==0){
                                                            echo '<optgroup label="'.$item->category_name.'">';
                                                                foreach ($getCategories->result() as $itemChild) {
                                                                    if($item->id==$itemChild->parent_id){
                                                                        if(isset($params['category'])){
                                                                            $arrayCategory=explode('-',$params['category']);
                                                                            if(in_array($itemChild->id, $arrayCategory)){
                                                                                $class = "selected='selected'";
                                                                            }
                                                                            else{
                                                                                $class='';
                                                                            }
                                                                        }
                                                                        else{
                                                                            $class='';
                                                                        }
                                                                        echo '<option '.$class.' value="'.$itemChild->id.'">'.$itemChild->category_name.'</option>';
                                                                    }
                                                                }
                                                            }
                                                            echo '</optgroup>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line('Address'); ?></label>
                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            $('#city').multiselect({
                                                                nonSelectedText: "<?php echo $this->lang->line('All City')?>"
                                                            });
                                                        });
                                                    </script>
                                                    <select class="form-control"  id="city" name="city[]" multiple="multiple">
                                                        <?php
                                                            foreach ($getCities->result() as $item) {
                                                                if(isset($params['city'])){
                                                                    $arrayCity=explode('-',$params['city']);
                                                                    if(in_array($item->id, $arrayCity)){
                                                                        $class = "selected='selected'";
                                                                    }
                                                                    else{
                                                                        $class='';
                                                                    }
                                                                }
                                                                else{
                                                                    $class='';
                                                                }
                                                                ?>
                                                                <option <?php echo $class; ?> value="<?php echo $item->id ?>"><?php echo $item->city_name; ?></option>
                                                                <?php
                                                                # code...
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line('Education'); ?></label>
                                                    <select id="education" name="education" class="form-control edit-control">
                                                        <option value=""><?php echo $this->lang->line('Select');?></option>
                                                        <?php
                                                        foreach ($getEducation as $key=>$value) {
                                                            if(isset($params['education'])){
                                                                if($key==$params['education']){
                                                                    $class = "selected='selected'";
                                                                }
                                                                else{
                                                                    $class='';
                                                                }
                                                            }
                                                            else{
                                                                $class='';
                                                            }
                                                            ?>
                                                            <option <?php echo $class; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>
                                                            <?php
                                                            # code...
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line('Type job'); ?></label>
                                                    <select id="type" name="type" class="form-control edit-control">
                                                        <option value=""><?php echo $this->lang->line('Select');?></option>
                                                        <?php
                                                        foreach ($default_cbPositionType as $key=>$value) {
                                                            if(isset($params['type'])){
                                                                if($key==$params['type']){
                                                                    $class = "selected='selected'";
                                                                }
                                                                else{
                                                                    $class='';
                                                                }
                                                            }
                                                            else{
                                                                $class='';
                                                            }
                                                            ?>
                                                            <option <?php echo $class; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>
                                                            <?php
                                                            # code...
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line('Level'); ?></label>
                                                    <select id="level" name="level" class="form-control edit-control">
                                                        <option value=""><?php echo $this->lang->line('Select');?></option>
                                                        <?php
                                                        foreach ($default_currentJobLevel as $key=>$value) {
                                                            if(isset($params['level'])){
                                                                if($key==$params['level']){
                                                                    $class = "selected='selected'";
                                                                }
                                                                else{
                                                                    $class='';
                                                                }
                                                            }
                                                            else{
                                                                    $class='';
                                                                }
                                                            ?>
                                                            <option <?php echo $class; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>
                                                            <?php
                                                            # code...
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line('Experience'); ?></label>
                                                    <select id="year_exp" name="year_exp" class="form-control edit-control">
                                                        <option value=""><?php echo $this->lang->line('Select');?></option>
                                                        <?php
                                                        foreach ($default_exp as $key=>$value) {
                                                            if(isset($params['year_exp'])){
                                                                if($key==$params['year_exp']){
                                                                    $class = "selected='selected'";
                                                                }
                                                                else{
                                                                    $class='';
                                                                }
                                                            }
                                                            else{
                                                                $class='';
                                                            }

                                                            ?>
                                                            <option <?php echo $class; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>
                                                            <?php
                                                            # code...
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line('Salary'); ?></label>
                                                    <select id="salary" name="salary" class="form-control edit-control">
                                                        <option value=""><?php echo $this->lang->line('Select');?></option>
                                                        <?php
                                                        foreach ($default_salary as $key=>$value) {
                                                            if(isset($params['salary'])){
                                                                if($key==$params['salary']){
                                                                    $class = "selected='selected'";
                                                                }
                                                                else{
                                                                    $class='';
                                                                }
                                                            }
                                                            else{
                                                                $class='';
                                                            }

                                                            ?>
                                                            <option <?php echo $class; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>
                                                            <?php
                                                            # code...
                                                        }
                                                        ?>
                                                    </select>
                                        <?php echo $this->lang->line('Million'); ?>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-info" id="test">Tìm kiếm</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end 9 Nhóm ngành nghề -->
                </div><!-- end body left -->
            </div>
        </div>
    </div><!-- end body page -->