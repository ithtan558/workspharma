
    <form action="<?php echo base_url();?>admin/articles_categories/remove_articles_categories" method="post" id="from-tindang">
        <table class="TableGrid datatables" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
        
            <thead>
                <tr>
                    <th width="5%">Stt</th>
                    <th width="10%">Mã chủ đề</th>
                    <th width="10%">Tên chủ đề</th>
                    <th width="10%">Trạng thái</th>
                    <th width="15%">
                        <input type="checkbox" onclick="toggle(this)" />&nbsp;<font color="#000000">Chọn tất cả</font>&nbsp;
                        <button type="submit" class="btn" name="btnDeleteall" onclick="return confirm('Are you sure you want to do that?');">
                            <span>Xóa</span>
                        </button>
                        
                    </th>
                </tr>
            </thead>
            <tbody>
			<?php
            $stt=1;
            foreach ($listArticlesCategories as $row)
            { 
            ?>
        
            <tr class="odd <?php if($stt%2!=0)echo 'tr_two';?>">
                <td  width="5%"><?php echo $stt?></td>
                <td  width="10%" ><?php echo $row->idArticlesCategories?></td>
                <td  width="10%" ><a href="<?php echo URL.'admin/articles_categories/index/'.$row->idArticlesCategories;?>"><?php echo $row->name_articles_categories;?></a></td>
                <td  width="10%" >
				<a title="Duyệt tuyển dụng" href="<?php echo base_url();?>admin/articles_categories/enable/<?php echo $row->enable_articles_categories?>/<?php echo $row->idArticlesCategories?>"
				<?php if($row->enable_articles_categories==1) echo 'class="daduyet"'; else echo 'class="chuaduyet"';?> 
                id="status">
				<?php 
					if($row->enable_articles_categories==1)
					{
						
						echo 'Bật';
					}
					else
					echo 'Tắt';
				?></a><br>
                </td>
                <td width="15%">
                    
                    
                    <a id="edit-hoadon" href="<?php echo URL;?>admin/articles_categories/edit_articles_categories/<?php echo $row->idArticlesCategories;?>">[&nbsp;Sửa&nbsp;]</a>
                    <input type="checkbox" name="delete[]" value="<?php echo $row->idArticlesCategories;?>" />   
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

<!--	<h1>Danh sách chủ đề</h1>
    <form action="<?php echo base_url();?>admin/articles_categories/remove_articles_categories" method="post" id="from-tindang">
        <table class="TableGrid datatables" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
        
            <thead>
                <tr>
                    <th width="5%">Stt</th>
                    <th width="10%">Mã chủ đề</th>
                    <th width="10%">Tên chủ đề</th>
                    <th width="50%">Số lượng bài viết</th>
                    <th width="10%">Trạng thái</th>
                    <th width="15%">
                        <input type="checkbox" onclick="toggle(this)" />&nbsp;<font color="#000000">Chọn tất cả</font>
                        <button type="submit" class="btn" name="btnDeleteall" onclick="return confirm('Are you sure you want to do that?');">
                            <span>Xóa</span>
                        </button>
                        <a class="them_articles_categories" href="<?php echo base_url();?>admin/articles_categories/add_articles_categories">Thêm chủ đề</a>
                    </th>
                </tr>
            </thead>
            <tbody>
			<?php
            $stt=1;
            foreach ($listArticlesCategories as $row)
            { 
            ?>
        
            <tr class="odd <?php if($stt%2!=0)echo 'tr_two';?>">
                <td  width="5%"><?php echo $stt?></td>
                <td  width="10%" ><?php echo $row->idArticlesCategories?></td>
                <td  width="10%" ><?php echo $row->name_articles_categories;?></td>
                <td  width="10%" ><?php echo count($row->idArticlesCategorie);?>&nbsp;&nbsp;<a href="<?php echo URL;?>admin/article/index/<?php echo $row->idArticlesCategories;?>"><img src="<?php echo IMAGES;?>go_items.png" /></a></td>
                <td  width="10%" >
				<a title="Duyệt tuyển dụng" href="<?php echo base_url();?>admin/articles_categories/enable/<?php echo $row->enable_articles_categories?>/<?php echo $row->idArticlesCategories?>"
				<?php if($row->enable_articles_categories==1) echo 'class="daenable"'; else echo 'class="chuaenable"';?> 
                id="status">
				<?php 
					if($row->enable_articles_categories==1)
					{
						
						echo 'Bật';
					}
					else
					echo 'Tắt';
				?></a><br>
                </td>
                <td width="15%">
                    
                    
                    <a id="edit-hoadon" href="<?php echo URL;?>admin/articles_categories/edit_articles_categories/<?php echo $row->idArticlesCategories;?>">[&nbsp;Sửa&nbsp;]</a>
                    <input type="checkbox" name="delete[]" value="<?php echo $row->idArticlesCategories;?>" />   
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
    -->