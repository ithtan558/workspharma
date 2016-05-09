
    <form action="<?php echo base_url();?>admin/blocks_slideshow/removeBlocksSlideshow" method="post" id="from-admin">
        <table class="TableGrid datatables" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
        
            <thead>
                <tr>
                    <th width="5%">Stt</th>
                    <th width="10%">Text</th>
                    <th width="10%">Hình ảnh</th>
                    <th width="20%">Thứ tự</th>
                    <th width="10%">Trạng thái</th>
                    <th width="15%">
                        <input type="checkbox" onclick="toggle(this)" />&nbsp;<font color="#000000">Chọn tất cả</font>
                        <button type="submit" class="btn" name="btnDeleteall" onclick="return confirm('Are you sure you want to do that?');">
                            <span>Xóa</span>
                        </button>
                        <a class="them_slideshow" href="<?php echo base_url();?>admin/blocks_slideshow/add_blocks_slideshow">Thêm hình ảnh</a>
                        
                    </th>
                </tr>
            </thead>
            <tbody>
			<?php
            $stt=0;
			$total_row=count($listBlocksSlideshow);
            foreach ($listBlocksSlideshow as $row)
            { 
            ?>
            <tr class="odd <?php if($stt%2!=0)echo 'tr_two';?>">
                <td  width="5%"><?php echo $stt+1?></td>
                <td  width="10%" ><?php echo $row->text_slide_show;?></td>
                <td  width="10%" >
				<?php 
				if($row->image_slide_show!="")
				{
					?>
                    <img src="<?php echo IMAGES.'slideshow/'.$row->image_slide_show;?>" width="100" height="100" />
                    <?php
				}
				?>
                </td>
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
						<a href="<?php echo URL?>admin/blocks_slideshow/check_ordering_previous/<?php echo $row->idSlideshow;?>/<?php echo $row->ordering_slide_show;?>"><img src="<?php echo IMAGES_ADMIN?>movedown.png" /></a>
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
						<a href="<?php echo URL?>admin/blocks_slideshow/check_ordering_next/<?php echo $row->idSlideshow;?>/<?php echo $row->ordering_slide_show;?>"><img style="margin-left:-5px;" src="<?php echo IMAGES_ADMIN?>moveup.png" /></a>
                        <?php
					}
					?>
                    <input name="ordering_slide_show[]" class="save_ordering" type="text" value="<?php echo $row->ordering_slide_show;?>" />
                    <!--data list idslide_show -->
                    <input name="idSlideshow[]" type="hidden" value="<?php echo $row->idSlideshow;?>" />
                    <input type="button" data="<?php echo $row->idSlideshow;?>" class="btn" value="Lưu" onclick="javascript:submitOrdering(<?php echo $row->idSlideshow;?>,<?php echo $stt;?>,'blocks_slideshow/check_ordering');" />
                </td>
                <td  width="10%" >
				<a title="Duyệt tuyển dụng" href="<?php echo base_url();?>admin/blocks_slideshow/enable/<?php echo $row->enable_slide_show?>/<?php echo $row->idSlideshow?>"
				<?php if($row->enable_slide_show==1) echo 'class="daduyet"'; else echo 'class="chuaduyet"';?> 
                id="status">
				<?php 
					if($row->enable_slide_show)
					{
						
						echo 'Bật';
					}
					else
					echo 'Tắt';
				?></a><br>
                </td>
                <td width="15%">
                    <a id="edit-hoadon" href="<?php echo URL;?>admin/blocks_slideshow/edit_blocks_slideshow/<?php echo $row->idSlideshow;?>">[&nbsp;Sửa&nbsp;]</a>  <input type="checkbox" name="delete[]" value="<?php echo $row->idSlideshow;?>" />
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
    