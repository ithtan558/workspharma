<?php
if(isset($jobs) and $jobs->num_rows()>0){
    $class = 'datatables';
}
else{
    $class = '';
}
?>
<form action="<?php echo base_url();?>admin/jobs/deleteJobs" method="post" id="from-tindang">
<table class="TableGrid <?php echo $class; ?>" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
    <thead>
        <tr>
            <th width="70">
                <input type="checkbox" onclick="toggle(this)" />
                <button type="submit" class="btn" name="btnDeleteallPosted" onclick="return confirm('Are you sure you want to do that?');">
                    <span>Xóa</span>
                </button>
            </th>
            <th>Id</th>
            <th>Job Name/View</th>
            <th>Company</th>
            <th>Address</th>
            <th>Date created</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(isset($jobs) and $jobs->num_rows()>0)
            {
                foreach($jobs->result() as $jobs)
                {
                $link = URL.'chi-tiet/'.$jobs->alias.'-'.$jobs->id;

                ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="delete[]" value="<?php echo $jobs->id;?>" />
                        </td>
                        <td>
                            <?php echo $jobs->id;?>
                        </td>
                        <td>
                            <b><?php echo $jobs->title;?></b><br>
                          <span class="project-status-1">View : <?php echo $jobs->views; ?></span>
                        </td>
                        <td>
                            <?php echo $jobs->company;?>
                        </td>
                        <td>
                            <?php echo get_city($jobs->city_ids);?>
                        </td>
                        <td>
                            <?php echo date('d-m-Y',strtotime($jobs->date_created));?><br><?php echo date('d-m-Y',strtotime($jobs->date_expiration));?>
                        </td>
                        
                        <td class="functions">
                            <a title="view detail and all resume" target="_blank" href="<?php echo $link; ?>" class="btn-action glyphicons right_arrow" />View</a> | 
                            <a title="view detail and all resume" href="<?php echo URL.'admin/jobs/applies/job_id/'.$jobs->id?>" class="btn-action glyphicons right_arrow" />View apply</a>
                        </td>
                    </tr>
                    <?php
                }
            }
            else{
                ?>
                    <tr>
                        <td colspan="8">
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
