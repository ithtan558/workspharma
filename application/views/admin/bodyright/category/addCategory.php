<div class="box">
    <div class="heading">
      <h1 style="float:left">Thêm danh mục</h1>
      <div class="buttons"><a class="button" id="cancel" onclick="javascript:submitbutton('cancel');">Thoát</a></div>
      <div class="buttons"><a class="button" id="save" onclick="javascript:submitbutton('save');">Lưu</a></div>
      <div class="buttons"><a class="button" id="save_close" onclick="javascript:submitbutton('save_close');">Lưu và đóng</a></div>
    </div>
    <div class="content1">
      <div class="vtabs">
          <a href="#tab-order" class="selected">Thông tin danh mục</a>
          <a href="#tab-payment">English</a>
      </div>
      <div id="tab-order" class="vtabs-content">
      	<form method="post" action="" enctype="multipart/form-data" class="origin_setting" name="adminForm" id="adminForm" method="post" accept-charset="utf-8" novalidate="novalidate">
        	<input type="hidden" name="addCategory" value="<?php echo $this->uri->segment(2).'/viewCategorys';?>" id="url">
                <table class="table_admin">
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <span class="span-success">
                                    <?php
                                    if($msg = $this->session->flashdata('flash_message')) {
                                        echo $msg;
                                    }
                                    ?>
                                </span>
                            </td>
                        </tr>
                        <tr class="alt-row">
                            <td>Tên danh mục:</td> 
                            <td><input name="category_name" type="text" autofocus    /></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Parent:</td>
                            <td>
                                <select name="parent_id">
                                <option value="">-- Select --</option>
                                <?php
                                foreach ($categories_parent->result() as $item) {
                                    ?>
                                    <option value="<?php echo $item->id; ?>"><?php echo $item->category_name; ?></option>
                                    <?php
                                }
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr class="alt-row">
                            <td>Meta Title:</td> 
                            <td><input name="page_title" type="text"    /></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Meta Keywords:</td> 
                            <td><input name="meta_keywords" type="text"     /></td>
                        </tr>
                        <tr class="alt-row">
                            <td>Meta Description:</td> 
                            <td><input name="meta_description" type="text"     /></td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="t" value="save" id="t">   
      </div>
      <div id="tab-payment" class="vtabs-content" style="display: none;">
            <table>
                <tbody>
                    <tr class="alt-row">
                        <td>Tên danh mục:</td> 
                        <td><input name="category_en_name" type="text" autofocus    /></td>
                    </tr>
                </tbody>
            </table>
        </form>
            <input type="hidden" name="t" value="save" id="t">
      </div>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function(e) {
    /*dang ky*/
		$("#adminForm").validate({ 
			rules: {
				category_name:{
					required: true
				},
                category_en_name:{
                    required: true
                }
			},
			messages: {
				category_name:{
					required: "Bắt buộc nhập",
				},
				category_en_name:{
					required: "Bắt buộc nhập"
				}
			}
		});
	/*end đăng ký*/
});
</script>
