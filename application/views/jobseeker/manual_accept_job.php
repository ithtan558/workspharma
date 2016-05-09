<h4><?php echo $this->lang->line('Manual work'); ?></h4>
<?php
foreach ($listArticles->result() as $item) {
    $link = URL.$this->lang->line('l_career_tool').'/'.$item->alias_articles.'-'.$item->idArticles;
    ?>
    <div class="row">
        <div class="border-bottom">
            <div class="col-xs-4 col-sm-4 col-md-4">
                <a href="<?php echo $link; ?>">
                    <img width="83" height="58" src="<?php echo IMAGES.'articles/'.$item->thumb_articles; ?>" alt="Images" class="img-responsive">
                </a>
            </div>
            <div class="col-xs-8 col-sm-8 col-md-8">
                <a href="<?php echo $link; ?>">
                    <?php echo $item->title_articles; ?>
                </a>
            </div>
        </div>
    </div> <!-- end row-1 -->
    <?php
    }
?>
<h4><?php echo $this->lang->line('Accept job'); ?></h4>
<div class="row border-bottom-temp1">
    <?php
    if(isset($getUsersAcceptJob)){
        $title = $this->lang->line('Edit accept job');
        $getUsersAcceptJob = $getUsersAcceptJob->row();
        ?>
        <div class="col-xs-12 col-sm-12 col-md-12 no-padding">
            <div class="col-xs-12 col-sm-12 col-md-12 no-padding no-margin-left"><b><?php echo $this->lang->line('Nghanh nghe'); ?></b> : <?php echo get_category($getUsersAcceptJob->category_ids) ?></div>
            <div class="col-xs-12 col-sm-12 col-md-12 no-padding no-margin-left"><b><?php echo $this->lang->line('Address'); ?></b> : <?php echo get_city($getUsersAcceptJob->city_ids) ?></div>
            <div class="col-xs-12 col-sm-12 col-md-12 no-padding no-margin-left"><b><?php echo $this->lang->line('Level'); ?></b> : <?php echo get_level($getUsersAcceptJob->level_ids) ?></div>
        </div>
        <?php
    }
    else{
        $title = $this->lang->line('Add accept job');
    }
    ?>
    <div class="col-xs-12 col-sm-12 col-md-12 no-padding">
        <a class="hover-blue" style="float: right; margin-top: 10px;" href="<?php echo URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_add_accept_job'); ?>" title=""><?php echo $title; ?></a>
    </div>
</div>
