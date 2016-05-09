    var frmMyJob = document.frm;
/*checkbox delete tat ca*/
//job
    function toggle(source) {
        checkboxes = document.getElementsByName('job[]');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
    }

    function onDelMyJob() {
        if (checkedJobtrackers()) {
            $("#deleteBtn").unbind("click");
            $('#deleteBtn').on("click", function () {
                $('#frmMyJob').submit();
            });
            $('#delete-modal').modal('show');
        }
    }

    function checkedJobtrackers() {
        if (!anyCheckOrUncheckBox(frmMyJob.job, 1)) {
            $('#alert-modal').modal('show');
            return false;
        }
        return true;
    }
//resume
    function toggleResume(source) {
        checkboxes = document.getElementsByName('resume[]');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
    }

    function onDelMyResume() {
        if (checkedResumetrackers()) {
            $("#deleteBtn").unbind("click");
            $('#deleteBtn').on("click", function () {
                $('#frmMyResume').submit();
            });
            $('#delete-modal').modal('show');
        }
    }

    function checkedResumetrackers() {
        if (!anyCheckOrUncheckBox(frmMyResume.resume, 1)) {
            $('#alert-modal').modal('show');
            return false;
        }
        return true;
    }
// message
    function toggleMessage(source) {
        checkboxes = document.getElementsByName('message[]');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
    }

    function onDelMyMessage() {
        if (checkedMessagetrackers()) {
            $("#deleteBtn").unbind("click");
            $('#deleteBtn').on("click", function () {
                $('#frmMyMessage').submit();
            });
            $('#delete-modal').modal('show');
        }
    }

    function checkedMessagetrackers() {
        if (!anyCheckOrUncheckBox(frmMyMessage.message, 1)) {
            $('#alert-modal').modal('show');
            return false;
        }
        return true;
    }

    function anyCheckOrUncheckBox(obj, isCheck) {
        var _isCheck = (isCheck == 0) ? false : true;

        if (typeof(obj) == 'undefined') return false;

        num_item = $(obj).length;
        if (num_item > 1) {
            for (i = 0; i < num_item; i++) {
                if (obj[i].checked == _isCheck) {
                    return true;
                }
            }
            return false;
        }
        else {
            return (obj.checked == _isCheck);
        }
    };

    function checkAllBox(obj, checked) {
        var _checked = (checked == 0) ? false : true;

        num_item = $(obj).length;
        if (num_item > 1) {
            for (i = 0; i < num_item; i++) {
                obj[i].checked = _checked;
            }
        }
        else {
            if (typeof obj != 'undefined') obj.checked = _checked;
        }
    }

    // BootstrapDialog
    function modal(element, title, message, type) {
        if (type == 'alert') {
            BootstrapDialog.alert({
                title: title,
                message: message,
                closable: true,
                cssClass: 'btn-primary',
                callback: function (result) {
                    return result;
                }
            });
        } else if (type == 'confirm') {
            var href = $(element).attr('href');
            var dlg = new BootstrapDialog({
                title: title,
                message: message,
                closable: false,
                buttons: [{
                    label: 'Yes',
                    cssClass: 'btn-primary',
                    id: 'btnYes',
                    action: function (dialog) {
                        window.location.href = href;
                        dialog.close();
                    }
                },
                    {
                        label: 'No',
                        cssClass: 'btn',
                        id: 'btnNo',
                        action: function (dialog) {
                            dialog.close();
                        }
                    }]
            });

            dlg.open();
        }
        return false;
    }
    $(document).ready(function() {
        //tooltip
        $('[data-toggle="tooltip"]').tooltip()

        $.validator.addMethod("greaterThan",
            function (value, element, param) {
              var $min = $(param);
              if (this.settings.onfocusout) {
                $min.off(".validate-greaterThan").on("blur.validate-greaterThan", function () {
                  $(element).valid();
                });
              }
              return parseInt(value) > parseInt($min.val());
            }, GREATERTHAN);


        /*Huynh An*/

        $("#form-accept-email").validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("type") == "radio" ) { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                } else if (element.attr("name") == "dd" || element.attr("name") == "mm" || element.attr("name") == "yyyy") {
                    error.insertAfter($(element).closest('.form-group').children('div'));
                } else if (element.attr("type") == "file" ) {
                    error.insertAfter($(element).closest('.form-group').children('div').last());
                } else if (element.attr("type") == "checkbox" ) {
                    error.appendTo($(element).closest('.form-group'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
            highlight: function (element) {
                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                // add the Bootstrap error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error');
                // set error class to the control group
            },
            success: function (label, element) {
                label.addClass('help-block valid');
                // mark the current input as valid and display OK icon
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
            },
            rules: {
                "email" : {
                    required : true,
                    email : true,
                    minlength:5,
                },
            },
            messages: {
                "email":{
                    required : REQUIRE,
                    email : VALID_EMAIL,
                    minlength : MIN_LENGTH,
                }
            },
            submitHandler: function (form) {
                $('.btn-accept-email').attr('disable');
                $('body').append('<div class="loader"><div class="overlay-loading"></div><div class="loading-2"></div></div>');
                var url = $("#form-accept-email").attr('action');
                var email = $('#email').val();
                var category = [];
                $('#category1 :selected').each(function(){
                    category[$(this).val()]=$(this).text();
                });
                var city = [];
                $('#city1 :selected').each(function(){
                    city[$(this).val()]=$(this).text();
                });
                var form = $(form).serialize();
                $.ajax({
                    type : "POST",
                    url : url,
                    data : form,
                    success:function(result){
                        var data = $.parseJSON(result);
                        $('.loader').remove();
                        if(data.status == "success") {
                            BootstrapDialog.alert('Subrices email successfull');
                        }else if(data.status == 'error' || data.status == 'duplicate'){
                            BootstrapDialog.alert('Subrices email successfull');
                        }
                    }
                });
            }
        });
        $('body').on('click','.favourites',function(e){
            e.preventDefault();
            var $this=$(this);
            var id = $(this).attr('data-id');
            var redirect_url = $(this).attr('data-url');
            var element = $(this);
            if($(this).hasClass('loved')){
                var status = "remove";
            }else{
                var status = "add";
            }
            $.ajax({
                type : "POST",
                url : BASE_URL+"job/ajaxAddFavourites",
                data : {id : id,status:status},
                success:function(result){
                    var data = $.parseJSON(result);
                    if(data.message == "Not logged") {
                        window.open(BASE_URL+ 'dang-nhap/?next='+redirect_url,'_self');
                    }else if(data.status == 'success'){
                        if(element.hasClass('loved')){
                            element.removeClass('loved');
                        }else{
                            element.addClass('loved');
                        }
                        if(element.hasClass('loved')){
                            element.removeClass('glyphicon-heart-empty');
                            element.addClass('glyphicon-heart');
                        }
                        else{
                            element.removeClass('glyphicon-heart');
                            element.addClass('glyphicon-heart-empty');
                        }
                    }

                }
            });
        });
    });


    



