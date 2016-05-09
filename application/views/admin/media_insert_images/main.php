<link href="<?php echo (CSS_ADMIN."style.css")?>" type="text/css" rel="stylesheet" />


        


        <link href="<?php echo (CSS_ADMIN."tuyendung_page.css")?>" type="text/css" rel="stylesheet" />


        


    	<link href="<?php echo (CSS_ADMIN."jquery-ui-1.10.3.custom.css")?>" type="text/css" rel="stylesheet" />


        


        


		<link href="<?php echo (CSS_ADMIN."colors-fresh.min.css")?>" type="text/css" rel="stylesheet" />


        <link href="<?php echo (CSS_ADMIN."load-styles.css")?>" type="text/css" rel="stylesheet" />


        


        <link href="<?php echo (CSS_ADMIN."demo_table_jui.css")?>" type="text/css" rel="stylesheet" />


        <link href="<?php echo (CSS."jquery.fancybox-1.3.4.css")?>" type="text/css" rel="stylesheet" />
        
        <link href="<?php echo (CSS_ADMIN."style.min.css")?>" type="text/css" rel="stylesheet" />


        


        <link rel="shortcut icon" href="<?php echo URL;?>puclic/images/favicon.ico" type="image/x-icon" />


		<link rel="icon" href="<?php echo URL;?>public/images/favicon.ico" type="image/x-icon" />


    <!--END Chèn file CSS--> 


    <!--Chèn file JS--> 


	<script language="javascript" type="text/javascript" src="<?php echo JS;?>jquery/jquery.min.js"></script>


    <script language="javascript" type="text/javascript" src="<?php echo JS?>jquery/jquery.validate.min.js"></script>


    <script language="javascript" type="text/javascript" src="<?php echo JS;?>jquery/jquery.dataTables.js"></script>


    <script language="javascript" type="text/javascript" src="<?php echo JS;?>jquery/jquery.fancybox-1.3.4.pack.js"></script>


     <script language="javascript" type="text/javascript" src="<?php echo JS;?>jquery/jquery-ui-1.10.3.custom.js"></script>

	<script language="javascript" type="text/javascript" src="<?php echo JS_ADMIN;?>index.js"></script>
    
    <script language="javascript" type="text/javascript" src="<?php echo JS_ADMIN;?>jquery.bpopup-0.9.3.min.js"></script>
