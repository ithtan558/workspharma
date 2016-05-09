<!--Nội dung right-->
   <div id="wpcontent">
    	<!--Tiêu đề-->
            <div id="wpadminbar" class="nojq nojs" role="navigation">
                <div class="quicklinks" id="wp-toolbar" role="navigation" aria-label="Top navigation toolbar." tabindex="0">Hệ thống ban quản trị</div>
                <!--Biến URL gởi qua file js-->
                    <input type="hidden" id="base_url" value="<?php echo base_url();?>">
                <!--end Biến URL gởi qua file js-->
            </div>
        <!--end tiêu đề-->
        
        <!--Nội dung right-->
        <div id="wpbody"> 
        	<div id="wpbody-content">
				<?php $this->load->view('admin/bodyright/donhang/main');?>
            </div>
    	</div><!-- wpbody -->
   	</div><!-- wpcontent -->
<!-- Nội dung right -->
