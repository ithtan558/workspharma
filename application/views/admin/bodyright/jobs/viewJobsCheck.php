<?php
if(isset($jobs) and $jobs->num_rows()>0){
    $class = 'datatables';
}
else{
    $class = '';
}
?>
<form action="<?php echo base_url();?>admin/jobs/updateJobsCheck" method="post" id="from-tindang">
<table class="TableGrid <?php echo $class; ?>" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
    <thead>
        <tr>
            <th width="70">
                <input type="checkbox" onclick="toggle(this)" /><br>
                <button type="submit" class="btn" name="btnDeleteall" onclick="return confirm('Are you sure you want to do that?');">
                    <span>Duyệt</span>
                </button>
            </th>
            <th>Id</th>
            <th>Job Name/View</th>
            <th>Company</th>
            <th>Address</th>
            <th>Date created</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(isset($jobs) and $jobs->num_rows()>0)
            {
                foreach($jobs->result() as $jobs)
                {
                $link = URL.$this->lang->line('l_detail').'/'.$jobs->alias.'-'.$jobs->id;

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
