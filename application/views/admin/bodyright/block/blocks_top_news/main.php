
    <form action="<?php echo base_url();?>admin/blocks_top_news/removeBlocksTopNews" method="post" id="from-tindang">
        <table class="TableGrid datatables" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
        
            <thead>
                <tr>
                    <th width="5%">Stt</th>
                    <th width="10%">Mã tin tức</th>
                    <th width="10%">Tiêu đề tin tức</th>
                    <th width="15%">
                        <input type="checkbox" onclick="toggle(this)" />&nbsp;<font color="#000000">Chọn tất cả</font>
                        <button type="submit" class="btn" name="btnDeleteall" onclick="return confirm('Are you sure you want to do that?');">
                            <span>Xóa</span>
                        </button>
                        <a class="them_new_article" href="<?php echo base_url();?>admin/blocks_top_news/add_blocks_top_news">Thêm tin tức</a>
                        
                    </th>
                </tr>
            </thead>
            <tbody>
			<?php
            $stt=1;
            foreach ($listBlocksTopNews as $row)
            { 
            ?>
            <tr class="odd <?php if($stt%2!=0)echo 'tr_two';?>">
                <td  width="5%"><?php echo $stt?></td>
                <td  width="10%" ><?php echo $row->idArticles;?></td>
                <td  width="10%" ><?php echo $row->title_articles;?></td>
                <td width="15%"><input type="checkbox" name="delete[]" value="<?php echo $row->idArticles;?>" />
                </td>
             </tr>
                <?php
			}
          ?>
          </tbody>
    </table>
    </form>
    <div style="clear:both;"></div>
    