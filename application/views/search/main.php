<div class="timviec <?php if(isset($template_timviec)) if($template_timviec=='index') echo 'index'; ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#thuong" aria-controls="thuong" role="tab" data-toggle="tab"><?php echo $this->lang->line('find job fast'); ?></a></li>
                        <li role="presentation"><a href="#nang-cao" aria-controls="nang-cao" role="tab" data-toggle="tab"><?php echo $this->lang->line('Find advanced'); ?></a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="thuong">
                            <div class="row">
                                <form id="form-search" class="col-lg-12 col-sm-12 col-md-12 col-xs-12 no-padding home-search-form search_form" action="<?php echo URL.$this->lang->line('l_job'); ?>" method="post">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <input type="text" name="keywords" class="form-control" placeholder="<?php echo $this->lang->line('Keywords')?>" />
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
                                                        echo '<option value="'.$itemChild->id.'">'.$itemChild->category_name.'</option>';
                                                    }
                                                }
                                            }
                                            echo '</optgroup>';
                                        }
                                        ?>
                                    </select>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
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
                                                    ?>
                                                    <option value="<?php echo $item->id ?>"><?php echo $item->city_name; ?></option>
                                                    <?php
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
                        <div role="tabpanel" class="tab-pane" id="nang-cao">
                            <form id="form-search" class="" action="<?php echo URL.$this->lang->line('l_job'); ?>" method="post">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12 text-right">
                                        <?php echo $this->lang->line('Keywords'); ?> :
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <input type="text" name="keywords" class="form-control" placeholder="<?php echo $this->lang->line('Keywords')?>" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12 text-right">
                                        <?php echo $this->lang->line('Choose nghanh'); ?> :
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
                                                            echo '<option value="'.$itemChild->id.'">'.$itemChild->category_name.'</option>';
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
                                    <div class="col-md-3 col-sm-3 col-xs-12 text-right">
                                        <?php echo $this->lang->line('Address'); ?> :
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
                                                    ?>
                                                    <option value="<?php echo $item->id ?>"><?php echo $item->city_name; ?></option>
                                                    <?php
                                                    # code...
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12 text-right">
                                        <?php echo $this->lang->line('Education'); ?> :
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <select id="education" name="education" class="form-control edit-control">
                                            <option value=""><?php echo $this->lang->line('Select');?></option>
                                            <?php
                                            foreach ($getEducation as $key=>$value) {
                                                ?>
                                                <option value="<?php echo $key ?>"><?php echo $value; ?></option>
                                                <?php
                                                # code...
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12 text-right">
                                        <?php echo $this->lang->line('Type job'); ?> :
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <select id="type" name="type" class="form-control edit-control">
                                            <option value=""><?php echo $this->lang->line('Select');?></option>
                                            <?php
                                            foreach ($default_cbPositionType as $key=>$value) {
                                                ?>
                                                <option value="<?php echo $key ?>"><?php echo $value; ?></option>
                                                <?php
                                                # code...
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12 text-right">
                                        <?php echo $this->lang->line('Level'); ?> :
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <select id="level" name="level" class="form-control edit-control">
                                            <option value=""><?php echo $this->lang->line('Select');?></option>
                                            <?php
                                            foreach ($default_currentJobLevel as $key=>$value) {
                                                ?>
                                                <option value="<?php echo $key ?>"><?php echo $value; ?></option>
                                                <?php
                                                # code...
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12 text-right">
                                        <?php echo $this->lang->line('Experience'); ?> :
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <select id="year_exp" name="year_exp" class="form-control edit-control">
                                            <option value=""><?php echo $this->lang->line('Select');?></option>
                                            <?php
                                            foreach ($default_exp as $key=>$value) {
                                                ?>
                                                <option value="<?php echo $key ?>"><?php echo $value; ?></option>
                                                <?php
                                                # code...
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12 text-right">
                                        <?php echo $this->lang->line('Salary'); ?> :
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <select id="salary" name="salary" class="form-control edit-control">
                                            <option value=""><?php echo $this->lang->line('Select');?></option>
                                            <?php
                                            foreach ($default_salary as $key=>$value) {
                                                ?>
                                                <option value="<?php echo $key ?>"><?php echo $value; ?></option>
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