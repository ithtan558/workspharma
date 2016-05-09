<div id="main-content" class="container">
    <div class="content">
    	<?php $this->load->view('breadcrumb'); ?>
    	
		<?php
		if(count($listArticlesCategories)>0)
		{
			if($listArticlesCategories[0]->alias_articles_categories=='gioi-thieu' || $listArticlesCategories[0]->alias_articles_categories=='about-us')
			{
				$fulltext_articles=$listArticlesCategories[0]->fulltext_articles;
				$fulltext_articles=str_replace('public/',''.URL.'public/'.'',$fulltext_articles);
				$fulltext_articles=str_replace(URL.URL.'public/',''.URL.'public/'.'',$fulltext_articles);
				?>
				<article class="post-424 page type-page status-publish hentry post-listing post">
					<div class="post-inner">
					<?php echo $fulltext_articles; ?>
					</div>
				</article>
				<?php
				
			}
			else
			{
				?>
				<div class="post-listing">
					<?php
					foreach($listArticlesCategories as $articlesCategories)
					{
						?>
						<article class="item-list">
							<h2 class="post-box-title"><a href="<?php echo URL.$articlesCategories->alias_articles_categories.'/'.$articlesCategories->alias_articles;?>" title="<?php echo $articlesCategories->title_articles;?>" rel="bookmark"><?php echo $articlesCategories->title_articles;?></a></h2>			
							<p class="post-meta">
							</p>					
							<div class="post-thumbnail">
								<a href="<?php echo URL.$articlesCategories->alias_articles_categories.'/'.$articlesCategories->alias_articles;?>" title="<?php echo $articlesCategories->title_articles;?>" rel="bookmark">
									<img width="150" height="150" src="<?php echo IMAGES.'articles/'.$articlesCategories->thumb_articles;?>" class="attachment-thumbnail wp-post-image" alt="<?php echo $articlesCategories->title_articles;?>">
									<span class="overlay-icon"></span>
								</a>
							</div><!-- post-thumbnail /-->
							<div class="entry">
								<p><?php echo $articlesCategories->introtext_articles;?>
									<a class="more-link" href="<?php echo URL.$articlesCategories->alias_articles_categories.'/'.$articlesCategories->alias_articles;?>">Chi tiết »</a>
								</p>
							</div>
							<div class="clear"></div>
						</article><!-- .item-list -->
						<?php
					}
					?>
				</div>
				<?php
			}
		}
		?>
		<?php
		if(count($listArticlesCategories)>0)
		{
			if($listArticlesCategories[0]->alias_articles_categories!='gioi-thieu')
			{
				?>
					<div id="pagination" class="pagination jquery_link_articles" align="center">
						<?php echo $pagination_listArticles;?>
					</div>		
				<?php
			}
		}
		?>
    </div>
    <!-- .content /-->

    <?php $this->load->view('body/right'); ?>
    <div class="clear"></div>
</div>