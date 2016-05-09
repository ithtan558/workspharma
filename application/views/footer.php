<!-- Modal view cv online -->
<div id="cv-modal" class="modal fade cv-modal" tabindex="-1" style="display: none;"></div>
<!-- Modal apply -->
<div id="apply-modal" class="modal fade apply-modal" tabindex="-1" style="display: none;"></div>
<!-- Modal apply -->
<div id="invite-modal" class="modal fade invite-modal" tabindex="-1" style="display: none;"></div>
<!-- Modal Alert -->
<div class="modal fade " tabindex="-1" role="dialog" id="alert-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <p><?php echo $this->lang->line('Please choose at least one job'); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Alert -->
<div class="modal fade " tabindex="-1" role="dialog" id="alert-modal-accept">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <p><?php echo $this->lang->line('Accept email subscribe successful'); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Delete -->
<div class="modal fade" tabindex="-1" role="dialog" id="delete-modal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <p id="modal-delete-message"><?php echo $this->lang->line('Do you really want to perform the operation?'); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?php echo $this->lang->line('Cancel'); ?></button>
                <button id="deleteBtn" type="button" class="btn btn-sm btn-primary"><?php echo $this->lang->line('Delete'); ?></button>
            </div>
        </div>
    </div>
</div>
<footer>

    <div class="container">

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">

                <p>

                    <a href="<?php echo URL.$this->lang->line('l_about_workspharma'); ?>"><?php echo $this->lang->line('About WorksPharma') ?></a>| 

                    <a href="<?php echo URL.$this->lang->line('l_contact'); ?>"> <?php echo $this->lang->line('Contact') ?> </a>| 

                    <a href="<?php echo URL.$this->lang->line('l_service'); ?>"> <?php echo $this->lang->line('Services') ?> </a>| 

                    <a href="<?php echo URL.$this->lang->line('l_help'); ?>"> <?php echo $this->lang->line('Help') ?> </a>| 

                    <a href="<?php echo URL.$this->lang->line('l_news'); ?>"> <?php echo $this->lang->line('News') ?></a>

                </p>

            <div class="col-md-12 col-sm-12 col-xs-12">

                <h5>Copyright © 2015 by <a href="http://www.workspharma.com">http://www.workspharma.com.</a> All rights reserved.</h5>

            </div>

            </div>

        </div>

    </div>

</footer><!-- end footer -->
<script>

    $('#myCarousel').carousel({

        interval:   7000

    });

</script>