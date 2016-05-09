    <form action="<?php echo base_url();?>admin/article/removeArticle" method="post" id="from-admin">
        <table class="TableGrid datatables" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
            <thead>
                <tr>
                    <th width="5%">Stt</th>
                    <th width="10%">Mã bài viết </th>
                    <th width="10%">Loại</th>
                    <th width="10%">Tên bài viết </th>
                    <th width="20%">Thứ tự bài viết</th>
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
            $stt=0;
			$total_row=count($listArticle);
            foreach ($listArticle as $row)
            {	
            ?>
            <tr class="odd <?php if($stt%2!=0)echo 'tr_two';?>">
                <td  width="5%"><?php echo $stt+1?></td>
                <td  width="10%" ><?php echo $row->idArticles?></td>
                <td  width="10%" ><?php echo $row->name_articles_categories?></td>
                <td  width="10%" ><?php echo $row->title_articles?></td>
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
						<a href="<?php echo URL?>admin/article/check_ordering_previous/<?php echo $row->idArticles;?>/<?php echo $row->ordering_articles;?>"><img src="<?php echo IMAGES_ADMIN?>movedown.png" /></a>
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
						<a href="<?php echo URL?>admin/article/check_ordering_next/<?php echo $row->idArticles;?>/<?php echo $row->ordering_articles;?>"><img style="margin-left:-5px;" src="<?php echo IMAGES_ADMIN?>moveup.png" /></a>
                        <?php
					}
					?>
                    <input name="ordering_articles[]" class="save_ordering" type="text" value="<?php echo $row->ordering_articles;?>" />
                    <!--data list idarticles_categories -->
                    <input name="idArticles[]" type="hidden" value="<?php echo $row->idArticles;?>" />
                    <input type="button" data="<?php echo $row->idArticles;?>" class="btn" value="Lưu" onclick="javascript:submitOrderingSub(<?php echo $row->idArticles;?>,<?php echo $stt;?>,<?php echo $row->catid;?>,'article/check_ordering');" />
                </td>
                <td  width="10%" >
				<a title="Duyệt tuyển dụng" href="<?php echo base_url();?>admin/article/enable/<?php echo $row->enable_articles?>/<?php echo $row->idArticles?>"
				<?php if($row->enable_articles==1) echo 'class="daduyet"'; else echo 'class="chuaduyet"';?> 
                id="status">
				<?php 
					if($row->enable_articles==1)
					{
						
						echo 'Bật';
					}
					else
					echo 'Tắt';
				?></a><br>
                </td>
                <td width="15%">
                    
                    
                    <a id="edit-hoadon" href="<?php echo URL;?>admin/article/edit_article/<?php echo $row->idArticles;?>">[&nbsp;Sửa&nbsp;]</a>
                    <input type="checkbox" name="delete[]" value="<?php echo $row->idArticles;?>" />   
                </td>
            </tr>
          <?php 
          $stt++;
          }
          ?>
          </tbody>
    </table>
    <!--data id -->
    <input type="hidden" name="catid" value="" id="catid">
    <input type="hidden" id="enable_articles" value="<?php if(isset($_SESSION['__enable_articles__']))echo $_SESSION['__enable_articles__']; else {echo -1;}?>" name="enable_articles">
    <textarea id="idArticlesCategories" hidden><?php echo $listArticlesCategoriesCombobox;?></textarea>
    <!--data idsub -->
    <input type="hidden" name="t" value="" id="t">
    <!--data stt -->
    <input type="hidden" name="stt" value="" id="stt">
    </form>
    <div style="clear:both;"></div>
   <!-- <script type="text/javascript">
	$(document).ready(function(e) {
        $("#them_hoadon").click(function(e){
			window.open("","_self");
		})
    });
	</script>-->
    
    <script type="text/javascript">
		$(document).ready(function(e) {
			var enable_articles=$("#enable_articles").val();
			var idArticlesCategories=$("#idArticlesCategories").val();
			//alert(idArticlesCategories);
			if(enable_articles==-1)
			{
				var trangthai='selected';
			}
			if(enable_articles==1)
			{
				var bat='selected';
			}
			if(enable_articles==0)
			{
				var tat='selected';
			}
			$("#tbl_danhsachhoadon_length").append('<div class="dataTables_length"><label>Trạng thái<select id="enable_articles" size="1" name="enable_articles" aria-controls="tbl_danhsachhoadon" ><option  value="-1"'+trangthai+'>Trạng thái</option><option '+bat+'  value="1">Bật</option><option '+tat+'  value="0">Tắt</option></select></label></div><div class="dataTables_length"><label>Nhóm<select id="idArticlesCategories" size="1" name="idArticlesCategories" aria-controls="tbl_danhsachhoadon" ><option value="0">--Chọn--</option>'+idArticlesCategories+'</select></label></div>');
			//$("#tbl_danhsachhoadon_length").css("display","none");
			//Khi chọn trạng thái bật hay tắt
			$("#enable_articles").change(function (evt) {
				evt.preventDefault();
				var enable_articles=$(this).val();
				$.post('<?php echo URL;?>admin/article/change_enable',
				{
					enable_articles:enable_articles
				},
				function (msg)
				{
					window.location.reload();
				});
			})
			//Khi chọn nhóm dịch vụ
			$("#idArticlesCategories").change(function (evt) {
				evt.preventDefault();
				var idArticlesCategories=$(this).val();
				$.post('<?php echo URL;?>admin/article/change_enable',
				{
					idArticlesCategories:idArticlesCategories
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
    
