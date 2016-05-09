<?php
$this->load->view("admin/bodyright/article/insert_articles");
?>
<div class="box">
    <div class="heading">
      <h1 style="float:left">Sữa user</h1>
      <div class="buttons"><a class="button" id="cancel" onclick="javascript:submitbutton('cancel');">Thoát</a></div>
      <div class="buttons"><a class="button" id="save" onclick="javascript:submitbutton('save');">Lưu</a></div>
      <div class="buttons"><a class="button" id="save_close" onclick="javascript:submitbutton('save_close');">Lưu và đóng</a></div>
    </div>
    <div class="contnet">
      <div class="vtabs">
          <a href="#tab-order" class="selected">Thông tin user</a>
          <a href="#tab-password">Thay đổi mật khẩu</a>
      </div>
      <div id="tab-order" class="vtabs-content">
      	<form method="post" action="" enctype="multipart/form-data" class="origin_setting" name="adminForm" id="adminForm" method="post" accept-charset="utf-8" novalidate="novalidate">
        	<input type="hidden" name="editUser" value="editUser" id="url">
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
                        <td><b>Email</b></td>
                        <td><?php echo $userDetails->email?></td>
                    </tr>
                    <tr class="alt-row">
                        <td><b>Tên Công Ty</b></td>
                        <td><?php echo $userDetails->company?></td>
                    </tr>
                    <tr class="alt-row">
                        <td><b>Lĩnh vực hoạt động</b></td>
                        <td><?php echo $userDetails->linhvuchoatdong?></td>
                    </tr>
                    <tr class="alt-row">
                        <td><b>Các chi nhánh (nếu có)</b></td>
                        <td><?php echo $userDetails->chinhanh?></td>
                    </tr>
                    <tr class="alt-row">
                        <td><b>Tổng số nhân viên</b></td>
                        <td><?php echo $userDetails->num_of_staff?></td>
                    </tr>
                    <tr class="alt-row">
                        <td><b>Website Công Ty</b></td>
                        <td><?php echo $userDetails->website?></td>
                    </tr>
                    <tr class="alt-row">
                        <td><b>Giới thiệu sơ lược Công ty</b></td>
                        <td><?php echo $userDetails->description?></td>
                    </tr>
                    <tr class="alt-row">
                        <td><b>Họ và tên</b></td>
                        <td><?php echo $userDetails->name?></td>
                    </tr>
                    <tr class="alt-row">
                        <td><b>Chức vụ</b></td>
                        <td><?php echo $userDetails->chucvu?></td>
                    </tr>
                    <tr class="alt-row">
                        <td><b>Email liên hệ</b></td>
                        <td><?php echo $userDetails->email_contact?></td>
                    </tr>
                    <tr class="alt-row">
                        <td><b>Điện thoại Cty</b></td>
                        <td><?php echo $userDetails->phone_contact?></td>
                    </tr>
                    <tr class="alt-row">
                        <td><b>Điện thoại di động</b></td>
                        <td><?php echo $userDetails->mobile_contact?></td>
                    </tr>
                    <tr class="alt-row">
                        <td><b>Tỉnh/ Thành</b></td>
                        <td><?php echo get_city($userDetails->city)?></td>
                    </tr>
                </tbody>
            </table>
    	</div>
    	<div id="tab-password" class="vtabs-content" style="display: none;">
    		<table class="table_admin">
                <tbody>
                    <tr class="alt-row">
                        <td>Password</td>
                        <td>
                        	<input name="password" type="password" class="textbox span10" id="password" value="<?php echo $this->input->post('password');?>"  >&nbsp;
							<input name="passwordold" type="hidden" class="textbox span10" value="<?php echo $userDetails->password;?>" >
							<input name="userid" type="hidden" class="textbox span10" value="<?php echo $userDetails->id;?>" >
                        </td>
                    </tr>
                </tbody>
            </table>
         	<input type="hidden" name="t" value="save" id="t">
         </form>
    	</div>
    </div>
</div>
<style type="text/css" media="screen">
	.table_admin tr td{
		padding:5px;
	}
</style>