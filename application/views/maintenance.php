<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title;?></title>
    <meta http-equiv="Content-Language" content="vi">
    <meta name="author" content="fredton">
    <meta name="contact" content="lienhe@fredton">
    <meta name="copyright" content="Copyright 2013 fredton">
    <meta name="description" content="<?php echo $description;?>">
    <meta name="keywords" content="<?php echo $keywords;?>">
    <meta property="og:image" content="<?php echo URL;?>public/images/icon.png">
    <meta property="og:title" content="<?php echo $title;?>">
    <meta property="og:site_name" content="<?php echo $title;?>">
    <meta property="og:description" content="<?php echo $description;?>">
    <link rel="image_src" href="<?php echo URL;?>public/images/icon.png">
    <link rel="shortcut icon" href="<?php echo URL;?>/public/images/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="<?php echo URL;?>/public/images/favicon.ico" type="image/x-icon" />
    <?php $this->load->view("script");?>
    <!--Biến URL gởi qua file js-->
        <input type="hidden" id="base_url" value="<?php echo URL;?>">
    <!--end Biến URL gởi qua file js-->
</head>
<body>
<center><object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="590" height="300">
  <param name="movie" value="<?php echo URL?>Scripts/underconstruction.swf" />
  <param name="quality" value="high" />
  <param name="wmode" value="opaque" />
  <param name="swfversion" value="8.0.35.0" />
  <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
  <param name="expressinstall" value="<?php echo URL?>Scripts/expressInstall.swf" />
  <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
  <!--[if !IE]>-->
  <object type="application/x-shockwave-flash" data="<?php echo URL?>Scripts/underconstruction.swf" width="590" height="300">
    <!--<![endif]-->
    <param name="quality" value="high" />
    <param name="wmode" value="opaque" />
    <param name="swfversion" value="8.0.35.0" />
    <param name="expressinstall" value="<?php echo URL?>Scripts/expressInstall.swf" />
    <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
    <div>
      <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
      <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
    </div>
    <!--[if !IE]>-->
  </object>
  <!--<![endif]-->
</object></center>
<script type="text/javascript">
swfobject.registerObject("FlashID");
</script>
<center>
	<h3><font color="red"><?php echo $error;?></font></h3>
</center>
</body>
</html>