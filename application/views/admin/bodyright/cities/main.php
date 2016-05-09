    <form action="<?php echo base_url();?>admin/cities/remove_cities" method="post" id="from-tindang">
        <table class="TableGrid datatables" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
            <thead>
                <tr>
                    <th width="5%">Stt</th>
                    <th width="10%">Mã city</th>
                    <th width="10%">Tên city</th>
                    <th width="15%">
                        <input type="checkbox" onclick="toggle(this)" />&nbsp;<font color="#000000">Chọn tất cả</font>&nbsp;
                        <button type="submit" class="btn" name="btnDeleteall" onclick="return confirm('Are you sure you want to do that?');">
                            <span>Xóa</span>
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody>
            <?php
            $stt=1;
            foreach ($listCities as $row)
            {
            ?>
            <tr class="odd <?php if($stt%2!=0)echo 'tr_two';?>">
                <td  width="5%"><?php echo $stt?></td>
                <td  width="10%" ><?php echo $row->id?></td>
                <td  width="10%" ><a href="<?php echo URL.'admin/cities/index/'.$row->id;?>"><?php echo $row->city_name;?></a></td>
                <td width="15%">
                    <a id="edit-hoadon" href="<?php echo URL;?>admin/cities/edit_cities/<?php echo $row->id;?>">[&nbsp;Sửa&nbsp;]</a>
                    <input type="checkbox" name="delete[]" value="<?php echo $row->id;?>" />   
                </td>
            </tr>
          <?php 
          $stt++;
          }
          ?>
          </tbody>
    </table>
    </form>
    <div style="clear:both;"></div>
<!--    <h1>Danh sách Cities</h1>
    <form action="<?php echo base_url();?>admin/cities/remove_cities" method="post" id="from-tindang">
        <table class="TableGrid datatables" cellpadding="0" cellspacing="0" border="0" id="tbl_danhsachhoadon">
            <thead>
                <tr>
                    <th width="5%">Stt</th>
                    <th width="10%">Mã Cities</th>
                    <th width="10%">Tên Cities</th>
                    <th width="50%">Số lượng bài viết</th>
                    <th width="10%">Trạng thái</th>
                    <th width="15%">
                        <input type="checkbox" onclick="toggle(this)" />&nbsp;<font color="#000000">Chọn tất cả</font>
                        <button type="submit" class="btn" name="btnDeleteall" onclick="return confirm('Are you sure you want to do that?');">
                            <span>Xóa</span>
                        </button>
                        <a class="them_cities" href="<?php echo base_url();?>admin/cities/add_cities">Thêm Cities</a>
                    </th>
                </tr>
            </thead>
            <tbody>
            <?php
            $stt=1;
            foreach ($listCities as $row)
            { 
            ?>
            <tr class="odd <?php if($stt%2!=0)echo 'tr_two';?>">
                <td  width="5%"><?php echo $stt?></td>
                <td  width="10%" ><?php echo $row->id?></td>
                <td  width="10%" ><?php echo $row->name_cities;?></td>
                <td  width="10%" ><?php echo count($row->idArticlesCategorie);?>&nbsp;&nbsp;<a href="<?php echo URL;?>admin/article/index/<?php echo $row->id;?>"><img src="<?php echo IMAGES;?>go_items.png" /></a></td>
                <td  width="10%" >
                <a title="Duyệt tuyển dụng" href="<?php echo base_url();?>admin/cities/enable/<?php echo $row->enable_cities?>/<?php echo $row->id?>"
                <?php if($row->enable_cities==1) echo 'class="daenable"'; else echo 'class="chuaenable"';?> 
                id="status">
                <?php 
                    if($row->enable_cities==1)
                    {
                        echo 'Bật';
                    }
                    else
                    echo 'Tắt';
                ?></a><br>
                </td>
                <td width="15%">
                    <a id="edit-hoadon" href="<?php echo URL;?>admin/cities/edit_cities/<?php echo $row->id;?>">[&nbsp;Sửa&nbsp;]</a>
                    <input type="checkbox" name="delete[]" value="<?php echo $row->id;?>" />   
                </td>
            </tr>
          <?php 
          $stt++;
          }
          ?>
          </tbody>
    </table>
    </form>
    <div style="clear:both;"></div>
    -->