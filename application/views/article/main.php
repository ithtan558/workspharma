<div id="main-content" class="container">
    <div class="content">
    	<?php
    	$this->load->view('breadcrumb');
		$fulltext_articles=$getArticles->fulltext_articles;
		$fulltext_articles=str_replace('public/',''.URL.'public/'.'',$fulltext_articles);
		$fulltext_articles=str_replace(URL.URL.'public/',''.URL.'public/'.'',$fulltext_articles);
		?>
		<article class="post-424 page type-page status-publish hentry post-listing post">
			<div class="post-inner">
			<?php echo $fulltext_articles; ?>
			</div>
		</article>
    </div>
    <!-- .content /-->
    <?php $this->load->view('body/right'); ?>
    <div class="clear"></div>
</div>