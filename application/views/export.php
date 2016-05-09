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
</head>
<body>
<div id="container">
	<!--Nội dung body-->
	<div class="content" id="content">
    	<div class="wrapper do-fade-in full-opacity">
    		<?php $this->load->view($template);?>
        </div>
    </div>
    <!--END Nội dung body-->
</div>
</body>
</html>