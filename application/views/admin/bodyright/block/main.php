
    <form action="<?php echo base_url();?>admin/block/removeBlocks" method="post" id="from-tindang">
        <table class="TableGrid datatables" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
        
            <thead>
                <tr>
                    <th width="5%">Stt</th>
                    <th width="10%">Tên</th>
                    <th width="10%">Title</th>
                    <th width="10%">Số record hiển thị</th>
                    <th width="10%">Trạng thái</th>
                    <th width="15%">
                        <input type="checkbox" onclick="toggle(this)" />&nbsp;<font color="#000000">Chọn tất cả</font>
                        <!-- <button type="submit" class="btn" name="btnDeleteall" onclick="return confirm('Are you sure you want to do that?');">
                            <span>Xóa</span>
                        </button> -->
                        <a class="them_blocks" href="<?php echo base_url();?>admin/block/add_blocks">Thêm block</a>
                        
                    </th>
                </tr>
            </thead>
            <tbody>
			<?php
            $stt=1;
            foreach ($listBlocks as $row)
            { 
            ?>
            <tr class="odd <?php if($stt%2!=0)echo 'tr_two';?>">
                <td  width="5%"><?php echo $stt?></td>
                <td  width="10%" ><?php echo $row->name_blocks;?></td>
                <td  width="10%" ><?php echo $row->title_blocks;?></td>
                <td  width="10%" ><?php echo $row->limit_show;?></td>
                <td  width="10%" >
				<a title="Duyệt tuyển dụng" href="<?php echo base_url();?>admin/block/enable/<?php echo $row->enable_blocks?>/<?php echo $row->idBlocks?>"
				<?php if($row->enable_blocks==1) echo 'class="daduyet"'; else echo 'class="chuaduyet"';?> 
                id="status">
				<?php 
					if($row->enable_blocks==1)
					{
						
						echo 'Bật';
					}
					else
					echo 'Tắt';
				?></a><br>
                </td>
                <td width="15%">
                    <a id="edit-hoadon" href="<?php echo URL;?>admin/block/edit_blocks/<?php echo $row->idBlocks;?>">[&nbsp;Sửa&nbsp;]</a>  <!-- <input type="checkbox" name="delete[]" value="<?php echo $row->idBlocks;?>" /> -->
                </td>
             </tr>
                <?php
				$stt++;
			}
          ?>
          </tbody>
    </table>
    </form>
    <div style="clear:both;"></div>
    