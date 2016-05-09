<div class="wrap-intro" style="margin: 50px 0">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
            <?php
                if ($msg = $this->session->flashdata('flash_message')) {
                    showMessage2($msg);
                }else{
                    redirect('/');
                }
            ?>
            </div>
        </div>

    </div>
    <!-- /.container -->
</div> <!-- wrap intro -->