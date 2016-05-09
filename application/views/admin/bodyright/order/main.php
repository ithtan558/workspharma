
    <form action="<?php echo base_url();?>admin/order/remove_order" method="post">
          <table class="TableGrid datatables" cellpadding="0" cellspacing="0" border="0" class="display dataTable" id="tbl_danhsachorder">
        
            <thead>
                <tr> 
                    <th width="5%">Stt</th>
                    <th width="10%">Id</th>
                    <th width="10%">Mã đơn hàng</th>
                    <th width="10%">Khách hàng</th>
                    <th width="10%">Trạng thái</th>
                    <th width="10%">Tổng tiền</th>
                    <th width="10%">Ngày</th>
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
            $stt=1;
            foreach ($listOrder as $row)
            { 
            ?>
        
            <tr class="odd <?php if($stt%2!=0)echo 'tr_two';?>">
                <td  width="5%"><?php echo $stt?></td>
                <td  width="10%" ><?php echo $row->code_order?></td>
                <td  width="10%"><?php echo $row->postalcode_order?></td>
                <td  width="10%" ><?php echo $row->name_users?></td>
                <td  width="10%" >
                <a title="Duyệt tuyển dụng" href="<?php echo base_url();?>admin/order/enable/<?php echo $row->enable_order?>/<?php echo $row->idOrder?>" <?php if($row->enable_order==1) echo 'class="daduyet"'; else echo 'class="chuaduyet"';?> id="status">
				<?php 
				
					if($row->enable_order==1)
					{
						
						echo 'Hoàn thành';
					}
					else
					echo 'Đang chờ xử lý';
				?></a><br>
                </td>
                <td  width="10%" ><?php echo formatMoney($row->total_order); ?></td>
                <td  width="10%">
                <?php echo date('d-m-Y',strtotime($row->date_update_order))?>
                </td>
                <td width="15%">
                    
                    <a id="View-order" href="<?php echo URL;?>admin/order/detail_order/<?php echo $row->idOrder;?>">[&nbsp;Xem&nbsp;]</a>&nbsp;
                    <a id="sua-order" href="<?php echo URL;?>admin/order/edit_order/<?php echo $row->idOrder;?>">[&nbsp;Sửa&nbsp;]</a>
                    <input type="checkbox" name="delete[]" value="<?php echo $row->idOrder;?>" />   
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
