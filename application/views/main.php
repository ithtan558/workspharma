<script type="text/javascript" src="<?php echo JS; ?>jssor.js"></script>
<script type="text/javascript" src="<?php echo JS; ?>jssor.slider.js"></script>
<script>
    jQuery(document).ready(function($) {
        var options = {
            $AutoPlay: true,
            $AutoPlaySteps: 1,
            $AutoPlayInterval: 0,
            $PauseOnHover: 4,
            $ArrowKeyNavigation: true,
            $SlideEasing: $JssorEasing$.$EaseLinear,
            $SlideDuration: 1600,
            $MinDragOffsetToSlide: 20,
            $SlideWidth: 140,
            $SlideSpacing: 0,
            $DisplayPieces: 7,
            $ParkingPosition: 0,
            $UISearchMode: 1,
            $PlayOrientation: 1,
            $DragOrientation: 1
        };
        var jssor_slider1 = new $JssorSlider$("slider1_container", options);
        function ScaleSlider() {
            var bodyWidth = document.body.clientWidth;
            if (bodyWidth)
                jssor_slider1.$ScaleWidth(Math.min(bodyWidth, 980));
            else
                window.setTimeout(ScaleSlider, 30);
        }
        ScaleSlider();
        $(window).bind("load", ScaleSlider);
        $(window).bind("resize", ScaleSlider);
        $(window).bind("orientationchange", ScaleSlider);
        $("#vnd").hide();
        $("#usd").hide();
        $("#selectabc").change(function(){
            var abc = $("#selectabc").val();
            if(abc == 0){
                $("#vnd").hide();
                $("#usd").hide();
            }else if(abc == 1){
                $("#vnd").show();
                $("#usd").hide();
            }else if(abc == 2){
                $("#vnd").hide();
                $("#usd").show();
            }
        });
    });
</script>
<div class="slide hidden-xs">
    <div class="container">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <?php
                $i=0;
                foreach ($listSlideshow as $item) {
                    # code...
                    ?>
                    <!-- item -->
                    <div class="item <?php if($i==0)echo 'active'; ?>">
                        <img alt="<?php echo $item->text_slide_show; ?>" title="<?php echo $item->text_slide_show; ?>" src="<?php echo IMAGES.'slideshow/'.$item->image_slide_show;?>">
                    </div>
                    <!-- /.item -->
                    <?php
                    $i++;
                }
                ?>
            </div>
            <!-- End Carousel Inner -->
            <!-- Controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
        <!-- End Carousel -->
    </div>
