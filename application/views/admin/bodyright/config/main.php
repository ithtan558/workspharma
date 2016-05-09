
    <form action="<?php echo base_url();?>admin/config/remove_config" method="post">
        <table class="TableGrid datatables" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
        
            <thead>
                <tr>
                    <th width="5%">Stt</th>
                    <th width="10%">name</th>
                    <th width="10%">value</th>
                    <th>Thao tác
                        <input type="checkbox" onclick="toggle(this)" />&nbsp;<font color="#000000">Chọn tất cả</font>
                        <button type="submit" class="btn" name="btnDeleteall" onclick="return confirm('Are you sure you want to do that?');">
                            <span>Xóa</span>
                        </button>
                        
                    </th>
                </tr>
            </thead>
            <tbody>
			<?php
            $stt=1;
            foreach ($listConfig as $row)
            { 
            ?>
        
            <tr class="odd <?php if($stt%2!=0)echo 'tr_two';?>">
                <td  width="5%"><?php echo $stt?></td>
                <td  width="10%"><?php echo $row->name?></td>
                <td  width="10%"><?php echo $row->value?></td>
                <td width="15%">
                    
                    
                    <a id="sua-hoadon" href="<?php echo URL;?>admin/config/sua_config/<?php echo $row->idConfig;?>">[&nbsp;Sửa&nbsp;]</a>
                    <input type="checkbox" name="delete[]" value="<?php echo $row->idConfig;?>" />   
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