
<div class="box">
    <div class="heading">
      <h1 style="float:left">Thêm danh mục bài viết</h1>
      <div class="buttons"><a class="button" id="cancel" onclick="javascript:submitbutton('cancel');">Thoát</a></div>
      <div class="buttons"><a class="button" id="save" onclick="javascript:submitbutton('save');">Lưu</a></div>
      <div class="buttons"><a class="button" id="save_close" onclick="javascript:submitbutton('save_close');">Lưu và đóng</a></div>
    </div>
    <div class="content">
      <div class="vtabs">
          <a href="#tab-order" class="selected">Thông tin chủ đề</a>
          <a href="#tab-payment" class="selected">English</a>
      </div>
      <div id="tab-order" class="vtabs-content">
          <form id="adminForm" action="<?php echo URL;?>admin/articles_categories/check_add_articles_categories" method="post" enctype="multipart/form-data">
          <input type="hidden" name="url" value="<?php echo $this->uri->segment(2);?>" id="url">
              <table class="table_admin">  
                  <tbody>
                        <tr>
                            <td colspan="2"><span style="color:#0C9;"><?php if(isset($messages)) echo $messages;?></span></td>
                        </tr>
                        <tr class="alt-row">
                        	<td>Tên chủ đề:</td>
                        	<td><input name="name_articles_categories" type="text" autofocus="autofocus"   /></td></tr>
                        <tr class="alt-row">
                            <td>Parent :</td>
                            <td><select name="parentid">
                            <option value="0">--Chọn--</option>
                            <?php
                            echo $listArticlesCategoriesCombobox;
                            ?>
                            </select></td>
                        </tr>
                        <tr>
                            <td>Mô tả:</td>
                            <td><textarea class="form-control" name="description_articles_categories" cols="40" rows="5" id="description_articles_categories" title="Không được bỏ trống" ></textarea>
                            </td>
                        </tr>
                        <tr class="alt-row">
                            <td>Thứ tự</td> 
                            <td><input name="ordering_articles_categories" type="text"   /></td>
                        </tr>
                        <tr>
                        	<td>Bật</td>
                            <td><input name="enable_articles_categories" type="radio" value="1" checked="checked" class="inputbox" >&nbsp;Có &nbsp;&nbsp;<input name="enable_articles_categories" type="radio" value="0" class="inputbox" >&nbsp;Không</td>
                        </tr>
                        <tr class="alt-row">
                            <td>Meta Title</td> 
                            <td><input name="meta_title_articles_categories" type="text"  /></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Meta Keywords</td> 
                            <td><input name="meta_key_articles_categories" type="text"  /></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Meta Description</td> 
                            <td><input name="meta_desc_articles_categories" type="text"  /></td>
                        </tr>
                  </tbody>
               </table>
        </div>
        <div id="tab-payment" class="vtabs-content" style="display: none;">
            <table class="table_admin">
                <tbody>
                    <tr class="alt-row">
                        <td>Name category:</td>
                        <td><input name="name_en_articles_categories" type="text"   /></td></tr><tr>
                        <td>Description:</td>
                        <td><textarea class="form-control" name="description_en_articles_categories" cols="40" rows="5" id="description_en_articles_categories" title="Không được bỏ trống" ></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <input type="hidden" name="t" value="save" id="t">
      </form>
      </div>
    </div>
</div>