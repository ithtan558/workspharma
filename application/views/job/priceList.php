<?php $this->load->view('header_page');?>
<div class="container-fluid">
    <form action="" method="POST" id="frm-invoice" class="smart-wizard">
    <div class="container no-padding container-invoice swMain">
        <!--<div class="process-bar">
            <img src="<?php /*echo image_url('bar-invoice.jpg')*/?>">
        </div>-->
        <ul class="anchor">
            <li>
                <a href="#step-1" class="done" isdone="1" rel="1">
                    <div class="stepNumber"> 1 </div>
                    <span class="stepDesc"> Post job <br>
                    <!--<small>Step 1 description</small>--> </span>
                </a>
            </li>
            <li>
                <a href="#step-2" class="selected" isdone="0" rel="2">
                    <div class="stepNumber"> 2 </div>
                    <span class="stepDesc"> Payment <br>
                    <!--<small>Step 2 description</small>--> </span>
                </a>
            </li>
            <li>
                <a href="#step-3" class="disabled" isdone="0" rel="3">
                    <div class="stepNumber"> 3 </div>
                    <span class="stepDesc"> Finish <br>
                    <!--<small>Step 3 description</small>--> </span>
                </a>
            </li>
        </ul>

        <div class="col-sm-12">
            <div class="box-message">
                <?php
                if ($msg = $this->session->flashdata('flash_message')) {
                    showMessage2($msg);
                }
                ?>
            </div>
            <div class="col-sm-12" style="padding-left: 170px;">
                <div id="step-2" class="step-content">
                    <ul class="pricing_table">
                        <li class=" price_info">
                            <div class="callto-price" style="height: 100px;">
                            </div>
                            <ul class="features">
                                <li title=""><?php echo $this->lang->line('Number of records')?><i class="fa fa-question-circle"></i></li>
                                <li title=""><?php echo $this->lang->line('Pay now')?><i class="fa fa-question-circle"></i></li>
                            </ul>
                        </li>

                        <!--<li class="price_block price-popular">
                            <h3>Free</h3>
                            <div class="price">
                                <div class="price_figure">
                                    <span class="price_number">$0</span>
                                </div>
                            </div>
                            <ul class="features">
                                <li><?php /*echo $this->lang->line('Unlimited')*/?></li>
                                <li><i class=""></i></li>
                            </ul>
                            <div class="price-footer">
                                <button type="submit" data-id="1" name="btn_payment" value="btn_payment" class="btn btn-default btn-primary btn-popular menu-regis btn-payment">Post now</button>
                            </div>
                        </li>-->
                        <li class="price_block price-professional" style="width: 35%">
                            <h3>Basic</h3>
                            <div class="price">
                                <div class="price_figure">
                                    <span class="price_number">$100<sub>/ <span>30 days</span> </sub></span>
                                </div>
                            </div>
                            <ul class="features">
                                <li><?php echo $this->lang->line('Unlimited')?></li>
                                <li><i class="glyphicon glyphicon-ok"></i></li>
                            </ul>
                            <div class="price-footer">
                                <button type="submit" data-id="2" name="btn_payment" value="btn_payment" class="btn btn-default btn-primary btn-popular menu-regis btn-payment">Post now</button>
                            </div>
                        </li>
                       <!-- <li class="price_block price-unlimit">
                            <h3>VIP</h3>
                            <div class="price">
                                <div class="price_figure">
                                    <span class="price_number">$100<sub>/ <span>30 days</span> </sub></span>

                                </div>
                            </div>
                            <ul class="features">
                                <li><?php /*echo $this->lang->line('Unlimited')*/?> </li>
                                <li><i class=""></i></li>
                            </ul>
                            <div class="price-footer">
                                <button type="submit" data-id="3" name="btn_payment" value="btn_payment" class="btn btn-default btn-primary btn-unlimit menu-regis btn-payment">Post now</button>
                            </div>
                        </li>-->
                        <input name="package_id" id="package_id" type="hidden" value="">
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
    <script>
        $(document).ready(function(){
            $('.btn-payment').click(function(){
                var val = $(this).data('id');
                $('#package_id').val(val);
            });

            $("#frm-invoice").validate({
                errorElement: "span", // contain the error msg in a span tag
                errorClass: 'help-block',
                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                        error.insertAfter($(element).closest('.form-group').children('.help-block'));
                        //error.appendTo($(element).closest('.form-group').children('.help-block'));
                        //error.appendTo($(element).closest('.form-group').children('div').last());
                    } else {
                        error.insertAfter(element);
                        // for other inputs, just perform default behavior
                    }
                },
                highlight: function (element) {
                    $(element).closest('.help-block').removeClass('valid');
                    // display OK icon
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                    $(element).after("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
                    // add the Bootstrap error class to the control group
                    if ($(element).attr("type") != "radio" || $(element).attr("type") != "checkbox") {
                        $(element).closest('.form-group').find(".glyphicon-ok").remove();
                    }

                },
                unhighlight: function (element) { // revert the change done by hightlight
                    $(element).closest('.form-group').removeClass('has-error');

                    // set error class to the control group
                },
                success: function (label, element) {
                    label.addClass('help-block');
                    // mark the current input as valid and display OK icon
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
                    $(element).after("<span class='glyphicon glyphicon-ok form-control-feedback'></span>");
                    if ($(element).attr("type") != "radio" || $(element).attr("type") != "checkbox") {
                        $(element).closest('.form-group').find(".glyphicon-ok").remove();
                    }
                },
                rules:{

                },
                messages:{

                },
                submitHandler: function (form) {
                    $('.btn-payment').attr('disable');
                    $('body').append('<div class="loader"><div class="overlay-loading"></div><div class="loading-2"></div></div>');
                    form.submit();
                }
            });

        });
    </script>
<?php $this->load->view('footer_page'); ?>