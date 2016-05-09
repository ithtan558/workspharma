<div id="body-product">
	<?php echo $this->load->view("breadcrumb");?>
    <div class="hero-area">
        <div class="wrapper do-fade-in full-opacity" data-globalid="3015934" style="opacity: 1;">
            <div class="body">
                <div id="content-left">
                	<?php 
					foreach($listArticlesCategories as $articlesCategories)
					{
						?>
						<div class="only-articles-categories">
                        	<h3><a href="<?php echo URL.'kien-thuc/'.$articlesCategories->alias_articles_categories;?>"><?php echo $articlesCategories->name_articles_categories;?></a></h3>
                            <p><?php echo $articlesCategories->description_articles_categories;?></p>
                            <div class="clear"></div>
                        </div>
                        <?php
					}
					?>
                    </ul>
                </div>
                <?php $this->load->view("body/right");?>   
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>