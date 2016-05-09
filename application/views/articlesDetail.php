<div class="body_page">
        <div class="container">
            <div class="row">
                <!-- Begin body left -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="pv_viec_lam">
                        <div class="title_header">
                            <h3><?php echo $articlesDetail->title_articles; ?></h3>
                        </div>
                        <div class="body_mo">
                            <div class="row">
                                <div class="col-md-9 col-sm-9 col-xs-12 no-padding-mobile">
                                    <?php
                                        echo $articlesDetail->fulltext_articles;
                                    ?>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12 no-padding-mobile">
                                    <div class="form-right row">
                                        <h4><?php echo $this->lang->line('Accept info job'); ?></h4>
                                        <p><?php echo $this->lang->line('Body accept job'); ?></p>
                                        <?php $this->load->view('rightAcceptJobEmail'); ?>
                                    </div>
                                    <div class="form-right2">
                                        <h5><?php echo $this->lang->line('Carrer tool'); ?></h5>
                                        <ul>
                                            <?php
                                            if(isset($articles)){
                                                foreach ($articles->result() as $item) {
                                                    $link = URL.$this->lang->line('l_career_tool').'/'.$item->alias_articles.'-'.$item->idArticles;
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo $link; ?>">
                                                            <i class="fa fa-angle-right"></i>
                                                            <?php echo $item->title_articles; ?>
                                                        </a>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            
                                        </ul>
                                    </div>
                                    <div class="form-right2 row">
                                        <h5><?php echo $this->lang->line('The most view jobs'); ?></h5>
                                        <ul>
                                            <?php
                                            if(isset($jobs)){
                                                foreach ($jobs->result() as $item) {
                                                    $link = URL.$this->lang->line('l_detail').'/'.$item->alias.'-'.$item->id;
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo $link; ?>">
                                                            <i class="fa fa-angle-right"></i>
                                                            <?php echo $item->title; ?>
                                                        </a>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end 9 Nhóm ngành nghề -->
                </div><!-- end body left -->
            </div>
        </div>
    </div><!-- end body page -->