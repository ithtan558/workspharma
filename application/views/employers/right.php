<div class="col-md-3 col-sm-3 col-xs-12 side-right">
    <div class="info-user row">
        <div class="col-xs-4 col-sm-4 col-md-4">
        <?php
            if(is_file_exists($userInfo->logo,'logo') == TRUE)
            {
                $url_image = thumb_uimage_url($userInfo->logo);
            }elseif(is_file_exists($userInfo->logo) == TRUE){
                $url_image = uimage_url($userInfo->logo);
            }
            else{
                $url_image = image_default();
            }
        ?>
            <img src="<?php echo $url_image; ?>" alt="User" class="img-responsive">
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8">
            <h4><?php echo displayUserName($userInfo->user_name,$userInfo->company) ?></h4>
            <p>
                <?php echo $this->lang->line('Date register');?>: </br>
                <?php echo date('d-m-Y',$userInfo->created); ?>
            </p>
        </div>
        <div style="clear: both"></div>
        <ul class="list-unstyled">
            <li><a href="<?php echo URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_account').'/'.$this->lang->line('l_edit'); ?>"><?php echo $this->lang->line('Edit account person'); ?></a></li>
            <li><a href="<?php echo URL.'users/'.$this->lang->line('l_sign_out') ?>"><?php echo $this->lang->line('Logout');?></a></li>
        </ul>
    </div>
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
</div>