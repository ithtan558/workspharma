<div id="body-product">
	<?php echo $this->load->view("breadcrumb");?>
    <div class="hero-area">
        <div class="wrapper do-fade-in full-opacity" data-globalid="3015934" style="opacity: 1;">
            <div class="body">
                <div id="content-left">
                	<?php 
					foreach($listArticlesCategories as $articles)
					{
						?>
						<div class="only-articles">
                        	<h3><?php echo $articles->title_articles;?></h3>
                            <p><span><?php
							$date=date_create($articles->created_articles);
							echo date_format($date, 'g:ia \o\n l jS F Y');;?></span></p>
                        	<img alt="<?php echo $articles->title_articles;?>" src="<?php echo IMAGES.'articles/'.$articles->thumb_articles;?>" />
                            <p><?php echo $articles->introtext_articles;?></p>
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