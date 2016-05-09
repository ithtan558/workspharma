
    <form action="<?php echo base_url();?>admin/language/removeLanguages" method="post">
        <table class="TableGrid datatables" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
        
            <thead>
                <tr>
                    <th width="5%">Stt</th>
                    <th width="10%">Mã ngôn ngữ</th>
                    <th width="10%">Tên ngôn ngữ</th>
                    <th width="10%">Mặc định</th>
                    <th width="10%">Trạng thái</th>
                    <th width="15%">
                        <input type="checkbox" onclick="toggle(this)" />&nbsp;<font color="#000000">Chọn tất cả</font>
                        <button type="submit" class="btn" name="btnDeleteall" onclick="return confirm('Are you sure you want to do that?');">
                            <span>Xóa</span>
                        </button><br />
                        <!-- <a class="them_languages" href="<?php echo base_url();?>admin/language/add_languages">Thêm ngôn ngữ </a> -->
                    </th>
                </tr>
            </thead>
            <tbody>
			<?php
            $stt=1;
            foreach ($listLanguages as $row)
            {
            ?>
        
            <tr class="odd <?php if($stt%2!=0)echo 'tr_two';?>">
                <td  width="5%"><?php echo $stt?></td>
                <td  width="10%" ><?php echo $row->code_languages?></td>
                <td  width="10%" ><?php echo $row->name_languages?></td>
                <td  width="10%" ><a title="Duyệt tuyển dụng" href="<?php echo base_url();?>admin/language/defaults/<?php echo $row->default_languages?>/<?php echo $row->idLanguages?>"
				<?php if($row->default_languages==1) echo 'class="daduyet"'; else echo 'class="chuaduyet"';?> 
                id="status">
				<?php 
					if($row->default_languages==1)
					{
						
						echo 'Mặc định';
					}
					else
					echo 'Không mặc định';
				?></a><br></td>
                <td  width="10%" >
				<a title="Duyệt tuyển dụng" href="<?php echo base_url();?>admin/language/enable/<?php echo $row->enable_languages?>/<?php echo $row->idLanguages?>"
				<?php if($row->enable_languages==1) echo 'class="daduyet"'; else echo 'class="chuaduyet"';?> 
                id="status">
				<?php 
					if($row->enable_languages==1)
					{
						
						echo 'Bật';
					}
					else
					echo 'Tắt';
				?></a><br>
                </td>
                <td width="15%">
                    
                    
                    <a id="edit-hoadon" href="<?php echo URL;?>admin/language/edit_languages/<?php echo $row->idLanguages;?>">[&nbsp;Sửa&nbsp;]</a>
                    <input type="checkbox" name="delete[]" value="<?php echo $row->idLanguages;?>" />   
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
