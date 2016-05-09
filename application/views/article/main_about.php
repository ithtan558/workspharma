<div id="body-product">
	<?php echo $this->load->view("breadcrumb");?>
    <div class="hero-area">
        <div class="wrapper do-fade-in full-opacity" data-globalid="3015934" style="opacity: 1;">
            <div class="body">
                <div id="content-left">
                    <h2><?php echo $getArticles->title_articles;?></h2>
                    <?php 
                    echo $getArticles->fulltext_articles;
                    ?>
                    <hr />
                    <br />
                    <h3>Bài viết liên quan</h3>
                    <ul style="padding-left:30px; list-style:outside;">
                    <?php 
                    foreach($listOtherArticles as $otherArticles){
                        ?>
                        <li><a href="<?php echo URL.$otherArticles->alias_articles_categories.'/'.$otherArticles->alias_articles;?>"><?php 
                        echo $otherArticles->title_articles;
                        ?></a></li>
                        <?php
                    }
                    ?>
                    </ul>
                </div>
                <?php $this->load->view("body/right_about");?>   
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>