
    <form action="<?php echo base_url();?>admin/blocks_new_articles/check_add_blocks_new_articles" method="post" id="from-tindang">
<input type="hidden" name="url" value="<?php echo $this->uri->segment(2);?>" id="url">
        <table class="TableGrid datatables" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
        
            <thead>
                <tr>
                    <th width="5%">Stt</th>
                    <th width="10%">Mã tin tức</th>
                    <th width="10%">Tiêu đề tin tức</th>
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
            foreach ($listBlocksNotNew as $row)
            { 
            ?>
            <tr class="odd <?php if($stt%2!=0)echo 'tr_two';?>">
                <td  width="5%"><?php echo $stt?></td>
                <td  width="10%" ><?php echo $row->idArticles;?></td>
                <td  width="10%" ><?php echo $row->title_articles;?></td>
                <td width="15%"><input type="checkbox" name="add[]" value="<?php echo $row->idArticles;?>" />
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
    