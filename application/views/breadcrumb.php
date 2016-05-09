<div id="crumbs">
    <span typeof="v:Breadcrumb">
        <a href="<?php echo URL;?>" class="crumbs-home"><?php echo 'Trang chủ';?></a>&nbsp;
    </span>
    <?php
        if(isset($home)){
            if($home!=1)
            {
                ?>
                <span class="current">
                <?php 
                    if(isset($name_parent)){
                        if($alias_parent!='thong-tin')
                        {
                            ?> / 
                            <a href="
                                <?php echo URL.$alias_parent;?>">
                                <?php echo $name_parent;?>
                            </a>
                            <?php
                        }
                    }
                    if(isset($name_parent_sub)){
                        if($alias_parent!='kien-thuc')
                        {
                            ?> / 
                            <a href="<?php echo URL.'san-pham/'.$alias_parent_sub.'-'.$getProducts->catid;?>"><?php echo $name_parent_sub;?></a>
                            <?php
                        }
                        else
                        {
                            ?> / 
                            <a href="<?php echo URL.'kien-thuc/'.$alias_parent_sub;?>"><?php echo $name_parent_sub;?></a>
                            <?php
                        }
                    }
                ?>
                </span>
                <?php
                if(isset($name)){
                ?>
                    / 
                    <span class="current"><?php echo $name;?></span>
                <?php
                }
            }
        }
        ?>
</div>