
    <form action="<?php echo base_url();?>admin/email/removeEmail" method="post" id="from-admin">
        <table class="TableGrid datatables" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
        
            <thead>
                <tr>
                    <th width="5%">Stt</th>
                    <th width="10%">Mã Email</th>
                    <th width="10%">Tên Email</th>
                    <th width="10%">Trạng thái</th>
                    <th width="15%">
                        <input type="checkbox" onclick="toggle(this)" />&nbsp;<font color="#000000">Chọn tất cả</font>
                        <button type="submit" class="btn" name="btnDeleteall" onclick="return confirm('Are you sure you want to do that?');">
                            <span>Xóa</span>
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody>
			<?php
            $stt=0;
            foreach ($listEmail as $row)
            { 
            ?>
            <tr class="odd <?php if($stt%2!=0)echo 'tr_two';?>">
                <td  width="5%"><?php echo $stt+1?></td>
                <td  width="10%" ><?php echo $row->idEmail;?></td>
                <td  width="10%" ><?php echo $row->name_email;?></td>
                
                <td  width="10%" >
				<a title="Duyệt tuyển dụng" href="<?php echo base_url();?>admin/email/enable/<?php echo $row->enable_email?>/<?php echo $row->idEmail?>"
				<?php if($row->enable_email==1) echo 'class="daduyet"'; else echo 'class="chuaduyet"';?> 
                id="status">
				<?php 
					if($row->enable_email==1)
					{
						
						echo 'Đã bật';
					}
					else
					echo 'Đã tắt';
				?></a><br>
                </td>
                <td width="15%">
                    
                    <input type="checkbox" name="delete[]" value="<?php echo $row->idEmail;?>" />   
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
    