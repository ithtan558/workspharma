<div id="adminmenushadow"></div>
<!-- <a href="<?php echo URL.'administrator';?>">
    <img src="<?php echo IMAGES.'admin/logo.png'?>" alt="" width="200" height="80">
</a> -->
<ul id="adminmenu" role="navigation">
    <!--config -->
        <li <?php
        if(isset($config_default))
        {
            echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
        }
        else
        {
            echo 'class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_tinhchat-option"';
        }
        ?>
        id="toplevel_page_tinhchat-option">
            <a href='<?php echo base_url();?>admin/config'
            <?php
            if(isset($config_default))
            {
                echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
            }
            else
            {
                echo 'class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media"';
            }
            ?>>
                <div class="wp-menu-arrow">
                    <div></div>
                </div>
                <div class='wp-menu-image'>
                    <img src="<?php echo IMAGES_ADMIN;?>/config.png" alt="" />
                </div>
                <div class='wp-menu-name'>Quản lý cấu hình</div>
            </a>
            <ul class="wp-submenu wp-submenu-wrap">
                <li class="<?php if(isset($config)) echo 'current';?>"><a href="<?php echo base_url();?>admin/config">Danh sách cấu hình</a>
                </li>
                <!-- <li class="wp-first-item <?php if(isset($add_config)) echo 'current';?>"><a href="<?php echo base_url();?>admin/config/add_config" class="wp-first-item current">Thêm cấu hình</a>
                </li> -->
            </ul>
        </li>
    <!--end config-->
    <!--article-->
        <li <?php
        if(isset($article_default))
        {
            echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
        }
        else
        {
            echo 'class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_tinhchat-option"';
        }
        ?>
        id="toplevel_page_tinhchat-option">
            <a href='<?php echo base_url();?>admin/article'
            <?php
            if(isset($article_default))
            {
                echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
            }
            else
            {
                echo 'class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media"';
            }
            ?>>
                <div class="wp-menu-arrow">
                    <div></div>
                </div>
                <div class='wp-menu-image'>
                    <img src="<?php echo IMAGES_ADMIN;?>/article.png" alt="" />
                </div>
                <div class='wp-menu-name'>Quản lý bài viết</div>
            </a>
            <ul class="wp-submenu wp-submenu-wrap">
                <li class="<?php if(isset($article)) echo 'current';?>"><a href="<?php echo base_url();?>admin/article">Quản lý bài viết</a>
                </li>
                <li class="<?php if(isset($add_article)) echo 'current';?>"><a href="<?php echo base_url();?>admin/article/add_article">Thêm bài viết</a>
                </li>
                <li class="wp-first-item <?php if(isset($articles_categories)) echo 'current';?>"><a href="<?php echo base_url();?>admin/articles_categories" class="wp-first-item current">Quản lý chủ đề</a>
                </li>
                <li class="wp-first-item <?php if(isset($add_articles_categories)) echo 'current';?>"><a href="<?php echo base_url();?>admin/articles_categories/add_articles_categories" class="wp-first-item current">Thêm chủ đề</a>
                </li>
            </ul>
        </li>
    <!--end article-->
    <!--Block-->
         <li <?php
        if(isset($blocks_default))
        {
            echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
        }
        else
        {
            echo 'class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_tinhchat-option"';
        }
        ?>
        id="toplevel_page_tinhchat-option">
            <a href='<?php echo base_url();?>admin/block'
            <?php
            if(isset($blocks_default))
            {
                echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
            }
            else
            {
                echo 'class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media"';
            }
            ?>>
                <div class="wp-menu-arrow"><div></div>
                </div>
                <div class='wp-menu-image'>
                <img src="<?php echo IMAGES_ADMIN;?>/block.png" alt="" />
                </div>
                <div class='wp-menu-name'>Quản lý khối</div>
            </a>
            <ul class="wp-submenu wp-submenu-wrap">
                <!-- <li class="<?php if(isset($blocks_config)) echo 'current';?>"><a href="<?php echo base_url();?>admin/block">Những khối chung</a>
                </li> -->
                <li class="wp-first-item <?php if(isset($block_slideshow)) echo 'current';?>"><a href="<?php echo base_url();?>admin/blocks_slideshow" class="wp-first-item current">Khối slideshow</a>
                </li>
                <!-- <li class="wp-first-item <?php if(isset($blocks_support_online)) echo 'current';?>"><a href="<?php echo base_url();?>admin/blocks_support_online" class="wp-first-item current">Khối hỗ trợ trực tuyến</a>
                </li> -->
                <li class="wp-first-item <?php if(isset($blocks_adv_right)) echo 'current';?>"><a href="<?php echo base_url();?>admin/blocks_adv_right" class="wp-first-item current">Khối các quảng cáo</a>
                </li>
                <!-- <li class="wp-first-item <?php if(isset($blocks_typcial_products)) echo 'current';?>"><a href="<?php echo base_url();?>admin/blocks_typcial_products" class="wp-first-item current">dịch vụ khuyến mãi</a>
                </li> -->
                <!-- <li class="wp-first-item <?php if(isset($blocks_default_products)) echo 'current';?>"><a href="<?php echo base_url();?>admin/blocks_default_products" class="wp-first-item current">dịch vụ trang chủ</a>
                </li> -->
                <!-- <li class="wp-first-item <?php if(isset($blocks_new_articles)) echo 'current';?>"><a href="<?php echo base_url();?>admin/blocks_new_articles" class="wp-first-item current">Tin tức mới nhất</a>
                </li> -->
                <!-- <li class="wp-first-item <?php if(isset($blocks_top_news)) echo 'current';?>"><a href="<?php echo base_url();?>admin/blocks_top_news" class="wp-first-item current">Điểm tin trên top</a>
                </li> -->
                <!-- <li class="wp-first-item <?php if(isset($blocks_finish_projects)) echo 'current';?>"><a href="<?php echo base_url();?>admin/blocks_finish_projects" class="wp-first-item current">Dự án đã thực hiện</a>
                </li> -->
            </ul>
        </li>
    <!--end block-->
    <!--categories and job -->
        <li <?php
        if(isset($jobs_default))
        {
            echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
        }
        else
        {
            echo 'class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_tinhchat-option"';
        }
        ?>
        id="toplevel_page_tinhchat-option">
            <a href='<?php echo base_url();?>admin/category/viewCategorys'
            <?php
            if(isset($jobs_default))
            {
                echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
            }
            else
            {
                echo 'class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media"';
            }
            ?>>
            <div class="wp-menu-arrow"><div></div>
            </div>
            <div class='wp-menu-image'>
                <img src="<?php echo IMAGES_ADMIN;?>/user-group.png" alt="" />
            </div>
            <div class='wp-menu-name'>Quản lý việc làm</div>
        </a>
        <ul class="wp-submenu wp-submenu-wrap">
            <li class="<?php if(isset($category)) echo 'current';?>"><a href="<?php echo base_url();?>admin/category/viewCategorys">Danh mục</a>
            </li>
            <li class="<?php if(isset($addCategory)) echo 'current';?>"><a href="<?php echo base_url();?>admin/category/addCategory">Thêm danh mục</a>
            </li>
            <li class="<?php if(isset($jobsPosted)) echo 'current';?>"><a href="<?php echo base_url();?>admin/jobs/viewJobsPosted">Việc làm đang đăng</a>
            </li>
            <li class="<?php if(isset($jobsExpried)) echo 'current';?>"><a href="<?php echo base_url();?>admin/jobs/viewJobsExpried">Việc làm hết hạn</a>
            </li>
            <li class="<?php if(isset($jobsCheck)) echo 'current';?>"><a href="<?php echo base_url();?>admin/jobs/viewJobsCheck">Việc làm cần duyệt</a>
            </li>
        </ul>
    </li>
    <!--categories and job -->
        <li <?php
        if(isset($country_default))
        {
            echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
        }
        else
        {
            echo 'class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_tinhchat-option"';
        }
        ?>
        id="toplevel_page_tinhchat-option">
            <a href='<?php echo base_url();?>admin/country'
            <?php
            if(isset($country_default))
            {
                echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
            }
            else
            {
                echo 'class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media"';
            }
            ?>>
            <div class="wp-menu-arrow"><div></div>
            </div>
            <div class='wp-menu-image'>
                <img src="<?php echo IMAGES_ADMIN;?>/user-group.png" alt="" />
            </div>
            <div class='wp-menu-name'>Quản lý country</div>
        </a>
        <ul class="wp-submenu wp-submenu-wrap">
            <li class="<?php if(isset($country)) echo 'current';?>"><a href="<?php echo base_url();?>admin/country">List</a>
            </li>
            <li class="<?php if(isset($add_country)) echo 'current';?>"><a href="<?php echo base_url();?>admin/country/add_country">Thêm country</a>
            </li>
        </ul>
    </li>
    <!--categories and job -->
        <li <?php
        if(isset($cities_default))
        {
            echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
        }
        else
        {
            echo 'class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_tinhchat-option"';
        }
        ?>
        id="toplevel_page_tinhchat-option">
            <a href='<?php echo base_url();?>admin/cities'
            <?php
            if(isset($cities_default))
            {
                echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
            }
            else
            {
                echo 'class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media"';
            }
            ?>>
            <div class="wp-menu-arrow"><div></div>
            </div>
            <div class='wp-menu-image'>
                <img src="<?php echo IMAGES_ADMIN;?>/user-group.png" alt="" />
            </div>
            <div class='wp-menu-name'>Quản lý city</div>
        </a>
        <ul class="wp-submenu wp-submenu-wrap">
            <li class="<?php if(isset($cities)) echo 'current';?>"><a href="<?php echo base_url();?>admin/cities">List</a>
            </li>
            <li class="<?php if(isset($add_cities)) echo 'current';?>"><a href="<?php echo base_url();?>admin/cities/add_cities">Thêm city</a>
            </li>
        </ul>
    </li>
    <!--Order -->
        <!-- <li <?php
        if(isset($order_default))
        {
            echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
        }
        else
        {
            echo 'class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_tinhchat-option"';
        }
        ?>
        id="toplevel_page_tinhchat-option">
            <a href='<?php echo base_url();?>admin/order'
            <?php
            if(isset($order_default))
            {
                echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
            }
            else
            {
                echo 'class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media"';
            }
            ?>>
                <div class="wp-menu-arrow">
                    <div></div>
                </div>
                <div class='wp-menu-image'>
                    <img src="<?php echo IMAGES_ADMIN;?>/order.png" alt="" width="23" height="23" />
                </div>
                <div class='wp-menu-name'>Quản lý đơn hàng</div>
            </a>
            <ul class="wp-submenu wp-submenu-wrap">
                <li class="<?php if(isset($order_config)) echo 'current';?>"><a href="<?php echo base_url();?>admin/order_config">Cấu hình</a>
                <li class="<?php if(isset($order)) echo 'current';?>"><a href="<?php echo base_url();?>admin/order">Danh sách</a>
                </li>
            </ul>
        </li> -->
    <!--end Order-->
    <!--video -->
        <!-- <li <?php
        if(isset($video_default))
        {
            echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
        }
        else
        {
            echo 'class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_tinhchat-option"';
        }
        ?>
        id="toplevel_page_tinhchat-option">
            <a href='<?php echo base_url();?>admin/video'
            <?php
            if(isset($video_default))
            {
                echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
            }
            else
            {
                echo 'class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media"';
            }
            ?>>
                <div class="wp-menu-arrow">
                    <div></div>
                </div>
                <div class='wp-menu-image'>
                    <img src="<?php echo IMAGES_ADMIN;?>/article.png" alt="" width="23" height="23" />
                </div>
                <div class='wp-menu-name'>Quản lý video</div>
            </a>
            <ul class="wp-submenu wp-submenu-wrap">
                <li class="<?php if(isset($video)) echo 'current';?>"><a href="<?php echo base_url();?>admin/video">Danh sách video</a>
                </li>
                <li class="<?php if(isset($add_video)) echo 'current';?>"><a href="<?php echo base_url();?>admin/video/add_video">Thêm video</a>
                </li>
            </ul>
        </li> -->
    <!--end video-->
    <!--Menu-->
        <!-- <li <?php
        if(isset($default_menu))
        {
            echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
        }
        else
        {
            echo 'class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_tinhchat-option"';
        }
        ?>
        id="toplevel_page_tinhchat-option">
            <a href='<?php echo base_url();?>admin/menus_parent'
            <?php
            if(isset($default_menu))
            {
                echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
            }
            else
            {
                echo 'class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media"';
            }
            ?>>
                <div class="wp-menu-arrow">
                    <div></div>
                </div>
                <div class='wp-menu-image'>
                    <img src="<?php echo IMAGES_ADMIN;?>/menu.png" alt="" />
                </div>
                <div class='wp-menu-name'>Quản lý menu</div>
            </a>
            <ul class="wp-submenu wp-submenu-wrap">
                <li class="<?php if(isset($menus_parent)) echo 'current';?>"><a href="<?php echo base_url();?>admin/menus_parent">Quản lý Menu</a>
                </li>
                <li class="<?php if(isset($add_menu)) echo 'current';?>"><a href="<?php echo base_url();?>admin/menu/add_menu">Thêm menu item</a>
                </li>
                <li class="<?php if(isset($list_all)) echo 'current';?>"><a href="<?php echo base_url();?>admin/menu/index">Tất cả menu item</a>
                </li>
            </ul>
        </li> -->
    <!--end Menu-->
    <!--Users -->
        <li <?php
        if(isset($users_default))
        {
            echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
        }
        else
        {
            echo 'class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_tinhchat-option"';
        }
        ?>
        id="toplevel_page_tinhchat-option">
            <a href='<?php echo base_url();?>admin/workers/viewWorkers'
            <?php
            if(isset($users_default))
            {
                echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
            }
            else
            {
                echo 'class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media"';
            }
            ?>>
            <div class="wp-menu-arrow"><div></div>
            </div>
            <div class='wp-menu-image'>
                <img src="<?php echo IMAGES_ADMIN;?>/user-group.png" alt="" />
            </div>
            <div class='wp-menu-name'>Quản lý thành viên</div>
        </a>
        <ul class="wp-submenu wp-submenu-wrap">
            <li class="<?php if(isset($workers)) echo 'current';?>"><a href="<?php echo base_url();?>admin/workers/viewWorkers">Người tìm việc</a>
            </li>
            <li class="<?php if(isset($employer)) echo 'current';?>"><a href="<?php echo base_url();?>admin/employer/viewEmployer">Nhà tuyển dụng</a>
            </li>
            <li class="<?php if(isset($usersTrash)) echo 'current';?>"><a href="<?php echo base_url();?>admin/users/viewUsersTrash">Users đã xóa</a>
            </li>
        </ul>
    </li>
    <!--end Users-->
    <!--contact-->
        <li <?php
        if(isset($contact_default))
        {
            echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
        }
        else
        {
            echo 'class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_tinhchat-option"';
        }
        ?>
        id="toplevel_page_tinhchat-option">
            <a href='<?php echo base_url();?>admin/contact'
            <?php
            if(isset($contact_default))
            {
                echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
            }
            else
            {
                echo 'class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media"';
            }
            ?>>
                <div class="wp-menu-arrow">
                    <div></div>
                </div>
                <div class='wp-menu-image'>
                    <img src="<?php echo IMAGES_ADMIN;?>/contact.png" alt="" />
                </div>
                <div class='wp-menu-name'>Quản lý liên hệ</div>
            </a>
            <ul class="wp-submenu wp-submenu-wrap">
                <li class="<?php if(isset($contact)) echo 'current';?>"><a href="<?php echo base_url();?>admin/contact">Danh sách liên hệ</a>
                </li>
                <li class="wp-first-item <?php if(isset($add_contact)) echo 'current';?>"><a href="<?php echo base_url();?>admin/contact/add_contact" class="wp-first-item current">Thêm liên hệ</a>
                </li><!-- 
                <li class="wp-first-item <?php if(isset($contact_config)) echo 'current';?>"><a href="<?php echo base_url();?>admin/contact_config" class="wp-first-item current">Cấu hình liên hệ</a>
                </li> -->
            </ul>
        </li>
    <!--end contact-->
    <!--craw job-->
        <li <?php
        if(isset($craw_job))
        {
            echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
        }
        else
        {
            echo 'class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_tinhchat-option"';
        }
        ?>
        id="toplevel_page_tinhchat-option">
            <a href='<?php echo base_url();?>admin/craw/viewCraw'
            <?php
            if(isset($media))
            {
                echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
            }
            else
            {
                echo 'class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media"';
            }
            ?>>
                <div class="wp-menu-arrow"><div></div></div>
                <div class='wp-menu-image'>
                <img src="<?php echo IMAGES_ADMIN;?>/media.png" alt="" />
                </div>
                <div class='wp-menu-name'>Quản lý Craw job</div>
            </a>
        </li>
    <!--end advertise-->
    <!--voucher-->
        <!--<li <?php
        if(isset($voucher))
        {
            echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
        }
        else
        {
            echo 'class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_tinhchat-option"';
        }
        ?>
        id="toplevel_page_tinhchat-option">
            <a href='<?php echo base_url();?>admin/voucher'
            <?php
            if(isset($voucher))
            {
                echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
            }
            else
            {
                echo 'class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media"';
            }
            ?>>
                <div class="wp-menu-arrow"><div></div></div>
                <div class='wp-menu-image'>
                <img src="<?php echo IMAGES_ADMIN;?>/media.png" alt="" />
                </div>
                <div class='wp-menu-name'>Quản lý khuyến mãi</div>
            </a>
        </li>-->
    <!--end voucher-->
    <!--Log system-->
        <li <?php
        if(isset($log_default))
        {
            echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
        }
        else
        {
            echo 'class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_tinhchat-option"';
        }
        ?>
        id="toplevel_page_tinhchat-option">
            <a href='<?php echo base_url();?>admin/log'
            <?php
            if(isset($log_default))
            {
                echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
            }
            else
            {
                echo 'class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media"';
            }
            ?>>
                <div class="wp-menu-arrow"><div></div>
                </div>
                <div class='wp-menu-image'>
                <img src="<?php echo IMAGES_ADMIN;?>/user-log.png" alt="" /></div>
                <div class='wp-menu-name'>Quản lý log
                </div>
            </a>
            <ul class="wp-submenu wp-submenu-wrap">
                <li class="wp-first-item <?php if(isset($log)) echo 'current';?>"><a href="<?php echo base_url();?>admin/log" class="wp-first-item current">Quản lý log</a>
                </li>
                <li class="wp-first-item <?php if(isset($unlogined)) echo 'current';?>"><a href="<?php echo base_url();?>admin/log/unlogined" class="wp-first-item current">Đăng nhập không thành công</a>
                </li>
            </ul>
        </li>
    <!--end Log system-->
    <!--Email customer-->
        <!-- <li <?php
        if(isset($email_default))
        {
            echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
        }
        else
        {
            echo 'class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_tinhchat-option"';
        }
        ?>
        id="toplevel_page_tinhchat-option">
            <a href='<?php echo base_url();?>admin/email'
            <?php
            if(isset($email_default))
            {
                echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
            }
            else
            {
                echo 'class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media"';
            }
            ?>>
                <div class="wp-menu-arrow"><div></div>
                </div>
                <div class='wp-menu-image'>
                <img src="<?php echo IMAGES_ADMIN;?>/user-log.png" alt="" /></div>
                <div class='wp-menu-name'>Quản lý Email
                </div>
            </a>
        </li> -->
    <!-- end Email customer -->
    <!--Languages -->
        <!-- <li <?php
        if(isset($languages_defautl))
        {
            echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
        }
        else
        {
            echo 'class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_tinhchat-option"';
        }
        ?>
        id="toplevel_page_tinhchat-option">
            <a href='<?php echo base_url();?>admin/language'
            <?php
            if(isset($languages_defautl))
            {
                echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
            }
            else
            {
                echo 'class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media"';
            }
            ?>>
                <div class="wp-menu-arrow">
                    <div></div>
                </div>
                <div class='wp-menu-image'>
                    <img src="<?php echo IMAGES_ADMIN;?>/eng01.gif" alt="" width="16" height="16" />
                </div>
                <div class='wp-menu-name'>Quản lý ngôn ngữ</div>
            </a>
        </li> -->
    <!--end Languages-->
    <!--tools-->
        <li <?php
        if(isset($tools_default))
        {
            echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
        }
        else
        {
            echo 'class="wp-has-submenu wp-not-current-submenu menu-top toplevel_page_tinhchat-option"';
        }
        ?>
        id="toplevel_page_tinhchat-option">
            <a href='<?php echo base_url();?>admin/tool'
            <?php
            if(isset($tools_default))
            {
                echo 'class="wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-page"';
            }
            else
            {
                echo 'class="wp-has-submenu wp-not-current-submenu menu-top menu-icon-media"';
            }
            ?>>
                <div class="wp-menu-arrow"><div></div>
                </div>
                <div class='wp-menu-image'>
                <img src="<?php echo IMAGES_ADMIN;?>/tool.png" alt="" /></div>
                <div class='wp-menu-name'>Công cụ quản trị
                </div>
            </a>
            <ul class="wp-submenu wp-submenu-wrap">
                <li class="wp-first-item <?php if(isset($tool)) echo 'current';?>"><a href="<?php echo base_url();?>admin/tool" class="wp-first-item current">Xuất database</a>
                </li>
                <li class="wp-first-item <?php if(isset($clear_cache)) echo 'current';?>"><a href="<?php echo base_url();?>admin/tool/clear_cache" class="wp-first-item current">Xóa bộ nhớ đệm</a>
                </li>
            </ul>
        </li>
    <!--end tools-->
    </ul>
<script type="text/javascript">
</script>