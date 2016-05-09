<form action="<?php echo base_url();?>admin/category/deleteCategory" method="post" id="from-tindang">
    <table class="TableGrid datatables" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
        <thead>
            <tr>
                <th width="70">
                    <input type="checkbox" onclick="toggle(this)" />
                    <button type="submit" class="btn" name="btnDeleteall" onclick="return confirm('Are you sure you want to do that?');">
                        <span>Xóa</span>
                    </button>
                </th>
                <th>Id</th>
                <th>Category Name</th>
                <th>Date created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(isset($categories_parent) and $categories_parent->num_rows()>0)
                {
                    foreach($categories_parent->result() as $category_parent)
                    {
                    ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="delete[]" value="<?php echo $category_parent->id;?>" />
                            </td>
                            <td>
                                <?php echo $category_parent->id;?>
                            </td>
                            <td>
                                <?php echo $category_parent->category_name;?>
                            </td>
                            <td>
                                <?php echo date('d-m-Y',$category_parent->created);?>
                            </td>
                            <td class="functions">
                                <a title="view detail and all resume" href="<?php echo URL.'admin/category/editCategory/'.$category_parent->id; ?>" class="btn-action glyphicons right_arrow" />Edit</a>
                            </td>
                        </tr>
                        <?php
                        if(isset($categories_child) and $categories_child->num_rows()>0)
                        {
                            foreach($categories_child->result() as $category_child)
                            {
                                if($category_child->parent_id == $category_parent->id){
                                    ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="delete[]" value="<?php echo $category_child->id;?>" />
                                            </td>
                                            <td>
                                                --- <?php echo $category_child->id;?>
                                            </td>
                                            <td>
                                                --- <?php echo $category_child->category_name;?>
                                            </td>
                                            <td>
                                                --- <?php echo date('d-m-Y',$category_child->created);?>
                                            </td>
                                            <td class="functions">
                                                -- <a href="<?php echo URL.'admin/category/editCategory/'.$category_child->id; ?>" class="btn-action glyphicons pencil btn-success" />Edit</a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }
                        }
                    }
                }
                else{
                    ?>
                        <tr>
                            <td colspan="5">
                                <?php echo $this->lang->line('No users found');?>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
        </tbody>
    </table>
</form>
<div style="clear:both;"></div>
