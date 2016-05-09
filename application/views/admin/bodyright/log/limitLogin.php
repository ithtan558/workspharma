
	<form action="<?php echo base_url();?>admin/log/removeUnlogined" method="post" id="from-admin">
    <table class="TableGrid datatables" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
    
        <thead>
            <tr>
                <th width="5%">Stt</th>
                <th width="5%">idLimitLogin</th>
                <th width="10%">Số lần đăng nhập</th>
                <th width="10%">Ip</th>
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
        foreach ($listUnlogined as $row)
        { 
        ?>
        <tr class="odd <?php if($stt%2!=0)echo 'tr_two';?>">
            <td  width="5%"><?php echo $stt+1?></td>
            <td  width="10%" ><?php echo $row->idLimitLogin;?></td>
            <td  width="10%" ><?php echo $row->numberlogin;?></td>
            <td  width="10%" ><?php echo $row->ip;?></td>
            
        	<td width="15%">
                <input type="checkbox" name="delete[]" value="<?php echo $row->idLimitLogin;?>" />   
            </td>
            <?php
            $stt++;
      }
      ?>
      </tbody>
</table>
</form>
    <div style="clear:both;"></div>
    