<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <title><?php if(isset($title))echo $title;?></title>
        <meta http-equiv="Content-Language" content="vi">
        <meta name="robots" content="all">
        <meta name="author" content="<?php if(isset($author)) echo $author?>">
        <meta name="contact" content="<?php if(isset($contact)) echo $contact?>">
        <meta name="copyright" content="<?php if(isset($copyright)) echo $copyright?>">
        <meta name="description" content="<?php if(isset($description)) echo $description;?>">
        <meta name="keywords" content="<?php if(isset($keywords)) echo $keywords;?>">
        <meta property="og:image" content="<?php if(isset($thumb_images)) echo $thumb_images;?>">
        <meta property="og:title" content="<?php if(isset($title)) echo $title;?>">
        <meta property="og:site_name" content="<?php if(isset($title)) echo $title;?>">
        <meta property="og:description" content="<?php if(isset($description)) echo $description;?>"
        <!-- Customizable CSS -->
        <link rel='stylesheet' href='<?php echo CSS;?>bootstrap.min.css' type='text/css' media='screen' />
        <link rel='stylesheet' href='<?php echo CSS;?>style.css' type='text/css' media='all' />
        <link rel="stylesheet" href="<?php echo CSS;?>bootstrap-datetimepicker.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo CSS;?>bootstrap-multiselect.css" type="text/css">
        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo IMAGES;?>favicon.ico">
        <script src="<?php echo JS; ?>jquery-2.1.1.js"></script>
        <script src="<?php echo JS; ?>jquery.form.js"></script>
        <script src="<?php echo JS; ?>bootstrap.min.js"></script>
        <script src="<?php echo JS; ?>bootstrap-dialog.js"></script>
        <script src="<?php echo JS; ?>moment.js"></script>
        <script src="<?php echo JS; ?>bootstrap-datetimepicker.js"></script>
        <script type="text/javascript" src="<?php echo JS; ?>jquery-validate.js"></script>
        <script type="text/javascript" src="<?php echo JS; ?>bootstrap-multiselect.js"></script>
        <script type="text/javascript" src="<?php echo JS; ?>bootstrap-multiselect-collapsible-groups.js"></script>
        <link rel="stylesheet" href="<?php echo CSS;?>bootstrap-dialog.min.css">
        <link rel="stylesheet" href="<?php echo CSS;?>font-awesome.min.css">
        <link href='<?php echo CSS;?>fonts.googleapis.css' rel='stylesheet' type='text/css'>
        <script type="text/javascript">
            var BASE_URL = '<?php echo URL; ?>';
            var REQUIRE = "<?php echo $this->lang->line('This field is required') ?>";
            var VALID_EMAIL = "<?php echo $this->lang->line('Please enter a valid email address.') ?>";
            var MIN_LENGTH = "<?php echo $this->lang->line('Email')." ".$this->lang->line('min_length'); ?>";
            var GREATERTHAN = "<?php echo $this->lang->line('Max must be greater than min'); ?>";
        </script>
    </head>
    <body id="top" class="home blog">
        <div class="background-cover"></div>
        <div class="">
            <?php $this->load->view('header'); ?>
            <?php $this->load->view($template); ?>     
            <?php $this->load->view('footer'); ?>
        </div>
        <script type="text/javascript" src="<?php echo JS; ?>script.js"></script>
    </body>
</html>