
<div class="box">
    <div class="heading">
      <h1 style="float:left">Thông tin craw dử liệu</h1>
      <div class="buttons"><a class="button" id="cancel" onclick="javascript:submitbutton('cancel');">Thoát</a></div>
    </div>
    <div class="content">
      <div class="vtabs">
          <a href="#tab-order" class="selected">Thông tin craw dử liệu</a>
      </div>
      <div id="tab-order" class="vtabs-content">
      	<form method="post" action="<?php echo URL;?>admin/craw/getDataWebsiteTimViecNhanh" enctype="multipart/form-data" class="origin_setting" name="adminForm" id="adminForm" method="post" accept-charset="utf-8" novalidate="novalidate">
            <input type="hidden" name="url" value="<?php echo $this->uri->segment(2);?>" id="url">
                <table class="table_admin">
                    <tbody>
                      <tr>
                        <td colspan="2">
                          <span class="span-success">
                            <?php
                              if($msg = $this->session->flashdata('flash_message')) {
                                  echo $msg;
                              }
                              ?>
                          </span>
                        </td>
                    </tr>
                      <tr>
                        <td>Link vietnamworks</td>
                        <td><input class="clsTextBox span12" type="text" name="link" value=""/></td>
                        <td>Quantity item</td>
                        <td><input class="clsTextBox span10" type="text" name="quantity" value=""/></td>
                        <td><button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok no-icon" name="submit" value="<?php echo $this->lang->line('Get data');?>">Get data</button></td>
                      </tr>
                    </tbody>
                </table>
            </form>
      </div>
    </div>
</div>
<style type="text/css">
  .content input[type="text"] {
      width: 90%;
      padding: 7px;
  }
</style>
