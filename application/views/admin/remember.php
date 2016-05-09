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
	<title><?php echo $title;?></title>
    <!--Chèn file CSS--> 
    	<link href="<?php echo (CSS_ADMIN."style1.css")?>" type="text/css" rel="stylesheet" />
        <link rel="shortcut icon" href="<?php echo URL;?>/puclic/images/favicon.ico" type="image/x-icon" />
		<link rel="icon" href="<?php echo URL;?>/public/images/favicon.ico" type="image/x-icon" />
    <!--END Chèn file CSS--> 
    <!--Chèn file JS--> 
		<script language="javascript" type="text/javascript" src="<?php echo (JS.'/jquery/jquery.min.js');?>"></script>
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
    <div class="login-register" id="remember">
        <section id="content-login">
            <form action="" id="form-login">
                <h1>Quên mật khẩu</h1>
                <span id="error" style="color:#F00; opacity:0;">Tên đăng nhập hoặc mã code sai!</span>
                <div>
                    <input type="text"  name="email_user" placeholder="Email..." required id="username_user" class="email_users" />
                </div>
                <div>
                    <input type="text" placeholder="Gõ ký tự bên dưới..." required id="captcha" class="captcha" />
                </div>
                <div>
               		<?php echo $captcha['image'];?><input id="captcha_session" type="hidden" value="<?php echo $captcha['word']?>">
                </div>
                <div>
                    <input type="submit" value="Xác nhận" id="remember-admin"  />
                    <a href="<?php echo URL.'ak-administrator'?>" id="a_login">Đăng nhập</a>
                </div>
            </form><!-- form -->
        </section><!-- content -->
    </div>
    <!--end login -->
<script type="text/javascript">
	$(document).ready(function(e) {
		$(".username_user").focus();
			/*nhấn nút remember*/
			$("#remember-admin").click(function(e){
				e.preventDefault();
				var email_users = $(".email_users").val();
				var captcha = $(".captcha").val();
				var captcha_session = $("#captcha_session").val();
				//alert(base_url);
				$.post("<?php echo URL;?>ak-administrator/check_admin_remember",
				{
					 email_users:email_users,
					 captcha:captcha,
					 captcha_session:captcha_session
					 
				},
				function(json) 
				{ 
					 if(json.active==1)
					 {
						alert("Mật khẩu mới đã được gửi qua Email, hãy kiểm tra hộp thư đến và hộp thư rác của bạn!");
						window.location = "<?php echo URL;?>ak-administrator";
					 }
					 else
					 {
						if(json.msg=='captcha')
						{
							alert("Mã code sai, đề nghị kiểm tra lại!");
						}
						if(json.msg=='username')
						{
							alert("Email sai, đề nghị kiểm tra lại!");
						}
						window.location.reload();
					 }
				},'json'); //end function (response)		
			});  
			/*end nhấn nút remember*/  
	});
	</script>
</body>
</html>