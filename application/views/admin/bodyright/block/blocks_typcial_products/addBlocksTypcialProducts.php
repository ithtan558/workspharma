
    <form action="<?php echo base_url();?>admin/blocks_typcial_products/check_add_blocks_typcial_products" method="post" id="from-tindang">
        <table class="TableGrid datatables" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
        
            <thead>
                <tr>
                    <th width="5%">Stt</th>
                    <th width="10%">Mã dịch vụ</th>
                    <th width="10%">Tên loại dịch vụ</th>
                    <th width="10%">Tên dịch vụ</th>
                    <th width="15%">
                        <input type="checkbox" onclick="toggle_add(this)" />&nbsp;<font color="#000000">Chọn tất cả</font>
                        <button type="submit" class="btn" name="btnAddall">
                            <span>Thêm vào</span>
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody>
			<?php
            $stt=1;
			if(count($listProductsNotTypcial)>0)
			{
				foreach ($listProductsNotTypcial as $row)
				{ 
				?>
				<tr class="odd <?php if($stt%2!=0)echo 'tr_two';?>">
					<td  width="5%"><?php echo $stt?></td>
					<td  width="10%" ><?php echo $row->code_products;?></td>
					<td  width="10%" ><?php echo $row->name_products_categories;?></td>
					<td  width="10%" ><?php echo $row->name_products;?></td>
					<td width="15%"><input type="checkbox" name="add[]" value="<?php echo $row->idProducts;?>" />
					</td>
				 </tr>
					<?php
				}
			}
          ?>
          </tbody>
    </table>
    </form>
    <div style="clear:both;"></div>
    