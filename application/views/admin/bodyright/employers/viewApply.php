<?php
if(isset($users) and $users->num_rows()>0){
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
            <th><input type="checkbox" /></th>
            <th>Id</th>
            <th>Email</th>
            <th>Title job</th>
            <th>Experience</th>
            <th>Salary</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if(isset($users) and $users->num_rows()>0)
        {
            foreach($users->result() as $userDetail)
            {
                //$rank = getRank($userDetail->experience);
        ?>
        <form name="manageuserdetail" id="manageuserdetail" action="" method="post" >
          <tr>
            <td><input type="checkbox" class="clsNoborder" name="userlist[]" id="userlist[]" value="<?php echo $userDetail->id; ?>"  /> </td>
            <td><?php echo $userDetail->id;?></td>
            <td>
                <?php echo $userDetail->email;?>
            </td>
            <td>
                <?php echo $userDetail->title;?>
                
            </td>
            <!--<td><?php /*echo ($rank != '')?$rank->title:'';*/?></td>-->
            <td align="" class="uniformjs">
                <?php echo $userDetail->yearOfExperience.' years';?>
            </td>
            <td align="" class="uniformjs">
                <?php
                    if($userDetail->expected_salary == 1){
                        echo $this->lang->line('Negotiable');
                    }else {
                        echo get_salary($userDetail->expected_salary, '');
                    }
                ?>
            </td>
            <td class="functions">
                <a target="_blank" href="<?php echo URL.'nha-tuyen-dung/xem-ho-so/?idResume='.$this->encrypt->encode($userDetail->resume_id) ; ?>" class="btn-action glyphicons right_arrow tooltips" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="" data-original-title="View resume">View resume</a>
            </td>
          </tr>
          <?php }
          }
          else{ ?>
           <tr>
            <td colspan="7"><?php echo $this->lang->line('No users found');?></td></tr>
          <?php }
          ?>
        </form>
    </tbody>
</table>
</form>
<div style="clear:both;"></div>
