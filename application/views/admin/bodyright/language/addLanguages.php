


<div class="box">


    <div class="heading">


      <h1 style="float:left">Thêm ngôn ngữ</h1>


      <div style="float:right; padding-top:7px;">


      <a class="button" id="save" onclick="javascript:submitbutton('save');">Lưu lại</a>&nbsp;&nbsp;


      <a class="button" id="save_close" onclick="javascript:submitbutton('save_close');">Lưu lại và đóng</a>&nbsp;&nbsp;


     


      </div>


    </div>


    <div class="content">


      <div class="vtabs">


          <a href="#tab-order" class="selected">Thông tin ngôn ngữ</a>


      </div>


      <div id="tab-order" class="vtabs-content">


      	<form method="post" action="<?php echo URL;?>admin/language/check_add_languages" enctype="multipart/form-data" class="origin_setting" name="adminForm" id="adminForm" method="post" accept-charset="utf-8" novalidate="novalidate">


                <table class="table_admin">


                    <tbody>


                        <tr>


                            <td><span style="color:#0C9;"><?php if(isset($messages)) echo $messages;?></span></td>


                        </tr>


                        <tr class="alt-row">


                            <td>Mã ngôn ngữ</td>


                            <td><input name="code_languages" type="text" autofocus="autofocus"   /></td>


                        </tr>


                        <tr class="alt-row">


                            <td>Tên ngôn ngữ</td>


                            <td><input name="name_languages" type="text" autofocus="autofocus"   /></td>


                        </tr>


                        


                        <tr>


                        	<td>Bật</td>


                            <td><input name="enable_languages" type="radio" value="1" class="inputbox" >&nbsp;Có &nbsp;&nbsp;<input name="enable_languages" type="radio" value="0" class="inputbox" checked="checked">&nbsp;Không</td>


                        </tr>


                    </tbody>


                </table>


            <input type="hidden" name="t" value="save" id="t">


        </form>


      </div>


    </div>


</div>


