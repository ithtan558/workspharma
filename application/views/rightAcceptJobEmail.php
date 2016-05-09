<form id="form-accept-email" class="col-lg-12 col-sm-12 col-md-12 col-xs-12 no-padding" action="<?php echo URL.$this->lang->line('l_accept_email'); ?>" method="post">
    <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
        <script type="text/javascript">
            $(document).ready(function() {
                $('#category1').multiselect({
                    nonSelectedText: "<?php echo $this->lang->line('Choose nghanh'); ?>"
                });
            });
        </script>
        <select class="form-control"  id="category1" name="category1[]" multiple="multiple">
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
    <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
        <script type="text/javascript">
            $(document).ready(function() {
                $('#city1').multiselect({
                    nonSelectedText: "<?php echo $this->lang->line('Address'); ?>"
                });
            });
        </script>
        <select class="form-control"  id="city1" name="city1[]" multiple="multiple">
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
    <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
        <select id="level" name="level" class="form-control edit-control">
            <option value=""><?php echo $this->lang->line('Level'); ?></option>
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
    <div class="col-md-12 col-sm-12 col-xs-12 no-padding padding-top">
        <input type="text" name="email" id="email" class="form-control" placeholder="Email..." aria-describedby="basic-addon2">
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 no-padding padding-top text-right">
        <span class="input-group-btn">
            <button class="btn btn-info btn-block" type="submit"><?php echo $this->lang->line('Send'); ?></button>
        </span>
    </div>
</form>