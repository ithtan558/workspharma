<form action="<?php echo base_url();?>admin/block/removeBlocks" method="post" id="from-tindang">
    <table class="TableGrid datatables" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
        <thead>
	   				<tr>
					 	<th width="70">
					 		<input type="checkbox" onclick="toggle(this)" />
					 		<button type="submit" class="btn" name="btnResote" onclick="return confirm('Are you sure you want to do that?');">
	                            <span>Restore</span>
	                        </button>
	                    </th>
					 	<th>Id</th>
					 	<th>Email</th>
						<th>Date created</th>
					</tr>
				</thead>
		        <tbody>
					<?php 
					if(isset($userDetails) and $userDetails->num_rows()>0)
					{

						foreach($userDetails->result() as $userDetail)
						{
							//$rank = getRank($userDetail->experience);
					?>
			          <tr>
					    <td><input type="checkbox" name="delete[]" value="<?php echo $userDetail->id;?>" /></td>
			            <td><?php echo $userDetail->id;?></td>
						<td>
							<b>Email:</b> <?php echo $userDetail->email;?>
						</td>
						  <td>
							  <?php echo date('d-m-Y',$userDetail->created);?>
						  </td>
			          </tr>
					  <?php }
					  }
					  else{ ?>
					   <tr>
			            <td colspan="5"><?php echo $this->lang->line('No users found');?></td></tr>
					  <?php }
					  ?>
				  	</form>
		        </tbody>
    </table>
</form>
<div style="clear:both;"></div>
