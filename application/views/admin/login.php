<!--Giới hạn số lần đăng nhập -->
<?php
	if($numberlogin > 5)
	{
		redirect(base_url().'admin/limitlogin');
	}
?>
<!--end Giới hạn số lần đăng nhập -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Workspharam - login</title>
    <!--Chèn file CSS-->
    	<link href="<?php echo (CSS_ADMIN."style1.css")?>" type="text/css" rel="stylesheet" />
        <link rel="shortcut icon" href="<?php echo URL;?>puclic/images/favicon.ico" type="image/x-icon" />
		<link rel="icon" href="<?php echo URL;?>public/images/favicon.ico" type="image/x-icon" />
    <!--END Chèn file CSS-->
    <!--Chèn file JS-->
		<script language="javascript" type="text/javascript" src="<?php echo (JS.'jquery/jquery.min.js');?>"></script>
    <!--END Chèn file JS-->
    <style>
	.hidden {
		display: none !important;
		visibility: hidden !important;
	}
	</style>
</head>
<!--Biến URL gởi qua file js-->
	<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<!--end Biến URL gởi qua file js-->
<body>
    <!-- login -->
    <div class="login-register" id="login-register">
        <section id="content-login">
            <form action="" id="form-login">
                <h1>Đăng nhập</h1>
                <?php
                if($this->session->userdata('error_login')){
                	?>
                	<span id="error" style="color:#F00;"><?php echo $this->session->userdata('error_login') ?></span>
                	<?php
                	$this->session->unset_userdata('error_login');
                }
                ?>
                <div>
                    <input type="text"  name="email_user" placeholder="Tên đăng nhập..." required id="username_user" class="username_user" />
                </div>
                <div>
                    <input type="password" placeholder="Mật khẩu..." required id="pass_user" class="pass_user" />
                </div>
                <!-- <div>
                    <input type="text" placeholder="Gõ ký tự bên dưới..." required id="captcha" class="captcha" />
                </div>
                <div>
               		<?php echo $captcha['image'];?><input id="captcha_session" type="hidden" value="<?php echo $captcha['word']?>">
                </div> -->
                <div>
                    <input type="submit" value="Đăng nhập" id="login-admin"  />
                    <a href="<?php echo URL.'ak-administrator/remember'?>">Quên mật khẩu</a>
                </div>
            </form><!-- form -->
        </section><!-- content -->
    </div>
    <!--end login -->
<script type="text/javascript">
	$(document).ready(function(e) {
			/*nhấn nút login*/
			$("#login-admin").click(function(e){
				e.preventDefault();
				var username = $(".username_user").val();
				var pass = $(".pass_user").val();
				var captcha = $(".captcha").val();
				var captcha_session = $("#captcha_session").val();
				//alert(base_url);
				$.post("<?php echo URL;?>ak-administrator/check_admin_login",
				{
					 username:username,
					 pass:pass,
					 captcha:captcha,
					 captcha_session:captcha_session,
				},
				function(msg)
				{
					window.location = "<?php echo URL;?>ak-administrator";
				},'json'); //end function (response)
			});
			/*end nhấn nút login*/
	});
	</script>
</body>
</html>