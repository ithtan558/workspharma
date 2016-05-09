<?php echo $this->load->view('search/main'); ?>
<div class="body_page">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="chi-tiet-tin">
                        <div class="title_header">
                            <h3><?php echo stripslashes($jobs->title);?></h3>
                        </div>
                        <div class="body_mo">
                            <div class="row">
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <?php
                                    if($msg = $this->session->flashdata('error_applyjob')) {
                                        echo '<div class="box-message">';
                                        showMessage2($msg);
                                        echo '</div>';
                                    }
                                    ?>
                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-12 no-padding">
                                            <div class="alert alert-success" hidden="hidden" id="alert-refer-to-friend-success" style="">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <p class="text-lg">
                                                    <?php echo $this->lang->line('Work'); ?> <strong>"<?php echo $jobs->title ?>"</strong> <?php echo $this->lang->line('have been introduced successfully'); ?>.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <h4><?php echo stripslashes($jobs->title);?></h4>
                                    <p>
                                        <b><?php echo $this->lang->line('Company') ; ?> : </b>
                                        <?php
                                            if($jobs->hide_infomation==1){
                                            ?>
                                            <span class="error"><?php echo $this->lang->line('Information has to be secured by the employer'); ?></span>
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <a href="#" class="link_cty"><?php echo $jobs->company?></a>
                                            <?php
                                        }
                                        ?>
                                    </p>
                                    <p><b><?php echo $this->lang->line('Address') ; ?></b> : <?php echo get_city($jobs->city_ids)?></p>
                                    <p><b><?php echo $this->lang->line('Quantity') ; ?></b> : <?php echo $jobs->qty?></p>
                                    <p><b><?php echo $this->lang->line('Salary') ; ?></b> : <?php echo get_salary($jobs->salary).' '. $this->lang->line('currency unit');?>
                                    </p>
                                    <?php
                                    $array_favourites = getJobFavourites();
                                    if($array_favourites && (in_array($jobs->id,$array_favourites))){
                                        $favourites = "glyphicon-heart loved";
                                    }else{
                                        $favourites = "glyphicon-heart-empty";
                                    }
                                    ?>
                                    <?php
                                    $flag_role=0;
                                    if($this->session->userdata('user_id')){
                                        if($this->session->userdata('role_id')==2) {
                                            $flag_role=1;
                                        }
                                    }
                                    if($flag_role==0){
                                        ?>
                                        <div class="share-send">
                                            <a class="color-gray f12-m"
                                               data-id=<?php echo $this->encrypt->encode($jobs->id); ?> alt="Save job">
                                            <span class="favourites glyphicon <?php echo $favourites; ?>"
                                                  data-id="<?php echo $this->encrypt->encode($jobs->id);?>"
                                                  data-url="<?php echo current_url(); ?>"></span>
                                            <i><?php echo $this->lang->line('Save job');?></i>
                                            </a>
                                            |
                                            <a href="javascript:fbShare('<?php echo current_url();?>', 'Fb Share', 'Facebook share popup', 'http://goo.gl/dS52U', 520, 350)" class="color-gray f12-m share-facebook" title="<?php echo $this->lang->line('Share to facebook');?>">
                                                <i class="fa fa-facebook"></i>
                                                <i><?php echo $this->lang->line('Share to facebook');?></i>
                                            </a>
                                            |
                                            <a class="popover-refer color-gray f12-m" data-id="<?php echo $this->encrypt->encode($jobs->id) ?>" data-original-title="" title="">
                                                <i class="glyphicon glyphicon-send"></i>
                                                <i><?php echo $this->lang->line('Send to your friend'); ?></i>
                                            </a>
                                            |
                                            <a class="popover-refer color-gray f12-m" target="_blank" href="<?php echo URL.$this->lang->line('l_job').'/'.$this->lang->line('l_print').'/'.$jobs->id ?>" data-original-title="" title="">
                                                <i class="glyphicon glyphicon-print"></i>
                                                <i><?php echo $this->lang->line('Print'); ?></i>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="line">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <?php
                                                if(isset($getApply))
                                                {
                                                    ?>
                                                    <span style="float:right;" class="applied"><?php echo $this->lang->line('Applied') ?></span>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <button href="<?php echo URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_apply').'/?idJob='.$this->encrypt->encode($jobs->id); ?>" type="button" class="btn btn-success btn-view-apply" style="float:right;"><?php echo $this->lang->line('Apply'); ?></button>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <h3><?php echo $this->lang->line('Description detail job'); ?></h3>
                                    <?php echo $jobs->description; ?>
                                    <h3><?php echo $this->lang->line('exprience/skill'); ?></h3>
                                    <?php echo $jobs->experience_skill; ?>
                                    <h3><?php echo $this->lang->line('Description'); ?></h3>
                                    <ul class="mo_ta_ct">
                                        <li><?php echo $this->lang->line('Nghanh nghe viec lam'); ?></li>
                                            <ul>
                                            <?php
                                                $array_job_categories = explode(",",$jobs->category_ids);
                                                foreach($getCategories->result() as $item){
                                                    if(in_array($item->id,$array_job_categories)){
                                                        ?>
                                                        <li>
                                                            <a style="margin-bottom:3px;" href="<?php echo URL.'skills/keywords/'.$item->category_name;?>"><?php echo $item->category_name?></a>
                                                        </li>
                                                    <?php }
                                                }
                                                ?>
                                            </ul>
                                        <li><?php echo $this->lang->line('Level'); ?> : <?php echo get_level($jobs->level_id)?></li>
                                        <li><?php echo $this->lang->line('Noi lam viec'); ?></li>
                                            <ul>
                                                <?php echo get_city_li($jobs->city_ids);?>
                                            </ul>
                                        <li><?php echo $this->lang->line('Education'); ?>: <?php echo get_education($jobs->education_id)?></li>
                                        <li><?php echo $this->lang->line('Experience'); ?>: <?php echo get_exp($jobs->year_exp)?></li>
                                        <li><?php echo $this->lang->line('Type job'); ?>: <?php echo get_type_job($jobs->type_id)?></li>
                                        <li><?php echo $this->lang->line('Age').': '. $jobs->fromage. ' - '.$jobs->toage?></li>
                                        <li><?php echo $this->lang->line('Sex'); ?>: <?php echo get_gender($jobs->gender)?></li>
                                    </ul>
                                    <h3><?php echo $this->lang->line('Infomation contact'); ?></h3>
                                    <ul class="mo_ta_ct">
                                    <?php
                                    if($jobs->hide_infomation==1){
                                        ?>
                                            <li class="error"><?php echo $this->lang->line('Note'). ' : '.$this->lang->line('Information has to be secured by the employer'); ?></li>
                                        <?php
                                    }
                                    else{
                                        ?>
                                            <li><?php echo $this->lang->line('Type contact'); ?>: <?php echo get_type_contact($jobs->type_contact)?></li>
                                            <li><span>- Chỉ nhận thông qua email: <i><?php echo $jobs->email_contact;?></i></span></li>
                                            <li><?php echo $this->lang->line('Name contact'); ?>: <?php echo $jobs->name_contact;?></li>
                                        <?php
                                    }
                                    ?>
                                    </ul>
                                    <p class="nhan_ho_so">** <?php echo $this->lang->line('Language contact'); ?>: <i><?php echo get_language($jobs->language_contact) ?></i></p>
                                    <p class="ngay_nhan_ho_so"><?php echo $this->lang->line('Date send'); ?>: <span><?php echo date('d/m/Y',strtotime($jobs->jdate_created)); ?></span> <?php echo $this->lang->line('Date finish'); ?>: <span><?php echo date('d/m/Y',strtotime($jobs->date_expiration)); ?></span></p>
                                    <div class="line">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <?php
                                                if(isset($getApply))
                                                {
                                                    ?>
                                                    <span style="float:right;" class="applied"><?php echo $this->lang->line('Applied') ?></span>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <button href="<?php echo URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_apply').'/?idJob='.$this->encrypt->encode($jobs->id); ?>" type="button" class="btn btn-success btn-view-apply" style="float:right;"><?php echo $this->lang->line('Apply'); ?></button>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="info_cty"><b><?php echo $this->lang->line('Company') ; ?> : </b>
                                        <?php
                                        if($jobs->hide_infomation==1){
                                            ?>
                                            <span class="error"><?php echo $this->lang->line('Information has to be secured by the employer'); ?></span>
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <a href="#" class="link_cty"><?php echo $jobs->company?></a>
                                            <?php
                                        }
                                        ?>
                                        <div class="col-lg-12 no-padding">
                                            <div class="col-lg-12 text-center padding-bottom">
                                                <div style="margin:0 auto;" class="avatar-user">
                                                    <a>
                                                        <img src="<?php if ((is_file_exists($creatorInfo->elogo, 'logos') == TRUE) && ($creatorInfo->elogo != "")) echo base_url() . 'files/logos/' . $creatorInfo->elogo; else echo image_default(); ?>"
                                                             alt="Add Thumbnail">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <p><b><?php echo $this->lang->line('Dia chi'); ?> </b>: <?php echo $jobs->address;?></p>
                                        <p><b><?php echo $this->lang->line('Website'); ?> </b>: <?php echo $jobs->website;?></p>
                                        <p><b><?php echo $this->lang->line('tong so nhan vien'); ?> </b>: <?php echo get_num_staff($jobs->num_of_staff) ?></p>
                                        <p><?php echo $creatorInfo->description;?></p>
                                        <?php
                                                if($sameToJobs->num_rows()>0){
                                                    ?>
                                                    <div class="no-padding color-blue padding-top"><b><?php echo $this->lang->line('More jobs from').' '.displayUserName($creatorInfo->user_name,$creatorInfo->company);?></b></div>
                                                    <?php
                                                }
                                            ?>
                                            <div class="no-padding list-job-employer">
                                                <?php
                                                if($sameToJobs->num_rows()>0){
                                                    echo '<ul class="no-padding">';
                                                    foreach ($sameToJobs->result() as $item) {
                                                        # code...
                                                        $link = URL.$this->lang->line('l_detail').'/'.$item->alias.'-'.$item->id;
                                                        ?>
                                                        <li>
                                                            <a href="<?php echo $link;?>">- <?php echo $item->title; ?></a>
                                                        </li>
                                                    <?php
                                                    }
                                                    echo '</ul>';
                                                }
                                                ?>
                                            </div>
                                            <div class=" no-padding list-images-employer">
                                                <?php
                                                if(isset($files) && $files->num_rows() > 0)
                                                {
                                                    $dem=0;
                                                    foreach($files->result() as $item){
                                                        ?>
                                                            <div class="">
                                                                <div>
                                                                    <?php
                                                                    $file_type = explode('/', $item->file_type);
                                                                    if(is_file_exists('', '', $item->path)){
                                                                        echo '<a class="fancybox" data-fancybox-group="gallery" href="'.file_url($item->path).'" target="_blank"><img src="'.file_url($item->path).'" class="img-responsive"></a>';
                                                                    }else{
                                                                        echo '<a class="fancybox" data-fancybox-group="gallery" href="'.file_url($item->path).'" target="_blank"><img src="'.image_url('file_default.png').'" class="img-responsive"></a>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        if($dem==3)break;
                                                        $dem++;
                                                    }
                                                }
                                                ?>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end 9 Nhóm ngành nghề -->
                </div><!-- end body left -->
                <!-- Begin body right -->
                <div class="col-md-3 col-sm-3 col-xs-12 pv_viec_lam">
                    <div class="form-right2">
                        <h5><?php echo $this->lang->line('Employment suits you'); ?></h5>
                        <ul>
                        <?php
                        if(isset($same_jobs)){
                            foreach ($same_jobs->result() as $item) {
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
                <!-- end body right -->
            </div>
        </div>
    </div><!-- end body page -->
    <script type="text/javascript">
    $(document).ready(function() {
        $('body').on('click','.btn-view-apply',function(event) {
            var $this = $(this);
            var $url = $this.attr('href');
            window.open($url,'_self');
        });
    });
    </script>
    <script type="text/javascript">
    function fbShare(url, title, descr, image, winWidth, winHeight) {
        var winTop = (screen.height / 2) - (winHeight / 2);
        var winLeft = (screen.width / 2) - (winWidth / 2);
        window.open('http://www.facebook.com/sharer.php?s=100&p[title]=' + title + '&p[summary]=' + descr + '&p[url]=' + url + '&p[images][0]=' + image, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
    }

    function checkRequired(_a, _b) {
        if (_b == null) {
            _b = "err_" + _a.name;
        }
        objErr = document.getElementById(_b);
        objErr.style.display = "none";
        var s = _a.value;
        if (trim(s) == "") {
            return errorAlert(_a, _b);
        }
        return true;
    }

    function ltrim(a) {
        var b = /^\s */;
        return a.replace(b, "");
    }

    function rtrim(a) {
        var b = /\s *$/;
        return a.replace(b, "");
    }

    function trim(a) {
        return ltrim(rtrim(a));
    }

    function errorAlert(a, b) {
        objErr = document.getElementById("err_top");
        if (objErr != null) {
            objErr.style.display = "";
        }
        if (b == null) {
            b = "err_" + a.name;
        }
        objErr = document.getElementById(b);
        objErr.style.display = "";
        return false;
    }

    function checkEmail(obj, a) {
        if (a == null) {
            a = "err_" + obj.name;
        }
        objErr = document.getElementById(a);
        objErr.style.display = "none";
        var s = trim(obj.value);
        if (!_checkEmail(s)) {
            return errorAlert(obj, a);
        }
        return true;
    }

    function _checkEmail(st) {
        var a = "^[_a-zA-Z0-9-]+(\\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\\.[a-zA-Z0-9-]+)*(\\.[a-zA-Z]{2,8})$";
        var b = new RegExp(a);
        return b.exec(st);
    }
    function showResponseReferralForm(data) {
        if (data.status == 'REDIRECT') {
            window.location.href = data.redirectUrl;
        } else if (data.status == 'VALIDATION_ERROR' || data.status == 'ERROR') {
            $('#errorAlertPopup').slideDown();
            setTimeout(function () {
                $('#errorAlertPopup').slideUp();
            }, 5000);
        }else if(data.status == 'SUCCESS'){
            $('#friendNameJR').html(data.firstName);
            $('#alert-refer-to-friend-success').slideDown();
            setTimeout(function () {
                $('#alert-refer-to-friend-success').slideUp();
            }, 5000);
        }
        $('#jobReferralFrm').parents('.popover-refer').popover('hide');
    }
    var frm_jr = document.jobReferralFrm;
    function checkValidFormJobReferral() {
        var frm_jr = document.jobReferralFrm;
        var has_error = false;
        $('#jobReferralFrm').find("div.error-message").attr('hidden','hidden');
        $('#jobReferralFrm').find(".has-error").removeClass('has-error');
        if (!checkRequired(frm_jr.emailJR,'errEmailJR')){
            $('#errEmailJR').removeAttr('hidden').parent().addClass('has-error');
            has_error = true;
        }//else if (!checkEmail(frm_jr.emailJR,'errValidEmailJR')){
            //$('#errValidEmailJR').removeAttr('hidden').parent().addClass('has-error');
            //has_error = true;
        //}
        if (!has_error) {
            return true;
        } else {
            return false;
        }
    }
    $(document).on('click', '.btn-refer', function () {
        $('body').append('<div class="loader"><div class="overlay-loading"></div><div class="loading-2"></div></div>');
        if (checkValidFormJobReferral()) {
            $('#jobReferralFrm').submit();
            
        }
        else{
            $('.loader').remove();
        }
    });
    var optionsJRFrm = {
        beforeSubmit: showRequestReferralForm,  // pre-submit callback
        success: showResponseReferralForm,  // post-submit callback
        type: 'post',        // 'get' or 'post', override for form's 'method' attribute
        dataType: 'json',        // 'xml', 'script', or 'json' (expected server response type)
        data: { idJobs: '<?php echo $this->encrypt->encode($jobs->id) ?>',referral: 'jobDescription'}
    };
    function submitJobReferralFrm(){
        //e.preventDefault(); // <-- important
        $('#jobReferralFrm').ajaxSubmit(optionsJRFrm);
        return false;
    }
    // pre-submit callback
    function showRequestReferralForm(formData, jqForm, optionsJRFrm) {
        return true;
    }
    function showResponseReferralForm(data) {
        //var res= $.parseJSON(data);
        if(data.result == 'success'){$('.loader').remove();
            $('#friendNameJR').html(data.firstName);
            $('#alert-refer-to-friend-success').slideDown();
            setTimeout(function () {
                $('#alert-refer-to-friend-success').slideUp();
            }, 5000);
        }
        else{
            $("#login-modal").modal('show');
        }
        $('#jobReferralFrm').parents('.popover-refer').popover('hide');
    }
    $(document).ready(function() {
        //auto load modal apply after login
                $('.popover-refer').each(function () {
            var $this = $(this);
            $this.popover({
                html: true,
                trigger: 'manual',
                title: 'Giới thiệu việc làm này cho bạn bè',
                content: '<form id="jobReferralFrm" onsubmit="return submitJobReferralFrm();" name="jobReferralFrm" method="post" action="'+BASE_URL+'job/shareForFriend">' +
                    '<div class="form-group"><input class="form-control" name="emailJR" type="text" placeholder="Email" /><div id="errEmailJR" hidden="hidden" class="error-message">Thông tin này bắt buộc</div><div id="errValidEmailJR" hidden="hidden" class="error-message">Email không hợp lệ.</div></div>' +
                '<div class="form-group pull-right"><button type="button" class="btn btn-sm btn-primary btn-refer">Giới thiệu</button></div></form>' +
                    '<button type="button" class="close close-refer-popover" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
                placement: 'bottom',
                container: $this
            });

            var popoverShowTimeOut, popoverHideTimeOut;
            var shown = false;
            $this.on('mouseenter', function () {
                clearTimeout(popoverHideTimeOut);
                if (shown == false) {
                    popoverShowTimeOut = setTimeout(function () {
                        $this.popover('show');
                        shown = true;
                    }, 400)
                }
            }
            ).on('mouseleave', function () {
                clearTimeout(popoverShowTimeOut);
                popoverHideTimeOut = setTimeout(function () {
                    var hasContent;
                    $this.find('input').each(function () {
                        if (!$(this).val().trim() == "") {
                            hasContent = true;
                            return false;
                        }
                    });
                    if (!hasContent) {
                        $this.popover('hide');
                        shown = false;
                    }
                }, 400);

            })
        });
    });

    $(document).on('click','.close-refer-popover',function(){
        $(this).parents('.popover-refer').popover('hide');
    })
</script>
