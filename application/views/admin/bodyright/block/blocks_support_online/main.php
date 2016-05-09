
    <form action="<?php echo base_url();?>admin/blocks_support_online/removeBlocksSupportOnline" method="post" id="from-admin">
        <table class="TableGrid datatables" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
        
            <thead>
                <tr>
                    <th width="5%">Stt</th>
                    <th width="10%">Tên</th>
                    <th width="10%">Điện thoại</th>
                    <th width="10%">Yahoo</th>
                    <th width="10%">Skype</th>
                    <th width="20%">Thứ tự</th>
                    <th width="10%">Trạng thái</th>
                    <th width="15%">
                        <input type="checkbox" onclick="toggle(this)" />&nbsp;<font color="#000000">Chọn tất cả</font>
                        <button type="submit" class="btn" name="btnDeleteall" onclick="return confirm('Are you sure you want to do that?');">
                            <span>Xóa</span>
                        </button>
                        <a class="them_support_online" href="<?php echo base_url();?>admin/blocks_support_online/add_blocks_support_online">Thêm hỗ trợ trực tuyến</a>
                        
                    </th>
                </tr>
            </thead>
            <tbody>
			<?php
            $stt=0;
			$total_row=count($listBlocksSupportOnline);
            foreach ($listBlocksSupportOnline as $row)
            { 
            ?>
            <tr class="odd <?php if($stt%2!=0)echo 'tr_two';?>">
                <td  width="5%"><?php echo $stt+1?></td>
                <td  width="10%" ><?php echo $row->name_support_online;?></td>
                <td  width="10%" ><?php echo $row->phone_support_online;?></td>
                <td  width="10%" ><?php echo $row->yahoo_support_online;?></td>
                <td  width="10%" ><?php echo $row->skype_support_online;?></td>
                <td  width="20%" >
                	<?php
					if($stt==$total_row-1)
					{
						?>
                        <img  src="<?php echo IMAGES_ADMIN?>movedown1.png" />
                        <?php
					}
					else
					{
						?>
						<a href="<?php echo URL?>admin/blocks_support_online/check_ordering_previous/<?php echo $row->idSupportOnline;?>/<?php echo $row->ordering_support_online;?>"><img src="<?php echo IMAGES_ADMIN?>movedown.png" /></a>
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
						<a href="<?php echo URL?>admin/blocks_support_online/check_ordering_next/<?php echo $row->idSupportOnline;?>/<?php echo $row->ordering_support_online;?>"><img style="margin-left:-5px;" src="<?php echo IMAGES_ADMIN?>moveup.png" /></a>
                        <?php
					}
					?>
                    <input name="ordering_support_online[]" class="save_ordering" type="text" value="<?php echo $row->ordering_support_online;?>" />
                    <!--data list idsupport_online -->
                    <input name="idSupportOnline[]" type="hidden" value="<?php echo $row->idSupportOnline;?>" />
                    <input type="button" data="<?php echo $row->idSupportOnline;?>" class="btn" value="Lưu" onclick="javascript:submitOrdering(<?php echo $row->idSupportOnline;?>,<?php echo $stt;?>,'blocks_support_online/check_ordering');" />
                </td>
                <td  width="10%" >
				<a title="Duyệt tuyển dụng" href="<?php echo base_url();?>admin/blocks_support_online/enable/<?php echo $row->enable_support_online?>/<?php echo $row->idSupportOnline?>"
				<?php if($row->enable_support_online==1) echo 'class="daduyet"'; else echo 'class="chuaduyet"';?> 
                id="status">
				<?php 
					if($row->enable_support_online)
					{
						
						echo 'Bật';
					}
					else
					echo 'Tắt';
				?></a><br>
                </td>
                <td width="15%">
                    <a id="edit-hoadon" href="<?php echo URL;?>admin/blocks_support_online/edit_blocks_support_online/<?php echo $row->idSupportOnline;?>">[&nbsp;Sửa&nbsp;]</a>  <input type="checkbox" name="delete[]" value="<?php echo $row->idSupportOnline;?>" />
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
    