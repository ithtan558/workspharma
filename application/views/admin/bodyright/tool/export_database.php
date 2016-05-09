
<div class="box">
    <div class="heading">
      <h1 style="float:left">Xuất file Excel</h1>
      <div class="buttons"><a class="button" id="cancel" onclick="javascript:submitbutton('cancel');">Thoát</a></div>
      <div class="buttons"><a class="button" id="save" onclick="javascript:submitbutton('save');">Xuất</a></div>
    </div>
    <div class="content">
      <div class="vtabs">
          <a href="#tab-order" class="selected">Export</a>
      </div>
      <div id="tab-order" class="vtabs-content">
      	<form method="post" action="<?php echo URL;?>admin/tool/export_database" enctype="multipart/form-data" class="origin_setting" name="adminForm" id="adminForm" accept-charset="utf-8" novalidate="novalidate">
        	<input type="hidden" name="url" value="<?php echo $this->uri->segment(2);?>" id="url">
        </form>
      </div>
    </div>
</div>