<div class="box" style="overflow: overlay;">
	
    <div class="heading">
      <h1 style="float:left">Thư mục hiện hành</h1>
      <div style="float:right; padding-top:7px;"></div>
    </div>
    <div><?php if(isset($messages))echo $messages;?></div>
    <div class="content" style="overflow:overlay; height:400px;">
          <div class="forder_admin">
          <form action="<?php echo base_url();?>admin/media_insert_images/removemedia_insert_images" method="post" id="from-tindang">
            	<ul>
                    <li>
                         <p><input type="checkbox" /></p>
                         <a href="<?php echo URL?>admin/media_insert_images/index/<?php echo $url_back; ?>">
                            <img src="<?php echo IMAGES;?>folder.png" /><br />Quay lại
                         </a>
                    </li>
					<?php 
					/*lay cac file trong thu muc*/
                    $dirname = realpath(APPPATH. "../public/images/".$url."");
                    //@mkdir( $dirname );
                    $dir = opendir( $dirname );
					/*folder*/
                    while( $file=readdir($dir) )
                    {
						if(is_dir($dirname . "/" . $file))
						{
							if ($file!=".." and $file!="." and $file!=".htaccess" and $file!="index.php" and $file!="index.html" and $file!=".svn"){
                        ?>
                         <li>
                        
                             <p><input type="checkbox" name="delete[]" value="<?php echo $file;?>" /></p>
                             <a rel="example_group"
							 <?php 
							 $in = array("pdf","doc","docx","xls","xlsx");
							 $in_img = array("jpg", "png", "gif", "bmp");
							 if(in_array(end(explode('.',$file)),$in))
                             {
								 ?>
                                 href="<?php echo URL.'admin/media_insert_images/download_file/';?><?php echo $file?>"
                                 <?php
							 }
							 elseif(in_array(end(explode('.',$file)),$in_img))
                             {
								 ?>
                                 href="<?php echo IMAGES.$url.$file;?>" onclick=""
                                 <?php
							 }
							 else
							 {
								 ?>
                                 href="<?php echo URL?>admin/media_insert_images/index/<?php echo $url.$file?>"
                                 <?php
							 }
							 ?> 
                             style="text-align:center;">
                                 <?php
                                     $in = array("jpg", "png", "gif", "bmp");
									 $in_pdf = array("pdf");
                                     if(in_array(end(explode('.',$file)),$in))
                                     {
                                         ?>
                                         <img width="50" height="50" src="<?php echo IMAGES.$url.''.$file;?>" /><br />
                                         <?php
                                     }
									 
									 elseif(in_array(end(explode('.',$file)),$in_pdf))
                                     {
										 ?>
                                        <img src="<?php echo IMAGES;?>pdf.png" /><br />
                                         <?php
									 }
                                     else
                                     {
                                         ?>
                                         
                                         <img src="<?php echo IMAGES;?>folder.png" /><br />
                                         <?php
                                     }
                                 ?>
                                 <?php echo mb_substr($file,0,5)." "."..";?>
                             </a>
                         </li>
                         <?php
							}
                        }
                    }
					/*file*/
					/*lay cac file trong thu muc*/
                    $dirname_file = realpath(APPPATH. "../public/images/".$url."");
                    //@mkdir( $dirname );
                    $dir_file = opendir( $dirname_file );
                    while( $file=readdir($dir_file) )
                    {
						if(!is_dir($dirname . "/" . $file))
						{
							if ($file!=".." and $file!="." and $file!=".htaccess" and $file!="index.php" and $file!="index.html" and $file!=".svn"){
                        ?>
                         <li>
                        
                             <p><input type="checkbox" name="delete[]" value="<?php echo $file;?>" /></p>
                             <a rel="example_group"
							 <?php 
							 $in = array("pdf","doc","docx","xls","xlsx");
							 $in_img = array("jpg", "png", "gif", "bmp");
							 if(in_array(end(explode('.',$file)),$in))
                             {
								 ?>
                                 href="<?php echo URL.'admin/media_insert_images/download_file/';?><?php echo $file?>"
                                 <?php
							 }
							 elseif(in_array(end(explode('.',$file)),$in_img))
                             {
								 ?>
                                 href="<?php echo IMAGES.$url.$file;?>" onclick="javascript:getPositionImages('<?php echo IMAGES.$url.''.$file;?>')"
                                 <?php
							 }
							 else
							 {
								 ?>
                                 href="<?php echo URL?>admin/media_insert_images/index/<?php echo $url.$file?>"
                                 <?php
							 }
							 ?> 
                             style="text-align:center;">
                                 <?php
                                     $in = array("jpg", "png", "gif", "bmp");
									 $in_pdf = array("pdf");
                                     if(in_array(end(explode('.',$file)),$in))
                                     {
                                         ?>
                                         <img width="50" height="50" src="<?php echo IMAGES.$url.''.$file;?>" /><br />
                                         <?php
                                     }
									 
									 elseif(in_array(end(explode('.',$file)),$in_pdf))
                                     {
										 ?>
                                        <img src="<?php echo IMAGES;?>pdf.png" /><br />
                                         <?php
									 }
                                     else
                                     {
                                         ?>
                                         
                                         <img src="<?php echo IMAGES;?>folder.png" /><br />
                                         <?php
                                     }
                                 ?>
                                 <?php echo mb_substr($file,0,5)." "."..";?>
                             </a>
                         </li>
                         <?php
							}
							}
                        }
                    closedir($dir);
                ?>
            </ul>
            <div class="clear"></div>
            <br />
            <input type="checkbox" onclick="toggle(this)" />&nbsp;<font color="#000000">Chọn tất cả</font>&nbsp;&nbsp;<button type="submit" class="btn" name="btnDeleteall" onclick="return confirm('Are you sure you want to do that?');">
                            <span>Xóa</span>
                        </button>
            </form>
            <div class="clear"></div>
            <br />
            <div>
            	<form action="<?php echo URL;?>admin/media_insert_images/check_upload" id="uploadForm" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Tải tập tin [ Tối đa&nbsp;5MB ]</legend>
                            <input type="file" id="filename" name="filename" class="inputbox">
                            <input type="submit" value="Bắt đầu tải lên" class="button">
                        </fieldset>
                    <input type="hidden" name="return" value="">
                    <input type="hidden" name="upfolder" id="upfolder" value="images">
                    <input type="hidden" name="root" value="">
                </form>
            </div>
            <div>
                <form action="<?php echo URL;?>admin/media_insert_images/check_create_folder" name="folderForm" id="folderForm" method="post">
                    <fieldset id="folderview">
                        <legend>Thư mục</legend>
                            <input class="inputbox" type="text" id="fname_folder" name="fname_folder" maxlength="100">&nbsp;
                            <button type="submit" class="button">Tạo thư mục</button>
                    </fieldset>
                    <input type="hidden" name="return" value="">
                    <input type="hidden" name="currentfolder" id="currentfolder" value="images">
                    <input type="hidden" name="root" value="">
                </form>
            </div>
   		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(e) {
    /*dang ky*/
		$("#adminForm").validate({ 
			rules: {
				title_menus:{
					required: true
				}
			},
			messages: {
				title_menus:{
					required: "Bắt buộc nhập",
				}
			}
		});
	/*end đăng ký*/
});
</script>
<!-- get position images -->
<script language="javascript" type="text/javascript" src="<?php echo JS;?>editor/ckeditor.js"></script>
<script>
/*
function getPositionImages(position){
	
	$('#images', window.parent.document).val(position);
	//$('#fulltext_articles', window.parent.document).text(position);
	var postition ='<img src='+position+'>';
	//CKEDITOR.instances["fulltext_articles"].setData('some text here');
	$('#fulltext_articles', window.parent.document).html('aasdsadasdas ád');
	parent.$("#popup2").bPopup().close();
    return false;
}*/
</script>
<!-- end get position images -->
    