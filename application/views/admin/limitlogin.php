<?php
if(!$listLimitLogin)
{
	redirect(base_url().'administrator');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- General meta information -->
	<title>Limit số lần đăng nhập</title>
	<!-- // General meta information -->
	<!-- Load stylesheets -->
	<link type="text/css" rel="stylesheet" href="css/style1.css" media="screen" />
    <style>
		ul li{
			padding:10px;
			margin-left:40px;
		}
	</style>
	<!-- // Load stylesheets -->
</head>
<body>
	<div id="wrapper">
		<div style="color:#030; font-size:14px">
        	
        	<ul>
            	<p style="color:#F00;font-size:16px">Chào bạn, Tài khoản của bạn đã bị khóa, vì những lí do sau đây:</p>
                <li>
                 Bạn đã đăng nhập sai quá số lần quy định
                </li>
                <li>
                 Bạn đã cố tình dò tài khoản admin để hack
                </li>
                
                <li>
                <?php
					$date=strtotime($listLimitLogin[0]->time_last);
					$time_conlai=10-date('i:s',(time()-$date));
					if($time_conlai<0)
					{
						echo redirect(base_url().'admin');
					}
						echo 'Lượt đăng nhập lần tiếp theo sẽ vào <font color="#FF0000">'.$time_conlai.' phút sau</font>';
				?>
                </li>
            </ul>
        </div>
	</div>
</body>
</html>