
    <form action="<?php echo base_url();?>admin/contact/removeContact" method="post" id="from-admin">
        <table class="TableGrid datatables" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
        
            <thead>
                <tr>
                    <th width="5%">Stt</th>
                   
                   
                    <th width="10%">Tên liên hệ</th>
                    <th width="10%">Địa chỉ liên hệ</th>
                    <th width="10%">Email liên hệ</th>
                    <th width="10%">Điện thoại liên hệ</th>
                     
                    
                    <th width="10%">Thứ tự</th>
                    <th width="10%">Trạng thái</th>
                    <th width="15%">
                        <input type="checkbox" onclick="toggle(this)" />&nbsp;<font color="#000000">Chọn tất cả</font>&nbsp;
                        <button type="submit" class="btn" name="btnDeleteall" onclick="return confirm('Are you sure you want to do that?');">
                            <span>Xóa</span>
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody>
			<?php
            $stt=0;
			
			$total_row=count($listContact);
            foreach ($listContact as $row)
            {
            ?>
        
            <tr class="odd <?php if($stt%2!=0)echo 'tr_two';?>">
                <td  width="5%"><?php echo $stt+1?></td>
                <td  width="10%" ><?php echo $row->name_contact?></td>
                <td  width="10%" ><?php echo $row->address_contact?></td>
                <td  width="10%" ><?php echo $row->email_contact?></td>
                <td  width="10%" ><?php echo $row->telephone_contact?></td>
                
                
                <td  width="10%" >
							<?php
							if(!$this->uri->segment(5))
							{
								if($stt==$total_row-1)
								{
									?>
									<img  src="<?php echo IMAGES_ADMIN?>movedown1.png" />
									<?php
								}
								else
								{
									?>
									<a href="<?php echo URL?>admin/contact/check_ordering_previous/<?php echo $row->idContact;?>/<?php echo $row->ordering_contact;?>"><img src="<?php echo IMAGES_ADMIN?>movedown.png" /></a>
									<?php
								}
								if($stt==0)
								{
									?>
									<img style="margin-left:-5px;" src="<?php echo IMAGES_ADMIN?>moveup1.png" />
									<?php
								}
								else
								{
									?>
									<a href="<?php echo URL?>admin/contact/check_ordering_next/<?php echo $row->idContact;?>/<?php echo $row->ordering_contact;?>"><img style="margin-left:-5px;" src="<?php echo IMAGES_ADMIN?>moveup.png" /></a>
									<?php
								}
							?>
							<input name="ordering_contact[]" class="save_ordering" type="text" value="<?php echo $row->ordering_contact;?>" />
							<!--data list idContact_categories -->
							<input name="idContact[]" type="hidden" value="<?php echo $row->idContact;?>" />
							<input type="button" data="<?php echo $row->idContact;?>" class="btn" value="Lưu" onclick="javascript:submitOrdering(<?php echo $row->idContact;?>,<?php echo $stt;?>,'contact/check_ordering');" />
							<?php
							}
							?>
						</td>
                <td  width="10%" >
				<a title="Duyệt tuyển dụng" href="<?php echo base_url();?>admin/contact/enable/<?php echo $row->enable_contact?>/<?php echo $row->idContact?>"
				<?php if($row->enable_contact==1) echo 'class="daduyet"'; else echo 'class="chuaduyet"';?> 
                id="status">
				<?php 
					if($row->enable_contact==1)
					{
						
						echo 'Bật';
					}
					else
					echo 'Tắt';
				?></a><br>
                </td>
                <td width="15%">
                    
                    
                    <a id="edit-hoadon" href="<?php echo URL;?>admin/contact/edit_contact/<?php echo $row->idContact;?>">[&nbsp;Sửa&nbsp;]</a>
                    <input type="checkbox" name="delete[]" value="<?php echo $row->idContact;?>" />   
                </td>
            </tr>
          <?php 
          $stt++;
          }
          ?>
          </tbody>
    </table>
    
    <!--data id -->
    <input type="hidden" name="t" value="" id="t">
    <!--data stt -->
    <input type="hidden" name="stt" value="" id="stt">
    </form>
    <div style="clear:both;"></div>
