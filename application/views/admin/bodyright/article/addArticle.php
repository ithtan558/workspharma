<div class="box">
    <div class="heading">
      <h1 style="float:left">Thêm bài viết</h1>
      <div class="buttons"><a class="button" id="cancel" onclick="javascript:submitbutton('cancel');">Thoát</a></div>
      <div class="buttons"><a class="button" id="save" onclick="javascript:submitbutton('save');">Lưu</a></div>
      <div class="buttons"><a class="button" id="save_close" onclick="javascript:submitbutton('save_close');">Lưu và đóng</a></div>
    </div>
    <div class="content1">
      <div class="vtabs">
          <a href="#tab-order" class="selected">Thông tin bài viết</a>
          <a href="#tab-payment">English</a>
          <a href="#tab-related" class="selected">Bài viết liên quan</a>
      </div>
      <div id="tab-order" class="vtabs-content">
      	<form method="post" action="<?php echo URL;?>admin/article/check_add_article" enctype="multipart/form-data" class="origin_setting" name="adminForm" id="adminForm" method="post" accept-charset="utf-8" novalidate="novalidate">
        	<input type="hidden" name="url" value="<?php echo $this->uri->segment(2);?>" id="url">
                <table class="table_admin">
                    <tbody>
                        <tr>
                            <td><span style="color:#0C9;"><?php if(isset($messages)) echo $messages;?></span></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Tên bài viết:</td> 
                            <td><input name="title_articles" type="text" autofocus    /></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Loại bài viết:</td>
                            <td><select name="catid">
                            <?php
                            /*foreach($listArticleCategories as $articlesCategories)
                            {
                                ?>
                                <option value="<?php echo $articlesCategories->idArticlesCategories;?>"><?php echo $articlesCategories->name_articles_categories;?></option>
                                <?php
                            }*/
							echo $listArticlesCategoriesCombobox;
                            ?>
                            </select></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Hình ảnh nhỏ:</td>
                            <td><input name="thumb_articles" type="file"   /></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Mô tả ngắn (*) </span></div></td><td>
                                    <textarea class="form-control" name="introtext_articles" cols="80" rows="10" id="introtext_articles" title="Không được bỏ trống" ></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Nội dung (*) </span></div></td><td>
                                    <textarea class="form-control" name="fulltext_articles" cols="2" rows="3" id="fulltext_articles" title="Không được bỏ trống" ></textarea>
                                    <!--<div class="a_hover"><a id="insert_images">Chèn ảnh</a></div>-->
                            </td>
                        </tr>
                        <tr>
                        	<td>Bật</td>
                            <td><input name="enable_articles" type="radio" value="1" class="inputbox" checked="checked">&nbsp;Có &nbsp;&nbsp;<input name="enable_articles" type="radio" value="0" class="inputbox">&nbsp;Không</td>
                        </tr>
                        
                        <tr class="alt-row">
                            <td>Meta Title:</td> 
                            <td><input name="meta_title_articles" type="text"    /></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Meta Keywords:</td> 
                            <td><input name="meta_key_articles" type="text"     /></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Meta Description:</td> 
                            <td><input name="meta_desc_articles" type="text"     /></td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="t" value="save" id="t">   
      </div>
      <div id="tab-payment" class="vtabs-content" style="display: none;">
            <table>
                <tbody>
                    <tr>
                        <td><span style="color:#0C9;"><?php if(isset($messages)) echo $messages;?></span></td>
                    </tr>
                    <tr class="alt-row">
                        <td>Tên bài viết:</td> 
                        <td><input name="title_en_articles" type="text" autofocus    /></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Mô tả ngắn (*) </span></div></td><td>
                                <textarea class="form-control" name="introtext_en_articles" cols="80" rows="10" id="introtext_en_articles" title="Không được bỏ trống" ></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Nội dung (*) </span></div></td><td>
                                <textarea class="form-control" name="fulltext_en_articles" cols="2" rows="3" id="fulltext_en_articles" title="Không được bỏ trống" ></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="hidden" name="t" value="save" id="t">
      </div>
      <div id="tab-related" class="vtabs-content">
      	<div>
        	<table class="table_admin">
                <tr>
                    <td>
                        <a href="" id="insert_related_articles">
                            <img src="<?php echo IMAGES?>icon-add.png" border="0" align="absmiddle">&nbsp;Thêm bài viết liên quan mới</a>
                    </td>
                </tr>
                <tr><td height="10px;"></td></tr>
                <tr>
                    <td>
                    <select name="related_pro[]" id="related_pro" multiple="multiple" size="10" class="inputbox" style="width:350px;">
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>
                    <p class="related_pro_bt">
                        <a href="javascript:void(0);" title="Di chuyển lên trên cùng" onclick="combo_MoveToTop('related_pro');">
                            <img src="<?php echo IMAGES?>bt_top16.png" border="0">
                        </a>
                        <a href="javascript:void(0);" onclick="combo_MoveUp('related_pro');" title="Di chuyển lên">
                            <img src="<?php echo IMAGES?>bt_up16.png" border="0">
                        </a>
                        <a href="javascript:void(0);" onclick="combo_MoveDown('related_pro');" title="Di chuyển xuống">
                            <img src="<?php echo IMAGES?>bt_down16.png" border="0">
                        </a>
                        <a href="javascript:void(0);" onclick="combo_MoveToBottom('related_pro');" title="Di chuyển xuống dưới cùng">
                            <img src="<?php echo IMAGES?>bt_bottom16.png" border="0">
                        </a>
                        <a href="javascript:void(0);" onclick="combo_MoveElements2('related_pro');" title="Xóa">
                            <img src="<?php echo IMAGES?>bt_remove16.png" border="0">
                        </a>
                        <br class="break">
                    </p>
                    </td>
                </tr>
         </table>
         </form>
      </div>
    </div>
</div>


<script language="javascript" type="text/javascript" src="<?php echo PUBLIC_ADMIN;?>editor/ckeditor.js"></script>
<script>
		CKEDITOR.replace( 'fulltext_articles',
		{
			<?php 
			echo $ckFinder;
			?>
		});
		CKEDITOR.replace( 'fulltext_en_articles',
		{
			<?php 
			echo $ckFinder;
			?>
		});
		$(document).ready(function(e) {
			$('.vtabs a').tabs();
		});
</script>
<script type="text/javascript">

$(document).ready(function(e) {
    /*dang ky*/
		$("#adminForm").validate({ 
			rules: {
				title_articles:{
					required: true
				},
				introtext_articles:{
					required: true
				},
				fulltext_articles:{
					required: true
				},
			},
			messages: {
				title_articles:{
					required: "Bắt buộc nhập",
				},
				introtext_articles:{
					required: "Bắt buộc nhập"
				},
				fulltext_articles:{
					required: "Bắt buộc nhập"
				}
			}
		});
	/*end đăng ký*/
});
</script>
