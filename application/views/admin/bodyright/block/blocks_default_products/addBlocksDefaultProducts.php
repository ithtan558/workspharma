
    <form action="<?php echo base_url();?>admin/blocks_default_products/check_add_blocks_default_products" method="post" id="from-tindang">
        <table class="TableGrid datatables" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
        
            <thead>
                <tr>
                    <th width="5%">Stt</th>
                    <th width="10%">Mã dịch vụ</th>
                    <th width="30%">Tên dịch vụ</th>
                    <th width="10%">Hình dịch vụ</th>
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
            
			if(count($listProductsNotDefault)>0)
			{
				$stt=1;
				foreach ($listProductsNotDefault as $row)
				{ 
				?>
				<tr class="odd <?php if($stt%2!=0)echo 'tr_two';?>">
					<td  width="5%"><?php echo $stt?></td>
					<td  width="10%" ><?php echo $row->code_products;?></td>
					<td  width="30%" ><?php echo $row->name_products;?></td>
                    <td>
                        <?php 
                        if($row->thumb_products!="")
                        {
                        ?>
                            <img width="100" height="100" src="<?php echo IMAGES;?>products/<?php echo $row->thumb_products;?>" />
                            <?php
                        }
                        ?></td>
					<td width="15%"><input type="checkbox" name="add1[]" value="<?php echo $row->idProducts;?>" />
					</td>
				 </tr>
					<?php
					$stt++;
				}
			}
          ?>
          </tbody>
    </table>
    <input type="hidden" id="enable_products" value="<?php if(isset($_SESSION['__enable_products__']))echo $_SESSION['__enable_products__']; else echo '-1'?>" name="__enable_products__">
    <textarea id="idProductsCategories" hidden><?php echo $listProductsCategoriesCombobox;?></textarea>
    </form>
    <div style="clear:both;"></div>
    <script type="text/javascript">
		$(document).ready(function(e) {
			var enable_products=$("#enable_products").val();
			var idProductsCategories=$("#idProductsCategories").val();
			//alert(idProductsCategories);
			if(enable_products==-1)
			{
				var trangthai='selected';
			}
			if(enable_products==1)
			{
				var bat='selected';
			}
			if(enable_products==0)
			{
				var tat='selected';
			}
			$("#tbl_danhsachhoadon_length").append('<div class="dataTables_length"><label>Trạng thái<select id="enable_products" size="1" name="enable_products" aria-controls="tbl_danhsachhoadon" ><option  value="-1"'+trangthai+'>Trạng thái</option><option '+bat+'  value="1">Bật</option><option '+tat+'  value="0">Tắt</option></select></label></div><div class="dataTables_length"><label>Nhóm<select id="idProductsCategories" size="1" name="idProductsCategories" aria-controls="tbl_danhsachhoadon" ><option value="0">--Chọn--</option>'+idProductsCategories+'</select></label></div>');
			//$("#tbl_danhsachhoadon_length").css("display","none");
			//Khi chọn trạng thái bật hay tắt
			$("#enable_products").change(function (evt) {
				evt.preventDefault();
				var enable_products=$(this).val();
				$.post('<?php echo URL;?>admin/blocks_default_products/change_enable',
				{
					enable_products:enable_products
				},
				function (msg)
				{
					window.location.reload();
				});
			})
			//Khi chọn nhóm dịch vụ
			$("#idProductsCategories").change(function (evt) {
				evt.preventDefault();
				var idProductsCategories=$(this).val();
				$.post('<?php echo URL;?>admin/blocks_default_products/change_enable',
				{
					idProductsCategories:idProductsCategories
				},
				function (msg)
				{
					window.location.reload();
				});
			})
			$(".btnSearch").click(function (evt) {
				evt.preventDefault();
				var keyword=$(".keyword").val();
				$.post('<?php echo URL;?>admin/row/change_enable',
				{
					keyword:keyword
				},
				function (msg)
				{
					window.location.reload();
				});
			})
		})
	</script>
    