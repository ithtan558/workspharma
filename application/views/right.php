<div class="col-md-2 col-sm-2 col-xs-12">
    <div class="quang_cao">
    <?php
    foreach($listBanner as $banner)
    {
        if($banner->paramid==1){
            ?>
            <a href=""><img src="<?php echo IMAGES.'banner/'.$banner->image_adv_right?>" class="img-responsive"></a>
            <?php
        }
    }
    ?>
    </div>
    <!-- end quang cao -->
    <div class="lien_ket">
        <h4>Liên kết</h4>
        <div class="img-lk">
            <?php
            foreach($listBanner as $banner)
            {
                if($banner->paramid==2){
                    ?>
                    <a href=""><img src="<?php echo IMAGES.'banner/'.$banner->image_adv_right?>" class="img-responsive"></a>
                    <?php
                }
            }
            ?>
        </div>
        <!-- end lien ket -->
    </div>
</div>