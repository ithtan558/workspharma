
<div id="body-product">
    <!--main-products-->
    <?php echo $this->load->view("breadcrumb");?>
    <div class="hero-area" id="content-left">
        <div class="wrapper">
        	<div class="body">
            	<div class="sitemap">	
                	<h2><?php echo 'Sơ đồ website';?></h2>				
                    <ul class="level_0">
                        <?php
                            foreach($listMenuSiteMap as $menu)
                            {
                                ?>
                                <li>
                                    <a href="
									<?php 
									if($menu->default_menus==1)
									{
										echo URL;
									}
									else
									{
										echo URL.$menu->alias_menus;
									}
									?>">
                                    <?php echo $menu->title_menus;?>
                                    </a>
                                    <?php 
                                        if($menu->alias_menus=='san-pham')
                                        {
                                        ?>
                                        <ul class="level_1">
                                            <?php
                                            echo $listMenuChildSiteMap;
                                            ?>
                                        </ul>
                                        <?php
                                        }
                                    ?>     
                                </li>
                                <?php
							}
                        ?>
                    </ul>
				</div>
            </div>
        </div>
    </div>
    <!--end main-products-->
    <?php $this->load->view("body/right");?>
    <div class="clear"></div>
    <!--end our services-->
</div>
