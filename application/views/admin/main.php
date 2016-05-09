<!DOCTYPE html>
<html lang="en"><head>
	<meta charset="utf-8">
	<title>Workspharam - Administration</title>
    <!--Chèn file CSS--> 
		<link href="<?php echo (CSS_ADMIN."style.css")?>" type="text/css" rel="stylesheet" />
        <link href="<?php echo (CSS_ADMIN."tuyendung_page.css")?>" type="text/css" rel="stylesheet" />
    	<link href="<?php echo (CSS_ADMIN."jquery-ui-1.10.3.custom.css")?>" type="text/css" rel="stylesheet" />
		<link href="<?php echo (CSS_ADMIN."colors-fresh.min.css")?>" type="text/css" rel="stylesheet" />
        <link href="<?php echo (CSS_ADMIN."load-styles.css")?>" type="text/css" rel="stylesheet" />
        <link href="<?php echo (CSS_ADMIN."demo_table_jui.css")?>" type="text/css" rel="stylesheet" />
        <link href="<?php echo (CSS_ADMIN."style.min.css")?>" type="text/css" rel="stylesheet" />
        <link href="<?php echo (CSS_ADMIN."dataTables/jquery.dataTables.min.css")?>" type="text/css" rel="stylesheet" />
        <link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo IMAGES;?>favicon.ico" />
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGES;?>favicon.ico" />
    <!--END Chèn file CSS--> 
    <!--Chèn file JS--> 
	<script language="javascript" type="text/javascript" src="<?php echo JS_ADMIN;?>jquery/jquery-1.11.3.min.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo JS?>jquery/jquery.validate.min.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo JS_ADMIN;?>dataTables/jquery.dataTables.min.js"></script>
     <script language="javascript" type="text/javascript" src="<?php echo JS;?>jquery/jquery-ui-1.10.3.custom.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo JS_ADMIN;?>index.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo JS_ADMIN;?>jquery.bpopup-0.9.3.min.js"></script>
	</script>
    <!--END Chèn file JS--> 
</head>
<!--Biến URL gởi qua file js-->
	<input type="hidden" id="base_url" value="<?php echo URL;?>">
<!--end Biến URL gởi qua file js-->
<body>
<div id="backgroundPopup"></div>
    <!--Nội dung wrapper-->
    <div id="wpwrap">
    	<!--Nội dung menu left-->
            <div id="adminmenuwrap">
                <?php $this->load->view('admin/menuleft/main');?>
            </div>
        <!--END Nội dung menu left-->
        <!--Nội dung body right-->
           <div id="wpcontent">
                <!--Tiêu đề-->
                    <div id="wpadminbar" class="nojq nojs" role="navigation">
                    	<div class="logo"></div>
                    	<div class="title">Hệ thống dành cho Administration</div>
                        <div class="quicklinks account" id="wp-toolbar" role="navigation" aria-label="Top navigation toolbar." tabindex="0">
                            <!-- <select name="">
                                <option value="">option</option>
                                <option value="">option</option><option value="">option</option><option value="">option</option>
                            </select> -->
                        	<ul>
                            	<li><a href="<?php echo URL;?>" target="_blank">Xem trước</a></li>
                            	<li><a href="" target="_blank">Tài khoản</a></li>
                            	<li class="item-content-last"><a href="<?php echo URL;?>admin/thoat">Thoát</a></li>
                            </ul>
                        </div>
                    </div>
                <!--end tiêu đề-->
                <!--Nội dung right-->
                <div id="wpbody"> 
                    <div id="wpbody-content">
                       <?php $this->load->view($template);?>
                    </div>
                </div><!-- wpbody -->
            </div><!-- wpcontent -->
            <div class="clear"></div>
        <!--END Nội dung body right-->
    </div>
    <!--END Nội dung wrapper-->
    <!-- footer-->
    <div id="footer" class="footer">
        <div>Copyright © 2014, ATHM. All rights reserved. Developed by <a href="mailto:ithtan558@gmail.com">An Huynh</a></div></div>
    </div>
    <!-- end footer-->
</body>
</html>