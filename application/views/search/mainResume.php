<div class="timviec">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 margin-bottom">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="<?php if(isset($tab)){if($tab ==1) echo 'active';}else{echo 'active';} ?>"><a href="#thuong" aria-controls="thuong" role="tab" data-toggle="tab"><?php echo $this->lang->line('find resume fast'); ?></a></li>
                        <li role="presentation" class="<?php if(isset($tab)){if($tab ==2) echo 'active';} ?>"><a href="#nang-cao" aria-controls="nang-cao" role="tab" data-toggle="tab"><?php echo $this->lang->line('Find resume advanced'); ?></a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane <?php if(isset($tab)){if($tab ==1) echo 'active';}else{echo 'active';} ?>" id="thuong">
                            <div class="row">
                                <form id="form-search-resume" class="col-lg-12 col-sm-12 col-md-12 col-xs-12 no-padding home-search-form search_form" action="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_find_resume'); ?>" method="post">
                                    <input type="hidden" name="tab" class="form-control" value="1" />
                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                        <input type="text" name="keywords" class="form-control" placeholder="<?php echo $this->lang->line('Keywords')?>" value="<?php if(isset($params['keywords']))echo urldecode($params['keywords']);?>" />
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
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
                                    <div class="col-md-2 col-sm-2 col-xs-12">
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
                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                        <select id="day" name="day" class="form-control edit-control">
                                            <option value=""><?php echo $this->lang->line('find resume day'); ?>...</option>
                                            <?php
                                            for ($i = 2 ; $i <= 360; $i++) {
                                                if($i < 30 || ($i > 30 && ($i ==32 || $i ==35 || $i ==38 || $i ==40 || $i ==45 || $i ==50 || $i ==60 || $i ==80 || $i ==90 || $i ==180 || $i ==360))){
                                                    if(isset($params['day'])){
                                                        if($i == $params['day']){
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
                                                    <option <?php echo $class; ?> value="<?php echo $i ?>"><?php echo $i.' '.$this->lang->line('Day'); ?></option>
                                                <?php
                                                }
                                                # code...
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <button type="submit" class="btn search"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end tìm việc thường -->
                        <div role="tabpanel" class="tab-pane <?php if(isset($tab)){if($tab ==2) echo 'active';} ?>" id="nang-cao">
                            <form id="form-search-resume" class="" action="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_find_resume'); ?>" method="post">
                                <input type="hidden" name="tab" class="form-control" value="2" />
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <p><?php echo $this->lang->line('Keywords'); ?> :</p>
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <input type="text" name="keywords" class="form-control" placeholder="<?php echo $this->lang->line('Keywords')?>" value="<?php if(isset($params['keywords']))echo urldecode($params['keywords']);?>" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <p><?php echo $this->lang->line('find resume nghanh nghe'); ?> :</p>
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#category2').multiselect({
                                                    nonSelectedText: "<?php echo $this->lang->line('All Category')?>"
                                                });
                                            });
                                        </script>
                                        <select class="form-control"  id="category2" name="category[]" multiple="multiple">
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
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <p><?php echo $this->lang->line('find resume address'); ?> :</p>
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#city2').multiselect({
                                                    nonSelectedText: "<?php echo $this->lang->line('All City')?>"
                                                });
                                            });
                                        </script>
                                        <select class="form-control"  id="city2" name="city[]" multiple="multiple">
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
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <p><?php echo $this->lang->line('Sex'); ?> :</p>
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <select class="form-control" name="gender">
                                           <option value="" selected="selected">Vui lòng chọn...</option>
                                            <?php
                                            foreach ($default_sex as $key=>$value) {
                                                if(isset($params['gender'])){
                                                    if($key==$params['gender']){
                                                        $class = "selected='selected'";
                                                    }
                                                    else{
                                                        $class='';
                                                    }
                                                }
                                                else{
                                                    $class = '';
                                                }
                                                ?>
                                                <option <?php echo $class; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>
                                                <?php
                                                # code...
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <p><?php echo $this->lang->line('Marital Status'); ?> :</p>
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <label class="radio-inline" for="marital-độc thân">
                                            <input <?php if(isset($getResume))if($getResume->marital==1) echo 'checked'; ?> class="edit-control" type="radio" name="marital" id="marital-độc thân" value="1" data-text-value="Độc thân"> Độc thân
                                        </label>
                                        <label class="radio-inline" for="marital-đã kết hôn">
                                            <input <?php if(isset($getResume))if($getResume->marital==2) echo 'checked'; ?> class="edit-control" type="radio" name="marital" id="marital-đã kết hôn" value="2" data-text-value="Đã kết hôn"> Đã kết hôn
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <p><?php echo $this->lang->line('Country'); ?> :</p>
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <select class="form-control" name="country">
                                            <option value="" selected="selected">Vui lòng chọn...</option>
                                            <?php
                                            foreach ($getCountry->result() as $item) {
                                                if(isset($params['country'])){
                                                    if($item->id==$params['country']){
                                                        $class = "selected='selected'";
                                                    }
                                                    else{
                                                        $class='';
                                                    }
                                                }
                                                else{
                                                    $class = '';
                                                }
                                                ?>
                                                <option <?php echo $class; ?> value="<?php echo $item->id ?>"><?php echo $item->country_name; ?></option>
                                                <?php
                                                # code...
                                            }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-sm-3 col-xs-12">
                                        <p><?php echo $this->lang->line('Languages') ?></p>
                                    </label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <select id="language" name="language" class="form-control">
                                            <option value=""><?php echo $this->lang->line('Select');?></option>
                                            <?php
                                            foreach ($getLanguage->result() as $items) {
                                                if(isset($params['language'])){
                                                    if($items->id==$params['language']){
                                                        $class = "selected='selected'";
                                                    }
                                                    else{
                                                        $class='';
                                                    }
                                                }
                                                else{
                                                    $class = '';
                                                }
                                                ?>
                                                <option <?php echo $class; ?> value="<?php echo $items->id ?>"><?php echo $items->name_languages; ?></option>
                                                <?php
                                                # code...
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <label class="col-md-1 col-sm-1 col-xs-12"><p><?php echo $this->lang->line('Languages level') ?></p></label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <select id="language-level" name="language-level" class="form-control">
                                            <option value=""><?php echo $this->lang->line('Select');?></option>
                                            <?php
                                            foreach ($getLanguageLevel->result() as $items) {
                                                if(isset($params['language-level'])){
                                                    if($items->id==$params['language-level']){
                                                        $class = "selected='selected'";
                                                    }
                                                    else{
                                                        $class='';
                                                    }
                                                }
                                                else{
                                                    $class = '';
                                                }
                                                ?>
                                                <option <?php echo $class; ?> value="<?php echo $items->id ?>"><?php echo $items->name_language_level; ?></option>
                                                <?php
                                                # code...
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <p><?php echo $this->lang->line('Education'); ?> :</p>
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
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
                                                    $class = '';
                                                }
                                                ?>
                                                <option <?php echo $class; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>
                                                <?php
                                                # code...
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <p><?php echo $this->lang->line('Type job'); ?> :</p>
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
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
                                                    $class = '';
                                                }
                                                ?>
                                                <option <?php echo $class; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>
                                                <?php
                                                # code...
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <p><?php echo $this->lang->line('Level'); ?> :</p>
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
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
                                                    $class = '';
                                                }
                                                ?>
                                                <option <?php echo $class; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>
                                                <?php
                                                # code...
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <p><?php echo $this->lang->line('Experience'); ?> :</p>
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
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
                                                    $class = '';
                                                }
                                                ?>
                                                <option <?php echo $class; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>
                                                <?php
                                                # code...
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <p><?php echo $this->lang->line('Salary'); ?> :</p>
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
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
                                                    $class = '';
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
                                </div>
                                <div class="row">
                                    <div class="col-md-2 col-md-offset-3 col-sm-3 col-offset-sm-3 col-xs-12">
                                        <button type="submit" class="btn btn-info"><?php echo $this->lang->line('Search'); ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- end tìm việc nâng cao -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>