</div>
<!-- End slide -->
<?php echo $this->load->view('search/main'); ?>
<!-- end tim viec -->
<div class="body_page">
    <div class="container">
        <div class="row">
            <!-- Begin body left -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="nhom9">
                    <div class="title_header">
                        <h3><?php echo $this->lang->line('9 group nghanh nghe'); ?></h3>
                    </div>
                    <div class="body_mo">
                        <div class="row">
                        <?php
                        $i=0;
                        foreach ($getCategories->result() as $item) {
                            if($item->parent_id==0){
                                if($i%4==0){
                                    echo '<div class="col-md-6 col-sm-6 col-xs-12">';
                                }
                                echo '<h4>'.$item->category_name.'</h4>';
                                    foreach ($getCategories->result() as $itemChild) {
                                        if($item->id==$itemChild->parent_id){
                                            ?>
                                            <a title="<?php echo $itemChild->category_name; ?>" href="<?php echo URL.$this->lang->line('l_job').'/'.standardURL($itemChild->category_name).'-'.$itemChild->id; ?>">
                                                <p><img src="<?php echo IMAGES;?>left.png" />&nbsp;&nbsp;<?php echo $itemChild->category_name;?></p>
                                            </a>
                                            <?php
                                        }
                                    }
                                $i++;
                                if($i==4 || $i==8 || $i==9){
                                    echo '</div>';
                                }
                            }
                        }
                        ?>
                        </div>
                    </div>
                </div>
                <!-- end 9 Nhóm ngành nghề -->
                <div class="viec_hap_dan">
                    <div class="title_header">
                        <h3><?php echo $this->lang->line('Hot job'); ?> <a href="<?php echo URL.$this->lang->line('l_job'); ?>"><?php echo $this->lang->line('Read more'); ?> --></a></h3>
                    </div>
                    <div class="body_mo">
                        <div class="row">
                            <?php
                            $i=0;
                            foreach ($jobs->result() as $item) {
                                $link = URL.$this->lang->line('l_detail').'/'.$item->alias.'-'.$item->id;
                                if($i%5==0){
                                    echo '<div class="col-md-6 col-sm-6 col-xs-12">';
                                    echo '<ul>';
                                }
                                ?>
                                 <li>
                                    <a title="<?php echo $item->title; ?>" href="<?php echo $link; ?>"><h4><img src="<?php echo IMAGES;?>ico-list.gif"/><?php echo cutString($item->title, 50, '..'); ?></h4></a>
                                    <p><?php echo $item->company; ?></p>
                                </li>
                                <?php
                                $i++;
                                if($i%5==0 || count($jobs->result()) == $i){
                                    echo '</ul>';
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- end viec_hap_dan -->
                <div class="nhan_thong_tin">
                    <div class="title_header">
                        <h3><?php echo $this->lang->line('Accept info job'); ?></h3>
                    </div>
                    <div class="body_mo">
                        <!-- <div class="top">
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-sm-offset-1 col-xs-12">
                                    <img src="<?php echo IMAGES;?>1.png" />
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <img src="<?php echo IMAGES;?>2.png" />
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <img src="<?php echo IMAGES;?>3.png" />
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <img src="<?php echo IMAGES;?>4.png" />
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <img src="<?php echo IMAGES;?>5.png" />
                                </div>
                            </div>
                        </div>
                        <div class="center">
                            <div class="row">
                                <div class="col-md-2 col-sm-offset-2 col-sm-2">
                                    <img src="<?php echo IMAGES;?>right.png" />
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <img src="<?php echo IMAGES;?>right.png" />
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <img src="<?php echo IMAGES;?>right.png" />
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <img src="<?php echo IMAGES;?>right.png" />
                                </div>
                            </div>

                        </div> -->
                        <div class="bottom">
                            <div class="row">
                                <form id="form-accept-email" class="col-lg-12 col-sm-12 col-md-12 col-xs-12 no-padding" action="<?php echo URL.$this->lang->line('l_accept_email'); ?>" method="post">
                                    <div class="col-md-2 col-sm-2 col-sm-offset-1 col-xs-12">
                                        <input requireds type="text" class="form-control" id="email" name="email" placeholder="Email của bạn..." />
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#category1').multiselect({
                                                    nonSelectedText: "<?php echo $this->lang->line('Choose nghanh'); ?>"
                                                });
                                            });
                                        </script>
                                        <select class="form-control"  id="category1" name="category1[]" multiple="multiple">
                                            <?php
                                            foreach ($getCategories->result() as $item) {
                                                if($item->parent_id==0){
                                                echo '<optgroup label="'.$item->category_name.'">';
                                                    foreach ($getCategories->result() as $itemChild) {
                                                        if($item->id==$itemChild->parent_id){
                                                            echo '<option value="'.$itemChild->id.'">'.$itemChild->category_name.'</option>';
                                                        }
                                                    }
                                                }
                                                echo '</optgroup>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#city1').multiselect({
                                                    nonSelectedText: "<?php echo $this->lang->line('Address'); ?>"
                                                });
                                            });
                                        </script>
                                        <select class="form-control"  id="city1" name="city1[]" multiple="multiple">
                                            <?php
                                                foreach ($getCities->result() as $item) {
                                                    ?>
                                                    <option value="<?php echo $item->id ?>"><?php echo $item->city_name; ?></option>
                                                    <?php
                                                    # code...
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                        <select id="level" name="level" class="form-control edit-control">
                                            <option value=""><?php echo $this->lang->line('Level'); ?></option>
                                            <?php
                                            foreach ($default_currentJobLevel as $key=>$value) {
                                                ?>
                                                <option value="<?php echo $key ?>"><?php echo $value; ?></option>
                                                <?php
                                                # code...
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                        <input type="submit" class="btn-accept-email btn" value="Nhận Email" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Nhận thông tin việc làm -->
                <div class="doi_tac">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 980px; height: 100px; overflow: hidden; ">
                                <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                                    <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                                            background-color: #000; top: 0px; left: 0px;width: 100%;height:100%;">
                                    </div>
                                    <div style="position: absolute; display: block; background: url(public/images/loading-2.gif) no-repeat center center;
                                            top: 0px; left: 0px;width: 100%;height:100%;">
                                    </div>
                                </div>
                                <!-- Slides Container -->
                                <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 980px; height: 100px; overflow: hidden;">
                                    <?php
                                    if($getEmployers->num_rows() > 0){
                                        foreach ($getEmployers->result() as $item) {
                                            if(is_file_exists($item->logo,'logo') == TRUE)
                                            {
                                                $url_image = thumb_uimage_url($item->logo);
                                            }elseif(is_file_exists($item->logo) == TRUE){
                                                $url_image = uimage_url($item->logo);
                                            }
                                            else{
                                                $url_image = image_default();
                                            }
                                            ?>
                                            <div><a title="<?php echo $this->lang->line('View job of company').' '.$item->company; ?>" href="<?php echo URL.$this->lang->line('l_job').'/employer/'.$item->user_id;?>"><img u="image" alt="<?php echo $item->company ?>" src="<?php echo $url_image; ?>" /></a></div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end đối tác -->
                <div class="cham-soc-ket-noi">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 cham_soc">
                            <div class="title_header">
                                <h3><?php echo $this->lang->line('take care customer'); ?></h3>
                            </div>
                            <div class="body_mo">
                                <p><?php echo $this->lang->line('Phone'); ?> : <span>0982 11 83 43</span></p>
                                <p><?php echo $this->lang->line('Email'); ?> : <span>contact@workspharma.com</span></p>
                            </div>
                        </div>
                        <!-- end cham soc -->
                        <div class="col-md-6 col-sm-12 col-xs-12 ket_noi">
                            <div class="title_header">
                                <h3><?php echo $this->lang->line('Connect with Workspharma'); ?></h3>
                            </div>
                            <div class="body_mo">
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-1 col-sm-3 col-sm-offset-1 col-xs-3 col-xs-offset-1">
                                        <a href="#"><img src="<?php echo IMAGES;?>g+.png" class="img-responsive" /></a>
                                    </div>
                                    <div class="col-md-3 col-md-offset-1 col-sm-3 col-sm-offset-1 col-xs-3 col-xs-offset-1">
                                        <a href="#"><img src="<?php echo IMAGES;?>fb.png" class="img-responsive" /></a>
                                    </div>
                                    <div class="col-md-3 col-md-offset-1 col-sm-3 col-sm-offset-1 col-xs-3 col-xs-offset-1">
                                        <a href="#"><img src="<?php echo IMAGES;?>in.png" class="img-responsive" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end ket noi -->
                    </div>
                </div>
                <!-- end cham soc ket noi -->
            </div>
            <!-- end body left -->
            <!-- Begin body right -->
            <?php //$this->load->view('right'); ?>
            <!-- end body right -->
        </div>
    </div>
</div>
<!-- end body page -->